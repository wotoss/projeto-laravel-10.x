<?php

namespace App\Repositories;

interface PaginationInterface
{
    //vou criar um método que vai me retornar um [] array com os items
    /**
     * preciso que retorne um array de stdClass
     * o laravel não faz isto teremos que converter o arryay para stdClass
     * @return stdClass[]
     */
    public function items(): array;
    //aqui vamos retornar um total de items
    public function total(): int;

    public function isFirstPage(): bool;
    //retornar um bolean tambem será ultil para retornar a paginação
    public function isLastPage(): bool;
    //pagina corrent=>exemplo estou na pagina (2) e quero verificar se a pagina (2) é a pagina atual.
    //ela retorna o numero da current page ou seja, numero da pagina atual.
    public function currentPage(): int;
    //métod irá para proxima pagina
    public function getNumberNextPage(): int;
    //método irá para pagina anterior.
    public function getNumberPreviousPage(): int;
      
}