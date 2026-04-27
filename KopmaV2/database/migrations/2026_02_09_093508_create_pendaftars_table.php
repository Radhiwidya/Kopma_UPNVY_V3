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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('nim');
            $table->bigInteger('no_wa');
            $table->string('ttl');
            $table->string('alamat');
            $table->string('kelamin');
            $table->string('agama');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('email');
            $table->string('metode');
            $table->string('bukti')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
