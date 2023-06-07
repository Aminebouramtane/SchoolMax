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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string("teacher_name_ar", 80);
            $table->string("teacher_name_en", 80);
            $table->string("email")->unique();
            $table->string("password");
            $table->string("birthday");
            $table->string("phone");
            $table->string("adress_en", 200);
            $table->string("adress_ar", 200);
            $table->string("cin", 10);
            $table->boolean("sexe");
            $table->bigInteger('specialit_id')->unsigned();
            $table->string("photo", 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
