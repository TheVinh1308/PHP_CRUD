@extends('layouts.app')
{{-- 'layouts' là tên folder , 'app' là tên file}, không có phần 'blade.php' --}}
@section('title', 'Product list')
@section('header')
    @parent
    &gt; <a href="{{ route('products.index') }}">Products</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1> Danh sách sản phẩm </h1>
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <a href="{{ route('products.create') }}" class="btn btn-success">Add product</a><br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>IMAGE</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($lst as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>
                                            <img src="{{ $p->image }}" alt=""
                                                style="width: 100px;max-height: 100px; object-fit: contain">
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', ['product' => $p]) }}">{{ $p->name }}</a>
                                        </td>
                                        <td>{{ $p->price }}</td>
                                        <td>{{ $p->category->name }}</td>
                                        <td>
                                            <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                                <form action="{{ route('products.destroy', ['product' => $p]) }}" onsubmit="return confirm('Bạn có chắc muốn xóa không?')"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger font-icon-detail" type="submit" id="delete">
                                                        <i class="pe-7s-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                                <a class="btn btn-warning font-icon-detail"
                                                    href="{{ route('products.edit', ['product' => $p]) }}">
                                                    <i class="pe-7s-tools"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        @endsection
