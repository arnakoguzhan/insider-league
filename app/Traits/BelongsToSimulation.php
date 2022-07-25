<?php

namespace App\Traits;

use App\Models\Simulation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToSimulation
{
    /**
     * The model always belongs to a simulation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function simulation(): BelongsTo
    {
        return $this->belongsTo(Simulation::class);
    }

    /**
     * Scope a query to only include Standing of a given simulation.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $simulation_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySimulation($query, $simulation_id)
    {
        $query->where('simulation_id', $simulation_id);
    }
}
