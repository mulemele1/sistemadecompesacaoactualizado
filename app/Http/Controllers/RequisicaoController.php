<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateRequisicaoRequest;
use App\Models\Projecto;
use App\Models\Recepcao;
use App\Models\Requisicao;
use App\Models\Administracao;
use Illuminate\Support\Facades\DB;

class RequisicaoController extends Controller
{
    // Listagem das requisições
    public function list(Request $request)
    {
        // Recebe o termo de pesquisa ou vazio por padrão
        $search = $request->input('search', '');

        // Consulta com joins nas tabelas relacionadas
        $requisicaos = DB::table('requisicaos')
            ->join('administracaos', 'requisicaos.administracao_id', '=', 'administracaos.id')
            ->join('projectos', 'requisicaos.projecto_id', '=', 'projectos.id')
            ->join('recepcaos', 'requisicaos.recepcao_id', '=', 'recepcaos.id') // Corrigido para associar com recepcao_id
            ->select('requisicaos.*', 'administracaos.nome', 'projectos.acronimo', 'recepcaos.name')
            ->where('projectos.acronimo', 'LIKE', "%{$search}%")
            ->get();

        // Retorna a view de listagem passando os dados
        return view('requisicaos.list', compact('requisicaos'));
    }

    // Exibir detalhes de uma requisição
    public function show($id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicao::find($id)) {
            return redirect()->route('requisicaos.list');
        }

        // Retorna a view de detalhes
        return view('requisicaos.show', compact('requisicao'));
    }

    // Exibir formulário de criação de requisição
    public function create()
    {
        // Carrega os dados necessários para o formulário
        $administracaos = Administracao::all(['id', 'nome']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $recepcaos = Recepcao::all(['id', 'name']);

        // Retorna a view de criação passando os dados
        return view('requisicaos.create', compact('administracaos', 'projectos', 'recepcaos'));
    }

    // Salvar nova requisição
    public function store(StoreUpdateRequisicaoRequest $request)
    {
        // Recebe os dados validados
        $data = $request->all();

        // Cria a nova requisição
        Requisicao::create($data);

        // Redireciona para a lista com mensagem de sucesso
        session()->flash('success', 'Requisição criada com sucesso!');
        return redirect()->route('requisicaos.list');
    }

    // Exibir formulário de edição de uma requisição
    public function edit($id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicao::find($id)) {
            return redirect()->route('requisicaos.list');
        }

        // Carrega os dados necessários para o formulário de edição
        $administracaos = Administracao::all(['id', 'nome']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $recepcaos = Recepcao::all(['id', 'name']);

        // Retorna a view de edição passando os dados
        return view('requisicaos.edit', compact('requisicao', 'administracaos', 'projectos', 'recepcaos'));
    }

    // Atualizar uma requisição
    public function update(StoreUpdateRequisicaoRequest $request, $id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicao::find($id)) {
            session()->flash('error', 'Requisição não encontrada!');
            return redirect()->route('requisicaos.list');
        }

        // Recebe os dados validados
        $data = $request->all();

        // Atualiza os dados da requisição
        $requisicao->update($data);

        // Redireciona para a lista com mensagem de sucesso
        session()->flash('success', 'Requisição atualizada com sucesso!');
        return redirect()->route('requisicaos.list');
    }

    // Excluir uma requisição
    public function delete($id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicao::find($id)) {
            session()->flash('error', 'Requisição não encontrada!');
            return redirect()->route('requisicaos.list');
        }

        // Exclui a requisição
        $requisicao->delete();

        // Redireciona para a lista com mensagem de sucesso
        session()->flash('success', 'Requisição excluída com sucesso!');
        return redirect()->route('requisicaos.list');
    }
}
