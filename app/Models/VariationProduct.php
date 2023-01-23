<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationProduct extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'qte_entre', 
        'qte_sorti',
        'qte_reel',
        'product_id'  
    ];

      /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        //une commande contient plusieurs produits

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
