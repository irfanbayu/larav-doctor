<?php

namespace App\Http\Requests\Role;

use App\Models\ManagementAccess\Roles;
// use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRolesRequest extends FormRequest
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
           'name' => [
                'required',
                'string',
                'max:255',
                 Rule::unique('roles')->ignore($this->roles),
            ],
        ];
    }
}
