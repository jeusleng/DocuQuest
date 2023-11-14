<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('document_requests', function (Blueprint $table) {
            $table->increments('document_request_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('document_id');
            $table->unsignedInteger('number_of_copies');
            $table->string('purpose');
            $table->string('request_status')->default('Pending');
            $table->string('reason_declined')->nullable();
            $table->timestamp('appointment_date_time')->nullable();
            $table->binary('acknowledgment_receipt')->nullable();
            $table->binary('id_picture')->nullable(); // Add the new field for ID picture
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('document_id')->references('document_id')->on('documents');
        });
    }

    public function down(): void {
        Schema::dropIfExists('document_requests');
    }
};

