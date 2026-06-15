<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class Produitcontroller extends Controller
{
    
     public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        return view('produits.create');
    }

    public function store(Request $request)
     {
      $request->validate([
        'reference'      => 'required|unique:produits',
        'designation'    => 'required',
        'prix_unitaire'  => 'required|numeric',
        'quantite_stock' => 'required|integer',
        'description'    => 'nullable'
    ]);

    $produit = new Produit();
    $produit->reference      = $request->reference;
    $produit->designation    = $request->designation;
    $produit->prix_unitaire  = $request->prix_unitaire;
    $produit->quantite_stock = (int) $request->quantite_stock;
    $produit->description    = $request->description;
    $produit->save();

    return redirect()->route('produits.index')
                     ->with('success', 'Produit ajouté avec succès');
}

    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
{
    $request->validate([
        'reference'      => 'required|unique:produits,reference,'.$produit->id,
        'designation'    => 'required',
        'prix_unitaire'  => 'required|numeric',
        'quantite_stock' => 'required|integer',
        'description'    => 'nullable'
    ]);

           $produit->reference       = $request->reference;
           $produit->designation     = $request->designation;
           $produit->prix_unitaire   = $request->prix_unitaire;
           $produit->quantite_stock  = $request->quantite_stock;
           $produit->description     = $request->description;
           $produit->save();

             return redirect()->route('produits.index')
                     ->with('success', 'Produit modifié avec succès');
        }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')
             ->with('success', 'Produit supprimé avec succès');
    }


}
