<?php
//Eu vou ter simplismente funções helpers...

//senão (!) existir a function

use App\Enums\SupportStatus;


if(!function_exists('getStatusSupport')) {
  //na minha function eu passo uma string $status e retorno uma string
  function getStatusSupport(string $status): string{
   //passei a classe SupportStatus busquei o método fromValue e passei (varivael ou retorno que esta vindo) 
    return SupportStatus::fromValue($status);
  }
}
