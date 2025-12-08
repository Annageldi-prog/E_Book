@extends('client.layout.app')
@section('title', 'Saýlanan kitaplar')

@section('content')
    <div class="row g-4">
        @forelse($favorites as $fav)
            <div class="col-md-3">
                <div class="card bg-dark text-light h-100 shadow-lg rounded-4 border border-secondary">
                    {{-- Клик по картинке ведет на show --}}
                    <a href="{{ route('book.show', $fav->product->id) }}">
                        <img src="{{ asset($fav->product->image ?? 'img/image-1.jpg') }}"
                             class="card-img-top"
                             alt="{{ $fav->product->name }}">
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-light">{{ $fav->product->name }}</h5>
                        <div class="mt-auto d-flex justify-content-between">
                            {{-- Удалить из избранного --}}
                            <form action="{{ route('favorites.toggle', $fav->product->id) }}" method="POST"
                                  class="w-100">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 btn-delete-gradient">
                                    <span>@lang('messages.delete') </span>
                                </button>
                            </form>
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

    <style>
        .btn-delete-gradient {
            position: relative;
            display: inline-block;
            padding: 0.35rem 0.9rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: #ff0018; /* начальный цвет */
            border: 2px solid #f5061d;
            background: transparent;
            overflow: hidden;
            transition: color 0.4s, border-color 0.4s;
            border-radius: 0.4rem;
            cursor: pointer;
            text-align: center;
            min-width: 100px;
        }

        .btn-delete-gradient span {
            position: relative;
            z-index: 1;
            transition: color 0.4s;
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
            color: #ffffff;
            border-color: #ff4d4f;
        }
    </style>
@endsection
