<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public function adminlte_image()
    {
        if (empty($this->foto)) {
            return 'https://picsum.photos/300/300';
        } else {
            return asset('storage/profile-image/' . $this->foto);
        }
    }
    public function adminlte_profile_url()
    {
        return 'profile';
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'foto',
        'nik',
        'telp',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the desa that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }
    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function kabupaten()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
}
