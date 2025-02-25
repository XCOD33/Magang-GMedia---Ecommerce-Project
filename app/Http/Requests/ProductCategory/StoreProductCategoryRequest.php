<?php

namespace App\Http\Requests\ProductCategory;

use App\Http\Requests\BaseRequest;

class StoreProductCategoryRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kategori harus diisi',
            'name.string' => 'Nama kategori harus berupa string',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa string',
            'description.min' => 'Deskripsi minimal 3 karakter',
            'description.max' => 'Deskripsi maksimal 255 karakter',
        ];
    }
}
