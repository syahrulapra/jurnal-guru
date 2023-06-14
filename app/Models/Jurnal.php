<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    protected $table        = 'jurnal' ;
    protected $primaryKey   = 'idjurnal'; 
    protected $fillable     = [
        'idguru',
        'jam',
        'materi',
        'tugas',
        'keterangan',
    ];

    public function guru(){
        return $this->belongsTo(Guru::class, 'idguru');
    }
}
