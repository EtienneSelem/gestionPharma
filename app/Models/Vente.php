<?php

namespace App\Models;

use App\Events\ModelCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vente extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id', 
        'total', 
        'reference', 
        'invoice_number', 
    ];

     /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];
    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        //une commande contient plusieurs produits

        public function products()
        {
            return $this->hasMany(VenteProduct::class);
        }
        
              /**
         * @return \Illuminate\Database\Eloquent\Relations\belongsTo
         */
        //elle est commandée par un seul utilisateur
        public function user()
        {
            return $this->belongsTo(User::class);
        }

}
