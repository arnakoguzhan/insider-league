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
            while (self::where('uid', '=', $uid)->count() > 0) {
                $uid = uniqid();
            }
            $item->uid = $uid;
        });
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
     * Define Relation with Fixture Model
     * 
     * @return \Illuminate\Support\Collection
     */
    public function nextFixture(): Collection
    {
        $lastPlayedFixture = $this->fixtures()->whereNotNull('played_at')->orderBy('week', 'desc')->first();

        return $lastPlayedFixture
            ? $this->fixtures()->whereWeek($lastPlayedFixture->week + 1)->get()
            : $this->fixtures()->whereWeek(1)->get();
    }

    /**
     * Define Relation with Fixture Model
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getUnplayedFixtures(): Collection
    {
        return $this->fixtures()->whereNotNull('played_at')->orderBy('week', 'desc')->get();
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
}
