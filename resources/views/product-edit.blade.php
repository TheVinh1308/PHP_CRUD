@extends('layouts.app')
{{--'layouts' là tên folder , 'app' là tên file}, không có phần 'blade.php'--}}
@section('title','Edit product')
@section('header')
    @parent
    &gt; <a href="{{route('products.index');}}">Products</a>
   {{--&gt; Edit sản phẩm--}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h1 class="title">Edit Product</h1>
            <div class="card">
                <div class="header">

                </div>
                <div class="content">
                    <form method="POST" action="{{route('products.update',['product'=>$p])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Name: </label>
                                    <input type="text" class="form-control" name="name" value="{{old('name',$p->name)}}">
                                    @if($errors->has('name')) {{$errors->first('name')}} <br> @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Price </label>
                                    <input type="text" class="form-control" name="price" value="{{old('price',$p->price)}}">
                                    @if($errors->has('price')) {{$errors->first('price')}} <br> @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description: </label>
                                    <textarea type="email" class="form-control" name="desc">{{old('desc',$p->desc)}}</textarea>
                                    @if($errors->has('desc')) {{$errors->first('desc')}} <br> @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image: </label>
                                    <img src="{{$p->image}}" alt="" style="width: 100px;max-height: 100px; object-fit: contain"><br>
                                    <input type="file" class="form-control" accept="image/*" name="image" value="" >
                                    @if($errors->has('image')) {{$errors->first('image')}} <br> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category: </label>
                                    <select name="category" id="" class="form-control">
                                        <option value="">-- Chọn loại --</option>
                                            @foreach ($lst as $cat)
                                                <option value="{{$cat->id}}" @if ($cat->id==old('category',$p->category_id))
                                                   selected @endif>{{$cat->name}}</option>
                                            @endforeach
                                    </select><br>
                                    @if($errors->has('category')) {{$errors->first('category')}} <br> @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
@endsection
