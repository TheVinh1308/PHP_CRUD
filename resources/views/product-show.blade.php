@extends('layouts.app')
{{--'layouts' là tên folder , 'app' là tên file}, không có phần 'blade.php'--}}
@section('title','Product details')
@section('header')
    @parent
    &gt; <a href="{{route('products.index');}}">Products</a>
    &gt; {{$p -> name}}
@endsection

@section('content')
    <h1>{{$p -> name}}</h1>
    <dl>
        <dt>Image: </dt>
        <dd>
            <img src="{{$p->image}}" alt="" style="width: 500px;max-height: 250px; object-fit: contain">
        </dd>

        <dt>Price: </dt>
        <dd>{{$p -> price}}</dd>

        <dt>Description: </dt>
        <dd>{{$p -> desc}}</dd>

        <dt>ProductType: </dt>
        <dd>{{$p -> category -> name}}</dd>

    </dl>
@endsection
