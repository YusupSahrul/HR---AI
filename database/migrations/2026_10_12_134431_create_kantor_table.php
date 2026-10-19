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
        Schema::create('kantor', function (Blueprint $table) {
            $table->increments('id_kantor');
            $table->string('nama_kantor', 20);
            $table->enum('tipe_kantor', ['Pusat', 'Cabang'])
                    ->default('Aktif');
            $table->enum('status_aktif', ['Aktif', 'Tidak_Aktif'])
                    ->default('Aktif');
            $table->integer('no_telp_kantor', 13);
            $table->string('zona_waktu', 4);
            $table->string('alamat_kantor', 255);

            $table->unsignedInteger('id_perusahaan');
            $table->foreign('id_perusahaan')
                    ->references('id_perusahaan')
                    ->on('perusahaan')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('id_lokasi');
            $table->foreign('id_lokasi')
                    ->references('id_lokasi')
                    ->on('lokasi')
                    ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kantor');
    }
};
