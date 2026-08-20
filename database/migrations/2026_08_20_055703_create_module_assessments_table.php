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
        Schema::create('module_assessments', function (Blueprint $table) {
            $table->id();
             $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
    $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
    $table->decimal('weight', 5, 2)->nullable();
    $table->decimal('grade', 5, 2)->nullable();
    $table->decimal('points', 6, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_assessments');
    }
};
