@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Catalogue des Produits</h2>
    <a href="{{ route('produits.create') }}" class="btn btn-primary">+ Ajouter un produit</a>
</div>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Référence</th>
            <th>Désignation</th>
            <th>Prix unitaire</th>
            <th>Stock</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produits as $produit)
        <tr>
            <td>{{ $produit->reference }}</td>
            <td>{{ $produit->designation }}</td>
            <td>{{ $produit->prix_unitaire }} CFA</td>
            <td>
                @if($produit->quantite_stock <= 5)
                    <span class="badge bg-danger">{{ $produit->quantite_stock }}</span>
                @else
                    <span class="badge bg-success">{{ $produit->quantite_stock }}</span>
                @endif
            </td>
            <td>{{ $produit->description }}</td>
            <td>
                <a href="{{ route('produits.edit', $produit) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('produits.destroy', $produit) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection