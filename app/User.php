<?php
 
namespace App;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 特定ユーザーの全タスク取得
    */
    public function tasks()
    {   
        // Eloquentに用意されているhasManyメソッドを呼び出し、Userモデルに対するtasksメソッドを定義。
        return $this->hasMany( Task::class );
    }
}
