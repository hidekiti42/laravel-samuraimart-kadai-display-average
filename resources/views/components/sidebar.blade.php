<div class="container">
    @foreach ($major_categories as $major_category)
        <div class="mb-4">
            {{-- 親カテゴリー名を1回だけ表示 --}}
            <h2 class="h4 fw-bold">{{ $major_category->name }}</h2>

            {{-- その親に紐づく子カテゴリーだけをループ --}}
            @foreach ($major_category->categories as $category)
                <div class="mb-2">
                    <label class="samuraimart-sidebar-category-label">
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="link-dark text-decoration-none">
                            {{ $category->name }}
                        </a>
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
