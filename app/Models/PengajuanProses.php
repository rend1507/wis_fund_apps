<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanProses extends Model
{
    use HasFactory;

    protected $table = "pengajuan_proses";

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pengajuan',
        'deskripsi_pengajuan',
        'jumlah_anggaran_pengajuan',
        'detail_anggaran_pengajuan',
        'sifat_pengajuan',
    ];
    protected $hidden = [
        'id_pengajuan',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    
     protected function casts(): array
    {
        return [
            'created_at_pengajuan' => 'datetime',
            'updated_at_pengajuan' => 'datetime',
        ];
    }
}
