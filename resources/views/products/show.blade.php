@extends('layouts.app')

@section('content')
<div class="container pt-2">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <nav class="mb-2" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('top') }}">トップ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->id]) }}">{{ $product->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    @if ($product->image)
                        {{-- 修正点1：表示パスを public/img に向ける --}}
                        <img src="{{ asset('img/' . basename($product->image)) }}" class="img-thumbnail samuraimart-product-img-detail">
                    @else
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail samuraimart-product-img-detail">
                    @endif
                </div>
                <div class="col">
                    <div>
                        <h1>
                            {{$product->name}}
                        </h1>
                        <p>
                            {{$product->description}}
                        </p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex align-items-baseline">
                        <span class="fs-4 fw-bold">￥{{ number_format($product->price) }}</span><span class="small">（税込）</span>
                    </div>

                    <hr class="my-4">

                    @auth
                        <form method="POST" action="{{route('carts.store')}}" class="align-items-end">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="name" value="{{$product->name}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            {{-- 修正点2：カートに送る画像パスもファイル名だけにする --}}
                            <input type="hidden" name="image" value="{{ basename($product->image) }}">
                            <input type="hidden" name="carriage" value="{{$product->carriage_flag}}">
                            <div class="form-group row mb-3 pt-2">
                                <label for="quantity" class="col-sm-2 col-form-label">数量</label>
                                <div class="col-sm-10">
                                    <input type="number" id="quantity" name="qty" min="1" value="1" class="form-control w-25 samuraimart-form-parts">
                                </div>
                            </div>
                            <input type="hidden" name="weight" value="0">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn samuraimart-submit-button w-100 text-white">
                                        <i class="fas fa-shopping-cart"></i>
                                        カートに追加
                                    </button>
                                </div>
                                <div class="col">
                                    @if(Auth::user()->favorite_products()->where('product_id', $product->id)->exists())
                                        <a href="{{ route('favorites.destroy', $product->id) }}" class="btn samuraimart-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                                            <i class="fa fa-heart"></i>
                                            お気に入り解除
                                        </a>
                                    @else
                                        <a href="{{ route('favorites.store', $product->id) }}" class="btn samuraimart-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                                            <i class="fa fa-heart"></i>
                                            お気に入り
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $product->id) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <form id="favorites-store-form" action="{{ route('favorites.store', $product->id) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                </div>
            </div>

            <hr class="mb-4">

            {{-- レビューセクションは変更なし --}}
            <div class="row">
                <h2 class="float-left">カスタマーレビュー</h2>
            </div>
            {{-- 以下省略 --}}
