@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-5">ショッピングカート</h1>

            <div class="row">
                <div class="col-md-8">
                    <span class="fs-5 fw-bold">商品</span>
                </div>
                <div class="col-md-2">
                    <span class="fs-5 fw-bold">数量</span>
                </div>
                <div class="col-md-2">
                    <span class="fs-5 fw-bold">合計</span>
                </div>
            </div>

            <hr class="my-4">

            @if ($cart->isEmpty())
                <div class="row">
                    <p class="mb-0">カートの中身は空です。</p>
                </div>
            @else
                @foreach ($cart as $product)
                    <div class="row align-items-center mb-2">
                        <div class="col-md-2">
                            <a href="{{ route('products.show', $product->id) }}">
                                @if ($product->options->image)
                                    {{-- 修正点：asset('img/' . basename(...)) に変更 --}}
                                    <img src="{{ asset('img/' . basename($product->options->image)) }}" class="img-thumbnail samuraimart-product-img-cart">
                                @else
                                    <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail samuraimart-product-img-cart">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-6">
                            <span class="fs-5">
                                <a href="{{ route('products.show', $product->id) }}" class="link-dark">{{ $product->name }}</a>
                            </span>
                        </div>
                        <div class="col-md-2">
                            <span class="fs-5">{{ number_format($product->qty) }}</span>
                        </div>
                        <div class="col-md-2">
                            <span class="fs-5">￥{{ number_format($product->qty * $product->price) }}</span>
                        </div>
                    </div>
                @endforeach
            @endif

            <hr class="my-4">

            <div class="row justify-content-end">
                <div class="col-md-2">
                    <span class="fs-5 fw-bold">送料</span>
                </div>
                <div class="col-md-2">
                    <span class="fs-5">￥{{ number_format($carriage_cost) }}</span>
                </div>
            </div>

            <hr class="my-4">

            <div class="row justify-content-end mb-4">
                <div class="col-md-2">
                    <span class="fs-5 fw-bold">合計</span>
                </div>
                <div class="col-md-2">
                    <span class="fs-5 fw-bold">￥{{ number_format($total) }}</span>
                </div>
            </div>

            <div class="row mb-4">
                <p class="text-end mb-1">表示価格は税込みです。</p>
            </div>

        <form method="post" action="{{route('carts.destroy')}}" class="d-flex justify-content-end mt-3">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <a href="{{ route('top') }}" class="btn samuraimart-favorite-button border-dark text-dark mr-3">
            買い物を続ける
        </a>
        @if ($total > 0)
            <div class="btn samuraimart-submit-button" data-bs-toggle="modal" data-bs-target="#buy-confirm-modal">購入を確定する</div>
        @else
            <div class="btn samuraimart-submit-button disabled" data-bs-toggle="modal" data-bs-target="#buy-confirm-modal">購入を確定する</div>
        @endif

        <div class="modal fade" id="buy-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aris-labelledby="staticBackdropLabel" aria="hidden=true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">購入を決定しますか？</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn samuraimart-favorite-button border-dark text-dark" data-bs-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn samuraimart-submit-button">購入</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
