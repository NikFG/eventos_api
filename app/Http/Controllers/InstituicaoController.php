<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstituicaoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $instituicoes = Instituicao::all();
        return response()->json($instituicoes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'max:200', 'min:3'],
            'cnpj' => ['required', 'cnpj', 'unique:instituicoes'],
            'endereco' => ['required', 'max:500', 'string'],
            'cidade' => ['required', 'string', 'max:100', 'min:3'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $instituicao = new Instituicao();

        $instituicao->nome = $request->nome;
        $instituicao->cnpj = $request->cnpj;
        $instituicao->endereco = $request->endereco;
        $instituicao->logo = "";//$request->logo;
        $instituicao->cidade = $request->cidade;
        $instituicao->administrador()->associate($user->id);
        $instituicao->save();
        $user->instituicao_id = $instituicao->id;
        $user->save();
        $user->assignRole('admin');
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'max:200', 'min:3'],
            'endereco' => ['required', 'max:500', 'string'],
            'cidade' => ['required', 'string', 'max:100', 'min:3'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $instituicao = Instituicao::find($id);

        $instituicao->nome = $request->nome;
        $instituicao->endereco = $request->endereco;
        $instituicao->cidade = $request->cidade;
        $instituicao->save();
        return response()->json([], 201);
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


    public function showByUser() {
        $user = Auth::user();
        $instituicao = Instituicao::find($user->instituicao_id);
        return response()->json($instituicao);
    }

    public function transferirAdmin(Request $request) {
        $admin = Auth::user();
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return response()->json(["msg" => "Usuário não existente, verifique o email digitado"], 422);
        }
        $user->instituicao()->associate($admin->instituicao_id);
        $user->save();
        $user->assignRole('admin');

        if (!$user->hasRole('associado')) {
            $user->assignRole('associado');
        }
        $admin->removeRole('admin');
        if ($request->permanece == false) {
            $admin->removeRole('associado');
            $admin->instituicao_id = null;
            $admin->save();
        }
        return response()->json([], 201);
    }


    //Associados

    public function addAssociado(Request $request) {
        $admin = Auth::user();
        $user = User::where('email', $request->email)->first();
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Usuário não encontrado'], 422);
        }
        $user->instituicao()->associate($admin->instituicao_id);
        $user->save();
        $user->assignRole('associado');
        return response()->json($user);
    }

    public function getAssociados() {
        $user = Auth::user();

        $instituicao = Instituicao::find($user->instituicao_id);
        $associados = $instituicao
            ->associados($user->id)
            ->where('instituicao_id', $instituicao->id)
            ->get();
        return response()->json($associados);
    }

    public function deleteAssociado($email) {
        $user = Auth::user();
        $validator = Validator::make(['email' => $email], [
            'email' => ['required', 'email', 'max:255', 'min:3', 'exists:users,email']
        ]);
        if ($validator->fails()) {
            return response()->json('Usuário não encontrado', 422);
        }
        $associado = User::where('email', $email)->first();
        $associado->removeRole('associado');
        $associado->instituicao()->dissociate();
        $associado->save();

        return response()->json($associado);
    }
}
