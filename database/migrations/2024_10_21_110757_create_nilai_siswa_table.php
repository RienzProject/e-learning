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
        Schema::create('nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_mata_pelajaran_id')->constrained('siswa_mata_pelajaran')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('upload_tugas_id')->constrained('upload_tugas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('nilai');
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
        Schema::dropIfExists('nilai_siswa');
    }
};
