<div class="container">
    @foreach ($major_categories as $major_category)
        <h2>{{ $major_category->name }}</h2>

        @foreach ($categories as $category)
            {{-- その親カテゴリに属する子カテゴリだけを表示 --}}
            @if ($category->major_category_id == $major_category->id)
                {{-- 【重要】親と子が同じ名前なら、子（リンク）の方は表示しない --}}
                @if ($category->name !== $major_category->name)
                    <label class="samuraimart-sidebar-category-label d-block">
                        <a href="{{ route('products.index', ['category' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </label>
                @endif
            @endif
        @endforeach
    @endforeach
</div>
