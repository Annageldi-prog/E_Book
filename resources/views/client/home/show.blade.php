@extends('client.layout.app')

@section('title', $product->name)

@section('content')
    <div class="container mt-4">
        <div class="row g-4">
            {{-- show book--}}
            <div class="col-md-4">
                <div class="card shadow-lg rounded-4 border border-secondary bg-dark">
                    <img src="{{ asset($product->image ?? 'img/image-1.jpg') }}"
                         class="card-img-top rounded-4"
                         alt="{{ $product->name }}">
                </div>
            </div>

            <div class="col-md-8 text-light">
                <h2 class="mb-3">{{ $product->name }}</h2>

                <p><strong>@lang('messages.author'):</strong> {{ $product->author->name ?? 'Belli däl' }}</p>
                <p><strong>@lang('messages.category'):</strong> {{ $product->category->name ?? 'Belli däl' }}</p>
                <p><strong>@lang('messages.series'):</strong> {{ $product->series->name ?? 'Ýok' }}</p>
                <p><strong>@lang('messages.price'):</strong> <span class="text-warning">{{ $product->price }} TMT</span>
                </p>


                @php $avg = round($product->reviews->avg('rating'), 1); @endphp
                <div class="mb-3">
                    <strong>@lang('messages.average_rating'):</strong>
                    @if ($product->reviews->count() > 0)
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $avg ? 'text-warning' : 'text-secondary' }}">★</span>
                        @endfor
                        <span class="ms-1 text-light">({{ $avg }}/5)</span>
                    @else
                        <span class="text-muted">@lang('messages.no_comments')</span>
                    @endif
                </div>

                <p class="mt-3">{{ $product->description }}</p>

                <div class="d-flex gap-2 mt-4">
                    {{-- add cart --}}
                    <form action="{{ route('buy.page', $product->id) }}" method="POST" class="flex-fill">
                        @csrf
                        <button type="submit" class="btn btn-fx-fill w-100">
                            <span>@lang('messages.add_to_cart')</span>
                        </button>
                    </form>

                    {{-- add favorite --}}
                    <form action="{{ route('favorites.toggle', $product->id) }}" method="POST" class="flex-fill">
                        @csrf
                        <button type="submit" class="btn btn-fx-fill w-100">
                        <span>
                            @auth
                                {{ (auth()->user()->favorites ?? collect())->contains('product_id', $product->id)
                                    ? __('messages.added_to_favorites')
                                    : __('messages.favorite') }}
                            @else
                                @lang('messages.favorite')
                            @endauth
                        </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <hr class="border-secondary mt-5">

        {{-- review --}}
        <div class="mt-4">
            <h4 class="text-light mb-3">@lang('messages.comments')</h4>

            @auth
                @if(!$product->reviews->where('user_id', auth()->id())->count())
                    <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-light">@lang('messages.rate_product'):</label>
                            <div class="star-rating d-flex">
                                <input type="hidden" name="rating" value="0">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star" data-value="{{ $i }}">★</span>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="3"
                                  placeholder="@lang('messages.add_comment')..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-fx-fill"><span>@lang('messages.add_comment')</span>
                        </button>
                    </form>
                @else
                    <div class="alert alert-secondary">@lang('messages.already_reviewed')</div>
                @endif
            @else
                <div class="alert alert-secondary">
                    @lang('messages.login_to_comment')
                    <a href="{{ route('admin.login') }}" class="text-warning">Login</a>.
                </div>
            @endauth

            {{-- rating --}}
            @forelse($product->reviews as $review)
                <div class="card bg-dark text-light mb-3 border border-secondary">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-warning mb-1">
                                {{ $review->user->name ?? 'Ulanyjy' }}
                                <small class="text-light ms-2">{{ $review->created_at->format('d.m.Y') }}</small>
                            </h6>

                            <div class="review-stars mb-2 d-flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? 'selected' : '' }}">★</span>
                                @endfor
                            </div>

                            <p class="card-text">{{ $review->comment }}</p>
                        </div>

                        @if(auth()->id() === $review->user_id || auth()->user()->is_admin)
                            <form action="{{ route('reviews.destroy', [$product->id, $review->id]) }}"
                                  method="POST"
                                  onsubmit="return confirm('@lang('messages.confirm_delete_review')');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete-gradient">
                                    <span>@lang('messages.delete')</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-light">@lang('messages.no_comments')</p>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star-rating .star');
            const input = document.querySelector('.star-rating input[name="rating"]');

            stars.forEach((star, idx) => {
                star.addEventListener('click', () => {
                    input.value = star.dataset.value;
                    stars.forEach((s, i) => s.classList.toggle('selected', i < idx + 1));
                });

                star.addEventListener('mouseover', () => {
                    stars.forEach((s, i) => s.classList.toggle('hover', i <= idx));
                });

                star.addEventListener('mouseout', () => {
                    stars.forEach(s => s.classList.remove('hover'));
                });
            });
        });
    </script>

    <style>
        .btn-delete-gradient {
            position: relative;
            display: inline-block;
            padding: 0.35rem 0.9rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: #ff0018; /* начальный цвет */
            border: 2px solid #f5061d;
            background: transparent;
            overflow: hidden;
            transition: color 0.4s, border-color 0.4s;
            border-radius: 0.4rem;
            cursor: pointer;
            text-align: center;
            min-width: 100px;
        }

        .btn-delete-gradient span {
            position: relative;
            z-index: 1;
            transition: color 0.4s;
        }

        .btn-delete-gradient::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, #414040, #fd080b);
            z-index: 0;
            transition: width 0.4s ease;
        }

        .btn-delete-gradient:hover::before {
            width: 100%;
        }

        .btn-delete-gradient:hover {
            color: #ffffff;
            border-color: #ff4d4f;
        }


        /* Кнопка корзины */
        .btn-gradient {
            background: linear-gradient(135deg, #ff0734, #ffb300);
            border: none;
            color: #1e1e2f;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #ffb300, #ff8c00);
            color: #fff;
        }

        /* Кнопка избранного fx-fill */
        .btn-fx-fill {
            position: relative;
            display: inline-block;
            padding: 0.35rem 0.9rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: #ffc107;
            border: 2px solid #ffc107;
            background: transparent;
            overflow: hidden;
            transition: color 0.4s, border-color 0.4s;
            border-radius: 0.4rem;
            cursor: pointer;
            text-align: center;
            min-width: 140px;
        }

        .btn-fx-fill span {
            position: relative;
            z-index: 1;
        }

        .btn-fx-fill::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, #ff071c, #ffc000);
            z-index: 0;
            transition: width 0.4s ease;
        }

        .btn-fx-fill:hover::before {
            width: 100%;
        }

        .btn-fx-fill:hover {
            color: #fdfdfd;
            border-color: #d36b09;
        }

        /* Звёзды рейтинга */
        .star-rating, .review-stars {
            font-size: 2rem;
            display: flex;
            gap: 4px;
        }

        .star {
            color: #555;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .star::before {
            content: '★';
            position: absolute;
            left: 0;
            top: 0;
            width: 0%;
            overflow: hidden;
            color: gold;
            background: linear-gradient(90deg, #ffc107, #ff8c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: width 0.3s ease;
        }

        .star.hover::before,
        .star.selected::before {
            width: 100%;
        }

        .star:hover {
            transform: scale(1.2);
        }

        /* Изображение книги */
        .card-img-top {
            transition: transform 0.4s;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }
    </style>
@endsection
