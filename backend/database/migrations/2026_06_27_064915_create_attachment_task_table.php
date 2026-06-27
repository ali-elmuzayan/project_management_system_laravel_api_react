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
        Schema::create('attachment_task', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();

            // Relationships: 
            $table->foreignUuid('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignUuid('file_id')->constrained('files')->onDelete('cascade');

            // constraints: 
            $table->unique(['task_id', 'file_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachment_task');
    }
};
