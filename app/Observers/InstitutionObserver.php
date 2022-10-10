<?php

namespace App\Observers;

use App\Models\Library;
use App\Models\Institution;

class InstitutionObserver
{
    /**
     * Handle the Institution "created" event.
     *
     * @param  \App\Models\Institution  $institution
     * @return void
     */
    public function created(Institution $institution)
    {
        Library::create([
            "name" => "Biblioteca " . $institution->name,
            "description" => "Biblioteca da instituição " . $institution->name
        ]);
    }

    /**
     * Handle the Institution "updated" event.
     *
     * @param  \App\Models\Institution  $institution
     * @return void
     */
    public function updated(Institution $institution)
    {
        //
    }

    /**
     * Handle the Institution "deleted" event.
     *
     * @param  \App\Models\Institution  $institution
     * @return void
     */
    public function deleted(Institution $institution)
    {
        //
    }

    /**
     * Handle the Institution "restored" event.
     *
     * @param  \App\Models\Institution  $institution
     * @return void
     */
    public function restored(Institution $institution)
    {
        //
    }

    /**
     * Handle the Institution "force deleted" event.
     *
     * @param  \App\Models\Institution  $institution
     * @return void
     */
    public function forceDeleted(Institution $institution)
    {
        //
    }
}
