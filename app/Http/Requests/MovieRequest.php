<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'release_date' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:1014',
            'is_active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'release_date.required' => 'Release date is required.',
            'image.max' => 'Image must be smaller than 1MB.',
        ];
    }
}
