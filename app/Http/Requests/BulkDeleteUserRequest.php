<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkDeleteUserRequest extends FormRequest
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
        ];
    }

    public function getIds(): array
    {
        return $this->get('ids');
    }
}
