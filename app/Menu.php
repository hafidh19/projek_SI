<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nbarang', 'hbarang','deskripsi','admin_id','gambar'
    ];

    public function Admin(){
        return $this-> belongsTo(Admin::class);
    }
}
