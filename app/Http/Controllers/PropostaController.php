<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePropostaRequest;
use App\Models\Projecto;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropostaController extends Controller
{
    public function list(Request $request){
        $propostas = DB::table('propostas')
        ->join('projectos', 'propostas.projecto_id', '=', 'projectos.id')
        ->select('propostas.*', 'projectos.acronimo')
        ->where('projectos.acronimo', 'LIKE', "%{$request->search}%")
        ->get();
        return view('propostas/list', compact('propostas'));
    }
    public function show($id)
    {
        if (!$proposta = Proposta::find($id))
            return redirect()->route('propostas.list');
        return view('propostas/show', compact('proposta'));
    }
    public function create()
    {
        $projectos = Projecto::all(['id', 'acronimo']);
        return view('propostas.create', compact('projectos'));
    }
    public function store(StoreUpdatePropostaRequest $request)
    {
        $data = $request->all();
        //$data['status'] = strtoupper($data['status']);  Garantir que o status seja em maiúsculas
        // Gera o número da proposta automaticamente
        $data['numero_prop'] = $this->generateNumeroProp();
        // Adiciona a descrição fixa
        $data['descricao'] = 'Valor de compesação';
        //$data['status'] = 'Pendente';
        $proposta = Proposta::create($data);
        return redirect()->route('propostas.list');
    }
    private function generateNumeroProp()
    {
        // Lógica para gerar um número de proposta único
        $lastProposta = Proposta::orderBy('id', 'desc')->first();
        return $lastProposta ? $lastProposta->id + 1 : 1; // Começa de 1
    }

    public function edit($id)
    {
        //$propostas = Proposta::find($id);
        if (!$proposta = Proposta::find($id))
        return redirect()->route('propostas.list');
        $projecto=$proposta->projecto;
        return view('propostas/edit', compact('proposta', 'projecto'));
    }
    public function update(StoreUpdatePropostaRequest $request, $id)
    {
        if (!$proposta = Proposta::find($id))
            return redirect()->route('propostas.list');
        $data = $request->all();
        $proposta->update($data);
        return redirect()->route('propostas.list');
    }
    public function delete($id)
    {
        if (!$proposta = Proposta::find($id))
            return redirect()->route('propostas.list');
            $proposta->delete();

        return redirect()->route('propostas.list');
    }
}
