@extends('layouts.app')
{{--'layouts' là tên folder , 'app' là tên file}, không có phần 'blade.php'--}}
@section('title','Add product')
@section('header')
    @parent

@endsection


@section('content')

 <h2>
     <a href="{{route('products.index');}}">Danh sách sản phẩm</a>
</h2>

@endsection
