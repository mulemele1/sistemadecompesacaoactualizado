<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestao; // Corrigido para o namespace correto
use App\Http\Requests\StoreUpdateGestaoRequest; // Certifique-se de que este request existe

class GestaoController extends Controller
{
    public function list(Request $request)
    {
        $gestaos = Gestao::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('gestaos.list', compact('gestaos')); // Corrigido o caminho da view
    }

    public function show($id)
    {
        $gestao = Gestao::find($id);
        if (!$gestao) {
            return redirect()->route('gestaos.list');
        }
        return view('gestaos.show', compact('gestao')); // Corrigido o caminho da view
    }

    public function create()
    {
        return view('gestaos.create');
    }

    public function store(StoreUpdateGestaoRequest $request)
    {
        $data = $request->validated(); // Use validated() para obter dados validados
        Gestao::create($data);
        return redirect()->route('gestaos.list');
    }

    public function edit($id)
    {
        $gestao = Gestao::find($id);
        if (!$gestao) {
            return redirect()->route('gestaos.list');
        }
        return view('gestaos.edit', compact('gestao')); // Corrigido o caminho da view
    }

    public function update(StoreUpdateGestaoRequest $request, $id)
    {
        $gestao = Gestao::find($id);
        if (!$gestao) {
            return redirect()->route('gestaos.list');
        }
        $data = $request->validated(); // Use validated() para obter dados validados
        $gestao->update($data);
        return redirect()->route('gestaos.list');
    }

    public function delete($id)
    {
        $gestao = Gestao::find($id);
        if (!$gestao) {
            return redirect()->route('gestaos.list');
        }
        $gestao->delete();
        return redirect()->route('gestaos.list');
    }
}