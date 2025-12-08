@extends('client.layout.app')

@section('content')
    <div class="container py-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body text-center">
                <h3>{{ $product->title }}</h3>
                <p><strong>Author:</strong> {{ $product->author->name ?? '—' }}</p>
                <p><strong>Price:</strong> {{ $product->price }} TMT</p>

                <form action="{{ route('buy.page', $product->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success">Satyn almak</button>
                </form>

                <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3">Yza gaýt</a>
            </div>
        </div>
    </div>
@endsection
