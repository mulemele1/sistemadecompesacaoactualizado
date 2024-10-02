<?php

namespace App\Http\Controllers;

use App\Models\Requisicaocispo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateRequisicaocispoRequest;
use App\Models\Projecto;
use App\Models\Gerencia;
use App\Models\Administracao;
use Illuminate\Support\Facades\DB;

class RequisicaocispoController extends Controller
{
    // Listagem das requisições
    public function list(Request $request)
    {
        // Recebe o termo de pesquisa ou vazio por padrão
        $search = $request->input('search', '');

        // Consulta com joins nas tabelas relacionadas
        $requisicaocispos = DB::table('requisicaocispos')
            ->join('gerencias', 'requisicaocispos.gerencia_id', '=', 'gerencias.id') 
            ->join('projectos', 'requisicaocispos.projecto_id', '=', 'projectos.id')
            ->join('administracaos', 'requisicaocispos.administracao_id', '=', 'administracaos.id')
            ->select('requisicaocispos.*', 'administracaos.nome', 'projectos.acronimo', 'gerencias.name')
            ->where('projectos.acronimo', 'LIKE', "%{$search}%")
            ->get();

        // Retorna a view de listagem passando os dados
        return view('requisicaocispos.list', compact('requisicaocispos'));
    }

    // Exibir detalhes de uma requisição
    public function show($id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicaocispo::find($id)) {
            session()->flash('error', 'Requisição não encontrada!');
            return redirect()->route('requisicaocispos.list');
        }

        // Retorna a view de detalhes
        return view('requisicaocispos.show', compact('requisicao'));
    }

    // Exibir formulário de criação de requisição
    public function create()
    {
        // Carrega os dados necessários para o formulário
        $administracaos = Administracao::all(['id', 'nome']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $gerencias = Gerencia::all(['id', 'name']);

        // Retorna a view de criação passando os dados
        return view('requisicaocispos.create', compact('administracaos', 'projectos', 'gerencias'));
    }

    // Salvar nova requisição
    public function store(StoreUpdateRequisicaocispoRequest $request)
    {
        // Recebe os dados validados
        $data = $request->all();

        // Cria a nova requisição
        Requisicaocispo::create($data);

        // Redireciona para a lista com mensagem de sucesso
        session()->flash('success', 'Requisição criada com sucesso!');
        return redirect()->route('requisicaocispos.list');
    }

    // Exibir formulário de edição de uma requisição
    public function edit($id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicaocispo::find($id)) {
            session()->flash('error', 'Requisição não encontrada!');
            return redirect()->route('requisicaocispos.list');
        }

        // Carrega os dados necessários para o formulário de edição
        $administracaos = Administracao::all(['id', 'nome']);
        $projectos = Projecto::all(['id', 'acronimo']);
        $gerencias = Gerencia::all(['id', 'name']);

        // Retorna a view de edição passando os dados
        return view('requisicaocispos.edit', compact('requisicao', 'administracaos', 'projectos', 'gerencias'));
    }

    // Atualizar uma requisição
    public function update(StoreUpdateRequisicaocispoRequest $request, $id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicaocispo::find($id)) {
            session()->flash('error', 'Requisição não encontrada!');
            return redirect()->route('requisicaocispos.list');
        }

        // Recebe os dados validados
        $data = $request->all();

        // Atualiza os dados da requisição
        $requisicao->update($data);

        // Redireciona para a lista com mensagem de sucesso
        session()->flash('success', 'Requisição atualizada com sucesso!');
        return redirect()->route('requisicaocispos.list');
    }

    // Excluir uma requisição
    public function delete($id)
    {
        // Verifica se a requisição existe, caso contrário redireciona
        if (!$requisicao = Requisicaocispo::find($id)) {
            session()->flash('error', 'Requisição não encontrada!');
            return redirect()->route('requisicaocispos.list');
        }

        // Exclui a requisição
        $requisicao->delete();

        // Redireciona para a lista com mensagem de sucesso
        session()->flash('success', 'Requisição excluída com sucesso!');
        return redirect()->route('requisicaocispos.list');
    }
}
