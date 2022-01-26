<?php

namespace App\Http\Controllers;

use App\Jobs\EnvioEmailJob;
use App\Mail\EnvioEmail;
use App\Models\Apresentador;
use App\Models\Atividade;
use App\Models\Certificado;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CertificadoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $user = Auth::user();
        $certificados = Certificado::where('participante_id', $user->id)->get();
        return response()->json($certificados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function store(Request $request, int $id): JsonResponse {
        $a = Atividade::with('evento')->find($id);
        $participantes = json_decode($request->participantes);
        $apresentadores = json_decode($request->apresentadores);
        $horario_inicio = Carbon::parse($a->horario_inicio);
        $horario_fim = Carbon::parse($a->horario_fim);
        $horas = $horario_fim->diff($horario_inicio);
        $modelo = $request->modelo;
        $horas = $horas->format('%H:%I');
        $atv = new Atividade();


        try {
            DB::transaction(function () use ($modelo, $horas, $a, $participantes, $apresentadores) {
                foreach ($participantes as $p) {
                    Log::info("Participante: " . $p);
                    $data = Carbon::now();
                    $c = new Certificado();
                    $c->descricao = $a->nome;
                    $c->data_emissao = $data->toDateString();
                    $c->data_hora_evento = $a->data;
                    $c->nome_evento = $a->evento->nome;
                    $c->local = $a->local;
                    $c->horas = $horas;
                    $c->participante()->associate($p);
                    $c->evento()->associate($a->evento_id);
                    $c->instituicao()->associate($a->evento->instituicao_id);
                    $c->atividade()->associate($a->id);
                    $c->codigo_verificacao = Hash::make($a->id . '-' . $p);
                    $c->modeloCertificado()->associate($modelo);
                    if ($c->save()) {
                        $a->users()->updateExistingPivot($p, ['participou' => true]);
                        $user = User::findOrFail($c->participante_id);
                        EnvioEmailJob::dispatch($user->nome, $user->email, $c)->delay(now()->addSeconds('3'));
                    }
                }
                foreach ($apresentadores as $ap) {
                    Log::info("Apresentador: " . $ap);
                    $data = Carbon::now();
                    $c = new Certificado();
                    $c->descricao = $a->nome;
                    $c->data_emissao = $data->toDateString();
                    $c->data_hora_evento = $a->data;
                    $c->nome_evento = $a->evento->nome;
                    $c->local = $a->local;
                    $c->horas = $horas;
                    $c->apresentador()->associate($ap);
                    $c->evento()->associate($a->evento_id);
                    $c->instituicao()->associate($a->evento->instituicao_id);
                    $c->atividade()->associate($a->id);
                    $c->codigo_verificacao = Hash::make($a->id . '-' . $ap);
                    $c->modeloCertificado()->associate($modelo);
                    if ($c->save()) {
                        $a->apresentadores()->updateExistingPivot($ap, ['participou' => true]);
                        $apr = Apresentador::findOrFail($c->apresentador_id);
                        EnvioEmailJob::dispatch($apr->nome, $apr->email, $c)->delay(now()->addSeconds('3'));
                    }
                }
            });
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getTrace(), 500);
        }
        return response()->json(null, 201);
    }

    public function gerarCertificado(int $id): JsonResponse {
        $c = Certificado::find($id);

        $user = User::findOrFail($c->participante_id);
        EnvioEmailJob::dispatch($user, $c)->delay(now()->addSeconds('3'));
        /* Mail::send(new EnvioEmail($user,$c));
         if (Mail::failures()) {
             return response()->json(Mail::failures(), 500);
         }*/


        return response()->json(null, 201);
    }

    /*  public function gerarCertificadoByAtividade(int $id): JsonResponse {
          $a = Atividade::find($id);
          $certificados = Certificado::where('atividade_id', $a->id)->get();
          foreach ($certificados as $c) {
              $user = User::findOrFail($c->participante_id);
              EnvioEmailJob::dispatch($user, $c)->delay(now()->addSeconds('3'));
          }
          return response()->json(null, 201);
      }*/
    public function gerarCertificadoByUserAtividade(int $id): JsonResponse {
        $user = Auth::user();
        $atividade = Atividade::whereRelation('users', 'participou', '=', true)->find($id);
        $certificado = Certificado::where('atividade_id', $atividade->id)->where('participante_id', $user->id)->first();
        $user = User::findOrFail($certificado->participante_id);
        Mail::send(new EnvioEmail($user, $certificado));
        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $user = Auth::user();
        $c = Certificado::find($id);
        return response()->json($c);
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

    public function verificaCertificado(Request $request): JsonResponse {
        $certificado = Certificado::where('codigo_verificacao', $request->codigo)->first();

        if ($certificado) {
            $codigo_extra = Hash::check($certificado->atividade_id . '-' . $certificado->apresentador_id, $request->codigo);
            if ($request->codigo == $certificado->codigo_verificacao && $codigo_extra) {

                return response()->json("Certificado válido!", 200);
            }
        }
        return response()->json("Certificado inválido!", 500);
    }
}
