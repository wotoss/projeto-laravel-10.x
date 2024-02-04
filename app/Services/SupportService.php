<?php

namespace App\Services;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repsitories\SupportRepositoryInterface;
use stdClass;
//Lembrando que estamos trablhando com o padrão ServiceLayer.
class SupportService
    {
       //vou criar um construtor onde vou injetar a interface do repository
       //lembrando: que ao entra na classe ele passa primeiro pelo contrutor antes do método.

       //aqui será um repositorio da minha classe SupportService
       //protected $repository;

       public function __construct(
          protected SupportRepositoryInterface $repository
       )
       {
         
          
       }


       //toda logica trazemos para ká !
       //exemplo se formos criar um email ou coisa do tipo
       //ele fará a comunicação do repository para os nossos controller

       //alguns desenvolvedore põe o (método com o nome da classe)=> getAllSupports.
       //Mas no livro "Clear code" aprendemo que
       // não a sentido a redundancia de nomes se já temos na classe
       
       //Quando eu coloco o parametro null ele passa a ser opcional => string $filter = null
       //basicamente estou setando o meu retorno como array. :array
       //vamos esperar ele na camada de repository.
       public function getAll(string $filter = null): array
       {
        //recupero os dados..
        //se eu tiver uma variavel eu armazeno e faço as operações..
          return  $this->repository->getAll($filter);
       }

      
       public function findOne(string $id): stdClass|null
       {
          return $this->repository->findOne($id);
       }

      //agora vou passar a DTO
      //passando a DTO estou (oitmizando), não preciso passar (propriedade uma de cada vez)
       public function new(CreateSupportDTO $dto): stdClass
       {
          return $this->repository->new($dto); 
       }

        //vamos atualizar..
         public function update(UpdateSupportDTO $dto): stdClass|null
            
        //vamos falar deste retorno => stdClass|null - do passo null
        //1º- se eu passar o (id) invalido que var (tratar ou validar) isto é o repositorio
        //2º- se eu tivesse em uma (api - rest) deixava estourar a expection e tranquilo (só era tirar o null do =>stdClass|null )
        //3º- mas como estamos no modelo (mvc) vou deixar retornar (null) e trato isto na (controller).
        //4º- quando for (api - rest) eu apenas dou um (response 404)
         
          {
            //neste momento estamos chamando o método update do reposioty
            return $this->repository->update($dto);
          }
       
       //posso utilizar o metodo (delete ou o método destroi)
       //poderia falar que é uma string ou int tanto faz.
       //ficaria assim => delete(string $id) => delete(string|int $id)
       //passo bool mostrando (true ou false)
       public function delete(string $id): void
       {
           $this->repository->delete($id);
       }
    }

