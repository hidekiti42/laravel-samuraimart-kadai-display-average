@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories, 'major_categories' => $major_categories])
        @endcomponent
    </div>
    <div class="col-9">
        <div class="container mt-4">
            {{-- パンくずリスト表示エリア --}}
            <div class="container">
                @if ($category !== null)
                    <a href="{{ route('products.index') }}">トップ</a> > <a href="#">{{ $major_category->name }}</a> > {{ $category->name }}
                    <h1>{{ $category->name }}の商品一覧 {{$total_count}}件</h1>
                @elseif ($keyword !== null)
                    <a href="{{ route('products.index') }}">トップ</a> > <a href="{{ route('products.index') }}">商品一覧</a>
                    <h1>"{{ $keyword }}"の検索結果 {{$total_count}}件</h1>
                @else
                    {{-- 何も選択されていない時も「トップ > 商品一覧」を出す場合 --}}
                    <a href="{{ route('products.index') }}">トップ</a> > 商品一覧
                    <h1>商品一覧</h1>
                @endif
            </div>
            <div>
                Sort By
                @sortablelink('id', 'ID')
                @sortablelink('price', 'price')
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('products.show', $product) }}">
                            @if ($product->image !== "")
                                {{-- 修正点：asset() の中に直接パスを入れる形に統一 --}}
                                <img src="{{ asset($product->image) }}" class="img-thumbnail samuraimart-product-img-products">
                            @else
                                <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail samuraimart-product-img-products">
                            @endif
                        </a>
                        <div class="row">
                            <div class="col-12">
                                <p class="samuraimart-product-label mt-2">
                                    {{-- 1. 商品名（リンク） --}}
    <a href="{{ route('products.show', $product) }}" class="link-dark">
        {{ $product->name }}
    </a><br>

    {{-- 2. 星評価コンポーネント --}}
    <x-star-rating :product="$product" />

    {{-- 3. 価格 --}}
    <label>￥{{ number_format($product->price) }}</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
