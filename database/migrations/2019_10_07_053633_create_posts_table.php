<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', // 테이블 명
            function (Blueprint $table) { // Closure, 콜백
                // $table: Blueprint 클래스의 인스턴스
                //         posts테이블 객체(인스턴스)
            $table->bigIncrements('id');  // 6.x
            $table->string('title');
            $table->text('body');
            $table->timestamps(); // created_at, updated_at 필드 생성
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
