@extends('client.layout.app')

@section('title', __('messages.cart'))

@section('content')
    <h2 class="text-center text-light mb-4">@lang('messages.cart') <i class="bi bi-basket-fill text-light"></i></h2>
    {{-- Верхние кнопки --}}
    @if($orders->count() > 0)
        <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
            {{-- Delete All --}}
            <form action="{{ route('mybooks.deleteAll') }}" method="POST"
                  onsubmit="return confirm('@lang('messages.confirm_delete_all')');" class="w-auto">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete-gradient fw-bold w-100">
                    <span>@lang('messages.delete_all')</span>
                </button>
            </form>

            {{-- Checkout --}}
            <a href="{{ route('checkout.index') }}" class="btn btn-check-gradient fw-bold"
               style="min-width: 120px; padding: 0.35rem 0.8rem;">
                <span>@lang('messages.checkout')</span>
            </a>
        </div>

    @endif

    {{-- Alert для действий --}}
    @if(session('success'))
        <div id="customAlert"
             class="alert alert-dark alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg rounded-4 px-4 py-3 border border-warning text-warning"
             style="z-index: 1055; min-width: 340px; font-weight: 500; backdrop-filter: blur(8px); background: rgba(33, 37, 41, 0.95);">
            <i class="bi bi-star-fill me-2 text-warning"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('customAlert');
                if (alert) {
                    alert.style.transition = 'all 0.6s ease';
                    alert.style.transform = 'translate(-50%, -50px)';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 600);
                }
            }, 2500);
        </script>
    @endif

    <div class="row g-4">
        @forelse($orders as $order)
            <div class="col-md-3">
                <div class="card bg-dark text-light h-100 shadow-lg rounded-4 border border-secondary cart-card">
                    {{-- Клик по картинке ведет на show --}}
                    <a href="{{ route('book.show', $order->product->id) }}">
                        <img src="{{ asset($order->product->image ?? 'img/image-1.jpg') }}"
                             class="card-img-top book-img"
                             alt="{{ $order->product->name }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-warning text-center">{{ $order->product->name }}</h5>
                        <p class="mb-1"><strong>@lang('messages.price'):</strong> {{ $order->product->price }} TMT</p>
                        <p class="mb-1"><strong>@lang('messages.code'):</strong> {{ $order->product->code }}</p>
                        <p class="mb-3"><strong>@lang('messages.quantity'):</strong> {{ $order->quantity }}</p>

                        <form action="{{ route('mybooks.delete', $order->id) }}" method="POST"
                              class="mt-auto w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete-gradient fw-bold w-100">
                                <span>@lang('messages.delete')</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">@lang('messages.empty_cart')</div>
            </div>
        @endforelse

        @if($orders->count() > 0)
            <div class="d-flex justify-content-center mt-5">
                <div class="card bg-dark text-light border border-warning" style="max-width: 400px; width:100%;">
                    <div class="card-body text-center">
                        <h4 class="text-warning mb-3">@lang('messages.total_price')</h4>
                        <h3 class="fw-bold text-light">{{ number_format($total, 2) }} TMT</h3>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>

    <style>
        .cart-card {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .cart-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 0 25px rgba(255, 193, 7, 0.5);
        }

        .book-img {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            transition: transform 0.5s ease;
        }

        .cart-card:hover .book-img {
            transform: scale(1.05);
        }

        /* Кнопки с градиентами */
        .btn-check-gradient, .btn-delete-gradient {
            position: relative;
            display: inline-block;
            padding: 0.35rem 0.9rem;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 0.4rem;
            cursor: pointer;
            text-align: center;
            overflow: hidden;
            transition: all 0.4s;
        }

        /* Checkout кнопка */
        .btn-check-gradient {
            color: rgb(90, 255, 0);
            border: 2px solid #129d04;
            background: transparent;
        }

        .btn-check-gradient::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, #414040, #129d04);
            z-index: 0;
            transition: width 0.4s ease;
        }

        .btn-check-gradient:hover::before {
            width: 100%;
        }

        .btn-check-gradient:hover {
            color: rgba(248, 248, 248, 0.99);
            border-color: #129d04;
        }

        /* Delete кнопка */
        .btn-delete-gradient {
            color: #ff0018;
            border: 2px solid #f5061d;
            background: transparent;
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
            color: #fff;
            border-color: #ff4d4f;
        }

        /* Текст поверх градиента */
        .btn-check-gradient span,
        .btn-delete-gradient span {
            position: relative;
            z-index: 1;
        }
    </style>
@endsection
