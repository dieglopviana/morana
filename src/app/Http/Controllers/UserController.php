<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\User;
use Exception;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::paginate(5);
        return view('user.index', compact('users'));
    }

    
    public function create()
    {
        return view('user.form');
    }

    
    public function store(StoreUserRequest $request)
    {
        try {
            if (!$request->has('id')){
                if ($user = User::create($request->all())){
                    $request->session()->flash('success', 'Usuário cadastrado com sucesso!');
                } else {
                    throw new \Exception('Erro ao cadastrar o usuário');
                }
            } else {
                $user = User::findOrFail($request->input('id'));

                if ($user){
                    $user->update($request->all());
                    $request->session()->flash('success', 'Usuário alterado com sucesso!');
                } else {
                    throw new \Exception('Usuário não encontrado com o id #' . $request->input('id'));
                }
            }

            return response()->json([
                'status_error' => false,
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status_error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.form', compact('user'));
    }

    
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            if ($user->delete()){
                return response()->json(['status_error' => false], 200);
            } else {
                throw new Exception('Erro ao deletar o usuário #' . $id);
            }
        } catch (\Exception $e) {
            return response()->json(['status_error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}
