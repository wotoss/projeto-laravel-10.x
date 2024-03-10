<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        //pegar as credênciais do usuário
        // $credentials = $request->only([
        //    'email',
        //    'password',
        //    /* como ele consegue gerar varios token para o mesmo usuario
        //       é importante atraves do device_name conseguimos identificar.*/
        //    'device_name',
        // ]);

        /* aqui eu faço a validação se os dados estão corretos
           farei esta validação pelo model User */
        $user = User::where('email', $request->email)->first();
        /**
         * com esta (hash) vou verificar se a senha do usuário tambem esta correta
         * 1º no método check(verifico-a-senha) se ela bati com a senha-do-usuasrtio.
         */
        //Hash::check($request->password, $user->password);
        //Se não encontrar usuario ou a senha não bater retornar false 
        //eu mostro uma exeception....
        //faz a comparação => request->password a senha que esta vindo do view form
        //com a senha que esta na base de dados
        if (!$user || !Hash::check($request->password, $user->password))
        {
           //envio a exception
           throw ValidationException::withMessages([
            //The provided credentials are incorrect
            //As credenciais fornecidas estão incorretas
              'email' => ['As credenciais fornecidas estão incorretas']
           ]);
        }
        /*
           Login unico de API
           vamos deletar todos os tokens que já existia deste usuario
           Quando deletarmos todos os tokens, ele ira deslogar de todas as paginas logadas
        */
        // Logout others devices
        // if ($request->has('Logout_others_devices'))

         /* 1º Deleto os demais token para que tenha um login unico
            Detalhe: removo todos os demais token que usuario tem, assim eu faço um (login único)
            todas as autenticações que eventualmente ele fez antes */
        $user->tokens()->delete();

        /* 2º Crio um novo token
           caso de certo e passe pela validação eu acobo de ter um usuário
           tendo o usuário vou criar uma (hash) pra ele. */
        $token =  $user->createToken($request->device_name)->plainTextToken;
        
        /* 3º retorno este token para o usuario
           retorno o token em formato (JSON) */
        return response()->json([
            'token' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        /**
         * pego o usuario autenticado os tokens dele e deleto tudo
         */
        $request->user()->tokens()->delete();

        /*
           Vou fazer um response para dizer que deu tudo certo
           retorno este token para o usuario
           retorno o token em formato (JSON) */
        return response()->json([
            'message' => 'success',
        ]);
    }

    //retornar o usuario autenticado neste método me
    public function me(Request $request)
    {
        //pego o usuario autenticado
        $user = $request->user();
        //e aqui eu retorno este usuário
        return response()->json([
        //este me esta retornando o proprio (usuario autenticado)    
            'me' => $user,
        ]);
    }
}
