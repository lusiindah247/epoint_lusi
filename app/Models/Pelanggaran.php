<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\DataBase\Eloquent\Factories\HasFactory;

class Pelanggaran extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'jenis',
        'konsekuensi',
        'poin',
    ];
}
