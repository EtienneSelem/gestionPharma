<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivrerFournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_net', 
        'prix_uni',
        'qt_livrer',
        'product_id',
        'fournisseur_id',  
    ];

    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        //une commande contient plusieurs produits

    public function products()
    {
        return $this->hasMany(Product::class);
    }

   
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

}
