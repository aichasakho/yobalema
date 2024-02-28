<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoitureFormRequest extends FormRequest
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
        // TODO: completer les regles de validation
        return [
            'matricule' => ['string', 'required', 'min:4', 'max:10', 'unique:voitures'],
            'date_achat' => ['date', 'required'],
            'km_par_defaut' => ['integer', 'required'],
            'statut' => ['required', 'string'],
            'image_vehicule' => ['required', 'string', 'extensions:.jpg,.png,.jpeg'],
            'type_de_voiture' => ['required', 'string']
        ];
    }
}
