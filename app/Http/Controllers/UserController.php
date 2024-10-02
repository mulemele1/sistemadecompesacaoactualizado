<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = User::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('users/list', compact('users'));
    }
    public function show($id)
    {
        //$users = User::find($id);
        if (!$user = User::find($id))
            return redirect()->route('users.list');
        return view('users/show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }
    public function store(StoreUpdateUserFormRequest $request)
    {
        /*Criando um utilizador e criptografando a palavra passe antes de salvar
        o registro e retirar a informação do utilizador para mostrar os detalhes*/
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return redirect()->route('users.list');
        //ou return redirect()->route('users.show', $user->id);


        //Forma alternativa de salvar um registro
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();
    }
    public function edit($id)
    {
        //$users = User::find($id);
        if (!$user = User::find($id))
            return redirect()->route('users.list');
        return view('users/edit', compact('user'));
    }
    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        //$users = User::find($id);
        if (!$user = User::find($id))
            return redirect()->route('users.list');
        $data = $request->all();
        if ($request->password)
            $data['password'] = bcrypt($request->password);
        $user->update($data);
        return redirect()->route('users.list');
    }
    public function delete($id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.list');
            $user->delete();

        return redirect()->route('users.list');
    }
}
