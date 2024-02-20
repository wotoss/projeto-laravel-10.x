<?php
namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupport;


class UpdateSupportDTO
{
   //vamos utilizar muito php8
   public function __construct(
      public string $id,
      public string $subject,
      public SupportStatus $status,
      public string $body,
   ){ }

    //vou retornor um (sef) um objeto da propria classe
    public static function makeFromRequest(StoreUpdateSupport $request, string $id = null): self
    {
        return new self(
            $id ?? $request->id,
            $request->subject,
            SupportStatus::A, 
            $request->body
        );
    }

}



