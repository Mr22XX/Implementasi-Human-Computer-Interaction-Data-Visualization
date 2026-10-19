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
        Schema::create('table_gaji', function (Blueprint $table) {
         $table->id('id_gaji'); // Primary Key
            $table->decimal('jumlah', 15, 2); // Jumlah uang
            $table->date('tanggal'); // Tanggal transaksi
            $table->text('keterangan')->nullable(); // Deskripsi tambahan
            $table->timestamps();
        });

        Schema::table('gaji_karyawan', function (Blueprint $table) {
        $table->unsignedBigInteger('id_keuangan')->nullable()->after('id_gaji');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_gaji');
    }
};
