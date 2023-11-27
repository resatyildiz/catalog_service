<?php

namespace App\Http\Requests\SaleChannel;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleChannelItemRequest extends FormRequest
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
            'sale_channel_slug' => ['required', 'string', 'exists:sale_channels,slug'],
            'sale_channel_item_group_id' => ['required', 'integer', 'exists:sale_channel_item_groups,id'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
