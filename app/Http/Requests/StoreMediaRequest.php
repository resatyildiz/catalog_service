<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
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
            "path" => ["required", "string", "max:255"],
            "type" => ["required", "string", "max:255"],
            "size" => ["required", "string", "max:255"],
            "extension" => ["required", "string", "max:255"],
            "mime_type" => ["required", "string", "max:255"],
            "url" => ["required", "string", "max:255"],
            "disk" => ["required", "string", "max:255"],
            "directory" => ["required", "string", "max:255"],
            "filename" => ["required", "string", "max:255"],
        ];
    }
}
