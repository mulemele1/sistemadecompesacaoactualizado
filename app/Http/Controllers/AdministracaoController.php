<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateAdministracaoRequest;
use App\Models\Administracao;
use Illuminate\Http\Request;

class AdministracaoController extends Controller
{
    public function list(Request $request){
        $administracaos = Administracao::where('nome', 'LIKE', "%{$request->search}%")->get();
        return view('administracaos/list', compact('administracaos'));
    }
    public function show($id)
    {
        if (!$administracao = Administracao::find($id))
            return redirect()->route('administracaos.list');
        return view('administracaos/show', compact('administracao'));
    }
    public function create()
    {
        return view('administracaos.create');
    }
    public function store(StoreUpdateAdministracaoRequest $request)
    {
        $data = $request->all();
        $administracao = Administracao::create($data);
        return redirect()->route('administracaos.list');
    }
    public function edit($id)
    {
        //$administracaos = Administracao::find($id);
        if (!$administracao = Administracao::find($id))
            return redirect()->route('administracaos.list');
        return view('administracaos/edit', compact('administracao'));
    }
    public function update(StoreUpdateAdministracaoRequest $request, $id)
    {
        if (!$administracao = Administracao::find($id))
            return redirect()->route('administracaos.list');
        $data = $request->all();
        $administracao->update($data);
        return redirect()->route('administracaos.list');
    }
    public function delete($id)
    {
        if (!$administracao = Administracao::find($id))
            return redirect()->route('administracaos.list');
            $administracao->delete();

        return redirect()->route('administracaos.list');
    }
}
