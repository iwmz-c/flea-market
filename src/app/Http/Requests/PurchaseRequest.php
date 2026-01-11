<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'payment_method' => ['required', 'in:convenience,card'],
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string'],
        ];
    }

    public function messages() {
        return [
            'payment_method.required' => '支払い方法を選択してください',
            'payment_method.in' => '選択した支払方法は選べません',
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => '郵便番号はxxx-xxxx形式で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
