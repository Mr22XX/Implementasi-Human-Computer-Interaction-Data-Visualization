<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budidaya', function (Blueprint $table) {
            $table->id('id_budidaya');
            $table->string('nama_kolam', 100);
            $table->string('jenis_ikan', 50);
            $table->date('tanggal_tebar');
            $table->integer('jumlah_bibit');
            $table->float('pakan_perhari');
            $table->integer('umur_ikan')->default(0);
            $table->date('perkiraan_panen')->nullable();
            $table->enum('status', ['aktif', 'panen', 'gagal'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budidaya');
    }
};
