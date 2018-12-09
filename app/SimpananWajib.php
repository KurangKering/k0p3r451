<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpananWajib extends Model
{
    protected $table = 'simpanan_wajib';
    protected $fillable = ['jumlah', 'tanggal', 'anggota_id'];


    public function anggota() {
    	return $this->belongsTo('App\Anggota');
    }
}
