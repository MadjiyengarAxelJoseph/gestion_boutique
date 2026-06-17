@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h4>Détails de la Commande #{{ $commande->id }}</h4>
        <a href="{{ route('commandes.index') }}" class="btn btn-light">Retour</a>
    </div>
    <div class="card-body">

        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Informations client</h5>
                <p><strong>Nom :</strong> {{ $commande->client->nom }} {{ $commande->client->prenom }}</p>
                <p><strong>Téléphone :</strong> {{ $commande->client->telephone }}</p>
                <p><strong>Adresse :</strong> {{ $commande->client->adresse }}</p>
                <p><strong>Email :</strong> {{ $commande->client->email }}</p>
            </div>
            <div class="col-md-6">
                <h5>Informations commande</h5>
                <p><strong>Numéro :</strong> #{{ $commande->id }}</p>
                <p><strong>Date :</strong> {{ $commande->date_commande }}</p>
            </div>
        </div>

        <h5>Produits commandés</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->ligneCommandes as $ligne)
                <tr>
                    <td>{{ $ligne->produit->designation }}</td>
                    <td>{{ $ligne->prix_unitaire }} CFA</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ $ligne->sous_total }} CFA</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-dark">
                    <td colspan="3"><strong>Montant total</strong></td>
                    <td><strong>{{ $commande->montant_total }} CFA</strong></td>
                </tr>
            </tfoot>
        </table>

        <a href="{{ route('commandes.pdf', $commande) }}" class="btn btn-success">📄 Imprimer la facture PDF</a>

    </div>
</div>
@endsection