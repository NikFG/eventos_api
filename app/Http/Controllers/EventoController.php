<?php

namespace App\Http\Controllers;

use App\Models\Apresentador;
use App\Models\Atividade;
use App\Models\Evento;
use App\Models\Imagem;
use App\Models\Instituicao;
use App\Models\ParticipanteAtividade;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller {

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse {
        $eventos = Evento::query()->with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
        }, 'categoria', 'instituicao'])
            ->whereHas('atividades')
            ->orderBy('created_at', 'desc');

        if ($request->titulo != null) {
            $queryLower = trim(strtolower($request->titulo));
            $eventos->where(function ($query) use ($queryLower) {
                $query->where(DB::raw('lower(nome)'), 'like', '%' . $queryLower . '%')
                    ->orWhere(DB::raw('lower(breve_descricao)'), 'like', '%' . $queryLower . '%');
            });
        }

        if ($request->cat != null) {
            $eventos->whereRelation('categoria', 'categorias.id', '=', $request->cat);
        }

        if ($request->instituicao != null) {
            $eventos->whereRelation('instituicao', 'instituicoes.id', $request->instituicao);
        }

        if ($request->dataInicio != null) {
            if ($request->dataFim != null) {
                $eventos->whereHas('atividades', function ($q) use ($request) {
                    $q->whereBetween('data', [$request->dataInicio, $request->dataFim]);
                });
            } else {
                $eventos->whereRelation('atividades', 'atividades.data', $request->dataInicio);
            }
        }

        if ($request->horarioInicio != null) {
            $eventos->whereHas('atividades', function ($q) use ($request) {
                $q->whereTime('atividades.horario_inicio', '>=', $request->horarioInicio);
            });
        }

        if ($request->horarioFim != null) {
            $eventos->whereHas('atividades', function ($q) use ($request) {
                $q->whereTime('atividades.horario_fim', '<=', $request->horarioFim);
            });
        }

        return response()->json($eventos->paginate(20));
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
            'breve_descricao' => ['required', 'string', 'max:100'],
            'local' => ['nullable', 'max:500'],
            'descricao' => ['nullable'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'atividades' => ['required', 'array'],
            'atividades.*.nome' => ['required', 'string', 'max:100'],
            'atividades.*.data' => ['required'],
            'atividades.*.url' => ['nullable', 'max:400', 'url'],
            'atividades.*.horario_inicio' => ['required', 'date_format:H:i'],
            'atividades.*.horario_fim' => ['required', 'date_format:H:i', 'after:atividades.*.horario_inicio'],
            'atividades.*.descricao' => ['nullable', 'string'],
            'atividades.*.tipo_atividade_id' => ['required', 'exists:tipo_atividades,id'],
            'atividades.*.apresentadores' => ['required', 'array'],
            'atividades.*.apresentadores.*.nome' => ['required', 'string', 'max:100'],
            'atividades.*.apresentadores.*.email' => ['required', 'email', 'max:100'],

        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        try {
            $id = DB::transaction(function () use ($user, $request) {
                $instituicao = Instituicao::find($user->instituicao_id);
                $e = new Evento();
                $e->nome = $request->nome;
                $e->breve_descricao = $request->breve_descricao;
                $e->expectativa_participantes = $request->expectativa_participantes;
                $e->local = $request->local;
                $e->descricao = $request->descricao;
                $e->tipo_id = 1;
                $e->instituicao_id = $instituicao->id;

                $e->categoria()->associate($request->categoria_id);
                $e->user()->associate($user->id);
                $e->save();

                $atividades = $request->atividades;
                foreach ($atividades as $atv) {
                    $a = new Atividade();
                    $a->nome = $atv['nome'];
                    $a->data = Carbon::createFromFormat('d/m/Y', $atv['data'])->format('Y-m-d');
                    $a->horario_inicio = $atv['horario_inicio'];
                    $a->horario_fim = $atv['horario_fim'];
                    $a->descricao = $atv['descricao'];
                    $a->local = $atv['local'];
                    $a->url = $atv['url'];
                    $a->tipo_atividade()->associate($atv['tipo_atividade_id']);
                    $a->evento()->associate($e->id);
                    $a->save();
                    foreach ($atv['apresentadores'] as $apresentador) {
                        $apr = new Apresentador();
                        $apr->nome = $apresentador['nome'];
                        $apr->email = $apresentador['email'];
                        $apr_user = User::firstWhere('email', $apr->email);
                        $pa = new ParticipanteAtividade();
                        $pa->atividade_id = $a->id;
                        if ($apr_user != null) {
                            $pa->user_id = $apr_user->id;
                            $apr->user()->associate($apr_user->id);
                        }
                        $apr->save();
                        $pa->apresentador_id = $apr->id;
                        $pa->save();
                    }
                }
                $e->save();
                return $e->id;
            });
            return response()->json(['id' => $id], 200);
        } catch (\Exception$e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $evento = Evento::query()->with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome")->with('apresentadores');
        }])
            ->withCount(['atividades as apresentadores_count' => function (Builder $query) {
                $query->select(DB::raw('count(distinct(participante_atividades.apresentador_id))'))
                    ->join('participante_atividades', 'participante_atividades.atividade_id', '=', 'atividades.id')
                    ->whereNotNull('participante_atividades.apresentador_id');
            }])->with('imagens')
            ->find($id);
        return response()->json($evento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'min:10', 'max:100'],
            'breve_descricao' => ['required', 'string', 'max:100'],
            'local' => ['nullable', 'max:500'],
            'descricao' => ['nullable'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'banner' => ['image'],
            'atividades' => ['required', 'array'],
            'atividades.*.nome' => ['required', 'string', 'max:100'],
            'atividades.*.data' => ['required', 'date', 'after:today'],
            'atividades.*.url' => ['nullable', 'max:400', 'url'],
            'atividades.*.horario_inicio' => ['required', 'date_format:H:i'],
            'atividades.*.horario_fim' => ['required', 'date_format:H:i', 'after:atividades.*.horario_inicio'],
            'atividades.*.descricao' => ['nullable', 'string'],
            'atividades.*.tipo_atividade_id' => ['required', 'exists:tipo_atividades,id'],
            'atividades.*.apresentadores' => ['required', 'array'],
            'atividades.*.apresentadores.*.nome' => ['required', 'string', 'max:100'],
            'atividades.*.apresentadores.*.email' => ['required', 'email', 'max:100'],

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        DB::transaction(function () use ($id, $user, $request) {
            $instituicao = Instituicao::find($user->instituicao_id);
            $e = Evento::find($id);
            $e->nome = $request->nome;
            $e->breve_descricao = $request->breve_descricao;
            $e->local = $request->local;
            $e->descricao = $request->descricao;
            $e->instituicao_id = $instituicao->id;
            $e->categoria()->associate($request->categoria_id);
            $e->save();

            //deleta as atividades que não são pertencentes mais
            $atividades = Atividade::hydrate((array)json_decode($request->atividades));
            $atividades = $atividades->flatten();
            $diff = collect($e->atividades->pluck('id'))->diff($atividades->pluck('id'));
            $e->atividades()->whereIn('id', $diff)->delete();
            foreach ($atividades as $atv) {
                $a = null;
                $apr = null;
                if ($e->atividades->contains($atv->id)) {
                    $a = Atividade::find($atv->id);
                } else {
                    $a = new Atividade();
                }
                $a->nome = $atv['nome'];
                $a->data = Carbon::createFromFormat('d/m/Y', $atv['data'])->format('Y-m-d');
                $a->horario_inicio = $atv['horario_inicio'];
                $a->horario_fim = $atv['horario_fim'];
                $a->descricao = $atv['descricao'];
                $a->local = $atv['local'];
                $a->tipo_atividade()->associate($atv['tipo_atividade_id']);
                $a->url = $atv['url'];
                $a->evento()->associate($e->id);
                $a->save();
                $participantes = [];
                foreach ($atv['apresentadores'] as $apresentador) {
                    $apr = Apresentador::firstWhere('email', $apresentador['email']);
                    if ($apr == null) {
                        $apr = new Apresentador();
                        $apr->email = $apresentador['email'];
                    }
                    $apr->nome = $apresentador['nome'];
                    $apr_user = User::firstWhere('email', $apresentador['email']);
                    $pa = ParticipanteAtividade::query()->where('apresentador_id', $apr->id)->where('atividade_id', $a->id)->first();

                    if ($pa == null) {
                        $pa = new ParticipanteAtividade();
                    }
                    $pa->atividade_id = $a->id;
                    if ($apr_user != null) {
                        $pa->user_id = $apr_user->id;
                        $apr->user()->associate($apr_user->id);
                    }

                    $apr->save();
                    $pa->apresentador_id = $apr->id;
                    $pa->save();

                    array_push($participantes, $apr->id);
                }

                ParticipanteAtividade::whereNotNull('apresentador_id')->whereNotIn('apresentador_id', $participantes)->where('atividade_id', $a->id)->delete();
                $e->save();
            }
        });

        return response()->json(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $e = Evento::query()->findOrFail($id);
        $e->delete();
        return response()->json(null, 204);
    }

    public function compraIngresso(Request $request): JsonResponse {
        $user = Auth::user();
        $atividades_id = json_decode($request->atividades);
        $user->atividades()->sync($atividades_id);
        return response()->json($atividades_id, 201);
    }

    public function eventos_criados(): JsonResponse {
        $user = Auth::user();
        $eventos = Evento::with(['atividades' => function ($query) {
            $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");

        }])
            ->withCount(['atividades as participantes_count' => function (Builder $query) {
                $query->select(DB::raw('count(distinct(participante_atividades.id))'))
                    ->join('participante_atividades', 'participante_atividades.atividade_id', '=', 'atividades.id')
                    ->whereNull('participante_atividades.apresentador_id');
            }])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($eventos);
    }

    public function eventos_participados(): JsonResponse {
        $user = Auth::user();
        $eventos = Evento::query()->whereHas('atividades', function (Builder $query) use ($user) {
            $query->whereRelation('users', 'users.id', $user->id);
        })
            ->with(['atividades' => function ($query) use ($user) {
                $query->orderBy('data')->orderBy('horario_inicio')->orderBy('horario_fim')->orderBy("nome");
            }, 'atividades.certificados' => function ($query) use ($user) {
                $query->where('participante_id', $user->id);
            }])
            ->get();
        return response()->json($eventos);
    }

    public function atividades_participadas($id): JsonResponse {
        $user = Auth::user();
        $atividades = Atividade::whereRelation('users', 'users.id', $user->id)
            ->whereRelation('evento', 'eventos.id', $id)
            ->get();
        return response()->json($atividades);
    }

    public function upload_imagens(Request $request, $id): JsonResponse {

        foreach ($request->imagens as $key => $i) {
            $img = new Imagem();
            $img->descricao = $i['nome'];
            $img->imagem = $i['url'];
            $img->evento()->associate($id);
            $img->tipo()->associate($i['tipo'] == 'banner' ? 1 : 2);
            if ($i['tipo'] == 'banner') {
                $e = Evento::findOrFail($id);
                $e->banner = $i['url'];
                $e->save();
            }
            $img->save();
        }
        return response()->json(null, 201);
    }
}
