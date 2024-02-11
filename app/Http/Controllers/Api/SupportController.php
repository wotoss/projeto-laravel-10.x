<?php

namespace App\Http\Controllers\Api;

use App\DTO\Supports\CreateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Services\SupportService;
use Illuminate\Http\Request;
use App\Http\Resources\SupportResource;

//Com o comando --api - Ele já criou com todo os metodos REST
class SupportController extends Controller
{
    public function __construct(
    //criando meu construtor e fazendo a injeção de dependencia da service 
    //como esta relação eu consigo utilizar todos os recursos que tenho na (service).
        protected SupportService $service,
    ){  }

    /**
     *Listagem de todo o conteudo
     */
    public function index()
    {
        //
    }

    /**
     * (Criação adição ou cadastro) de conteudo...
     * 
     * A diferença daqui para a controller e que não vou reposder os dados para a view
     * e sim, enviar para json
     */
    public function store(StoreUpdateSupport $request)
    {
        /*
          1- Uso o $this para instância o objeto da minha classe...
          2- Com esta instância aponto para o service que foi injetado no meu construtor
          3- o (new) é um método que tenho no meu service.
          4- Passo o DTO ou seja o modelo que quero que ele crie (CreateSupportDTO).
          5- Ele tem um método chamado makeFromRequest(onde passaremos o nosso request)
        */
        
        $support = $this->service->new(
           CreateSupportDTO::makeFromRequest($request)
        );
        //dou um return do objeto, será no formato JSON-encond
        return new SupportResource($support);
    }


    /**
     * Trazer conteudo 
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Atualizar o conteudo
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remover o conteudo
     */
    public function destroy(string $id)
    {
        //
    }
}
