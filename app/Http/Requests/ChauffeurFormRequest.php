<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChauffeurFormRequest extends FormRequest
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
            'numero_permis' => ['required', 'string', 'min:8', 'max:15', Rule::unique('chauffeurs')->ignore($this->chauffeur)],
            'categorie' => ['required', 'string'],
            'date_emission' => ['required', 'date'],
            'date_expiration' => ['required', 'date'],
            'experience' => ['required', 'integer'],
            'image' => ['required', 'image', 'extensions:jpg,png,jpeg'],
            'user_id' => ['integer', 'required'],
        ];
    }
}
