<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * 権限によって機能させるバリデーションを割り当てる。
     * ここではすべての権限にバリデーションを適用するからtrueを返しておく。
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションのルールを設定する。
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    /**
     * バリデーションをかける項目を日本語対応させる。
     *
     * @return void
     */
    public function attributes() {
        return [
            'title' => 'タイトル',
            'due_date' => '期限部',
        ];
    }

    /**
     * エラーメッセージを日本語対応させる。
     * validation.phpのjaに書いてもいいが、FormRequestクラス内部の特有のエラーメッセージならここに書く。
     *
     * @return void
     */
    public function messages() {
        return [
            'due_date.after_or_today' => ':attribute: には今日以降の日付を入力してください。'
        ];
    }
}
