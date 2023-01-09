<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ChirpStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'message' => 'required|string|max:255',
            'file' => [
                'nullable',
                File::types(['png', 'jpg'])
                    ->max(5 * 1024)
            ]
        ];
    }
}
