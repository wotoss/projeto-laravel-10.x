<?php

use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;

/* 
  a unica rota que vou fazer é esta e ele declara todas as rotas [ get, post put, delete ].
  caso queira ver as rotas de o comando dentro do containner => php artisan route:list

  Faça o teste:
  Se vc comentar esta linha e der o comando => php artisan route:list => as rotas api não aparecem
  Caso você descomente esta linha Route::apiResource('/supports', SupportController::class); => as rotas aparecem
  ao ser passado o comando => php artisan route:list
*/
Route::apiResource('/supports', SupportController::class);
