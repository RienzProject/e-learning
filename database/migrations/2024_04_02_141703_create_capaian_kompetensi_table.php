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
        Schema::create('capaian_kompetensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_mata_pelajaran_id')->constrained('nilai_mata_pelajaran')->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('catatan');
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
        Schema::dropIfExists('capaian_kompetensi');
    }
};
