@extends('layout.app')

@section('content')
    <h2 class="text-center text-dark mb-4">Sebedim <i class="bi bi-cart-fill"></i></h2>
    @if($orders->count() > 0)
        <div class="d-flex justify-content-center gap-3 mb-4">
            <form action="{{ route('my.books.deleteAll') }}" method="POST"
                  onsubmit="return confirm('Hakykatdanam ähli kitaplary pozmakçymy?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger text-light fw-bold px-4">
                    Poz hemmesini
                </button>
            </form>

            <a href="{{ route('checkout') }}" class="btn btn-success fw-bold px-4">
                Satyn almak
            </a>
        </div>
    @endif


    <div class="row g-4">
        @forelse($orders as $order)
            <div class="col-md-3">
                <div class="card bg-dark text-light h-100 shadow-lg rounded-4 border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title text-warning">{{ $order->product->name }}</h5>
                        <p><strong>Bahasy:</strong> {{ $order->product->price }} TMT</p>
                        <p><strong>Kod:</strong> {{ $order->product->code }}</p>
                        <p><strong>Sany:</strong> {{ $order->quantity }}</p>
                    </div>
                    <div class="card-footer bg-transparent text-center">
                        <form action="{{ route('my.books.delete', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Pozmak
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Sebediňiz häzirlikçe boş</div>
            </div>
        @endforelse
            @if($orders->count() > 0)
                <div class="card bg-dark text-light border border-warning mt-5 mx-auto" style="max-width: 400px;">
                    <div class="card-body text-center">
                        <h4 class="text-warning mb-3">Jemi baha</h4>
                        <h3 class="fw-bold text-light">{{ number_format($total, 2) }} TMT</h3>
                    </div>
                </div>
            @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
