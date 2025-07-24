<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterPromo extends Model
{
    protected $table = 'master_promo';
    protected $fillable = ['kode', 'deskripsi'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'kode_promo_id');
    }
}
