<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseListRequest extends FormRequest
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
            "page_number" => ["integer", "max:255"],
            "page_size" => ["integer", "max:255"],
            "sort" => ["string", "max:255"],
        ];
    }
}
