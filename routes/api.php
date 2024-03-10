<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'auth']);
//para fazer logout precisa tambem esta autenticado
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
/* esta rota (me) retorna usuário autenticado
   nesta caso vou passar as validações do (middleware) inline (na mesma linha)
   Não em groupo como esta no exemplo abaixo */
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

//auth é autenticação web onde ele requer sessões.
//sanctum é do laravel o qual estou utilizando para trabalhar com autenticação
//group nós passamos um função de calback todas as rotas que tiver dentro desta função
//solicitará (autenticação)
Route::middleware(['auth:sanctum'])->group(function(){
  //agora para acessar nossa rota de (supports), precisa estar autenticado.
  /* 
  a unica rota que vou fazer é esta e ele declara todas as rotas [ get, post put, delete ].
  caso queira ver as rotas de o comando dentro do containner => php artisan route:list

  Faça o teste:
  Se vc comentar esta linha e der o comando => php artisan route:list => as rotas api não aparecem
  Caso você descomente esta linha Route::apiResource('/supports', SupportController::class); => as rotas aparecem
  ao ser passado o comando => php artisan route:list
*/
  Route::apiResource('/supports', SupportController::class);
});


/* 
  a unica rota que vou fazer é esta e ele declara todas as rotas [ get, post put, delete ].
  caso queira ver as rotas de o comando dentro do containner => php artisan route:list

  Faça o teste:
  Se vc comentar esta linha e der o comando => php artisan route:list => as rotas api não aparecem
  Caso você descomente esta linha Route::apiResource('/supports', SupportController::class); => as rotas aparecem
  ao ser passado o comando => php artisan route:list
*/
//Posso passar o middleware tambem desta forma, mas tenho que passar em cada rota indepedente
//Já da forma acima eu passo (varias) rotas dentro do grupo.
//Route::apiResource('/supports', SupportController::class)->middleware('auth');
