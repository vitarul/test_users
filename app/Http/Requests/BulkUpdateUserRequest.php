<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkUpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ids' => ['required', 'array'],
            'ids.*' => ['int', 'exists:users,id'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function getData(): array
    {
        return $this->except('ids');
    }

    public function getIds(): array
    {
        return $this->get('ids');
    }
}
