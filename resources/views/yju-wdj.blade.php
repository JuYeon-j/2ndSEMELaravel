@extends('layouts.master')

@section('content')
    <h1>자식이야 잘받아.</h1>
@endsection

{{-- 없으면 무시하고 넘어감 --}}
@section('style')
    <style>
    body{background:green; color:white;}
    </style>
@stop {{-- stop는 endsection이랑 같음 --}}

@section('foot')
    @include('subviews.footer')
@stop

@section('script')
<script>
    alert('자식의 스크립트 섹션임');
</script>
@stop




{{-- 자식 --}}