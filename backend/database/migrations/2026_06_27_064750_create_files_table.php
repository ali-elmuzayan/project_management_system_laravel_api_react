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
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('path');
            $table->string('type')->comment('image, video, audio, document, other');
            $table->string('mime_type')->nullable();
            $table->string('disk')->default('public');
            $table->string('original_name')->nullable();
            $table->integer('size')->nullable();
            $table->timestamps();


            // Relationships: 
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignUuid('project_id')->constrained('projects')->onDelete('cascade');

            // constraints: 
            $table->index(['project_id', 'created_by']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
