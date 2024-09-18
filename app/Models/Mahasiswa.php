<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['kelas_id', 'user_id', 'nim', 'name', 'tempat_lahir', ' tanggal_lahir', ' edit'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requestletter(): HasOne
    {
        return $this->hasOne(Requestletter::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    
}
