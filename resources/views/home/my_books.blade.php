@extends('layout.app')

@section('title', __('messages.cart'))

@section('content')
    <h2 class="text-center text-dark mb-4">@lang('messages.cart') <i class="bi bi-basket-fill"></i></h2>

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

    @if($orders->count() > 0)
        <div class="d-flex justify-content-center gap-3 mb-4">
            <form action="{{ route('my.books.deleteAll') }}" method="POST"
                  onsubmit="return confirm('@lang('messages.confirm_delete_all')');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger text-light fw-bold px-4">
                    @lang('messages.delete_all')
                </button>
            </form>

            <a href="{{ route('checkout') }}" class="btn btn-success fw-bold px-4">
                @lang('messages.checkout')
            </a>
        </div>
    @endif

    <div class="row g-4">
        @forelse($orders as $order)
            <div class="col-md-3">
                <div class="card bg-dark text-light h-100 shadow-lg rounded-4 border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title text-warning">{{ $order->product->name }}</h5>
                        <p><strong>@lang('messages.price'):</strong> {{ $order->product->price }} TMT</p>
                        <p><strong>@lang('messages.code'):</strong> {{ $order->product->code }}</p>
                        <p><strong>@lang('messages.quantity'):</strong> {{ $order->quantity }}</p>
                    </div>
                    <div class="card-footer bg-transparent text-center">
                        <form action="{{ route('my.books.delete', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                @lang('messages.delete')
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
            <div class="card bg-dark text-light border border-warning mt-5 mx-auto" style="max-width: 400px;">
                <div class="card-body text-center">
                    <h4 class="text-warning mb-3">@lang('messages.total_price')</h4>
                    <h3 class="fw-bold text-light">{{ number_format($total, 2) }} TMT</h3>
                </div>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
