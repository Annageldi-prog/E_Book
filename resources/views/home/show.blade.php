@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset($product->image ?? 'image/image5.jpg') }}"
                     alt="{{ $product->name }}"
                     class="img-fluid rounded shadow">
            </div>

            <div class="col-md-8">
                <h2 class="text-warning">{{ $product->title }}</h2>
                <p><strong>Автор:</strong> {{ $product->author->name ?? '—' }}</p>
                <p><strong>Kategoriýa:</strong> {{ $product->category->name ?? '—' }}</p>
                <p><strong>Seriýa:</strong> {{ $product->series->name ?? '—' }}</p>
                <p><strong>Bahasy:</strong> {{ $product->price }} TMT</p>

                <p class="mt-3">{{ $product->description }}</p>

                <form action="{{ route('book.order', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning mt-3">Sebede goş</button>
                </form>
            </div>
        </div>
    </div>
@endsection
