@extends('layout.app')

@section('title', __('messages.checkout'))

@section('content')
    <h2 class="text-center text-light mb-4">@lang('messages.checkout')</h2>

    <div class="card bg-dark text-light border border-warning mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h4 class="text-warning mb-3">@lang('messages.your_books'):</h4>
            <ul class="list-group list-group-flush mb-3">
                @foreach($orders as $order)
                    <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center book-item">
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ asset($order->product->image ?? 'img/image-1.jpg') }}"
                                 alt="{{ $order->product->name }}"
                                 style="width:50px; height:70px; object-fit:cover; border-radius:0.3rem;">
                            <span>{{ $order->product->name }}</span>
                        </div>
                        <span class="book-price">{{ number_format($order->product->price, 2) }} TMT</span>
                    </li>
                @endforeach
            </ul>

            <div class="text-center mb-3">
                <h5 class="text-warning">@lang('messages.total_price'): {{ number_format($total, 2) }} TMT</h5>
            </div>

            <form action="{{ route('checkout.confirm') }}" method="POST" class="text-center mb-3">
                @csrf
                <button type="submit" class="btn btn-checkout-gradient fw-bold w-100">
                    @lang('messages.confirm_purchase')
                </button>
            </form>

            <a href="{{ route('my.books.index') }}" class="btn btn-return-gradient fw-bold w-100">
                @lang('messages.return_to_cart')
            </a>
        </div>
    </div>

    <style>
        .book-item span,
        .book-item div span,
        .book-item span,
        .book-item li {
            color: #ffffff; /* золотистый цвет */
        }

        .book-item .book-price {
            color: #ffc107;
            font-weight: 600;
        }

        .book-item {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            margin-bottom: 5px;
        }

        .book-item:hover {
            background: rgba(255, 193, 7, 0.1);
            transform: translateY(-2px);
        }

        .btn-checkout-gradient, .btn-return-gradient {
            position: relative;
            display: inline-block;
            padding: 0.45rem 1rem;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 0.4rem;
            cursor: pointer;
            text-align: center;
            overflow: hidden;
            transition: all 0.4s;
        }

        .btn-checkout-gradient {
            color: #fdf9f9;
            border: 2px solid #129d04;
            background: linear-gradient(135deg, #129d04, #41c700);
        }

        .btn-checkout-gradient:hover {
            background: linear-gradient(135deg, #41c700, #0f8903);
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(65, 199, 0, 0.5);
        }

        .btn-return-gradient {
            color: #fff;
            border: 2px solid #6c757d;
            background: linear-gradient(135deg, #3a3a5c, #6c757d);
        }

        .btn-return-gradient:hover {
            background: linear-gradient(135deg, #6c757d, #3a3a5c);
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(108, 117, 125, 0.5);
        }
    </style>
@endsection
