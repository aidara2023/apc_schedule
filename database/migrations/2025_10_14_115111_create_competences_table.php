<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->bigInteger('numero_competence');
            $table->string('code');
           // $table->string('quota_horaire');
            $table->bigInteger('formateur_id');
            $table->foreign('formateur_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('metier_id');
            $table->foreign('metier_id')->references('id')->on('metiers')->onDelete('cascade');
            $table->bigInteger('salle_id');
            $table->foreign('salle_id')->references('id')->on('salles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
