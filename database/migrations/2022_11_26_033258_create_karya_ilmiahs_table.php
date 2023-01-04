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
            $table->uuid('id')->primary();
            $table->foreignUuid('mahasiswa_id');
            $table->string('nim',15);
            $table->text('judul');
            $table->string('pembimbing_1',100);
            $table->string('pembimbing_2',100)->nullable();
            $table->date('tgl_ujian');
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
        Schema::dropIfExists('karya_ilmiahs');
    }
};
