<!-- resources/views/sauces/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Toutes les Sauces</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Fabricant</th>
                    <th>Chaleur</th>
                    <th>Image</th>
                    <th>Voir</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Vérification si l'utilisateur est connecté pour afficher le bouton -->
                @auth
                    <a href="{{ route('sauces.create') }}">Ajouter une sauce</a>
                @endauth

                <!-- Si l'utilisateur n'est pas connecté, tu peux afficher un message ou ne rien afficher -->
                @guest
                    <p>Vous devez être connecté pour ajouter une sauce.</p>
                @endguest
                
                @foreach ($sauces as $sauce)
                    <tr>
                        <td>{{ $sauce->name }}</td>
                        <td>{{ $sauce->manufacturer }}</td>
                        <td>{{ $sauce->heat }}</td>
                        <td>
                            <img src="{{ $sauce->imageUrl }}" alt="{{ $sauce->name }}" style="width:200px; height:auto;"/>
                        </td>
                        <td>
                            <a href="{{ route('sauces.show', $sauce->id) }}" class="btn btn-info btn-sm">Voir</a>
                        </td>
                        <td>
                            @auth
                                <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                <form action="{{ route('sauces.destroy', $sauce->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            @endauth

                            @guest
                                <p>Vous devez être connecté pour modifier ou supprimer une sauce.</p>
                            @endguest
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
