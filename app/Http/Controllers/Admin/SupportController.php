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
         $supports = $support->all();
         //dd($supports);
        //aqui eu passo o meu path que esta na (view) do projeto
        //nomeDaPasta/nomeDaOutraPasta/nomeDoArquivo sem a extensão blade.php
        //este => compact('supports')seria como a criação de um array para enviar para view.
        return view('/admin/supports/index', compact('supports'));
    }

    public function create()
    {
        return view('/admin/supports/create');
    }

    public function store(Request $request, Support $support)
    {
        $data = $request->all();
        $data['status'] = 'a';

        //aqui eu faço o cadastro
        //Support::create($data);

        //$support = $support->create($data);
        
        //vou enviar para view esta lista, passando o nome da rota não a (url)
        //o nome da rota sempre fica a url pode ser alterada, e mudar o projeto
        $support->create($data);
        
        return redirect()->route('supports.index');


        //podemos usar via injeção de dependencia (parametros)
        //ou criar a instancia do Request
        //$request = new Request();
        //com este request.all eu pego todos os dados que vem da reuisição
        dd($request->all());
    }
}
