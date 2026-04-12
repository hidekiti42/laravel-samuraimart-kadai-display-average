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
                @sortablelink('created_at', 'created_at')
            </div>

            <div class="row w-100">
                @foreach ($products as $product)
                <div class="col-3">
                    <a href="{{ route('products.show', $product) }}">
                        @if ($product->image !== "")
                        <img src="{{ asset($product->image) }}" class="img-thumbnail">
                        @else
                        <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                        @endif
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <p class="samuraimart-product-label mt-2">
                                {{$product->name}}<br>
                                <label>￥{{$product->price}}</label>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- ページネーション --}}
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
