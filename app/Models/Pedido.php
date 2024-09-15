<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    protected $fillable = ['estado', 'preco_total'];

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'produto_pedido')
            ->withPivot('preco', 'quantidade')
            ->withTimestamps();
    }
}

