<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommandExecutionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar se o usuário está autenticado
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Acesso negado'
            ], 401);
        }

        // Verificar se o usuário tem permissão para executar comandos
        // Por padrão, apenas usuários autenticados podem executar comandos
        // Você pode adicionar lógica adicional aqui para verificar roles/permissions

        // Exemplo: verificar se o usuário tem um campo 'is_admin' ou similar
        // if (!Auth::user()->is_admin) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Permissão insuficiente para executar comandos'
        //     ], 403);
        // }

        // Verificar se a requisição está vindo do backoffice
        if (!$request->is('backoffice/admin/commands/*')) {
            return response()->json([
                'success' => false,
                'message' => 'Acesso negado'
            ], 403);
        }

        return $next($request);
    }
}
