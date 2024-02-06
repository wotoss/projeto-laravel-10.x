<?php

namespace App\Repositories;

use App\DTO\{
    CreateSupportDTO,
    UpdateSupportDTO
};
use stdClass;

interface SupportRepositoryInterface
{
    //vamos montar a paginação em nossa interface ou contrato
    //vamos ter um valor inteiro montando a $page  =  1
    //iremos mostrar totalPerPage = 15 items por pagina.
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;

    //neste getAll sendo vazio ou não ele retornará um array
    public function getAll(string $filter = null): array;
   
    //ele encontrando o objeto retorna um stdClass não encontrando retorna null
    //passando null não exibi a exception.
    public function findOne(string $id): stdClass|null;

    //temos o delete recebendo uma string que é o id e não retorna nada um void.
    public function delete(string $id): void;
    
    //método new recebento CreateSupportDTO e retorno um stdClass
    public function new(CreateSupportDTO $dto): stdClass;

    //método update vamos, receber um UpdateSupportDTO, retornando um stdClass
    public function update(UpdateSupportDTO $dto): stdClass|null;
}