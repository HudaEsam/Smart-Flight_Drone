<?php

namespace App\Http\Requests;
use App\Customs\Services\PasswordService;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordRequest extends FormRequest
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
            'password'=>['required','string','confirmed','min:8'],
            'current_password'=>['required','string'],

        ];
    }
}
