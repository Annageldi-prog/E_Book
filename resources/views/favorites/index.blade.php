@extends('layout.app')
@section('title', 'Saýlanan kitaplar')

@section('content')
    <div class="row g-4">
        @forelse($favorites as $fav)
            <div class="col-md-3">
                <div class="card bg-dark text-light h-100 shadow-lg rounded-4 border border-secondary">
                    <img src="{{ asset($fav->product->image ?? 'img/image-1.jpg') }}" class="card-img-top" alt="{{ $fav->product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-light">{{ $fav->product->name }}</h5>
                        <div class="mt-auto d-flex justify-content-between">
                            {{-- Удалить из избранного --}}
                            <form action="{{ route('favorites.toggle', $fav->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">@lang('messages.delete')</button>
                            </form>

                            {{-- Подробнее --}}
                            <a href="{{ route('book.show', $fav->product->id) }}" class="btn btn-outline-light btn-sm">@lang('messages.details')</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    @lang('messages.no_favorites')
                </div>
            </div>
        @endforelse
    </div>
@endsection
