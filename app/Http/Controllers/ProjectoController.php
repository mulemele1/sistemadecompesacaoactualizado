<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProjectoRequest;
use App\Models\Projecto;
use App\Models\Fonte; // Certifique-se de importar o modelo Fonte
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Adicione esta linha

class ProjectoController extends Controller
{
    public function list(Request $request) {
        // Se quiser filtrar por acrônimo, descomente a linha abaixo
        $projectos = Projecto::where('acronimo', 'LIKE', "%{$request->search}%")->get();
        
        
        $projectos = DB::table('projectos')
            ->join('fontes', 'projectos.fonte_id', '=', 'fontes.id') // Junção correta
            ->select('projectos.*', 'fontes.name as fonte_nome') // Use 'name' se for o nome correto
            ->get(); // Executa a consulta
    
        return view('projectos.list', compact('projectos')); // Retorna a view com os dados
    }

    public function show($id) {
        if (!$projecto = Projecto::find($id))
            return redirect()->route('projectos.list');
        return view('projectos/show', compact('projecto'));
    }

    public function create() {
        $fontes = Fonte::all(['id', 'name']);
        return view('projectos.create', compact('fontes')); // Passa as fontes para a view
    }

    public function store(StoreUpdateProjectoRequest $request) {
        $data = $request->all();
        //$data['status'] = strtoupper($data['status']); // Garantir que o status seja em maiúsculas
        Projecto::create($data);
        return redirect()->route('projectos.list');
    }

    public function edit($id) {
        if (!$projecto = Projecto::find($id))
            return redirect()->route('projectos.list');
        
        $fonte = Fonte::find($projecto->fonte_id); // Corrigido o acesso ao fonte_id
        $fontes = Fonte::all(['id', 'name']);
        return view('projectos/edit', compact('projecto', 'fontes', 'fonte')); // Passa as fontes e o fonte selecionado
    }

    public function update(StoreUpdateProjectoRequest $request, $id) {
        if (!$projecto = Projecto::find($id))
            return redirect()->route('projectos.list');
        
        $data = $request->all();
        $projecto->update($data);
        return redirect()->route('projectos.list');
    }

    public function delete($id) {
        if (!$projecto = Projecto::find($id))
            return redirect()->route('projectos.list');
        
        $projecto->delete();
        return redirect()->route('projectos.list');
    }
}