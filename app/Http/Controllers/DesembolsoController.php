<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateDesembolsoRequest;
use App\Models\Projecto;
use App\Models\Gerencia;
use App\Models\Desembolso;
use App\Models\Administracao;
use Illuminate\Support\Facades\DB;

class DesembolsoController extends Controller
{
    public function list(Request $request)
    {
        $desembolsos = DB::table('desembolsos')
            ->join('gerencias', 'desembolsos.gerencia_id', '=', 'gerencias.id')
            ->join('projectos', 'desembolsos.projecto_id', '=', 'projectos.id')
            ->join('administracaos', 'desembolsos.administracao_id', '=', 'administracaos.id') 
            ->select('desembolsos.*', 'gerencias.name', 'projectos.acronimo', 'administracaos.nome')
            ->where('projectos.acronimo', 'LIKE', "%{$request->search}%")
            ->get();
    
        return view('desembolsos.list', compact('desembolsos'));
    }
    

    public function show($id)
    {
        if (!$desembolso = Desembolso::find($id)) {
            return redirect()->route('desembolsos.list');
        }
        return view('desembolsos.show', compact('desembolso'));
    }

    public function create()
    {
        $gerencias = Gerencia::all(['id', 'name']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $administracaos = Administracao::all(['id', 'nome']);
        return view('desembolsos.create', compact('gerencias', 'projectos', 'administracaos'));
    }

    public function store(StoreUpdatedesembolsoRequest $request)
    {
        $data = $request->all();
        Desembolso::create($data);
        return redirect()->route('desembolsos.list');
    }

    public function edit($id)
    {
        if (!$desembolso = Desembolso::find($id)) {
            return redirect()->route('desembolsos.list'); 
        }

        $gerencias = Gerencia::all();
        $projectos = Projecto::all(['id', 'acronimo']);
        $administracaos = Administracao::all();
        
        return view('desembolsos.edit', compact('desembolso', 'gerencias', 'projectos', 'administracaos'));
    }

    public function update(StoreUpdatedesembolsoRequest $request, $id)
    {
        if (!$desembolso = Desembolso::find($id)) {
            return redirect()->route('desembolsos.list');
        }

        $data = $request->all();
        $desembolso->update($data);
        return redirect()->route('desembolsos.list');
    }

    public function delete($id)
    {
        if (!$desembolso = Desembolso::find($id)) {
            return redirect()->route('desembolsos.list');
        }
        
        $desembolso->delete();
        return redirect()->route('desembolsos.list');
    }
}