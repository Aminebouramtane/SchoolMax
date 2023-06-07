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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text("student_name_ar");
            $table->string("student_name_en", 80);
            $table->string("email")->unique();
            $table->string("password");
            $table->date("birthday");
            $table->string("phone");
            $table->text("adress_en");
            $table->text("adress_ar");
            $table->string("cin", 10);
            $table->boolean("sexe");
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('classe_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('parent_id')->unsigned();
            $table->string("season", 200);
            $table->string("photo", 300)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
