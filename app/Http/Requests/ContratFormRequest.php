<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratFormRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'unique:contrats'],
            'salaire' => ['required', 'integer'],
            'duree_contrat' => ['required'],
            'type_contrat' => ['required', 'string'],
            'etat_contrat' => ['required'],
            'date_embauche' => ['required', 'date'],
        ];
    }
}
