<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    // MassAssignment 대응

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // 테이블 내용 조회시 숨겨지는 필드

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 시간형태로 값이 들어감
    ];

    protected $dates=['last_login']; // 날짜형태로 받자는 설정  //  /Carbon/Carbon

    public function articles(){ // Many쪽 관계를 설정: 복수
        return $this->hasMany(Article::class);
        // $this(사용자)는 많은 Article을 가진다
    }
}
