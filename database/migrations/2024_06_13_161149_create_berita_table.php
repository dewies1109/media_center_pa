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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            $table->date('tanggal');
            $table->timestamps();
            $table->unsignedBigInteger('id_admin');   // foreign key dari tabel admin
            $table->unsignedBigInteger('id_daerah');   // foreign key dari tabel daerah
            $table->unsignedBigInteger('id_kategori');   // foreign key dari tabel kategori

            $table->foreign('id_admin')->references('id')->on('admins');
            $table->foreign('id_daerah')->references('id')->on('daerahs');
            $table->foreign('id_kategori')->references('id')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
