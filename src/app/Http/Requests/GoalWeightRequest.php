<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalWeightRequest extends FormRequest
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
            'goal_weight' => ['required',  'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'goal_weight.required' => '目標の体重を入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $fields = ['goal_weight'];

            foreach ($fields as $field) {
                $value = $this->input($field);
                if ($value === null || $value === '') {
                    continue;
                }
                if (!preg_match('/^\d{1,4}(\.\d+)?$/', $value)) {
                    $validator->errors()->add($field, '4桁までの数字で入力してください');
                }
                elseif (preg_match('/\.\d{2,}$/', $value)) {
                    $validator->errors()->add($field, '小数点は1桁で入力してください');
                }
            }
        });
    }
}
