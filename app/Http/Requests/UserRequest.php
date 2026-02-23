<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    // protected $stopOnFirstFailure = true;

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->somethingElseIsInvalid()) {
    //             $validator->errors()->add('field', 'Something is wrong with this field!');
    //         }
    //     });
    // }

    private function somethingElseIsInvalid()
    {
        // Complex validation logic here
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
            'name' => 'required|String|max:255', //this rule will set on the page of the web NOT the DB, the rules be set on the migratiion
            'email' => 'required|email',
            'password' => 'required|String|min:4|max:255|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already registered. Please log in instead.',
            'password.min' => 'Your password must be at least 8 characters long for security.',
        ];
    }

   
    public function attributes(): array
    {
        return [
            'email' => 'email address',
            'password_confirmation' => 'password confirmation',
        ];
    }
    //     public function after(): array
    // {
    //     return [
    //         function (Validator $validator) {
    //             if ($this->somethingElseIsInvalid()) {
    //                 $validator->errors()->add(
    //                     'field',
    //                     'Something is wrong with this field!'
    //                 );
    //             }
    //         }
    //     ];
    // }
}
