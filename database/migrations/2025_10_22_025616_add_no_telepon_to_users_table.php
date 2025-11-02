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
         Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom noTelepon setelah kolom email, sebagai string unik
            $table->string('noTelepon', 15)->unique()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom noTelepon jika migration di-rollback
            $table->dropColumn('noTelepon');
        });
    }
};
