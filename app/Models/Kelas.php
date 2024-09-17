<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;


    protected $guarded = ['id'];


    public function dosen(): HasOne
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswas(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function requestletters(): HasMany
    {
        return $this->hasMany(Requestletter::class);
    }

    
}
