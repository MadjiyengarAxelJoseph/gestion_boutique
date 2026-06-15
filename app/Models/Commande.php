<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
     protected $fillable = [
        'date_commande',
        'client_id',
        'montant_total'
    ];     

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function ligneCommandes()
    {
        return $this->hasMany(LigneCommande::class);
    }
}
