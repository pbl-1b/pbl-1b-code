<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlamatRumah extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function karyawanPerusahaan()
    {
        return $this->BelongsTo(KaryawanPerusahaan::class, 'id_karyawan');
    }

    public function perjalananKaryawan()
    {
        return $this->BelongsTo(PerjalananKaryawanPerusahaan::class, 'id_perjalanan');
    }
}
