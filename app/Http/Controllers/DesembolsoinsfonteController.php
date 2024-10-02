<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateDesembolsoinsfonteRequest;
use App\Models\Fonte;
use App\Models\Projecto;
use App\Models\Gestao;
use App\Models\Desembolsoinsfonte;
use Illuminate\Support\Facades\DB;

class DesembolsoinsfonteController extends Controller
{
    public function list(Request $request)
    {
        $desembolsoinsfontes = DB::table('desembolsoinsfontes')
            ->join('fontes', 'desembolsoinsfontes.fonte_id', '=', 'fontes.id')
            ->join('projectos', 'desembolsoinsfontes.projecto_id', '=', 'projectos.id')
            ->join('gestaos', 'desembolsoinsfontes.daf_id', '=', 'gestaos.id') 
            ->select('desembolsoinsfontes.*', 'fontes.name AS fonte_name', 'projectos.acronimo', 'gestaos.name AS gesto_name')
            ->where('projectos.acronimo', 'LIKE', "%{$request->search}%")
            ->get();
    
        return view('desembolsoinsfontes.list', compact('desembolsoinsfontes'));
    }

    public function show($id)
    {
        if (!$desembolsoinsfonte = Desembolsoinsfonte::find($id)) {
            return redirect()->route('desembolsoinsfontes.list');
        }
        return view('desembolsoinsfontes.show', compact('desembolsoinsfonte'));
    }

    public function create()
    {
        $fontes = Fonte::all(['id', 'name']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $gestaos = Gestao::all(['id', 'name']);
        return view('desembolsoinsfontes.create', compact('projectos', 'fontes', 'gestaos'));
    }

    public function store(StoreUpdateDesembolsoinsfonteRequest $request)
    {
        $data = $request->all();
        Desembolsoinsfonte::create($data);
        return redirect()->route('desembolsoinsfontes.list');
    }

    public function edit($id)
    {
        if (!$desembolsoinsfonte = Desembolsoinsfonte::find($id)) {
            return redirect()->route('desembolsoinsfontes.list');
        }

        $fontes = Fonte::all();
        $projectos = Projecto::all(['id', 'acronimo']);
        $gestaos = Gestao::all();
        
        return view('desembolsoinsfontes.edit', compact('desembolsoinsfonte', 'fontes', 'projectos', 'gestaos'));
    }
 
   public function update(StoreUpdateDesembolsoinsfonteRequest $request, $id)
{
    if (!$desembolsoinsfonte = Desembolsoinsfonte::find($id)) {
        return redirect()->route('desembolsoinsfontes.list');
    }

    $data = $request->all();
    
    // Atualiza o status na base de dados
    DB::table('desembolsoinsfontes')->where('id', $id)->update(['status' => $data['status']]);

    $desembolsoinsfonte->update($data);

    return redirect()->route('desembolsoinsfontes.list');
}


    public function delete($id)
    {
        if (!$desembolsoinsfonte = Desembolsoinsfonte::find($id)) {
            return redirect()->route('desembolsoinsfontes.list');
        }
        
        $desembolsoinsfonte->delete();
        return redirect()->route('desembolsoinsfontes.list');
    }
}