<?php

namespace App\Http\Requests\User;

use App\Rules\AlphaSpaces;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => ['nullable', new AlphaSpaces],
            'email'    => 'nullable|email|unique:users,email,id',
            'class'    => 'nullable|numeric',
            'birthday' => 'nullable|date_format:Y-m-d'
        ];
    }
}
