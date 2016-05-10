<?php

namespace App\Http\Requests;

use App\UserManager;
use App\Http\Requests\Request;

/**
 * Update user request
 * @package users
 * @author Gertjan Roke <groke@intothesource.com>
 */
class UserRequest extends Request
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
        if($this->method() === 'POST')
        {
            return [
                'name'      => 'max:255',
                'email'     => 'required|email|max:255|unique:users,email',
                'role'      => 'required',
                'password'  => 'required|confirmed|min:'.config('entrance.password_length').'|max:255',
            ];
        }
        elseif ($this->method() === 'PUT' || $this->method() === 'PATCH')
        {
            $id = $this->route()->users;
            $user = UserManager::findOrFail($id);
            if(!$this->get('password'))
            {
                return [
                    'name'      => 'max:255',
                    'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
                    'role'      => 'required',
                    'password'  => 'min:'.config('entrance.password_length').'|max:255|confirmed',
                ];
            }
            else
            {
                return [
                    'name'      => 'max:255',
                    'email'     => 'required|email|max:255|unique:users,email,'.$user->id,
                    'role'      => 'required',
                    'password'  => 'required|min:'.config('entrance.password_length').'|max:255|confirmed',
                ];
            }
        }
    }
}
