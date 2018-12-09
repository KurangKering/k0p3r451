<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use File;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
        'name',
        'nip',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'foto',
        'tanggal_masuk',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'foto_small',
    ];

    public function getFotoSmallAttribute() {

        $fullPath = '';
        if ($this->foto) {
            $pathPhoto = $this->foto;
            $fileName = File::name($pathPhoto);
            $fileExt = File::extension($pathPhoto);
            $dirName = File::dirname($pathPhoto);
            $fullPath = "$dirName/$fileName-small.$fileExt"; 
        }

        return $fullPath;
    }


    public function anggota() {
        return $this->hasOne('App\Anggota');
    }

    
}
