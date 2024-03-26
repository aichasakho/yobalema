<?php

namespace App\Http\Requests;

use Doctrine\Inflector\Rules\French\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'matricule' => ['string', 'required',Rule::unique('voitures')->ignore($this->voiture)],
            'date_achat' => ['string', 'required'],
            'km_par_defaut' => ['integer', 'required'],
            'statut' => ['required', 'string'],
            'image_voiture' => ['image'],
            'type_de_voiture' => ['required', 'string'],
            'name' => ['string', 'required'],


        ];
    }
}
