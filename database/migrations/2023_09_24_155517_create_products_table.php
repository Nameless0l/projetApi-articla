<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //Ouvrir le fichier de migration 2023_09_24_155517_create_products_table et remplir y apporter les modifs suivantes
    //pour finir entrer la commande artisan : php artisan migrate
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brandName');
            $table->string('description');
            $table->string('price');
            $table->string('inPromotion');
            $table->string('imagePath');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
