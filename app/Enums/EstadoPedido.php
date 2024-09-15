<?php

namespace App\Enums;

enum EstadoPedido: string
{
    case ABERTO = 'aberto';
    case APROVADO = 'aprovado';
    case CONCLUIDO = 'concluido';
    case CANCELADO = 'cancelado';
}
