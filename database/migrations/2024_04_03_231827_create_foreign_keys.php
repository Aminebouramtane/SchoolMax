<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('classes', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('classe_id')->references('id')->on('classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('teachers', function(Blueprint $table) {
			$table->foreign('specialit_id')->references('id')->on('specialits')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('teachers_sections', function(Blueprint $table) {
			$table->foreign('teacher_id')->references('id')->on('teachers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('section_id')->references('id')->on('sections')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('students', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('classe_id')->references('id')->on('classes')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('section_id')->references('id')->on('sections')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('parent_id')->references('id')->on('add_parents')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		//promotion freignkey 
		Schema::table('promotions', function(Blueprint $table) {

			$table->foreign('student_id')->references('id')
							->on('students')
							->onDelete('cascade');
			$table->foreign('from_grade')->references('id')
							->on('grades')
							->onDelete('cascade');
			$table->foreign('from_classe')->references('id')
							->on('classes')
							->onDelete('cascade');
			$table->foreign('from_section')->references('id')
							->on('sections')
							->onDelete('cascade');
			$table->foreign('to_grade')->references('id')
							->on('grades')
							->onDelete('cascade');
			$table->foreign('to_classe')->references('id')
							->on('classes')
							->onDelete('cascade');
			$table->foreign('to_section')->references('id')
							->on('sections')
							->onDelete('cascade');
		});
		Schema::table('fees', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('classe_id')->references('id')->on('classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('fees_invoices', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('classe_id')->references('id')->on('classes')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('fees_id')->references('id')->on('fees')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('students_acounds', function(Blueprint $table) {
			$table->foreign('fees_invoice_id')->references('id')->on('fees_invoices')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('receipt_id')->references('id')->on('receipt_students')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('processing_id')->references('id')->on('processing_fees')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('payment_id')->references('id')->on('payment_students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('processing_fees', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('fund_accounts', function(Blueprint $table) {
			$table->foreign('receipt_id')->references('id')->on('receipt_students')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('payment_id')->references('id')->on('payment_students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('payment_students', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// Schema::table('subjects', function(Blueprint $table) {
		// 	$table->foreign('grade_id')->references('id')->on('grades')
		// 				->onDelete('cascade')
		// 				->onUpdate('cascade');
		// 	$table->foreign('classe_id')->references('id')->on('classes')
		// 				->onDelete('cascade')
		// 				->onUpdate('cascade');
		// 	$table->foreign('teacher_id')->references('id')->on('teachers')
		// 				->onDelete('cascade')
		// 				->onUpdate('cascade');
		// });
	}

	public function down()
	{
		Schema::table('classes', function(Blueprint $table) {
			$table->dropForeign('classes_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_grade_id_foreign');
			$table->dropForeign('sections_classe_id_foreign');
		});
		Schema::table('teachers', function(Blueprint $table) {
			$table->dropForeign('teachers_specialit_id_foreign');
		});
		Schema::table('teachers_sections', function(Blueprint $table) {
			$table->dropForeign('teachers_sections_teacher_id_foreign');
			$table->dropForeign('teachers_sections_section_id_foreign');
		});
		Schema::table('students', function(Blueprint $table) {
			$table->dropForeign('students_grdae_id_foreign');
			$table->dropForeign('students_classe_id_foreign');
			$table->dropForeign('students_section_id_foreign');
			$table->dropForeign('students_parent_id_foreign');
		});
		Schema::table('promotions', function(Blueprint $table) {
			$table->dropForeign('promotions_student_id_foreign');
			$table->dropForeign('promotions_from_grade_id_foreign');
			$table->dropForeign('promotions_from_classe_id_foreign');
			$table->dropForeign('promotions_from_section_id_foreign');
			$table->dropForeign('promotions_to_grade_id_foreign');
			$table->dropForeign('promotions_to_classe_id_foreign');
			$table->dropForeign('promotions_to_section_id_foreign');
		});
		Schema::table('fees', function(Blueprint $table) {
			$table->dropForeign('fees_grade_id_foreign');
			$table->dropForeign('fees_classe_id_foreign');
		});
		Schema::table('fees_invoices', function(Blueprint $table) {
			$table->dropForeign('fees_invoices_grade_id_foreign');
			$table->dropForeign('fees_invoices_classe_id_foreign');
			$table->dropForeign('fees_invoices_student_id_foreign');
			$table->dropForeign('fees_invoices_fees_id_foreign');
		});
		Schema::table('students_acounds', function(Blueprint $table) {
			$table->dropForeign('students_acounds_grade_id_foreign');
			$table->dropForeign('students_acounds_classe_id_foreign');
			$table->dropForeign('students_acounds_student_id_foreign');
		});
	}
}