<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'target_weight' => ['required', 'numeric'],
        ];
    }
    
    public function messages()
    {
        return [
            'target_weight.required' => '目標の体重を入力してください',
            //'target_weight.numeric' => '数字で入力してください',  不要？
        ];
    }
    public function withValidator($validator){
        $value = $this->input('target_weight');
        if (!is_numeric($value)) return;

        $parts = explode('.', $value);
        if (strlen($parts[0]) > 4){
            $validator->errors()->add('weight', '4桁までの数字で入力してください');
        }
        if (isset($parts[1]) && strlen($parts[1]) > 1){
            $validator->errors()->add('weight', '小数点は1桁で入力してください');
        }
    }

}
