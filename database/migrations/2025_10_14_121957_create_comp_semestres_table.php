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
        Schema::create('comp_semestres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('semestre_id');
            $table->foreign('semestre_id')->references('id')->on('semestres')->onDelete('cascade');
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
        Schema::dropIfExists('comp_semestres');
    }
};
