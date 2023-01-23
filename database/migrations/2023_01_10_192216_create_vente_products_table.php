<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vente_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('total_price_gross');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreignId('vente_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vente_products');
    }
};
