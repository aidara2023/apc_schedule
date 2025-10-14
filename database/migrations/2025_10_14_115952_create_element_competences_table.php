<?php

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
        Schema::create('element_competences', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->string('code');
            $table->string('quota_horaire');                                  
            $table->bigInteger('competence_id');
            $table->foreign('competence_id')->references('id')->on('competences')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_competences');
    }
};
