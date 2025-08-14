<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ref_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->timestamps();
        });

        DB::table('ref_kelas')->insert([
            ['id' => 1, 'nama_kelas' => 'VII-1'],
            ['id' => 2, 'nama_kelas' => 'VII-2'],
            ['id' => 3, 'nama_kelas' => 'VIII-1'],
            ['id' => 4, 'nama_kelas' => 'VIII-2'],
            ['id' => 5, 'nama_kelas' => 'IX-1'],
            ['id' => 6, 'nama_kelas' => 'IX-2'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_kelas');
    }
};
