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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('from_grade')->unsigned();
            $table->bigInteger('from_classe')->unsigned();
            $table->bigInteger('from_section')->unsigned();
            $table->bigInteger('to_grade')->unsigned();
            $table->bigInteger('to_classe')->unsigned();
            $table->bigInteger('to_section')->unsigned();
            $table->string('season');
            $table->string('new_season');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
