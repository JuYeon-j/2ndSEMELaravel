<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // protected $table = 'users; Author모델과 users테이블 연결
    
    // `updated_at`, `created_at` 컬럼 사용을 취소
    public $timestamps = false;   
    protected $fillable = ['email', 'password'];
}
