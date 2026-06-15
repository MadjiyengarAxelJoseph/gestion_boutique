@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des Clients</h2>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">+ Ajouter un client</a>
</div>

<div class="table-responsive-wrapper">
<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->nom }}</td>
            <td>{{ $client->prenom }}</td>
            <td>{{ $client->telephone }}</td>
            <td>{{ $client->adresse }}</td>
            <td>{{ $client->email }}</td>
            <td>
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection