@extends('layout.app')

@section('title', $product->name)

@section('content')
    <div class="container mt-4">
        <div class="row">
            {{-- 📘 Информация о книге --}}
            <div class="col-md-4">
                <img src="{{ asset($product->image ?? 'img/image-1.jpg') }}"
                     class="img-fluid rounded shadow"
                     alt="{{ $product->name }}">
            </div>

            <div class="col-md-8 text-dark">
                <h2>{{ $product->name }}</h2>
                <p><strong>@lang('messages.author'):</strong> {{ $product->author->name ?? 'Belli däl' }}</p>
                <p><strong>@lang('messages.category'):</strong> {{ $product->category->name ?? 'Belli däl' }}</p>
                <p><strong>@lang('messages.series'):</strong> {{ $product->series->name ?? 'Ýok' }}</p>
                <p><strong>@lang('messages.price'):</strong> {{ $product->price }} TMT</p>

                {{-- Средний рейтинг --}}
                @php
                    $avg = round($product->reviews->avg('rating'), 1);
                @endphp
                <div class="mb-3">
                    <strong>@lang('messages.average_rating'):</strong>
                    @if ($product->reviews->count() > 0)
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $avg ? 'text-warning' : 'text-secondary' }}">★</span>
                        @endfor
                        <span class="ms-1 text-muted">({{ $avg }}/5)</span>
                    @else
                        <span class="text-muted">@lang('messages.no_comments')</span>
                    @endif
                </div>
                <p class="mt-3">{{ $product->description }}</p>

                {{-- Кнопки действий --}}
                <div class="d-flex gap-2 mt-4">
                    {{-- Добавить в корзину --}}
                    <form action="{{ route('book.order', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark">
                            @lang('messages.add_to_cart')
                        </button>
                    </form>

                    {{-- Добавить в избранное --}}
                    <form action="{{ route('favorites.toggle', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            @auth
                                {{ (auth()->user()->favorites ?? collect())->contains('product_id', $product->id)
                                    ? __('messages.added_to_favorites')
                                    : __('messages.favorite') }}
                            @else
                                @lang('messages.favorite')
                            @endauth
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <hr class="border-secondary mt-5">

        {{-- 💬 Отзывы --}}
        <div class="mt-4">
            <h4 class="text-dark mb-3">@lang('messages.comments')</h4>

            {{-- Форма добавления отзыва --}}
            @auth
                @if(!$product->reviews->where('user_id', auth()->id())->count())
                    <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-dark">@lang('messages.rate_product'):</label><br>
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" id="rate{{ $i }}" value="{{ $i }}">
                                <label for="rate{{ $i }}">★</label>
                            @endfor
                        </div>

                        <div class="mb-3">
                            <textarea name="comment" class="form-control" rows="3" placeholder="@lang('messages.add_comment')..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-dark text-light">@lang('messages.add_comment')</button>
                    </form>
                @else
                    <div class="alert alert-secondary">
                        @lang('messages.already_reviewed')
                    </div>
                @endif
            @else
                <div class="alert alert-secondary">
                    @lang('messages.login_to_comment')
                    <a href="{{ route('admin.login') }}" class="text-warning">Login</a>.
                </div>
            @endauth

            {{-- Список отзывов --}}
            @forelse($product->reviews as $review)
                <div class="card bg-dark text-light mb-3 border border-secondary">
                    <div class="card-body">
                        <h6 class="card-title text-warning mb-1">
                            {{ $review->user->name ?? 'Ulanyjy' }}
                            <small class="text-light ms-2">{{ $review->created_at->format('d.m.Y H:i') }}</small>
                        </h6>

                        {{-- ⭐ Звёзды --}}
                        <div class="mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}">★</span>
                            @endfor
                        </div>

                        <p class="card-text">{{ $review->comment }}</p>
                    </div>
                </div>
            @empty
                <p class="text-light">@lang('messages.no_comments')</p>
            @endforelse
        </div>
    </div>
@endsection
