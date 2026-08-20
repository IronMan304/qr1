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
        Schema::create('assessment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Topic Assessment, Module Exam
        $table->foreignId('domain_id')->constrained('domains')->onDelete('cascade');
        $table->decimal('weight',5,2); // dynamic weight
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_types');
    }
};
