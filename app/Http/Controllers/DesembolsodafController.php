<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateDesembolsodafRequest;
use App\Models\Projecto;
use App\Models\Gestao;
use App\Models\Desembolsodaf;
use App\Models\Gerencia;
use Illuminate\Support\Facades\DB;

class DesembolsodafController extends Controller
{
    public function list(Request $request)
    {
        $desembolsodafs = DB::table('desembolsodafs')
            ->join('gestaos', 'desembolsodafs.daf_id', '=', 'gestaos.id')
            ->join('projectos', 'desembolsodafs.projecto_id', '=', 'projectos.id')
            ->join('gerencias', 'desembolsodafs.administracao_id', '=', 'gerencias.id') 
            ->select('desembolsodafs.*', 'gestaos.name AS gestao_name', 'projectos.acronimo AS projecto_acronimo', 'gerencias.name AS gerencia_name')
            ->where('projectos.acronimo', 'LIKE', "%{$request->search}%")
            ->get();
    
        return view('desembolsodafs.list', compact('desembolsodafs'));
    }
    

    public function show($id)
    {
        if (!$desembolsodaf = Desembolsodaf::find($id)) {
            return redirect()->route('desembolsodafs.list');
        }
        return view('desembolsodafs.show', compact('desembolsodaf'));
    }

    public function create()
    {
        $gestaos = Gestao::all(['id', 'name']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $gerencias = Gerencia::all(['id', 'name']);
        return view('desembolsodafs.create', compact('gestaos', 'projectos', 'gerencias'));
    }

    public function store(StoreUpdatedesembolsodafRequest $request)
    {
        $data = $request->all();
        Desembolsodaf::create($data);
        return redirect()->route('desembolsodafs.list');
    }

    public function edit($id)
    {
        if (!$desembolsodaf = Desembolsodaf::find($id)) {
            return redirect()->route('desembolsodafs.list'); 
        }

        $gestaos = Gestao::all();
        $projectos = Projecto::all(['id', 'acronimo']);
        $gerencias = Gerencia::all();
        
        return view('desembolsodafs.edit', compact('desembolsodaf', 'gestaos', 'projectos', 'gerencias'));
    }

    public function update(StoreUpdatedesembolsodafRequest $request, $id)
    {
        if (!$desembolsodaf = Desembolsodaf::find($id)) {
            return redirect()->route('desembolsodafs.list');
        }

        $data = $request->all();
        $desembolsodaf->update($data);
        return redirect()->route('desembolsodafs.list');
    }

    public function delete($id)
    {
        if (!$desembolsodaf = Desembolsodaf::find($id)) {
            return redirect()->route('desembolsodafs.list');
        }
        
        $desembolsodaf->delete();
        return redirect()->route('desembolsodafs.list');
    }
}