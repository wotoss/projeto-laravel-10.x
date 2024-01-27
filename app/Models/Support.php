<?php

namespace App\Models;

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
}
