<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Criação do usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Criptografando a senha
            ]);

            // Retorna sucesso
            return response()->json([
                'message' => 'Usuário cadastrado com sucesso!',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            // Captura o erro e retorna uma mensagem
            return response()->json([
                'message' => 'Erro ao cadastrar usuário.',
                'error' => $e->getMessage(), // Detalhes do erro (para debug, remova em produção)
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível criar o token'], 500);
        }

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logout realizado com sucesso']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Falha ao realizar logout'], 500);
        }
    }

    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json($user);
    }
}