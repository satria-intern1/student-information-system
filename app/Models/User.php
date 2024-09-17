<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    
    
    
    use HasFactory;
    
    protected $guarded  = 'id';
    // protected $with = ['kaprodi' , 'dosen', 'mahasiswa'];


    public function kaprodi(): HasOne
    {
        return $this->hasOne(Kaprodi::class);
    }

    public function dosen(): HasOne
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class);
    }


}
