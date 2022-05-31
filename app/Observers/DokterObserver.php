<?php

namespace App\Observers;

use App\Models\Dokter;

class DokterObserver
{
    /**
     * Handle the Dokter "created" event.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return void
     */
    public function created(Dokter $dokter)
    {
        $count = Dokter::count();
        if($count == 0){
            $dokter->update([
                'code' => 'A'
            ]);
        }else{
            $dokter->update([
                'code' => chr($count+ 64)
            ]);
        }

    }

    /**
     * Handle the Dokter "updated" event.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return void
     */
    public function updated(Dokter $dokter)
    {
        //
    }

    /**
     * Handle the Dokter "deleted" event.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return void
     */
    public function deleted(Dokter $dokter)
    {
        //
    }

    /**
     * Handle the Dokter "restored" event.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return void
     */
    public function restored(Dokter $dokter)
    {
        //
    }

    /**
     * Handle the Dokter "force deleted" event.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return void
     */
    public function forceDeleted(Dokter $dokter)
    {
        //
    }
}
