<?php

namespace App\Repositories;
use App\Repositories;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

//esta é a classe concreta sendo implementada pelo contrato da interface.
class SupportEloquentORM implements SupportRepositoryInterface
{
    //montar o construtor
    public function __construct(
        //vamos injetar nosso model
        protected Support $model
    )
    { }
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
                 ->where(function ($query) use ($filter) {
                   if ($filter) {
                      $query->where('subject', $filter);
                      $query->orWhere('body', 'like', "%{$filter}%");
                   }
                 })
                 //no primeiro parametro eu trago o total de items por pagina (total-de-pagina)
                 //no segundo no array eu passo qual coluna é para trazer neste caso todas as colunas [*]
                 //neste page eu passo em qual pagina que estou ($page)
                 ->paginate($totalPerPage, ["*"], 'page', $page);
               //dd((new PaginationPresenter($result))->items());
               //vou retornar um new passo o classe PaginationPresente($result)  
               return new PaginationPresenter($result);
    }
    //neste getAll sendo vazio ou não ele retornará um array
    public function getAll(string $filter = null): array
    {
       //vamos retornar todos os dados mas quero com formato de array. 
       //vamos trabahar com $filter lembrando que filter pode receber null então é opçional
       //veja que uso uma função de (calbeack)
       return $this->model
       //este ($query) esta fazendo por detrás do sistema (select * from Support)
                ->where(function ($query) use ($filter) {
                    //se informou o ($filter)
                    if ($filter){
                        $query->where('subject', $filter);
                        $query->orWhere('body', 'like', "%{$filter}%");
                        }
                })
                ->get()
                //->toSql() -> para ver a query que formou
                //->paginete()
                ->toArray();
    }
   
    //ele encontrando o objeto retorna um stdClass não encontrando retorna null
    //passando null não exibi a exception.
    public function findOne(string $id): stdClass|null 
    {
        //vou tentan buscar (conteudo) no support
        $support = $this->model->find($id);
        if(!$support){
            return null;
        }
        //se encontrou eu pego o support converto para o array
        //e faço um (cast) para (objeto)
       return (object) $support->toArray();
    }

    //temos o delete recebendo uma string que é o id e não retorna nada um void.
    public function delete(string $id): void
    {
       //findOrFail() irá buscar pelo id se não encontrar ele retorna uma exception 404
       $this->model->findOrFail($id)->delete();
    }
    
    //método new recebento CreateSupportDTO e retorno um stdClass
    public function new(CreateSupportDTO $dto): stdClass
    {
        //tanto podemos montar com (cast)
        $support = $this->model->create(
            (array) $dto
        ); 

        return (object) $support->toArray();
        
        
    }
    //como podemos montar apontando para os método e funções
        /*
        $retornoviaArray = $this->model->create($dto)->toArray();
        $transformandoEmObjeto = $retornoviaArray->Object();
        return $transformandoEmObjeto;
        */

    //método update vamos, receber um UpdateSupportDTO, retornando um stdClass
    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        //vamos fazer a validação (direto) dentro do if
       if (!$support = $this->model->find($dto->id)){
            return null;
       }
         $support->update((array) $dto);
       return (object) $support->toArray();
    }
}