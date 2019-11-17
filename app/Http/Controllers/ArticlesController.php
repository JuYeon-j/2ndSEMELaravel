<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ArticlesRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return __METHOD__ . '조회기능';
        //$articles = \App\Article::with('user')->get(); // with()로 eager loading
        //$articles = \App\Article::get()->load('user'); // 지연로딩
        $articles = \App\Article::with('user')->latest()->paginate(3);
        return view('articles.index', compact('articles'));
        // compact(): 배열 만들기, https://www.php.net/manual/en/function.compact.php
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return __METHOD__ . 'create생성을위한 폼뷰 기능';
        return view('articles.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
        //return __METHOD__ . '은 사용자의 입력가능한 폼 데이터로 새로운 Article 컬렉션을 만듦(저장기능)';
        //1)
        // $rules =[ // 유효성 체크 필드 설정 룰 저장
        //     'title'=>['required'], // '필드'=>'검사조건'
        //     'content'=>['required', 'min:10'], //적어도 10개 글자
        // ];
       
        // $validator=\Validator::make($request->all(), $rules);

        // if($validator->fails()){
        //     return back()->withErrors($validator)->withInput();
        // }
        // $article=\App\User::find(1)->articles()->create(
        //     $request->all() // 자동으로 만들어짐
        // );  
        // if(!$article){
        //     return back()->with('flash_message','글작성 실패')->withInput();
        // }
        // return redirect(route('articles.index'))->with('flash_message','글작성 성공');

        /* 2)
        $rules =[
            'title'=>['required'], // '필드'=>'검사조건'
            'content'=>['required', 'min:10'], //적어도 10개 글자
        ];
        $message=[
            'title.required'=>"제목은 필수 입력 항목임",
            'content.required'=>"내용은 필수 입력 항목임",
            'content.min'=>"본문은 최소 :min글자 이상이어야 함",
        ];

        $validator=\Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $article=\App\User::find(1)->articles()->create(
            $request->all() // 자동으로 만들어짐
        );  
        if(!$article){
            return back()->with('flash_message','글작성 실패')->withInput();
        }
        return redirect(route('articles.index'))->with('flash_message','글작성 성공'); */

        //3)
    //     $rules =[
    //         'title'=>['required'], // '필드'=>'검사조건'
    //         'content'=>['required', 'min:10'], //적어도 10개 글자
    //     ];
    //     $message=[
    //         'title.required'=>"제목은 필수 입력 항목임",
    //         'content.required'=>"내용은 필수 입력 항목임",
    //         'content.min'=>"본문은 최소 :min글자 이상이어야 함",
    //     ];

    //     // $validator=\Validator::make($request->all(), $rules, $message);
    //     $this->validate($request, $rules, $message);

    //     // if($validator->fails()){
    //     //     return back()->withErrors($validator)->withInput();
    //     // }
    //     $article=\App\User::find(1)->articles()->create(
    //         $request->all() // 자동으로 만들어짐
    //     );  
    //     if(!$article){
    //         return back()->with('flash_message','글작성 실패')->withInput();
    //     }
    //     return redirect(route('articles.index'))->with('flash_message','글작성 성공'); 
        

    // }

    // public function store(\App\Http\Requests\ArticlesRequest $request)
    public function store(ArticlesRequest $request)
    {
        $article=\App\User::find(1)->articles()->create($request->all());
// $article=auth()->user()->articles()->create($request->all());
        if(!$article){
            return back()->with('flash_message','글작성 실패')->withInput();
        }
        // return redirect(route('articles.index'))->with('flash_message','글작성 성공'); 
        //var_dump('이벤트 발생');

        // event('article.created', [$article]);
        // event(new \App\Events\ArticleCreated($article));
        event(new \App\Events\ArticlesEvent($article));
        
        //var_dump('이벤트 발생완료');
        return redirect(route('articles.index'))->with('flash_message','글작성 성공');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // id는 url에서 넘어옴
    {
        // echo $foo;
        // $id : URL에서 넘겨지는 리소스아이디
        // return __METHOD__ . "{$id} 번째 리소스 조회 기능";
        $articles = \App\Article::findOrFail($id);

        return $articles->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return __METHOD__ . "{$id} 번째 폼뷰 수정";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return __METHOD__ . "{$id} 번째 수정기능을 함";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return __METHOD__ . "{$id} 번째 리소스 삭제 기능";
    }
}
