<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>여기가 새로운 뷰이여..잘봐!</h1>
    <h1><?= isset($greeting)? "{$greeting}":'Hse' ?><?= $name; ?></h1>
    <h1>{{$greeting}} {{$name}}</h1>
    {{-- 주석입니당 --}}

    @if($itemCount = count($items))
        <p>{{$itemCount}} 종류의 과일을 판매중</p>
    @else
        <p>완판!</p>
    @endif

    <ul>
        @foreach($items as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>

    <ul>
        @forelse($items as $item)
            <li>{{$item}}</li>
        @empty
            <li>엥 아무것도 없는데</li>
        @endforelse
    </ul>

</body>
</html>