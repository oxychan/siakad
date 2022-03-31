<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('jenisKelamin', 1)->after('nama');
            $table->string('email', 30)->after('jenisKelamin');
            $table->date('tglLahir')->after('email');
            $table->string('alamat', 50)->after('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('jenisKelamin');
            $table->dropColumn('email');
            $table->dropColumn('tglLahir');
            $table->dropColumn('alamat');
        });
    }
}
