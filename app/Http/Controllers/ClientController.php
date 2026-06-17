<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class Clientcontroller extends Controller
{
    
      public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.ajouter');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'       => 'required',
            'prenom'    => 'required',
            'telephone' => 'required',
            'adresse'   => 'required',
            'email'     => 'required|email|unique:clients'
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index')
                         ->with('success', 'Client ajouté avec succès');
    }

    public function edit(Client $client)
    {
        return view('clients.modifier', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom'       => 'required',
            'prenom'    => 'required',
            'telephone' => 'required',
            'adresse'   => 'required',
            'email'     => 'required|email|unique:clients,email,'.$client->id
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')
                         ->with('success', 'Client modifié avec succès');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
                         ->with('success', 'Client supprimé avec succès');
    }

}
