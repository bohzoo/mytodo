<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model {
    public function tasks() {
        // hasManyの第一引数は関連するモデル名、第二引数は関連するモデルの属性、第三引数は親モデルの外部キーに紐づけられたカラム
        return $this->hasMany('App\Task', 'folder_id', 'id');
    }
}
