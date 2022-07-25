<?php

namespace App\Models;

use App\Traits\BelongsToSimulation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Define Relation with Team Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
