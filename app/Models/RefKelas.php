<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefKelas extends Model
{
    use HasFactory;

    protected $table = 'ref_kelas';

    protected $fillable = [
        'id',
        'nama_kelas',
    ];
}
