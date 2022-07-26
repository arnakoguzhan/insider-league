<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Simulation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
    ];

    /**
     * Get route key name for binding routes
     */
    public function getRouteKeyName()
    {
        return 'uid';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Create uid when creating model.
        static::creating(function ($item) {
            $uid = uniqid();
            // Make sure the uid is unique.
            while (self::where('uid', '=', $uid)->count() > 0) {
                $uid = uniqid();
            }
            $item->uid = $uid;
        });
    }

    /**
     * Define Relation with Standing Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function standings(): HasMany
    {
        return $this->hasMany(Standing::class);
    }

    /**
     * Define Relation with Fixture Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }

    /**
     * Get the last played fixture for the simulation
     * 
     * @return \Illuminate\Support\Collection
     */
    public function lastPlayedFixture(): Collection
    {
        // Get all fixtures (2) for the last played week
        return $this->fixtures()->whereNotNull('played_at')->orderBy('week', 'desc')->take(2)->get();
    }

    /**
     * Get the next fixture for the simulation
     * 
     * @return \Illuminate\Support\Collection
     */
    public function nextFixture(): Collection
    {
        $lastPlayedFixture = $this->lastPlayedFixture()->first();

        return $lastPlayedFixture
            ? $this->fixtures()->whereWeek($lastPlayedFixture->week + 1)->get()
            : $this->fixtures()->whereWeek(1)->get();
    }

    /**
     * Get unplayed fixtures for the simulation
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getUnplayedFixtures(): Collection
    {
        return $this->fixtures()->whereNotNull('played_at')->orderBy('week', 'desc')->get();
    }
}
