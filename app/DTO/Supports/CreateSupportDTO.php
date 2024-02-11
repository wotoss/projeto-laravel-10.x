<?php
namespace App\DTO\Supports;
use App\Http\Requests\StoreUpdateSupport;


class CreateSupportDTO
{
   //vamos utilizar muito php8
   public function __construct(
      public string $subject,
      public string $status,
      public string $body,
   ){ }

    //vou retornor um (sef) um objeto da propria classe
    public static function makeFromRequest(StoreUpdateSupport $request): self
    {
        return new self(
            $request->subject,
            'a', 
            $request->body
        );
    }

}



