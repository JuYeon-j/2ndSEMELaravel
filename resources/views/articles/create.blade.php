@extends('layouts.app')

@section('content')
<div class="container">
    <h1>새글 쓰기</h1>
    <hr />
    <!-- css: bootstrap4.3.1사용, ch9에서 php artisan ui:vue --auth npm i, npm run dev -->
    <form action="{{ route('articles.store') }}" method="post">
        {!! csrf_field() !!} {{-- @csrf --}}
        {{-- route()-url경로, csrf_field(): csrf 대응 헬퍼함수 => @csrf --}}
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        {{-- $errors->has('title') ? 'has-error' : '' ==> title을 key 로 하는 유효성 체크 오류가 있는 지 확인,
            'has error' : 부트스탭이 css 클래스 --}}
            <label for="title">제목</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"/>
            {!! $errors->first('title','<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
            <label for="content">본문</label>
            <textarea name="content" id="content" rows="10" class="form-control">{{ old('content')}}</textarea>
            {!! $errors->first('content','<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                저장하기
            </button>
        </div>
    </form>
</div>
@stop