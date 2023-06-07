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
        Schema::create('fees_invoices', function (Blueprint $table) {
            $table->id();
            $table->date("date_invoice");
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('classe_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('fees_id')->unsigned();
            $table->decimal("amount");
            $table->string("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_invoices');
    }
};
