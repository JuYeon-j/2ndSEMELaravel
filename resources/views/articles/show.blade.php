@extends('layouts.app')

@section('content')
<h1>
{{$article->title}}  <small>{{$article->user->name}}</small>
</h1>
<hr>
<article>
{{$article -> content}}
<small>{{$article->created_at}}</small>
</article>
<footer>
copyright by J.Y KIM since 2019.  <img src="http://127.0.0.1:8000/elephant.gif" alt="">
</footer>
@stop