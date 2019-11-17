<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    // MassAssignment 허용
    protected $fillable = ['title', 'body']; 
}
