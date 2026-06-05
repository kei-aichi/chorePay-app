<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'amount' => 'required|integer|min:0',
            'done_at' => 'required|date',

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タスク名は必須です',
            'title.max' => 'タスク名は255文字以内です',

            'amount.required' => '金額は必須です',
            'amount.integer' => '金額は数値で入力してください',
            'amount.min' => '金額は0円以上で入力してください',

            'done_at.required' => '日付は必須です',
            'done_at.date' => '正しい日付を入力してください',

            'category_id.required' => 'カテゴリーを選択してください',
            'category_id.exists' => '存在しないカテゴリーです',
        ];
    }
}
