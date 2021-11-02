<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller {
    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email e/ou senha inválidos'], 401);
        }

        return $this->respondWithToken($token);
    }


    private function respondWithToken($token): JsonResponse {
        $user = JWTAuth::setToken($token)->toUser();
//        if ($user->email_verified_at != null) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $user,
        ]);
//        }
//        JWTAuth::setToken($token)->invalidate();
//        $user->sendEmailVerificationNotification();
//        return response()->json('Email não verificado, olhe sua caixa de entrada ou spam', 403);
    }

    public function logout() {
        auth('api')->logout();

        return response()->json(['msg' => 'Logout efetuado com sucesso']);
    }

    public function resetPassword(Request $request) {

        $credentials = $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->only('email'))->first();
        if ($user != null) {
            $status = Password::sendResetLink(
                $request->only('email')
            );
            return response()->json(["status" => $status, "msg" => 'Reset password link sent on your email id.']);
        } else {
            return response()->json(["msg" => "Usuário não encontrado"], 401);
        }
    }

    public function reset() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Token inválido"], 403);
        }

        return response()->json(["msg" => "Senha alterada com sucesso"]);
    }
}
