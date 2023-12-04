<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:orders,id',
            'description' => 'required|string|max:244',
            'customer_id' => 'required|integer',
            'sale_channel_item_id' => 'required|integer',
            'order_items' => 'required|array',
            'order_status_slug' => 'required|string|in:received,processing,prepared,delivered,canceled,completed',
        ];
    }
}
