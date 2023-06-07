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
        Schema::create('students_acounds', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->unsignedBigInteger('fees_invoice_id')->nullable();
            $table->bigInteger('student_id')->unsigned();
            $table->unsignedBigInteger('receipt_id')->nullable();
            $table->unsignedBigInteger('processing_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->decimal("debit")->nullable();
            $table->decimal("credit")->nullable();
            $table->string("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_acounds');
    }
};
