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
        Schema::create('fuel_requests', function (Blueprint $table) {
            $table->id();

            // Request ID
            $table->string('request_id', 100);

            // Date Requested
            $table->dateTime('date_requested');

            // Requestor details
            $table->string('requestor_name');
            $table->string('requestor_office');
            $table->string('requestor_head_office')->nullable();

            // Vehicle details
            $table->string('plate_no', 50)->nullable();
            $table->string('vehicle')->nullable(); // brand/model

            // Status
            $table->enum('status', ['approve', 'reject', 'pending', 'canceled'])->default('pending');

            // Soft delete flag
            $table->boolean('is_deleted')->default(false);

            // Created at & Updated at
            $table->timestamps(); // includes created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
