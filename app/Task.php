<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model {
    /**
     * 状態定義
     */
    const STATUS = [
        1 => ['label' => '未着手', 'class' => 'label-danger'],
        2 => ['label' => '着手中', 'class' => 'label-info'],
        3 => ['label' => '完了',   'class' => ''],
    ];

    /**
     * アクセサを定義する
     * 状態のラベル
     *
     * @return void
     */
    public function getStatusLabelAttribute() {
        $status = $this->attributes['status'];
        if(!isset(self::STATUS[$status])) {
            return '';
        }
        return self::STATUS[$status]['label'];
    }

    /**
     * アクセサを定義する
     * 色のクラス
     *
     * @return void
     */
    public function getStatusClassAttribute() {
        $status = $this->attributes['status'];
        if(!isset(self::STATUS[$status])) {
            return '';
        }
        return self::STATUS[$status]['class'];
    }

    /**
     * アクセサの定義
     * 期限日の表示形式を変更する
     *
     * @return void
     */
    public function getFormattedDueDateAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('Y/m/d');
    }
}
