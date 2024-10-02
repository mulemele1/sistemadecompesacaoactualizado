<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDispensaRequest;
use App\Models\Participante;
use App\Models\Dispensa;
use App\Models\Projecto;
use App\Models\Recepcao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DispensaController extends Controller
{
    public function list(Request $request)
    {
        //$dispensas = Dispensa::where('id', 'LIKE', "%{$request->search}%")->get();
        $dispensas = DB::table('dispensas')
            ->join('participantes', 'dispensas.participante_id', '=', 'participantes.id')
            ->join('projectos', 'dispensas.projecto_id', '=', 'projectos.id')
            ->join('recepcaos', 'dispensas.recepcao_id', '=', 'recepcaos.id')
            ->select('dispensas.*', 'participantes.codigo', 'projectos.acronimo', 'recepcaos.name')
            ->where('projectos.acronimo', 'LIKE', "%{$request->search}%")
            ->get();
        return view('dispensas/list', compact('dispensas'));
    }
    public function show($id)
    {
        if (!$dispensa = Dispensa::find($id))
            return redirect()->route('dispensas.list');
        return view('dispensas/show', compact('dispensa'));
    }
    public function create()
    {
        $recepcaos = Recepcao::all(['id', 'name']);
        $projectos = Projecto::all();
        $participantes = Participante::all(['id', 'codigo']);
        return view('dispensas.create', compact('projectos', 'recepcaos', 'participantes'));
    }
    public function store(StoreUpdateDispensaRequest $request)
    {
        $data = $request->all();
        $dispensa = Dispensa::create($data);
        return redirect()->route('dispensas.list');
    }
    public function edit($id)
    {
        //$dispensas = Dispensa::find($id);
        if (!$dispensa = Dispensa::find($id))
            return redirect()->route('dispensas.list');
        $projecto = Projecto::find($dispensa->projecto_id);
        $participante = Participante::find($dispensa->participante_id);
        $recepcao = Recepcao::find($dispensa->recepcao_id);
        $participantes = Participante::all(['id', 'codigo']);
        $projectos = Projecto::all();
        $recepcaos = Recepcao::all(['id', 'name']);
        return view('dispensas/edit', compact(
            'projecto',
            'participante',
            'projectos',
            'recepcaos',
            'recepcao',
            'participantes',
            'dispensa'
        ));
    }
    public function update(StoreUpdateDispensaRequest $request, $id)
    {
        if (!$dispensa = Dispensa::find($id))
            return redirect()->route('dispensas.list');
        $data = $request->all();
        $dispensa->update($data);
        return redirect()->route('dispensas.list');
    }
    public function delete($id)
    {
        if (!$dispensa = Dispensa::find($id))
            return redirect()->route('dispensas.list');
        $dispensa->delete();

        return redirect()->route('dispensas.list');
    }
}
