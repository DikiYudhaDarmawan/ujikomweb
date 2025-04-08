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
        Schema::create('ekskuls', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('pembina_id');
            $table->string('activity_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('activity_date2')->nullable();
            $table->time('start_time2')->nullable();
            $table->time('end_time2')->nullable();
            $table->string('location');
            $table->timestamps();

            $table->foreign('pembina_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekskuls');
    }
};