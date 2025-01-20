<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            // Validação personalizada
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'password.confirmed' => 'A confirmação de senha não coincide com a senha.', // Mensagem personalizada
            ]);

            // Criação do usuário
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Retorna sucesso
            return response()->json([
                'message' => 'Usuário cadastrado com sucesso!',
                'user' => $user,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Captura erros de validação e retorna uma resposta JSON
            return response()->json([
                'message' => 'Erro ao cadastrar usuário.',
                'errors' => $e->errors(), // Detalha os erros de validação
            ], 422);
        } catch (\Exception $e) {
            // Captura outros erros
            return response()->json([
                'message' => 'Erro ao cadastrar usuário.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = Auth::attempt($credentials)) {
        return response()->json(['error' => 'Credenciais inválidas'], 401);
    }

    return response()->json([
        'message' => 'Login bem-sucedido',
        'token' => $token,
    ]);
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