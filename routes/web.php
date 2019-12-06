<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Route::get(
    '/{tParam?}', // url 파라미터 처리
    function($tParam='여가 디폴트값'){
        return "<h1> {$tParam} 을 URL로부터 받음 </h1>";
    }
); */

/* Route::get(
    '/', // 요청경로(URL),GET /
    function () {  // 요청처리함수, 콜백,클로저
    return view('welcome'); // view(): 뷰 객체를 만들어 응답
        // 인자: 뷰폴더
        // resources/views/뷰파일명.blade.php
        // resources/views/welcme.blade.php
});

Route::get(
    '/yju', // 요청경로(URL),GET /
    function () {  // 요청처리함수, 콜백,클로저
    return view('yju-com'); // view(): 뷰 객체를 만들어 응답
        // 인자: 뷰폴더
        // resources/views/뷰파일명.blade.php
        // resources/views/welcme.blade.php
}); */

/* Route::get(
    '/{tParam?}/test',
    function($tParam='두번째 디폴트값'){
        return "<h1> {$tParam} 을 두번째 URL로부터 받음 </h1>";
    }
); */

/* Route::pattern('rich','[0-9a-zA-Z!]{4}');

Route::get(
    '/{rich?}',
    function($rich='돈'){
        return "{$rich} 부자";
    }
); */

/* Route::get(
    '/{rich?}',
    function($rich='돈'){
        return "{$rich} 부자";
    }
)->where('rich','[0-9a-zA-Z!]{3}');
 */

/* Route::get('/',
    [
        "as"=>'alias',
        function(){
            return '여는 다른라이팅인데 이름이 alias이야!';
        }
    ]
);

Route::get('/wdj',
    function(){
        return redirect(route('alias'));
    }
); */


/* 
Route::get(
    '/',
    function(){
       // return view('errors.503'); // 503은 파일이름
        return view('errors/503'); // 둘다 됨
        }
); */

// Route::get(
//     '/databind',
//    /*  function(){
//         return view('yju-com') -> with([
//             'name'=> '김영진',
//             'greeting'=> 'hello',
//         ]);
//     } */
//     function(){
//         $fruits = ['레몬','딸기','바나나','키위'];
//         $fruits=[];
//         return view('yju-com',['name'=>'이영진', 'greeting'=>'오쓰~', 'items'=>$fruits]);
//     } 
// );

// Route::get('/inherit', function(){
//     return view('yju-wdj');
// });


// Route::get('/', function(){}); ==> 
                    //클로저 (Closure)
// Route::get('/', '컨트롤명@메소드');
Route::get('/', 'ProjectController@index');

Route::resource('articles', 'ArticlesController');

Route::get('auth/login', function(){
    $credentials = [ // 로그인 기능: 입력구현 하는 걸 권장
        'email'=>'changyj@yju.ac.kr',
        'password'=>'password',
    ];
    // Auth파사드와 같은 기능
    if(!auth()->attempt($credentials)){
        // auth()->attempt($credentials)
        // 인증시도: 로그인 시도 ($credentials 값을 이용)
        // return: true - 로그인 성공
        //         false - 로그인 실패
        return '로그인 실패함';
    }
    // 로그인 성공시
    return redirect('protected');
});
// Route::get('protected', function(){
//     dump(session()->all()); // 화면에 나타내라 (모든 것을)
//     if(!auth()->check()) return '니누꼬? 로그인하시오';
//     // auth()->check(): 로그인 상태인지 확인
//     // return true - 로그인 상태
//     //        false - 로그아웃 상태
                                                
//     return '환영, Welcome, いらっしゃいませ！' . auth()->user()->name;
//             // auth()->user(): User모델의 객체, 로그인한 사용자 객체

// });
Route::get('protected', 
        ['middleware'=>'auth', 
        function(){
            dump(session()->all());                                       
            return '환영, Welcome, いらっしゃいませ！' . auth()->user()->name;
            // auth()->user(): User모델의 객체, 로그인한 사용자 객체
        }
        ]
);
Route::get('auth/logout', function(){
    auth()->logout();
    return '또 봅시다';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* DB::listen(function($query){
    var_dump($query->sql);
}); */ // 주석하면 ArticlesController.php수정한거 안뜬다
// db에 이벤트가 발생하면 듣고있다가 실행

Route::get('json', function(){
    // 모델 연결하여 요청한 결과를 뷰로 보내지만 뷰가 아니라 json으로 응답하기
    $datas=['name'=>'김영진', 'age'=>'24', 'grade'=>'4.0'];
    return response()->json($datas);
});

/* Event::listen('article.created', function($article){ // listen으로 ArticlesController.php 에서 던진거 받음
    var_dump('이벤트 수령');
    var_dump($article->toArray()); // 이쁘게 배열로 출력해줘
}); */

Route::get('mail',function(){
    $article=App\Article::with('user')->find(1);

    return Mail::send(
        'emails.articles.created',
        compact('article'),
        function($message) use($article){
            /* $message->to('bel1222@yju.ac.kr');
            $message->subject('새글이 등록되었습니다. '.$article->title); */
            $message->from('admin@yju.ac.kr');
            //$message->to(['bel1222@yju.ac.kr','wndus99227@gmail.com']);
            $message->to('bel1222@yju.ac.kr');
            $message->subject('새글이 등록되었습니다. '.$article->title);
            //$message->cc('kga99227@naver.com');
            //$message->attach(storage_path('elephant.gif'));
            // storage_path(): storages폴더 내의 파일의 절대경로 반환하는 헬퍼함수
        }
    );
});

Route::get('markdown',function(){
    $text=<<<EOT
#마크다운 예제 1

이 문서는[마크다운][1]으로 썼습니다. 화면에는 HTML로 변환되어 출력됩니다.

## 순서 없는 목록

- 첫 번째 항목
- 두 번째 항목[^1]

[1] : http://daringfireball.net/projectsmarkdown

[^1] : 두 번째 항목_ http://google.com

EOT;
    return app(ParsedownExtra::class)->text($text);
});
