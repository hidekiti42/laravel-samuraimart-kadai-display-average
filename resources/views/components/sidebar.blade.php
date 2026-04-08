<div>
    @foreach ($major_categories as $major_category)
        <div class="mb-4">
            <h2>{{ $major_category->name }}</h2>
            {{-- $categories ではなく、親(major_category)に紐づく categories を使う --}}
            @foreach ($major_category->categories as $category)
                <div class="mb-3">
                    <label class="samuraimart-sidebar-category-label">
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="h6 link-dark text-decoration-none">
                            {{ $category->name }}
                        </a>
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
