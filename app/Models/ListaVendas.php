<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaVendas extends Model
{
    use HasFactory;

    protected $fillable = ['produtos_idprodutos','vendas_idvendas'];
}
