<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itens extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['codigo', 'nome', 'tipo', 'valor-un-compra', 'valor-un-venda', 'estoque-gerado', 'estoque-disponivel', 'entradas', 'saidas', 'perca'];

    public function Item(){
        return $this->hasMany(itens::class);
    }
}
