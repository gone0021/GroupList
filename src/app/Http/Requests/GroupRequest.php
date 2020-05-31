<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// ---
use Illuminate\Validation\Rule;
use App\Rules\Current;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends FormRequest
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
            'group_name' => [
                "required",
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
                // Rule::unique('user')->ignore(Auth::deleted_at()),
            ],

            'current_password' => new Current(),
        ];
    }

    public function messages()
    {
        return [
            'group_name.required' => 'グループ名を入力してください',
            'group_name.max' => '255文字まで',
            'group_name.unique' => '登録があります',
        ];
    }
}
