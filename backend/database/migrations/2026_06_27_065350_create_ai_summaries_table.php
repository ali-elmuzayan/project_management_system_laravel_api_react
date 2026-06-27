<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\AiSummaryType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ai_summaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('content');
            $table->enum('type', AiSummaryType::values())->default(AiSummaryType::SUMMARY->value);
            $table->timestamps();

            // Relationships: 
            $table->foreignUuid('meeting_id')->constrained('meetings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_summaries');
    }
};
