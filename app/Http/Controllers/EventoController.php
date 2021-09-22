<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Evento;
use App\Models\Instituicao;
use App\Models\ParticipanteAtividade;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])
            ->with('imagens')
            ->with('categoria')
            ->whereHas('atividades')
            ->with('instituicao')
            ->get();
        return response()->json($eventos);
    }

    public function porCategoria($id): JsonResponse {
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])->with('imagens')->with('categoria')
            ->whereRelation('categoria', 'id', '=', $id)
            ->whereHas('atividades')
            ->with('instituicao')
            ->get();
        return response()->json($eventos);
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
            'nome' => ['required', 'string', 'min:10', 'max:100'],
            'expectativa_participantes' => ['required', 'integer'],
            'link_evento' => ['max:100', 'nullable'],
            'breve_descricao' => ['required', 'string', 'max:100'],
            'local' => ['nullable', 'max:500'],
            'descricao' => ['nullable'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'atividades' => ['required'],
            'atividades.*.nome' => ['required', 'max:255'],
            'atividades.*.data' => ['required', 'date', 'after:today'],
            'atividades.*.horario_inicio' => ['required', 'date_format:H:i'],
            'atividades.*.horario_fim' => ['required', 'date_format:H:i', 'after:atividades.*.horario_inicio'],
            'atividades.*.local' => ['nullable', 'max:200'],
            'atividades.*.link_tranmissao' => ['nullable', 'max:400'],
            'atividades.*.descricao' => ['nullable'],
            'atividades.*.tipo_atividade_id' => ['required', 'exists:tipo_atividades,id'],
            'atividades.*.nome_apresentador' => ['required', 'string', 'min:3', 'max:255'],
            'atividades.*.email_apresentador' => ['required', 'email'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $instituicao = Instituicao::whereRelation('administrador', 'id', $user->id)->first();
        $e = new Evento();
        $e->nome = $request->nome;
        $e->breve_descricao = $request->breve_descricao;
        $e->expectativa_participantes = $request->expectativa_participantes;
        $e->link_evento = $request->link_evento;
        $e->local = $request->local;
        $e->descricao = $request->descricao;
        $e->tipo_id = 1;
        $e->instituicao_id = $instituicao->id;
        $e->categoria()->associate($request->categoria_id);
        $e->user()->associate($user->id);
        $e->save();

        //criar atividades
        $atividades = json_decode($request->atividades);

        foreach ($atividades as $atv) {
            $a = new Atividade();
            $a->nome = $atv->nome;
            $a->data = $atv->data;
            $a->horario_inicio = $atv->horario_inicio;
            $a->horario_fim = $atv->horario_fim;
            $a->tipo_atividade()->associate($atv->tipo_atividade_id);
            $a->evento()->associate($e->id);
            $a->nome_apresentador = $atv->nome_apresentador;
            $a->email_apresentador = $atv->email_apresentador;
            $apr = User::firstWhere('email', $a->email_apresentador);
            if ($apr != null) {
                $a->apresentador()->associate($apr->id);
            }
            $a->save();
        }


        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse {
        $evento = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])->
        withCount(['atividades as apresentadores_count' => function ($query) {
            $query->select(DB::raw('count(distinct(email_apresentador))'));
        }])->find($id);
        return response()->json($evento);
    }

    public function search($query): JsonResponse {
        $queryLower = trim(strtolower($query));
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }])
            ->where(DB::raw('lower(nome)'), 'like', '%' . $queryLower . '%')
            ->orWhere(DB::raw('lower(breve_descricao)'), 'like', '%' . $queryLower . '%')
            ->orWhereHas('categoria', function ($q) use ($queryLower) {
                $q->where(DB::raw('lower(categorias.nome)'), 'like', '%' . $queryLower . '%');
            })
            ->get();
        return response()->json($eventos);
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
        $instituicao = Instituicao::whereRelation('administrador', 'id', $user->id)->first();
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'min:10', 'max:100'],
            'expectativa_participantes' => ['required', 'integer'],
            'link_evento' => ['max:100', 'nullable'],
            'breve_descricao' => ['required', 'string', 'max:100'],
            'local' => ['nullable', 'max:500'],
            'descricao' => ['nullable'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'atividades' => ['required'],
            'atividades.*.nome' => ['required', 'max:255'],
            'atividades.*.data' => ['required', 'date', 'after:today'],
            'atividades.*.horario_inicio' => ['required', 'date_format:H:i'],
            'atividades.*.horario_fim' => ['required', 'date_format:H:i', 'after:atividades.*.horario_inicio'],
            'atividades.*.local' => ['nullable', 'max:200'],
            'atividades.*.link_tranmissao' => ['nullable', 'max:400'],
            'atividades.*.descricao' => ['nullable'],
            'atividades.*.tipo_atividade_id' => ['required', 'exists:tipo_atividades,id'],
            'atividades.*.nome_apresentador' => ['required', 'string', 'min:3', 'max:255'],
            'atividades.*.email_apresentador' => ['required', 'email'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $e = Evento::find($id);
        $e->nome = $request->nome;
        $e->breve_descricao = $request->breve_descricao;
        $e->expectativa_participantes = $request->expectativa_participantes;
        $e->link_evento = $request->link_evento;
        $e->local = $request->local;
        $e->descricao = $request->descricao;
        $e->tipo_id = 1;
        $e->instituicao_id = $instituicao->id;
        $e->categoria()->associate($request->categoria_id);
        $e->user()->associate($user->id);
        $e->save();

        //deleta as atividades que não são pertencentes mais
        $atividades = Atividade::hydrate((array)json_decode($request->atividades));
        $atividades = $atividades->flatten();
        $diff = collect($e->atividades->pluck('id'))->diff($atividades->pluck('id'));
        $e->atividades()->whereIn('id', $diff)->delete();

        //Cria as novas ou atualiza as recentes
        foreach ($atividades as $atv) {
            $a = null;
            if ($e->atividades->contains($atv->id)) {
                $a = Atividade::find($atv->id);
            } else {
                $a = new Atividade();
            }
            $a->nome = $atv->nome;
            $a->data = $atv->data;
            $a->horario_inicio = $atv->horario_inicio;
            $a->horario_fim = $atv->horario_fim;
            $a->tipo_atividade()->associate($atv->tipo_atividade_id);
            $a->evento()->associate($e->id);
            $a->nome_apresentador = $atv->nome_apresentador;
            $a->email_apresentador = $atv->email_apresentador;
            $apr = User::firstWhere('email', $a->email_apresentador);
            if ($apr != null) {
                $a->apresentador()->associate($apr->id);
            }
            $a->save();
        }

        return response()->json(null, 201);
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

    public function compraIngresso(Request $request) {
        $user = Auth::user();
        $atividades_id = json_decode($request->atividades);
        foreach ($atividades_id as $id) {

            $pa = new ParticipanteAtividade();
            $pa->atividade_id = $id;
            $pa->user_id = $user->id;
            $pa->save();
        }

        return response()->json(null, 201);
    }

    public function eventos_criados(): JsonResponse {
        $user = Auth::user();
        $eventos = Evento::with('atividades')->where('user_id', $user->id)->get();

        return response()->json($eventos);
    }

    public function atividades_participadas(): JsonResponse {
        $user = Auth::user();
        $atividades = Evento::whereHas('atividades', function (Builder $query) use ($user) {
            $query->whereRelation('users', 'users.id', $user->id)->with('users');
        })
            ->with('atividades')
            ->get();
        return response()->json($atividades);
    }
}
