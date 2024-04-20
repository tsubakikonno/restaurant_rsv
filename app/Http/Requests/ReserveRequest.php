<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'reservation_date' => 'required|after_or_equal:today',
            'reservation_time' => 'required|after_or_equal:today',
            'number' => 'required|min:1'

        ];
    }

    public function messages()
  {
    return [
      'reservation_date.required' => '予約日を入力してください',
      'reservation_date.after_or_equal' => '日付が不正です',
      'reservation_time.after_or_equal' => '時刻が不正です',
      'reservation_time.required' => '時刻を入力してください',
      'number.required' => '人数を入力してください',
      'number.min' => '最低でも1人以上です',

    ];
}
}
