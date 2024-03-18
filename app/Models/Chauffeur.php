<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperChauffeur
 */
class Chauffeur extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * @return BelongsTo
     */
    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class);
    }

    /**
     * @return HasMany
     */
    public function locations(): HasMany
    {
        return $this -> hasMany(Location::class);
    }
}
