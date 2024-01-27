<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    //nosso index irá retornar uma view e ter a listagem dos nossos itens
    public function index()
    {
        /*
          1º Você pode usar a injeção de depêndencia do Laravel
          e passar no parametro do método=> 
          public function index(Support $support)
          {
             $support = $support->all();
             dd($support);
          }
          a injeção como parametro seria "a mesmo sentido" de criar a instância (new)
        */

         /*
           2º exemplo de como buscar todos na controller
           pego a classe Support e dou um (all ou get) ele me trás todos
           $support = Support::all();
         */
        
         /*
           me retorna uma (collection ou um array)
         */
         $support = new Support();
         $support = $support->all();
         dd($support);
        //aqui eu passo o meu path que esta na (view) do projeto
        //nomeDaPasta/nomeDaOutraPasta/nomeDoArquivo sem a extensão blade.php
        //este => compact('supports')seria como a criação de um array para enviar para view.
        return view('admin/supports/index', compact('supports'));
    }
}
