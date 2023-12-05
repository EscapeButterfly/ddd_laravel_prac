<?php

namespace App\Store\Catalog\Presentation\HTTP\Requests;

use App\Store\Catalog\Domain\Enums\Currency;
use App\Store\Catalog\Presentation\HTTP\Requests\Rules\Isbn;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBookRequest extends FormRequest
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
            'isbn'              => ['required', new Isbn],
            'title'             => 'required|string',
            'description'       => 'required|string',
            'pages'             => 'required|integer',
            'publish_date'      => 'required|date',
            'quantity'          => 'required|integer',
            'authors'           => 'required|array|exists:authors,uuid',
            'genres'            => 'required|array|exists:genres,uuid',
            'prices'            => 'required|array',
            'prices.*.currency' => ['required', 'string', Rule::enum(Currency::class)],
            'prices.*.price'    => 'required|decimal:2'
        ];
    }
}
