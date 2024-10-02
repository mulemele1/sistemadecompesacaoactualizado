<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDistribuicaoRequest;
use App\Models\Administracao;
use App\Models\Distribuicao;
use App\Models\Projecto;
use App\Models\Recepcao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribuicaoController extends Controller
{
    public function list(Request $request)
    {
        //$distribuicaos = Distribuicao::where('id', 'LIKE', "%{$request->search}%")->get();
        $distribuicaos = DB::table('distribuicaos')
        ->join('administracaos', 'distribuicaos.administracao_id', '=', 'administracaos.id')
        ->join('projectos', 'distribuicaos.projecto_id', '=', 'projectos.id')
        ->join('recepcaos', 'distribuicaos.recepcao_id', '=', 'recepcaos.id')
        ->select('distribuicaos.*', 'administracaos.nome', 'projectos.acronimo',  'recepcaos.name As recepcao_nome')
        ->where('projectos.acronimo', 'LIKE', "%{$request->search}%")
        ->get();
        return view('distribuicaos/list', compact('distribuicaos'));
    }
    public function show($id)
    {
        if (!$distribuicao = Distribuicao::find($id))
            return redirect()->route('distribuicaos.list');
        return view('distribuicaos/show', compact('distribuicao'));
    }
    public function create()
    {
        $administracaos = Administracao::all(['id', 'nome']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $recepcaos = Recepcao::all(['id', 'name']);
        return view('distribuicaos.create', compact('administracaos', 'projectos', 'recepcaos'));
    }
    public function store(StoreUpdateDistribuicaoRequest $request)
    {
        $data = $request->all();
        $distribuicao = Distribuicao::create($data);
        return redirect()->route('distribuicaos.list');
    }
    public function edit($id)
    {
        //$distribuicaos = Distribuicao::find($id);
        if (!$distribuicao = Distribuicao::find($id))
        return redirect()->route('distribuicaos.list');
        $administracao = Administracao::find($distribuicao->administracao_id);
        $projecto = Projecto::find($distribuicao->projecto_id);
        $recepcao = Recepcao::find($distribuicao->recepcao_id);
        $administracaos = Administracao::all(['id', 'nome']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $recepcaos = Recepcao::all(['id', 'name']);
        return view('distribuicaos/edit', compact('distribuicao', 'projecto', 'recepcao','administracao','projectos', 'administracaos','recepcaos'));
    }
    public function update(StoreUpdateDistribuicaoRequest $request, $id)
    {
        if (!$distribuicao = Distribuicao::find($id))
            return redirect()->route('distribuicaos.list');
        $data = $request->all();
        $distribuicao->update($data);
        return redirect()->route('distribuicaos.list');
    }
    public function delete($id)
    {
        if (!$distribuicao = Distribuicao::find($id))
            return redirect()->route('distribuicaos.list');
        $distribuicao->delete();

        return redirect()->route('distribuicaos.list');
    }
}
