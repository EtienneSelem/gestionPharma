<?php

namespace App\Models;

use App\Events\ModelCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id', 
        'fournisseur_id', 
        'reference',  
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
        return $this->hasMany(OrderProduct::class);
    }
    
          /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    //elle est commandée par un seul utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
           /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    //elle est commandée par un seul utilisateur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    

    public function getTotalOrderAttribute()
    {
        return $this->total;
    }

    public function getTvaAttribute()
    {
        return $this->tax > 0 ? $this->total / (1 + $this->tax) * $this->tax : 0;
    }

    public function getHtAttribute()
    {
        return $this->total / (1 + $this->tax);
    }
}
