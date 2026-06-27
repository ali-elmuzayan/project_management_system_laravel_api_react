<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\ProjectPriority;
use App\Enums\ProjectStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('name'); 
            $table->string('slug')->unique();
            $table->string('type')->default('saas')->comment('saas, web, mobile, desktop, other');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('deadline')->nullable();
            $table->text('description')->nullable();
            $table->integer('progress_percentage')->default(0);

            $table->enum('status', ProjectStatus::values())->default(ProjectStatus::PENDING->value);
            $table->enum('priority', ProjectPriority::values())->default(ProjectPriority::MEDIUM->value);

            $table->timestamps();

            // Relationships
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
