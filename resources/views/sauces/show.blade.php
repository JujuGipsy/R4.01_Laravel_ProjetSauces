@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $sauce->name }}</h1>
        <p><strong>Fabricant:</strong> {{ $sauce->manufacturer }}</p>
        <p><strong>Ingrédient principal:</strong> {{ $sauce->main_pepper }}</p>
        <p><strong>Description:</strong> {{ $sauce->description }}</p>
        <p><strong>Chaleur:</strong> {{ $sauce->heat }} / 10</p>
        <p><strong>Avis positifs:</strong> {{ $sauce->likes }}</p>
        <p><strong>Avis négatifs:</strong> {{ $sauce->dislikes }}</p>
        <img src="{{ $sauce->imageUrl }}" alt="{{ $sauce->name }}" style="width:200px; height:auto;"/>

        @auth
            <div class="d-flex justify-content-between mt-3">
                <form action="{{ route('sauces.like', $sauce->id) }}" method="POST" id="likeForm">
                    @csrf
                    <button type="submit" class="btn btn-success" 
                        @if(in_array(auth()->user()->id, $sauce->users_liked ?? [])) 
                            disabled 
                        @endif>
                        Like
                    </button>
                </form>

                <form action="{{ route('sauces.dislike', $sauce->id) }}" method="POST" id="dislikeForm">
                    @csrf
                    <button type="submit" class="btn btn-danger" 
                        @if(in_array(auth()->user()->id, $sauce->users_disliked ?? [])) 
                            disabled 
                        @endif>
                        Dislike
                    </button>
                </form>
            </div>
        @endauth

        @guest
            <p>Vous devez être connecté pour modifier, liker ou disliker une sauce.</p>
        @endguest

    </div>
@endsection
