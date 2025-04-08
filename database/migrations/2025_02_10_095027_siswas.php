<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedBigInteger('kelas_id'); 
            $table->unsignedBigInteger('jurusan_id'); 
            $table->unsignedBigInteger('gelombang_belajar_id');
            $table->string('nomor_telp');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
            $table->foreign('gelombang_belajar_id')->references('id')->on('gelombang_belajars')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};