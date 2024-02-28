<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'numero_premis' => ['required', 'string', 'min:8', 'max:15', 'unique:chauffeurs'],
            'categorie' => ['required', 'string'],
            'date_emission' => ['required', 'date'],
            'date_expiration' => ['required', 'date'],
            'experience' => ['required', 'integer'],
            'is_permis_valide' => ['required'],
            'image' => ['required', 'string', 'extensions:.jpg,.png,.jpeg'],
            "voiture_id" => ['integer'],
        ];
    }
}
