<?php

namespace App\Models;

use App\Enums\SupportStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    //eu passo quais colunas eu posso cadastrar 
    //faço isto para evitar ataques.
    protected $fillable = [
        'subject',
        'body',
        'status'
    ];

    /*
      Outro Exemplo:
      se eu tivesse queriado um enum (sem ser do tipo string)
      poderia converter desta forma
      toda vez que colocasse o status ele faria o (cast ou a conversão)

        protected $casts = [
            'status' => SupportStatus::class
        ];

        Deixo como exemplo no nosso caso já fizemos sem precisar a conversão ou o cast.

    */
    //vamos fazer um muteitor quando for persistir algo no banco faremos o cast de forma manual.


    /**
     * O que esta sendo feito de forma resumida
     * 1º A nossa DTO esta enviando para nossa Model "SupportStatus".
     * 2º Estou enviando pro banco a coluna (status) apenas o nome não o value desta coluna
     * Fazendo esta conversão eu envio para o banco
     */
    public function status(): Attribute
    {
        return Attribute::make(
            set: fn (SupportStatus $status) => $status->name,
           //caso eu quiser pegar o value, seria só passa-lo
           //set: fn (SupportStatus $status) => $status->value,
        );
    }
}
