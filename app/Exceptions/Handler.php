<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        // 로그로 예외 레포트하지 않을 예외 리스트를 작성
        // \Illuminate\Auth\AuthenicationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    { // 예외를 로그에 남기기
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    { // 예외를 브라우저 화면에 남김
        if(app()->environment('production')){ // 꼭 할필요는 없음.
            // app(): 헬퍼함수, Illuminate\Foundation\Application의 객체 반환
            // environment() 메소드: .env의 App_ENV 값 읽어서 반환
            if($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException){
                return response(view('errors.notice',[
                    'title'=>'찾을 수 없습니다.',
                    'description'=>'죄송합니다. 요청하신 페이지가 없습니다.'
                ]),404);
                // response(인자1,인자2): 헬퍼함수, 응답객체 생성
            }
        }

        return parent::render($request, $exception);
    }
}
