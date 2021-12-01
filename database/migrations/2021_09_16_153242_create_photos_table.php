<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('album_id')->nullable();
            $table->string('nom')->nullable();
            $table->string('nom_fichier')->unique();
            $table->integer('ordre')->nullable();
            $table->integer('ordre_accueil')->nullable();
            $table->boolean('accueil')->nullable();
            $table->boolean('couverture')->nullable();
            $table->boolean('afficher')->nullable();
            $table->longText('description')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
