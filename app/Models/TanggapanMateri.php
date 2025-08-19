<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapanMateri extends Model
{
    use HasFactory;
    protected $table = 'tanggapan_materi';
    protected $guarded = ['id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(RefKelas::class);
    }
}
