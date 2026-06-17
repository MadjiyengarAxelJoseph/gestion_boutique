<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use App\Models\LigneCommande;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    
    public function index()
    {
        $commandes = Commande::with('client')->get();
        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {   
        $clients = Client::all();
        $produits = Produit::all();
        return view('commandes.ajouter', compact('clients', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'    => 'required',
            'date_commande'=> 'required|date',
            'produits'     => 'required|array'
        ]);

        $commande = Commande::create([
            'client_id'     => $request->client_id,
            'date_commande' => $request->date_commande,
            'montant_total' => 0
        ]);

        $montantTotal = 0;

        foreach ($request->produits as $produit_id => $details) {
            if (isset($details['quantite']) && $details['quantite'] > 0) {
                $produit = Produit::find($produit_id);
                $sousTotal = $produit->prix_unitaire * $details['quantite'];

                LigneCommande::create([
                    'commande_id'  => $commande->id,
                    'produit_id'   => $produit_id,
                    'quantite'     => $details['quantite'],
                    'prix_unitaire'=> $produit->prix_unitaire,
                    'sous_total'   => $sousTotal
                ]);

                $produit->quantite_stock -= $details['quantite'];
                $produit->save();

                $montantTotal += $sousTotal;
            }
        }

        $commande->montant_total = $montantTotal;
        $commande->save();

        return redirect()->route('commandes.index')
                         ->with('success', 'Commande créée avec succès');
    }

    public function show(Commande $commande)
    {
        $commande->load('client', 'ligneCommandes.produit');
        return view('commandes.afficher', compact('commande'));
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')
                         ->with('success', 'Commande supprimée avec succès');
    }

    public function genererPdf(Commande $commande)
    {
    $commande->load('client', 'ligneCommandes.produit');
    $pdf = Pdf::loadView('commandes.pdf', compact('commande'));
    return $pdf->download('facture-'.$commande->id.'.pdf');
    }
   
}
