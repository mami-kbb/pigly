<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
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
            'date' => ['required'],
            'weight' => ['required',  'numeric'],
            'calories' => ['required', 'integer'],
            'exercise_time' => ['required', 'date_format:H:i'],
            'exercise_content' => ['string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.integer' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $value = $this->input('weight');

            if ($value !== null) {
                if (!preg_match('/^\d{1,4}(\.\d+)?$/', $value)) {
                    $validator->errors()->add('weight', '4桁までの数字で入力してください');
                } elseif (preg_match('/\.\d{2,}$/', $value)) {
                    $validator->errors()->add('weight', '小数点は1桁で入力してください。');
                }
            }
        });
    }
}
