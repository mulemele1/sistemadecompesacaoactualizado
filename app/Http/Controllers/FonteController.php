<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFonteRequest;
use App\Models\Fonte;
use Illuminate\Http\Request;

class FonteController extends Controller
{
    public function list(Request $request){
        $fontes = Fonte::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('fontes/list', compact('fontes'));
    }
    public function show($id)
    {
        if (!$fonte = Fonte::find($id))
            return redirect()->route('fontes.list');
        return view('fontes/show', compact('fonte'));
    }
    public function create()
    {
        return view('fontes.create');
    }
    public function store(StoreUpdateFonteRequest $request)
    {
        $data = $request->all();
        $fonte = Fonte::create($data);
        return redirect()->route('fontes.list');
    }
    public function edit($id)
    {
        //$fontes = Fonte::find($id);
        if (!$fonte = Fonte::find($id))
            return redirect()->route('fontes.list');
        return view('fontes/edit', compact('fonte'));
    }
    public function update(StoreUpdateFonteRequest $request, $id)
    {
        if (!$fonte = Fonte::find($id))
            return redirect()->route('fontes.list');
        $data = $request->all();
        $fonte->update($data);
        return redirect()->route('fontes.list');
    }
    public function delete($id)
    {
        if (!$fonte = Fonte::find($id))
            return redirect()->route('fontes.list');
            $fonte->delete();

        return redirect()->route('fontes.list');
    }
}
