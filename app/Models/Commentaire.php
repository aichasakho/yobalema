<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commentaire extends Model
{
    use HasFactory;


    protected $guarded = [];


    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function chauffeur(): HasOne
    {
        return $this->hasOne(Chauffeur::class);
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
