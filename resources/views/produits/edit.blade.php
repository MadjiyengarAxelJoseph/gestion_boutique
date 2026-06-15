@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">
                <h4>Modifier un Produit</h4>
            </div>
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('produits.update', $produit) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Référence</label>
                        <input type="text" name="reference" class="form-control" value="{{ old('reference', $produit->reference) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Désignation</label>
                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $produit->designation) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix unitaire (CFA)</label>
                        <input type="number" step="0.01" name="prix_unitaire" class="form-control" value="{{ old('prix_unitaire', $produit->prix_unitaire) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantité en stock</label>
                        <input type="number" name="quantite_stock" class="form-control" value="{{ old('quantite_stock', $produit->quantite_stock) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ old('description', $produit->description) }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Modifier</button>
                        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection