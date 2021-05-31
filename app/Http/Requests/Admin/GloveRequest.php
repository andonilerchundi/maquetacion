<?php



namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GloveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El titulo es obligatorio',
        ];
    }
}
