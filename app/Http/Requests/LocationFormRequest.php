<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationFormRequest extends FormRequest
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
            'debut_trajet' => ['required', 'datetime'],
            'fin_trajet' => ['required', 'datetime'],
            'date' => ['required', 'date'],
            'lieu_depart' => ['required', 'string', 'min:4', 'max:255'],
            'lieu_d_arrive' => ['required', 'string'],
            'prix_du_trajet' => ['required', 'integer'],
            'chauffeur_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
        ];
    }
}
