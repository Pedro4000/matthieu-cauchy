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
        Schema::table('albums', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('id'); // ou après un autre champ si besoin
        });
    }
    
    public function down()
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
