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
    public function list(Request $request){
        // $participantes = Participante::where('codigo', 'LIKE', "%{$request->search}%")->get();
        $participantes = DB::table('participantes')
        ->join('projectos', 'participantes.projecto_id', '=', 'projectos.id')
        ->select('participantes.*', 'projectos.acronimo')
        ->where('participantes.codigo', 'LIKE', "%{$request->search}%")
        ->get();
        return view('participantes/list', compact('participantes'));
    }
    public function show($id)
    {
        if (!$participante = Participante::find($id))
            return redirect()->route('participantes.list');
        return view('participantes/show', compact('participante'));
    }
    public function create()
    {
        $projectos = Projecto::all(['id', 'acronimo']);
        return view('participantes.create', compact('projectos'));
    }
    public function store(StoreUpdateParticipanteRequest $request)
    {
        $data = $request->all();
        $participante = Participante::create($data);
        return redirect()->route('participantes.list');
    }
    public function edit($id)
    {
        //$participantes = Participante::find($id);
        if (!$participante = Participante::find($id))
            return redirect()->route('participantes.list');
            $projectos = Projecto::all(['id', 'acronimo']);
        return view('participantes/edit', compact('participante', 'projectos'));
    }
    public function update(StoreUpdateParticipanteRequest $request, $id)
    {
        if (!$participante = Participante::find($id))
            return redirect()->route('participantes.list');
        $data = $request->all();
        $participante->update($data);
        return redirect()->route('participantes.list');
    }
    public function delete($id)
    {
        if (!$participante = Participante::find($id))
            return redirect()->route('participantes.list');
            $participante->delete();

        return redirect()->route('participantes.list');
    }


    //METODO CARREGAR IMPORTAR E GUARDAR
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
            Participante::updateOrCreate(
                ['codigo' => $participante['codigo']],
                ['projecto_id' => $participante['projecto_id']]
            );
        }

        return response()->json(['success' => true, 'message' => 'Dados guardados com sucesso!']);
    }

    public function index()
    {
        return view('import');
    }
    //...
    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ParticipantesImport, $file);
        return back()->with('success', 'Products imported successfully.');
    }


}
