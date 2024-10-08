<?php

namespace App\Http\Requests;

use App\Enums\EstadoPedido;
use App\Models\Pedido;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdatePedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $pedidoId = $this->route('pedido');
        $pedido = Pedido::find($pedidoId);

        return [
            'estado' => [
                'required',
                new Enum(EstadoPedido::class),
                function ($attribute, $value, $fail) use ($pedido) {
                    if ($pedido && $value === $pedido->estado) {
                        $fail("O estado enviado é igual ao estado atual do pedido.");
                    }
                }
            ],
        ];
    }
}
