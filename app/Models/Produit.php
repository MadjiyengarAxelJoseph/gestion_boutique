<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
     protected $fillable = [
        'reference',
        'designation',
        'prix_unitaire',
        'quatite_stock',
        'description'
    ];     

    public function ligneCommandes()
    {
        return $this->hasMany(LigneCommande::class);
    }
}
