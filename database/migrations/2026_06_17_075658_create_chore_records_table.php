<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chore_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('task_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('worked_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chore_records');
    }
};
