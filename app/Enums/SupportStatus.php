<?php
//vamos trabalhar com (Enums) para deixar os nossos dados o mais tipado possível

namespace App\Enums;

//criando um enum SupportStatus do tipo string (para ficar bem definido)
//vamos deixar os tipos de dados em nosso enms => ['a', 'p', 'c']
enum SupportStatus: string
{
   //['a', 'p', 'c']
   //vamos definir os nossos tipos
   case A = "Open";
   case C = "Closed";
   case P = "Pendent";

   //perceba que ele esta retornando uma (string que seria Open, Colsed, Pendent)
   //Detalhe eu não consigo pegar este método ffromValue na view
   public static function fromValue(string $name): string
   {
    //Vamos percorrer todos os nossos items
    //SupportStatus como estou dentro da propria classe dou um self ou a propria classe => SupportStatus
    /**
     * doc
     * neste momento eu pego pego todos cases ou seja todo retorno da classe => self::cases() 
     */
       foreach (self::cases() as $status) {
        //então vamos percorrer o nosso lop 
        //se o status que esta vindo da view for igual ao status que esta aqui $status->name
         if($name === $status->name){
        //sendo igual eu quero que retorne o status value ou seja um dos nomes que esta vindo 
        //"Open" "Closed" "Pendent"    
            return $status->value;
         }
       }
       //caso não encontre nenhuma das opções posso, passar uma exception...
       throw new \ValueError("$status is not a valid");
   }
}

