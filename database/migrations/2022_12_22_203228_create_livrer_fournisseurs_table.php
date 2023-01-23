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
        Schema::create('livrer_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('prix_uni');
            $table->decimal('qt_livrer');
            $table->decimal('total_net');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('fournisseur_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livrer_fournisseurs');
    }
};
