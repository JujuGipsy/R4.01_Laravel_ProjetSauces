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
        <img src="{{ $sauce->imageUrl }}" alt="Image de la sauce" style="width:200px; height:auto;"/>

        <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-primary">Modifier</a>
        <form action="{{ route('sauces.destroy', $sauce->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@endsection
