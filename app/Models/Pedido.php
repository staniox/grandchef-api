<?php

namespace App\Models;

use App\Enums\EstadoPedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{

    use HasFactory;

    protected $fillable = ['estado', 'preco_total'];

    protected $attributes = [
        'estado' => EstadoPedido::ABERTO,
    ];

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'produto_pedido')
            ->withPivot('preco', 'quantidade')
            ->withTimestamps();
    }
}

