<?php

namespace App\Http\Requests;


use App\Enums\ClientType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string[]", 'address' => "string[]", 'phone' => "string[]", 'fax' => "array", 'email' => "string[]"])] public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'phone' => ['required'],
            'fax' => [],
            'email' => ['required'],
        ];
    }
}
