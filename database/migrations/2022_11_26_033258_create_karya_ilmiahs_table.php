<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karya_ilmiahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id');
            $table->string('nim');
            $table->text('judul');
            $table->string('pembimbing')->nullable();
            $table->date('tgl_ujian');
            $table->string('file_naskah');
            $table->string('no_surat')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->string('file_surat')->nullable();
            $table->string('admin')->nullable();
            $table->enum('status',['1','2','3','4'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karya_ilmiahs');
    }
};
