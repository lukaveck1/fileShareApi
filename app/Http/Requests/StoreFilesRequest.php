<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilesRequest extends FormRequest
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
            'name' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'photo' => ['required', 'min:1', 'max:1000', 'image']
        ];
    }

    /**
     * Override default messages and specify custom ones for given validation rule
     * @return array
     */
    public function messages()
    {
        return [
            'photo.max' => 'Image size must be less than 1 MB.',
            'photo.image' => 'File MIME type must be image.'
        ];
    }
}
