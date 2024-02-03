<?php
namespace App\Services;
use stdClass;
//Lembrando que estamos trablhando com o padrão ServiceLayer.
class SupportService
    {
       //vou criar um construtor onde vou injetar a interface do repository
       //lembrando: que ao entra na classe ele passa primeiro pelo contrutor antes do método.

       //aqui será um repositorio da minha classe SupportService
       protected $repository;

       public function __construct()
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

       //uso o stdClass para eu nunca retornar um tipo especifico do laravel.
       //stdClass como se fosse um objeto especifico
       //estou dizendo para ele retornar um (stdClass|null) stdClass OU null
       //neste momento não vou deixar mostrar a (expection) é assim que neste senario (sem mostrar)
       public function findOne(string $id): stdClass|null
       {
          return $this->repository->findOne($id);
       }

       //vamos (criar) (com new) um novo suporte e ele não vai retornar um objeto
       //ele vai retornar um (stdClass) um objeto genérico
       //Outro exemplo como se fosse o dynamic do C#
       //cria um objeto generico sem estrutura
       public function new(
        //vou passar assim uma propriedade de cada vez.
        //no proximo exemplo vou passar via DTO
        //se eu tenho muitas propriedade fica inviavel passar uma a uma com o DTO eu resolvo.
          string $subject,
          string $status, //este status poderia ser do tipo (enum)
          string $body,
       ): stdClass
       {
        //passando para o repository
        //neste momento estamos chamando o método update do reposioty
        return  $this->repository->new(
             $subject,
             $status,
             $body,
         );
        }
        //vamos atualizar..
          public function update(
             string $id,
             string $subject,
             string $status,
             string $body,
        //vamos falar deste retorno => stdClass|null - do passo null
        //1º- se eu passar o (id) invalido que var (tratar ou validar) isto é o repositorio
        //2º- se eu tivesse em uma (api - rest) deixava estourar a expection e tranquilo (só era tirar o null do =>stdClass|null )
        //3º- mas como estamos no modelo (mvc) vou deixar retornar (null) e trato isto na (controller).
        //4º- quando for (api - rest) eu apenas dou um (response 404)
          ): stdClass|null
          {
            //neste momento estamos chamando o método update do reposioty
            return $this->repository->update(
                $id,
                $subject,
                $status,
                $body,
            );
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

