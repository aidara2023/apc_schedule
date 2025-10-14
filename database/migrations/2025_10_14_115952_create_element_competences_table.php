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
            $table->foreignId('competence_id')->constrained('competences')->onDelete('cascade');
            $table->timestamps();
            $table->foreignId('integration_id')->constrained('integrations')->onDelete('cascade'); // ✅ nouvelle relation
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
