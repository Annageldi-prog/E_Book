@extends('admin.layout.admin')

@section('title', $product->title)

@section('content')
    <div class="container py-5">
        <div class="row g-4 align-items-center">

            {{-- Картинка слева --}}
            <div class="col-md-5">
                <img src="{{ asset($product->image ?? 'img/image-1.jpg') }}"
                     alt="{{ $product->title }}"
                     class="img-fluid rounded shadow"
                     style="width: 100%; height: 100%; object-fit: contain; max-height: 500px;">
            </div>


            {{-- Информация справа --}}
            <div class="col-md-7">
                <h2 class="text-warning mb-3">{{ $product->name }}</h2>
                <p class="text-light mb-1"><strong>Baha:</strong> ${{ $product->price }}</p>
                <p class="text-light mb-1"><strong>Kategoriýa:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                <p class="text-light mb-1"><strong>Awtor:</strong> {{ $product->author->name ?? 'N/A' }}</p>
                <p class="text-light mb-1"><strong>Seriýa:</strong> {{ $product->series->name ?? 'N/A' }}</p>
                <p class="text-light mb-3"><strong>Code:</strong> ${{ $product->code }}</p>

                @if($product->description)
                    <div class="text-light p-3 bg-dark rounded description-box">
                        <p>{{ $product->description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .description-box {
            background: rgba(255, 255, 255, 0.05);
        }
    </style>
@endsection
