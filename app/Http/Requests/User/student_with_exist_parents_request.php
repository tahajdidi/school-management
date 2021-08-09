<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateUserRequest
 * @package App\Http\Requests\User
 */
class student_with_exist_parents_request extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string',
            'birthday' => 'required|string',
            'section' => 'required|string',
            'blood_group' => 'required|string',
            'nationality' => 'required|string',
            'phone_number' => 'required|string|unique:users',
            
          
            
        ];
    }
}
