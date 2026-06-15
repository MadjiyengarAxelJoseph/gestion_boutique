<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #333; }
        .info-section { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .info-box { width: 48%; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #333; color: white; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .total-row { background-color: #f2f2f2; font-weight: bold; }
        .footer { margin-top: 40px; text-align: center; color: #666; }
    </style>
</head>
<body>

<div class="header">
    <h1>Gestion Boutique</h1>
    <h2>FACTURE #{{ $commande->id }}</h2>
    <p>Date : {{ $commande->date_commande }}</p>
</div>

<div class="info-section">
    <div class="info-box">
        <h4>Informations Client</h4>
        <p><strong>Nom :</strong> {{ $commande->client->nom }} {{ $commande->client->prenom }}</p>
        <p><strong>Téléphone :</strong> {{ $commande->client->telephone }}</p>
        <p><strong>Adresse :</strong> {{ $commande->client->adresse }}</p>
        <p><strong>Email :</strong> {{ $commande->client->email }}</p>
    </div>
    <div class="info-box">
        <h4>Informations Commande</h4>
        <p><strong>Numéro :</strong> #{{ $commande->id }}</p>
        <p><strong>Date :</strong> {{ $commande->date_commande }}</p>
    </div>
</div>

<table>
    <thead>
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
            <td>{{ $ligne->prix_unitaire }} FCA</td>
            <td>{{ $ligne->quantite }}</td>
            <td>{{ $ligne->sous_total }} FCFA</td>
        </tr>
        @endforeach
        <tr class="total-row">
            <td colspan="3">MONTANT TOTAL</td>
            <td>{{ $commande->montant_total }} CFA</td>
        </tr>
    </tbody>
</table>

<div class="footer">
    <p>Merci pour votre confiance !</p>
</div>

</body>
</html>