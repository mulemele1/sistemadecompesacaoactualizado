<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateParticipanteRequest;
use App\Models\Participante;
use App\Models\Projecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//NOVOS
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParticipantesImport;


class ParticipanteController extends Controller 
{
    public function list(Request $request)
    {
        // Lista os participantes filtrando por código
        $participantes = DB::table('participantes')
            ->join('projectos', 'participantes.projecto_id', '=', 'projectos.id')
            ->select('participantes.*', 'projectos.acronimo')
            ->where('participantes.codigo', 'LIKE', "%{$request->search}%")
            ->get();
            
        return view('participantes/list', compact('participantes'));
    }

    public function show($id)
    {
        // Exibe um participante específico
        if (!$participante = Participante::find($id)) {
            return redirect()->route('participantes.list')->with('error', 'Participante não encontrado!');
        }

        return view('participantes/show', compact('participante'));
    }

    public function create()
    {
        // Formulário de criação de participante
        $projectos = Projecto::all(['id', 'acronimo']);
        return view('participantes.create', compact('projectos'));
    }

    

    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'codigo' => 'required|unique:participantes,codigo',
            'projecto_id' => 'required',
        ], [
            'codigo.unique' => 'O ID do Participante já existe. Por favor, insira um novo.',
        ]);

        // Salvar o participante se passar pela validação
        Participante::create($validatedData);

        return redirect()->route('participantes.list')->with('success', 'Participante adicionado com sucesso!');
    }



    public function edit($id)
    {
        // Edita um participante
        if (!$participante = Participante::find($id)) {
            return redirect()->route('participantes.list')->with('error', 'Participante não encontrado!');
        }

        $projectos = Projecto::all(['id', 'acronimo']);
        return view('participantes/edit', compact('participante', 'projectos'));
    }

    public function update(StoreUpdateParticipanteRequest $request, $id)
{
    // Verifica se o participante existe
    if (!$participante = Participante::find($id)) {
        return redirect()->route('participantes.list')->with('error', 'Participante não encontrado!');
    }

    // Verifica se o código que está sendo atualizado já existe, exceto para o participante atual
    $request->validate([
        'codigo' => 'required|unique:participantes,codigo,' . $participante->id,
        'projecto_id' => 'required',
    ], [
        'codigo.unique' => 'O ID do Participante já existe. Por favor, insira um novo.',
    ]);

    // Atualiza os dados do participante
    $data = $request->all();
    $participante->update($data);

    return redirect()->route('participantes.list')->with('success', 'Participante atualizado com sucesso!');
}


    public function delete($id)
    {
        // Deleta um participante
        if (!$participante = Participante::find($id)) {
            return redirect()->route('participantes.list')->with('error', 'Participante não encontrado!');
        }

        $participante->delete();

        return redirect()->route('participantes.list')->with('success', 'Participante excluído com sucesso!');
    }

    // Métodos de importação e armazenamento de participantes

    public function carregar(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new ParticipantesImport, $request->file('file'));

            return response()->json(['success' => true, 'message' => 'Dados carregados com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro ao carregar os dados: ' . $e->getMessage()]);
        }
    }

    public function guardar(Request $request)
{
    $data = json_decode($request->input('participantes'), true);

    foreach ($data as $participante) {
        // Verifique se o participante já existe
        $existingParticipante = Participante::where('codigo', $participante['codigo'])->first();

        if ($existingParticipante) {
            // Atualize o participante existente
            $existingParticipante->update(['projecto_id' => $participante['projecto_id']]);
        } else {
            // Crie um novo participante
            Participante::create([
                'codigo' => $participante['codigo'],
                'projecto_id' => $participante['projecto_id'],
            ]);
        }
    }

    return response()->json(['success' => true, 'message' => 'Dados guardados com sucesso!']);
}


    public function index()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ParticipantesImport, $file);
        return back()->with('success', 'Participantes importados com sucesso.');
    }
}
