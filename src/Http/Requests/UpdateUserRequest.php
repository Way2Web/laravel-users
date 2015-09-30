<?php

namespace App\Http\Requests;

use App\User;
use App\Http\Requests\Request;

class UpdateUserRequest extends Request
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
        $id = $this->segments()[1];
        $user = User::findOrFail($id);
        if(!$this->get('password'))
        {
            return [
                'name'      => 'max:255',
                'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
                'role'      => 'required',
                'password'  => 'min:10|max:255|confirmed',
            ];
        }
        else
        {
            return [
                'name'      => 'max:255',
                'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
                'role'      => 'required',
                'password'  => 'required|min:10|max:255|confirmed',
            ];
        }
    }
}
