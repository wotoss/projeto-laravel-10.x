<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

/**
 * Documentação
 * Lembrando: que esta classe PaginationPresenter esta sendo
 * herdando ou implementando este contrato desta interface PaginationInterface
 * obrigatoriamente dever ter todos os métodos que se tem na interface
 */
class PaginationPresenter implements PaginationInterface
{
    /**
     * @var stdClass[]
     */
    private array $items;
    //montar o construtor para receber informação do SupportEloquentORM.php
    //neste momento do método paginate
    public function __construct(
        //lembrando que esta construtor esta sendo preenchido do método paginate que esta enviando
        //objeto no seu return, para este contrutor.
        protected LengthAwarePaginator $paginator,
    ){
        //vamos receber estes dados convertidos para stdClass
         $this->items = $this->resolveItems($this->paginator->items());
     }

    //vou criar um método que vai me retornar um [] array com os items
    /**
     * preciso que retorne um array de stdClass
     * o laravel não faz isto teremos que converter o arryay para stdClass
     * @return stdClass[]
     */
    public function items(): array
    {
       return $this->items;
    }
    //aqui vamos retornar um total de items
    public function total(): int
    {
       return $this->paginator->total() ?? 0;
    }
    
    public function isFirstPage(): bool
    {
       //este método me retorna a primeira pagina ou não
       return $this->paginator->onFirstPage();
       
    }
    //retornar um bolean tambem será ultil para retornar a paginação
    public function isLastPage(): bool
    {
        /*
         este me retorna a ulitma pagina
         vou verificar se o (currentPage) é igual === a( ultima pagina)
         exemplo: estou na pagina 5 e ela é ultima o numero da ultima pagina é igual da pagina atual que é 5
         se sim retorne true
         $this->paginator->lastPage() => verifico a ultima pagina
         $this->paginator->currentPage()=> verifico a pagina atual
       */
       return $this->paginator->currentPage() === $this->paginator->lastPage();
    }
    //pagina corrent=>exemplo estou na pagina (2) e quero verificar se a pagina (2) é a pagina atual.
    //ela retorna o numero da current page ou seja, numero da pagina atual.
    public function currentPage(): int
    {
    //nosso retorno da pagina atual se não retornar nada, eu quero que esteja na pagina 1
       return $this->paginator->currentPage() ?? 1;
    }
    //métod irá para proxima pagina
    public function getNumberNextPage(): int
    {
    //ele vai pegar o currentPage que é a pagina atual e acrescentar mais 1
        return $this->paginator->currentPage() + 1;
    }
    //método irá para pagina anterior.
    public function getNumberPreviousPage(): int
    {
        //vai pegar a pagina atual currentPage() -1 menos 1
        return $this->paginator->currentPage() - 1;
    }
    private function resolveItems(array $items): array
    {
        $response = [];
        foreach ($items as $item){
            //vou converter casa item para stdClass
            //e devolver convertido em yum array de stdClass
            $stdClassObject = new stdClass;
            foreach($item->toArray() as $key => $value){
                //akey estamos pegando o nome  e o value o valor que tem nele
                $stdClassObject->{$key} = $value;
                //posso dar um dd depois do foreach para ver o objeto
                //dd($stdClassObject);
            }
            //estou preenchendo o meu $response estou dando um push
            //com as informações do objeto que esta vindo $stdClassObject
            array_push($response, $stdClassObject);
        }
        return $response;
    }

}