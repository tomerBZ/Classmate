<?php

namespace App\Http\Requests\Post;

use App\Rules\AlphaSpaces;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required'
        ];
    }
}
