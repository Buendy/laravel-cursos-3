<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role_id === Role::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'GET':
            case 'DELETE':
                return[];
            case 'POST':
                return [
                    'name' => 'required | min:3 | unique:courses,name',
                    'description' => 'required | min:30',
                    'level_id' => 'required | exists:levels,id',
                    'category_id' => 'required | exists:categories,id',
                    'picture' => 'required | image | mimes:jpg,jpeg,png',
                    'requirements.0' => 'required_with:requirements.1',
                    'goals.0' => 'required_with:goals.1',
                ];
            case 'PUT':
                return [

                    'description' => 'required|min:30',
                    'level_id' => 'required | exists:levels,id',
                    'category_id' => 'required | exists:categories,id',
                    'picture' => 'sometimes|image|mimes:jpg,jpeg,png',
                    'requirements.0' => 'required_with:requirements.1',
                    'goals.0' => 'required_with:goals.1',
                ];
        }
        return [
            //
        ];
    }
}
