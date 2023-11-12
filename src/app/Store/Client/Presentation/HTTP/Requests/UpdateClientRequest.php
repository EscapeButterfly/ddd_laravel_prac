<?php

namespace App\Store\Client\Presentation\HTTP\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
            'email'        => ['required',
                               'email',
                               Rule::unique('clients')->ignore($this->route('uuid'), 'uuid')],
            'password'     => 'sometimes|required|min:8',
            'first_name'   => 'required|string',
            'last_name'    => 'required|string',
            'phone_number' => ['required',
                               'string',
                               Rule::unique('clients')->ignore($this->route('uuid'), 'uuid')],

            'addresses'               => 'required|array',
            'addresses.*.street'      => 'required|string',
            'addresses.*.city'        => 'required|string',
            'addresses.*.state'       => 'required|string',
            'addresses.*.country'     => 'required|string',
            'addresses.*.postal_code' => 'required|string',
        ];
    }
}
