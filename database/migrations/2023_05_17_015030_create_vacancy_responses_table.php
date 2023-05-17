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
        Schema::create('vacancy_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resume_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->enum('status', ['new', 'accept', 'cancel'])->default('new');
            $table->timestamps();

            $table->foreign('resume_id')
                ->references('id')
                ->on('resumes')
                ->onDelete('CASCADE');

            $table->foreign('vacancy_id')
                ->references('id')
                ->on('vacancies')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_responses');
    }
};
