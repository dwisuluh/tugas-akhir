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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable();
            $table->string('nim',15)->unique();
            $table->string('name',100);
            $table->string('tempat_lahir',100)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('nik',20)->nullable();
            $table->enum('jenis_kelamin',['1','2'])->nullable();
            $table->enum('program_studi',['1','2','3'])->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('mahasiswas');
    }
};
