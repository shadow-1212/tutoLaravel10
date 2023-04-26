<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:8|max:255',
            //unique slug ignore the current post using array format of rule
            'slug' => ['required', 'string', 'min:8', 'max:255', Rule::unique("posts")->ignore($this->post), 'regex:/^[a-z0-9\-]+$/'],
            'content' => 'required|string',
        ];
    }

    // create a prepareForValidation method
    protected function prepareForValidation(): void
    {
        // get the slug from the title
        $this->merge([
            'slug' =>  $this->input('slug')?:Str::slug($this->input('title')),
        ]);
    }

}
