@extends('layout.app')

@section('content')
    <h2 class="text-center text-light mb-4">Satyn almak</h2>

    <div class="card bg-dark text-light border border-warning mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h4 class="text-warning mb-3">Siziň kitaplaryňyz:</h4>
            <ul class="list-group list-group-flush mb-3">
                @foreach($orders as $order)
                    <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                        <span>{{ $order->product->name }}</span>
                        <span>{{ number_format($order->product->price, 2) }} TMT</span>
                    </li>
                @endforeach
            </ul>

            <div class="text-center mb-3">
                <h5 class="text-warning">Jemi baha: {{ number_format($total, 2) }} TMT</h5>
            </div>

            <form action="{{ route('checkout.confirm') }}" method="POST" class="text-center">
                @csrf
                <button type="submit" class="btn btn-success w-100 fw-bold">
                     Satyn almagy tassyklamak
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('my.books') }}" class="btn btn-outline-light w-100">Sebede dolan</a>
            </div>
        </div>
    </div>
@endsection
