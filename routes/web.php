<?php

use App\Http\Controllers\Admin\{SupportController};
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;
use App\Enums;
use App\Enums\SupportStatus;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//vamos fazer um teste
//uma rota get, então ela virá url
  Route::get('/test', function(){
    /*
    Doc
    Criei a classe enum na raiz do app
    e consigo utiliza-la na rosa e pegar o seu método para obter o retorno
    */
    //dd(SupportStatus::cases());
    //agora vou pegar somente os valores
    //primeiramente eu pego um arrya com os items.
    //depois eu passo o name
    dd(array_column(SupportStatus::cases(), 'name'));
  });
//fim 

/* 
   1- esta unica linha, faria a substituição de todas as outras rotas...
   [ get, put, delete, post ]
   //Route::resource('/supports/{id}', [SupportController::class]);
*/


Route::delete('/supports/{id}', [SupportController::class, 'destroy'])->name('supports.destroy');

Route::put('/supports/{id}', [SupportController::class, 'update' ])->name('supports.update');

Route::get('/supports/{id}/edit', [SupportController::class, 'edit'])->name('supports.edit');

Route::get('/supports/create', [SupportController::class, 'create'])->name('supports.create');

Route::get('/supports/{id}', [SupportController::class, 'show'])->name('supports.show');

Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');

Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');

Route::get('/contato', [SiteController::class, 'contact']);

Route::get('/', function () {
    return view('welcome');
});
