<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gerencia; // Corrigido para o namespace correto
use App\Http\Requests\StoreUpdateGerenciaRequest; // Certifique-se de que este request existe

class GerenciaController extends Controller
{
    public function list(Request $request)
    {
        $gerencias = Gerencia::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('gerencias.list', compact('gerencias')); // Corrigido o caminho da view
    }

    public function show($id)
    {
        $gerencia = Gerencia::find($id);
        if (!$gerencia) {
            return redirect()->route('gerencias.list');
        }
        return view('gerencias.show', compact('gerencia')); // Corrigido o caminho da view
    }

    public function create()
    {
        return view('gerencias.create');
    }

    public function store(StoreUpdateGerenciaRequest $request)
    {
        $data = $request->validated(); // Use validated() para obter dados validados
        Gerencia::create($data);
        return redirect()->route('gerencias.list');
    }

    public function edit($id)
    {
        $gerencia = Gerencia::find($id);
        if (!$gerencia) {
            return redirect()->route('gerencias.list');
        }
        return view('gerencias.edit', compact('gerencia')); // Corrigido o caminho da view
    }

    public function update(StoreUpdateGerenciaRequest $request, $id)
    {
        $gerencia = Gerencia::find($id);
        if (!$gerencia) {
            return redirect()->route('gerencias.list');
        }
        $data = $request->validated(); // Use validated() para obter dados validados
        $gerencia->update($data);
        return redirect()->route('gerencias.list');
    }

    public function delete($id)
    {
        $gerencia = Gerencia::find($id);
        if (!$gerencia) {
            return redirect()->route('gerencias.list');
        }
        $gerencia->delete();
        return redirect()->route('gerencias.list');
    }
}