<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'adresse', 
        'telephone', 
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

       /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        //une commande contient plusieurs produits

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
