<?php

namespace App\Store\Catalog\Presentation\HTTP\Requests;

use App\Store\Catalog\Presentation\HTTP\Requests\Rules\Isbn;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'isbn'         => ['required', new Isbn],
            'title'        => 'required|string',
            'description'  => 'required|string',
            'pages'        => 'required|integer',
            'publish_date' => 'required|date',
            'quantity'     => 'required|integer'
        ];
    }
}
