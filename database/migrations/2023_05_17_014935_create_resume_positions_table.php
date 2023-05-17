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
        Schema::create('resume_positions', function (Blueprint $table) {
            $table->unsignedBigInteger('resume_id');
            $table->unsignedBigInteger('position_id');

            $table->foreign('resume_id')
                ->references('id')
                ->on('resumes')
                ->onDelete('CASCADE');

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_positions');
    }
};
