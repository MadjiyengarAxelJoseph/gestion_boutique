@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des Commandes</h2>
    <a href="{{ route('commandes.create') }}" class="btn btn-primary">+ Nouvelle commande</a>
</div>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Numéro</th>
            <th>Date</th>
            <th>Client</th>
            <th>Montant total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($commandes as $commande)
        <tr>
            <td>#{{ $commande->id }}</td>
            <td>{{ $commande->date_commande }}</td>
            <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
            <td><strong>{{ $commande->montant_total }} FCFA</strong></td>
            <td>
                <a href="{{ route('commandes.show', $commande) }}" class="btn btn-sm btn-info text-white">Détails</a>
                <form action="{{ route('commandes.destroy', $commande) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette commande ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection