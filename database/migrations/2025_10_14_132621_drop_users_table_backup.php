<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('users_table_backup');
    }

    public function down(): void
    {
        // Si tu veux pouvoir la recréer en cas de rollback :
        Schema::create('users_table_backup', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
