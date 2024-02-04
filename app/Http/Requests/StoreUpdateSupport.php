<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //aqui é onde eu valido se o usuário tem autorização para fazer isto ou não.
        //Por enquanto não estamos trabalhando com (acl) então vou deixar o return como true 
        //estava como false.
        //vou deixar true se não, não conseguirei validar.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'subject' => 'required|min:3|max:255|unique:supports',
        //vou passar um array no body ,,,no subject eu passei uma string separado por peipeLine |
        'body' => [
            'required',
            'min:3',
            'max:10000',
        ],
    ];
    //definição de regraS
        //resumindo posso fazer das duas formas tanto com (string separada por | pipeline)
        //como por array []
        //vou fazer as validações de (adicionar e atualizar)

        //aqui vou passar o nome do campo => subject
            //validações:
            /* 1º coloco ele como required obrigatório
               2º quantidade minima de caractere será 3, quantidade maxima será 255 que é a
                quantidade maxima da coluna do banco
               3º estou dizendo que ele é (unico na tabela supports), isto quer dizer que não posso cadastrar a mesma duvida
               se já existir ele não vai deixar cadastrar....
             */
    return $rules;

    //se a minha requisição for do method 'PUT' seria uma atualizar
         
        if ($this->method() === 'PUT') {
            $rules['subject'] = [
                'required',
                'min:3',
                'max:255',

                //"unique:supports,subject,{$this->id}",
                //minha regra => ele é unico na tabela supports, na coluna suject, com id que esta vindo na requisição 
                //igual da coluna id
                
                //a logica seria !
                //1º Quando eu vou editar a minha requisição pega um id ele confere o assunto e nome são iquais da quele id ou requisição se sim ele permite a edição
                //2º Mas se eu estiver em um Id = 2 e pegar um valor do Id = 3 e tentar colocar no  id = 2 ele não permite. 
                //4º Pois desta forma estarei duplicando os assuntos ou conteudos e a tabela e logica não permite
                //mas quando eu for editar o subject ou assunto que já existe em outro topico ele não aceita.
                Rule::unique('supports')->ignore($this->id),
            ];
            
        }
    }
}
