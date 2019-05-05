<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Task;

// タスクの作成と編集では状態欄の有無が異なるだけでタイトルと期限日は同一。
// 重複を避けるためにEditTaskクラスはCreateTaskクラスを継承させる。
class EditTask extends CreateTask {
    public function rules() {
        // 親クラスであるCreateTaskクラスで定義したrulesメソッドを使う。
        $rule = parent::rules();
        // 状態欄には入力値が許可リストに含まれているかを検証するinルールを使う。
        // Ruleクラスが必要。
        $status_rule = Rule::in(array_keys(Task::STATUS));
        // returnする連想配列は'status' => 'required|in(1,2,3)'になる。
        return $rule + ['status' => 'required|' . $status_rule,];
    }

    public function attributes() {
        // 親クラスであるCreateTaskクラスで定義したattributesメソッドを使う。
        $attributes = parent::attributes();
        // 親クラスの$attributesと新たに「状態」も加える。
        return $attributes + ['status' => '状態'];
    }

    public function messasges() {
        // 親クラスであるCreateTaskクラスで定義した$messagesメソッドを使う。
        $messages = parent::messages();
        // array_map関数によって第二引数の配列の要素ひとつひとつを第一引数の引数として渡して第一引数のクロージャの処理を実行する。
        // ここではSTATUSのlabelキーの値を取り出して配列にしている。
        $status_lables = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);
        // implodeによって配列要素を文字列により連結する。
        $status_lables = implode('、'. $status_labels);
        return $messages + [
            // 状態欄にinのバリデーションを追加する。
            'status.in' => ':attribute には' . $status_labels . ' のいずれかを指定してください。',
        ];
    }
}
