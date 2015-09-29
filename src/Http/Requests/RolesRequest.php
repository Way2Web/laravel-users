<?php

namespace App\Http\Requests;

use App\Role;
use App\Http\Requests\Request;

class RolesRequest extends Request
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|min:3|max:255|unique:roles,name',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $param = $this->segments()[1];
                $role = Role::findOrFail($param);
                return [
                    'name' => 'required|min:3|max:255|unique:roles,name,'.$role->id,
                ];
            }
            default:break;
        }
    }
}
