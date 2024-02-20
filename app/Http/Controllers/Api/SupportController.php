<?php

namespace App\Http\Controllers\Api;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Services\SupportService;
use Illuminate\Http\Request;
use App\Http\Resources\SupportResource;
use Illuminate\Http\Response;

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
        if(!$support = $this->service->findOne($id)){
           
            /*
            $dam = response();
            dd($dam);*/
            //Json vou passar o (status code de error)
            return response()->json([
                'error' => 'Not Found'
            // 404 é o Not Found
            //Posso fazer com este exempo => ], 404);
            //Ou com este para não ficar passando numero 404
            ], Response::HTTP_NOT_FOUND);
        }
        //caso encontre o objeto eu passo ele no (Presenter é o API => SupportResource)
        return new SupportResource($support);
    }

    /**
     * Atualizar o conteudo
     */
    public function update(StoreUpdateSupport $request, string $id = null)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request, $id)
        );
        if (!$support){
            return response()->json([
                'error' => 'Not Found'
            /* 404 é o Not Found
               Posso fazer com este exempo => ], 404);
               Ou com este para não ficar passando numero 404 */
            ], Response::HTTP_NOT_FOUND);
        }
        return new SupportResource($support);
    }

    /**
     * Remover o conteudo
     */
    public function destroy(string $id)
    {
        /*
          tento encontrar o support, caso não encontre dou o response de 404
        */
           if(!$this->service->findOne($id)){
              return response()->json([
                //=> 'Not Found'
                  'error' => 'Not Found'
              ], Response::HTTP_NOT_FOUND);
           }
           //ele achando o $id irá fazer a deleção é vou dar um no (content ou 204 de return).
           $this->service->delete($id); 
           //return response()->json([], 204)
           return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
