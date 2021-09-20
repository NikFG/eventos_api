<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Senha;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'cpf' => 'required|cpf|unique:users',
            'password' => ['required', 'string', 'confirmed', Senha::min(6)->mixedCase()->numbers()->uncompromised(3)],
            'telefone' => 'required|celular_com_ddd',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            return response()->json([], 409);
        }
        $user = new User();
        $user->nome = $request->nome;
        $user->cpf = $request->cpf;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->telefone = $request->telefone;
        $user->save();
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }


}
