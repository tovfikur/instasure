<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogCategoryUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:50'],
            'slug' => [
                'required',
                'max:60',
                Rule::unique('blog_categories')->ignore($this->blog_category)
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Name required",
            'name.max' => "Name max length 50",
            'slug.required' => "Slug required",
            'slug.max' => "Slug max length 50",
            'slug.unique' => "Slug must be unique"
        ];
    }
}
