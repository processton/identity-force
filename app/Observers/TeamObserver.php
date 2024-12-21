<?php

namespace App\Observers;

use App\Models\Team;

class TeamObserver
{

    /**
     * Handle the Team "creating" event.
     */

    public function creating(Team $team): void
    {
        $team->color = (string) substr(md5(rand()), 0, 6);
    }

    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        //
    }
}
