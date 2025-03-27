<!-- resources/views/sauces/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la Sauce: {{ $sauce->name }}</h1>

        <form action="{{ route('sauces.update', $sauce->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $sauce->name) }}" required>
            </div>

            <div class="form-group">
                <label for="manufacturer">Fabricant</label>
                <input type="text" id="manufacturer" name="manufacturer" class="form-control" value="{{ old('manufacturer', $sauce->manufacturer) }}" required>
            </div>

            <div class="form-group">
                <label for="main_pepper">Ingrédient principal</label>
                <input type="text" id="main_pepper" name="main_pepper" class="form-control" value="{{ old('main_pepper', $sauce->main_pepper) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" required>{{ old('description', $sauce->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image_url">URL de l'image</label>
                <input type="text" id="image_url" name="image_url" class="form-control" value="{{ old('image_url', $sauce->image_url) }}" required>
            </div>

            <div class="form-group">
                <label for="heat">Chaleur (de 1 à 10)</label>
                <input type="number" id="heat" name="heat" class="form-control" value="{{ old('heat', $sauce->heat) }}" min="1" max="10" required>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
@endsection
