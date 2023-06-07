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
        Schema::create('sections', function (Blueprint $table) {
			$table->id();
			$table->string('section_name_en', 200);
			$table->string('section_name_ar', 200);
			$table->boolean('active');
			$table->bigInteger('grade_id')->unsigned();
			$table->bigInteger('classe_id')->unsigned();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
