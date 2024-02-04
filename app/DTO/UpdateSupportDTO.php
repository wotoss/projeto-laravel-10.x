
<?php

namespace App\DTO;
use App\Http\Requests\StoreUpdateSupport;


class UpdateSupportDTO
{
   //vamos utilizar muito php8
   public function __construct(
      public string $id,
      public string $subject,
      public string $status,
      public string $body,
   ){ }

    //vou retornor um (sef) um objeto da propria classe
    public static function makeFromRequest(StoreUpdateSupport $request): self
    {
        return new self(
            $request->id,
            $request->subject,
            'a', 
            $request->body
        );
    }

}



