<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE peminjamans 
            MODIFY status ENUM(
                'menunggu',
                'dipinjam',
                'menunggu_konfirmasi',
                'dikembalikan'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE peminjamans 
            MODIFY status ENUM(
                'dipinjam',
                'dikembalikan'
            ) NOT NULL
        ");
    }
};
