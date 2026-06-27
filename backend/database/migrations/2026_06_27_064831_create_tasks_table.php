<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\TaskStatus;
use App\Enums\TaskPriority;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();

            $table->enum('status', TaskStatus::values())->default(TaskStatus::PENDING->value);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('priority', TaskPriority::values())->default(TaskPriority::LOW->value);
            $table->integer('position')->comment('position of the task in the kanban board');
            $table->timestamps();

            // Relationships     
            $table->foreignUuid('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignUuid('parent_task_id')->nullable()->constrained('tasks')->onDelete('set null');

            // constraints: 
            $table->index(['project_id', 'status']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
