@extends('admin.layout.admin')

@section('title', $product->name)

@section('content')
    <div class="container py-5">
        <div class="row g-4 align-items-center">

            {{-- Image Left --}}
            <div class="col-md-5">
                <img src="{{ asset($product->image ?? 'img/image-1.jpg') }}"
                     alt="{{ $product->name }}"
                     class="img-fluid rounded shadow"
                     style="width: 100%; height: 100%; object-fit: contain; max-height: 500px;">
            </div>

            {{-- Info Right --}}
            <div class="col-md-7">
                <h2 class="text-warning mb-3">{{ $product->name }}</h2>

                <p class="text-light mb-1">
                    <strong>{{ __('messages.price') }}:</strong> ${{ $product->price }}
                </p>

                <p class="text-light mb-1">
                    <strong>{{ __('messages.category') }}:</strong>
                    {{ $product->category->name ?? __('messages.not_available') }}
                </p>

                <p class="text-light mb-1">
                    <strong>{{ __('messages.author') }}:</strong>
                    {{ $product->author->name ?? __('messages.not_available') }}
                </p>

                <p class="text-light mb-1">
                    <strong>{{ __('messages.series') }}:</strong>
                    {{ $product->series->name ?? __('messages.not_available') }}
                </p>

                <p class="text-light mb-3">
                    <strong>{{ __('messages.code') }}:</strong> {{ $product->code }}
                </p>

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
            border: 1px solid #444;
        }
    </style>
@endsection
