<?php

namespace App\Adapters;

use App\Http\Resources\DefaultResource;
use App\Repositories\PaginationInterface;

class ApiAdapter
{
    //deixar ele statico para não ter que criar o (objeto)
    public static function toJson(
        PaginationInterface $data
    )
    {
        return DefaultResource::collection(collect($data->items()))
        /* desta formar consigo passar estas informações para o front-end com paginação
           estou pegando estas propriedades do PaginatioInterface.php
           com a finalidade de preencher o frnt-end */
                            ->additional([
                                'meta' => [
                                    //total de paginas
                                    'total' => $data->total(),
                                    //primeira pagina
                                        'is_first_page' => $data->isFirstPage(),
                                        //ultima pagina
                                        'is_last_page' => $data->isLastPage(),
                                        //pegar a pagina atual 
                                        'current_page' => $data->currentPage(),
                                        //proxima pagina
                                        'next_page' =>  $data->getNumberNextPage(),
                                        'previous_page' =>  $data->getNumberPreviousPage()
                                ]
                            ]);
        
    }
}