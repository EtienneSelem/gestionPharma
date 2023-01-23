<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ModelCreated;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'price', 
        'description',
        'forme',
        'date_fabrication',
        'date_peremption', 
        'active', 
        'user_id',
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
     * Get user of the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get all categories for the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

      /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        //une commande contient plusieurs produits

    public function Variations()
    {
        return $this->hasMany(VariationProduct::class);
    }
    
    
}
