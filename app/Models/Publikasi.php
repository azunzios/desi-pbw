<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $table = 'publikasis';

    protected $fillable = [
        'judul',
        'tanggal_rilis',
        'sampul',
        'deskripsi',
    ];
}
