<?php

namespace App\Observers;

use App\Models\pendaftaran;
use App\Models\Riwayat;

class RiwayatObserver
{
    /**
     * Handle the Riwayat "created" event.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return void
     */
    public function created(Riwayat $riwayat)
    {
        pendaftaran::where('antrian', $riwayat->antrian)->first()->delete();
    }

    /**
     * Handle the Riwayat "updated" event.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return void
     */
    public function updated(Riwayat $riwayat)
    {
        //
    }

    /**
     * Handle the Riwayat "deleted" event.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return void
     */
    public function deleted(Riwayat $riwayat)
    {
        //
    }

    /**
     * Handle the Riwayat "restored" event.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return void
     */
    public function restored(Riwayat $riwayat)
    {
        //
    }

    /**
     * Handle the Riwayat "force deleted" event.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return void
     */
    public function forceDeleted(Riwayat $riwayat)
    {
        //
    }
}
