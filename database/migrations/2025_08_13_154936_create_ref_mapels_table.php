<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ref_mapel', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mapel');
            $table->timestamps();
        });

         DB::table('ref_mapel')->insert([
            ['id' => 1, 'nama_mapel' => 'Bahasa Indonesia'],
            ['id' => 2, 'nama_mapel' => 'IPA'],
            ['id' => 3, 'nama_mapel' => 'IPS'],
            ['id' => 4, 'nama_mapel' => 'AGAMA'],
            ['id' => 5, 'nama_mapel' => 'PKN'],
            ['id' => 6, 'nama_mapel' => 'OLAHRAGA'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_mapel');
    }
};
