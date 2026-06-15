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

    Produit::create([
        'reference'      => $request->reference,
        'designation'    => $request->designation,
        'prix_unitaire'  => $request->prix_unitaire,
        'quantite_stock' => $request->quantite_stock ?? 0,
        'description'    => $request->description
    ]);

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

        $produit->update($request->all());
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
