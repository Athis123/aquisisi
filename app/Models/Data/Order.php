<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;

class order extends Model
{
    use HasFactory,SoftDeletes;

    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'order';

    protected $fillable = [
        'id',
        'tanggal',
        'lok_gudang',
        'ekpedisi',
        'nama_cs',
        'nama_adv',
        'sku_produk_id',
        'nama_produk',
        'qty_produk',
        'harga_produk',
        'customer',
        'no_hp',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'kode_promo_id',
        'ongkir',
        'diskon_ongkir',
        'admin_cod',
        'diskon_admin_cod',
        'pembayaran',
        'total_pembayaran',
        'bukti_tf',

    ];

    public function promo()
    {
        return $this->belongsTo(\App\Models\Master\MasterPromo::class, 'kode_promo_id');
    }

    public function sku()
    {
        return $this->belongsTo(\App\Models\Master\MasterSku::class, 'sku_produk_id');
    }

}
