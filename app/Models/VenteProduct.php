<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenteProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price_gross', 
        'name', 
        'quantity',
        'vente_id',  
    ];
}
