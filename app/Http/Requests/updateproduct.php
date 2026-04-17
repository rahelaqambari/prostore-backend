<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateproduct extends FormRequest
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
    public function rules(): array
    {
        return [
            "name"=> "nullabel|string|min:3",
            "stock"=> "nullabel|integer|min:",
            "price"=> "nullabel|decimal|min:20",
            "category"=> "nullabel|string|min:3",
            "description"=> "nullabel|string|min:10",
            "brand"=> "nullabel|string|min:3",
            "image_url"=> "nullabel|string",
            "imageable_type"=> "required|string",
            "imageable_id"=> "required|integer",
        ];
    }
}
