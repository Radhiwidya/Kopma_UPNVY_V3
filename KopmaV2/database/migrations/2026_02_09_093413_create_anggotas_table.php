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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('no_anggota')->nullable();
            $table->string('nama');
            $table->integer('nim');
            $table->string('no_wa');
            $table->string('ttl');
            $table->string('alamat');
            $table->string('kelamin');
            $table->string('agama');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('email');
            $table->string('diklat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};