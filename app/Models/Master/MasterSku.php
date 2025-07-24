<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterSku extends Model
{
    protected $table = 'master_sku_produk';
    protected $fillable = ['kode', 'deskripsi'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'sku_produk_id');
    }
}
