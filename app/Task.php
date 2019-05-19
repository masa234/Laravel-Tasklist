<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Taskデータベーステーブルと紐づく
class Task extends Model
{   
    /* 複数代入可能な属性
    // @var array
    */
    protected $fillable = ['name'];

    /**
     * タスク所有ユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo( User::class );
    }  
}

