<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return MateriFac::new();
    // }

    public function mapel()
    {
        return $this->belongsTo(RefMapel::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function tanggapanMateri()
    {
        return $this->hasMany(TanggapanMateri::class);
    }
}
