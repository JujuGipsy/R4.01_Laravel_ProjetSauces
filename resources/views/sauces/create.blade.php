<!-- resources/views/sauces/create.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Sauce</title>
</head>
<body>
    <h1>Ajouter une Nouvelle Sauce</h1>

    <!-- Afficher les erreurs de validation -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire pour ajouter une sauce -->
    <form action="{{ route('sauces.store') }}" method="POST">
        @csrf

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="manufacturer">Fabricant :</label>
        <input type="text" id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>

        <label for="mainPepper">Piment principal :</label>
        <input type="text" id="mainPepper" name="mainPepper" value="{{ old('mainPepper') }}" required>

        <label for="heat">Chaleur :</label>
        <input type="number" id="heat" name="heat" value="{{ old('heat') }}" min="0" max="10" required>

        <label for="imageUrl">URL de l'image :</label>
        <input type="text" id="imageUrl" name="imageUrl" value="{{ old('imageUrl') }}">

        <button type="submit">Ajouter la sauce</button>
    </form>

    <a href="{{ route('sauces.index') }}">Retour à la liste des sauces</a>
</body>
</html>
