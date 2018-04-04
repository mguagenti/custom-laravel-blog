<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogPost extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'slug'  => [
                'required',
                'max:255',
                Rule::unique('posts')->ignore($this->post->slug, 'slug'),
            ],
            'meta.title'            => 'required|max:255',
            'meta.author'           => 'max:255',
            'meta.description'      => 'required|max:255',
            'content'               => 'required',
            'published_at_date'     => 'nullable|date:Y-m-d'
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance() {
        $this->formatSlug();

        return parent::getValidatorInstance();
    }

    /**
     * Slugs should be modified to contain the proper characters before validation.
     */
    protected function formatSlug() {
        $this->merge([
            'slug' => str_slug($this->request->get('slug'))
        ]);
    }


}
