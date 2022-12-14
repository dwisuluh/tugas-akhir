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
        Schema::create('file_karyas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('karya_ilmiah_id');
            $table->string('name');
            $table->string('file',50);
            $table->string('extension',5);
            $table->integer('size');
            $table->string('mime',50);
            $table->enum('jenis_file',['1','2']);
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
        Schema::dropIfExists('file_karyas');
    }
};
