<?php

namespace App\Events;

use Illuminate\ {
    Queue\SerializesModels,
    Database\Eloquent\Model,
    Foundation\Events\Dispatchable
};

class ModelCreated
{
    use Dispatchable, SerializesModels;

    public $model;

    /**
     * Create a new event instance.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
