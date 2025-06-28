<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePageRequest extends FormRequest
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
        return array(
            'title' => 'required|string',
            'url' => [
                'required',
                'string',
                Rule::unique('pages')->where(function ($query) {
                    return $query->where('tag_id', $this->tag_id);
                }),
            ],
            'icon' => 'required|string',
            'tag_id' => 'required',
        );
    }
}
