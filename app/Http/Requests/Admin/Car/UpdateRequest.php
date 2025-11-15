<?php

namespace App\Http\Requests\Admin\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'brand'         => 'required|string|max:255',
            'model'         => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars,license_plate,' . $this->route('id'),
            'transmission'  => 'required|string|max:255',
            'year'          => 'required|integer|min:1900|max:' .date('Y'),
            'daily_rate'    => 'required|numeric|min:0',
            'penalty_rate_per_day'  => 'required|numeric|min:0',
            'passenger_capacity'    => 'required|integer|min:1',
            'category_id'   => 'required|exists:categories,id',
            'fuel_type'     => 'required|string|max:255',
            'status'        => 'nullable',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ];
    }
}
