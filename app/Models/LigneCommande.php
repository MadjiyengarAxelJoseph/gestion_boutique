<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
       protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'sous_total'
    ];     

    public function commande()
    {
        return $this->belongsTo(commande::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}

