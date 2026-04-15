@props(['product'])

{{-- 余計な余白や枠を一度消して、純粋に星が出るか確認します --}}
<span class="samuraimart-star-rating" data-rate="{{ $product->rounded_average_rating }}"></span>
<span class="ms-1">{{ number_format($product->average_rating, 1) }}</span>
