<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identify' => $this->id,
            //para deixar o assunto em caixa alta => (strtoupper).
            'subject' => strtoupper($this->subject),
            'content' => $this->body,
            'dt_created' => Carbon::make($this->created_at)->format('Y-m-d') ,
            //este pode ser mais um exemplo de persistencia em base dedsd
            //'dt_created' => Carbon::make($this->created_at)->format('Y-m-d H:i:s') ,
        ];
    }
}
