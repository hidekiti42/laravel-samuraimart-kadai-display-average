@extends('layouts.app')

@section('content')
<div class="container pt-2">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- 1. パンくずリスト --}}
            <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('top') }}">トップ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->id]) }}">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            {{-- 2. 商品メイン情報エリア --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    @if ($product->image)
                        <img src="{{ asset('img/' . basename($product->image)) }}" class="img-thumbnail samuraimart-product-img-detail">
                    @else
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail samuraimart-product-img-detail">
                    @endif
                </div>
                <div class="col">
                    <h1>{{$product->name}}</h1>
                    <x-star-rating :product="$product" />
                    <p>{{$product->description}}</p>
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
                                        <i class="fas fa-shopping-cart"></i> カートに追加
                                    </button>
                                </div>
                                <div class="col">
                                    @if(Auth::user()->favorite_products()->where('product_id', $product->id)->exists())
                                        <a href="{{ route('favorites.destroy', $product->id) }}" class="btn samuraimart-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                                            <i class="fa fa-heart"></i> お気に入り解除
                                        </a>
                                    @else
                                        <a href="{{ route('favorites.store', $product->id) }}" class="btn samuraimart-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                                            <i class="fa fa-heart"></i> お気に入り
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $product->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        <form id="favorites-store-form" action="{{ route('favorites.store', $product->id) }}" method="POST" class="d-none">@csrf</form>
                    @endauth
                </div>
            </div>

            <hr class="mb-4">

            {{-- 3. カスタマーレビューセクション --}}
            <div class="row">
                {{-- 左側：見出しと投稿フォーム --}}
                <div class="col-md-5">
                    <h2 class="mb-3">カスタマーレビュー</h2>
                    <x-star-rating :product="$product" />
                    <p class="h4 fw-bold">{{ $reviews->total() }}件のレビュー</p>

                    @auth
                    <div class="mt-4">
                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf
                            <h4>評価</h4>
                            <select name="score" class="form-control m-2 review-score-color">
                                <option value="5" class="review-score-color">★★★★★</option>
                                <option value="4" class="review-score-color">★★★★</option>
                                <option value="3" class="review-score-color">★★★</option>
                                <option value="2" class="review-score-color">★★</option>
                                <option value="1" class="review-score-color">★</option>
                            </select>
                            <h4>タイトル</h4>
                            <input type="text" name="title" class="form-control m-2">
                            <h4>レビュー内容</h4>
                            <textarea name="content" class="form-control m-2"></textarea>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button type="submit" class="btn samuraimart-submit-button ml-2">レビューを追加</button>
                        </form>
                    </div>
                    @endauth
                </div>

                {{-- 右側：レビュー一覧 --}}
<div class="col-md-7">
    @foreach($reviews as $review)
        <div class="mb-3">
            {{-- 1. タイトル --}}
            <p class="h3 fw-bold">{{ $review->title }}</p>

            {{-- 2. 本文 --}}
            <p class="h4">{{ $review->content }}</p>

            {{-- 3. 投稿日時と氏名 --}}
            <label class="text-muted">
                {{ $review->created_at->format('Y/m/d') }} {{ $review->user->name }}様
            </label>
            <br>

            {{-- 4. 個別レビューの星評価（ここに配置！） --}}
            <p class="review-score-color">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->score)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </p>
        </div>
    @endforeach
</div>

    {{-- ページネーション --}}
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>
            </div>

        </div> {{-- col-md-10 終了 --}}
    </div> {{-- row justify-content-center 終了 --}}
</div> {{-- container 終了 --}}
@endsection
