<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPending extends Model
{
    use HasFactory;

    protected $table = "pengajuan_pending";
    protected $primaryKey = 'id_pengajuan';

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


    public function getCreatedAtPengajuanFormattedAttribute()
    {
        return $this->created_at_pengajuan->format('j F Y, h:i');
    }
}

