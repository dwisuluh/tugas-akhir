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
        Schema::create('surats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mahasiswa_id');
            $table->string('nim',15);
            $table->text('tujuan');
            $table->text('alamat');
            $table->text('judul');
            $table->enum('id_surat',['1','2']);
            $table->text('lokasi')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('no_surat',5)->nullable();
            $table->date('tgl_surat')->nullable();
            $table->string('admin',100)->nullable();
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
        Schema::dropIfExists('surats');
    }
};
