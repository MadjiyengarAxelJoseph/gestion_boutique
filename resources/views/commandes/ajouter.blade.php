@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Nouvelle Commande</h4>
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

        <form method="POST" action="{{ route('commandes.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Client</label>
                    <select name="client_id" class="form-select">
                        <option value="">-- Choisir un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date de commande</label>
                    <input type="date" name="date_commande" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <h5>Produits</h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Stock disponible</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->designation }}</td>
                        <td>{{ $produit->prix_unitaire }} FCFA</td>
                        <td>
                            @if($produit->quantite_stock <= 5)
                                <span class="badge bg-danger">{{ $produit->quantite_stock }}</span>
                            @else
                                <span class="badge bg-success">{{ $produit->quantite_stock }}</span>
                            @endif
                        </td>
                        <td>
                            <input type="number"
                                   name="produits[{{ $produit->id }}][quantite]"
                                   class="form-control"
                                   style="width:100px"
                                   min="0"
                                   max="{{ $produit->quantite_stock }}"
                                   value="0">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Enregistrer la commande</button>
                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>

    </div>
</div>
@endsection