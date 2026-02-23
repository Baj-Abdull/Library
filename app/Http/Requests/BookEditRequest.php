<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        
        return [
            'title' => 'required|max:500',
            'author' => 'required|max:255', //Author and author is to diffrent things
            'librarian_id' => 'required',
            ];
    }
    public function prepareForValidation(){
        $this->merge([
            'librarian_id' => Auth::user()->id,
        ]);
    }

    
}
