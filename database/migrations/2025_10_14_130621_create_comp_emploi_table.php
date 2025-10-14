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
        Schema::create('comp_emploi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('competence_id');            
            $table->foreign('competence_id')->references('id')->on('competences')->onDelete('cascade');
            $table->bigInteger('emploi_id');
            $table->foreign('emploi_id')->references('id')->on('emplois')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_emploi');
    }
};
