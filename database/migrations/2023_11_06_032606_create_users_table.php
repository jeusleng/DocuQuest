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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->enum('type', ['admin', 'student']);
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('student_type');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('act_status')->default('Active');
            $table->string('contact_number')->nullable();
            $table->string('complete_address');
            $table->string('grade_level')->nullable();
            $table->string('section')->nullable();
            $table->string('learner_reference_number', 12)->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('last_grade_attended')->nullable();
            $table->string('adviser_name')->nullable();
            $table->string('adviser_section')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('guardian_full_name');
            $table->string('guardian_contact_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
