<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
