<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'slug' => 'required|string|unique:blog_posts,slug',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }
}
