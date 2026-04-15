
                    <div class="mb-4">
                        @if ($total > 0)
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn samuraimart-submit-button text-white w-100">お支払い</a>
                            </form>
                        @else
                            <button class="btn samuraimart-submit-button-disabled w-100">お支払い</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
