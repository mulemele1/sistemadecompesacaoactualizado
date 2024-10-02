<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRecepcaoRequest;
use App\Models\Recepcao;
use Illuminate\Http\Request;

class RecepcaoController extends Controller
{
    public function list(Request $request){
        $recepcaos = Recepcao::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('recepcaos/list', compact('recepcaos'));
    }
    public function show($id)
    {
        if (!$recepcao = Recepcao::find($id))
            return redirect()->route('recepcaos.list');
        return view('recepcaos/show', compact('recepcao'));
    }
    public function create()
    {
        return view('recepcaos.create');
    }
    public function store(StoreUpdateRecepcaoRequest $request)
    {
        $data = $request->all();
        $recepcao = Recepcao::create($data);
        return redirect()->route('recepcaos.list');
    }
    public function edit($id)
    {
        //$recepcaos = Recepcao::find($id);
        if (!$recepcao = Recepcao::find($id))
            return redirect()->route('recepcaos.list');
        return view('recepcaos/edit', compact('recepcao'));
    }
    public function update(StoreUpdateRecepcaoRequest $request, $id)
    {
        if (!$recepcao = Recepcao::find($id))
            return redirect()->route('recepcaos.list');
        $data = $request->all();
        $recepcao->update($data);
        return redirect()->route('recepcaos.list');
    }
    public function delete($id)
    {
        if (!$recepcao = Recepcao::find($id))
            return redirect()->route('recepcaos.list');
            $recepcao->delete();

        return redirect()->route('recepcaos.list');
    }
}
