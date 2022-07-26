<?php

namespace App\Models;

use App\Traits\BelongsToSimulation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Standing extends Model
{
    use HasFactory;
    use BelongsToSimulation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'simulation_id',
        'points',
        'played',
        'won',
        'lost',
        'draw',
        'goal_difference',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Always order standings by points descending
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('points', 'desc');
        });
    }

    /**
     * Define Relation with Team Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Scope a query to only include Standing of a given team.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $team_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByTeam($query, $team_id)
    {
        $query->where('team_id', $team_id);
    }
}
