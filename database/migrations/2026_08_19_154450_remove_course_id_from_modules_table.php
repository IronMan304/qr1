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
        Schema::table('modules', function (Blueprint $table) {
             // kung may foreign key dati, i-drop muna
        // $table->dropForeign(['course_id']); 

        $table->dropColumn('course_id'); // ✅ drop the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
             $table->unsignedBigInteger('course_id')->nullable();
        // kung gusto mo ibalik na may FK:
        $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }
};
