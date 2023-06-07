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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string("fees_name_en",100);
            $table->string("fees_name_ar",100);
            $table->decimal("amount");
            $table->string("note")->nullable();
            $table->string("season")->nullable();
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
        Schema::dropIfExists('fees');
    }
};
