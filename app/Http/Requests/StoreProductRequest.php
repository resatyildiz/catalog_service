<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "name" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255"],
            "price" => ["required", "numeric", "max:255"],
            "description" => ["required", "string", "max:255"],
            "media_id" => ["integer", "max:255"],
            "order" => ["required", "integer", "max:255"],
            "category_id" => ["required", "integer", "max:255"],
        ];
    }
}
