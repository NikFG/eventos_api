<?php

namespace App\Http\Controllers;

use App\Models\ModeloCertificado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ModeloCertificadoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $u = Auth::user();
        $modelos = ModeloCertificado::where('instituicao_id', $u->instituicao_id)->get();
        return response()->json($modelos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'imagem_fundo' => ['required', 'image'],
            'assinatura' => ['required', 'image'],
            'logo' => ['required', 'image'],
            'nome_assinatura' => ['required', 'string', 'max:100'],
            'cargo_assinatura' => ['required', 'string', 'max:50'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        DB::transaction(function () use ($user, $request) {

            $m = new ModeloCertificado();
            $m->nome_assinatura = $request->nome_assinatura;
            $m->cargo_assinatura = $request->cargo_assinatura;
            $m->instituicao()->associate($user->instituicao_id);
            $m->save();

            $path = "images/modelo/{$m->id}";
            $imagem_fundo = $request->file('imagem_fundo');
            $nome_imagem_fundo = $path . "/imagemfundo/" . Str::uuid() . '-' . $imagem_fundo->getClientOriginalName();
            Storage::cloud()->put($nome_imagem_fundo, $imagem_fundo->getContent());

            $logo = $request->file('logo');
            $nome_logo = $path . "/logo/" . Str::uuid() . '-' . $logo->getClientOriginalName();
            Storage::cloud()->put($nome_logo, $logo->getContent());

            $assinatura = $request->file('assinatura');
            $path_assinatura = $path . "/assinatura/" . Str::uuid() . '-' . $assinatura->getClientOriginalName();
            Storage::cloud()->put($path_assinatura, $assinatura->getContent());

            $m->imagem_fundo = Storage::cloud()->url($nome_imagem_fundo);
            $m->logo = Storage::cloud()->url($nome_logo);
            $m->assinatura = Storage::cloud()->url($path_assinatura);

            $m->save();
        });
        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $u = Auth::user();
        $modelo_certificado = ModeloCertificado::find($id);
        return response()->json($modelo_certificado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }
}
