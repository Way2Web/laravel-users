<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Auth::user()->role == 'admin' OR \Auth::user()->id == $this->user()){
            return true;
        }
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
            'name'      => 'max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'role'      => 'required',
            'password'  => 'required|password_confirmation|min:10|max:255',
        ];
    }
}
