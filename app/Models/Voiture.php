<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperVoiture
 */
class Voiture extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chauffeur(): BelongsTo
    {
        return $this->belongsTo(Chauffeur::class);
    }

    public function locations(): hasMany
    {
        return $this->hasMany(Location::class);
    }

    public function client(): hasOne
    {
        return $this->hasOne(User::class);
    }

}
