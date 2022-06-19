<?php

namespace App\Observers;

use App\Models\JamPraktek;
use App\Models\pendaftaran;

class PendaftaranObserver
{
    /**
     * Handle the pendaftaran "created" event.
     *
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return void
     */
    public function created(pendaftaran $pendaftaran)
    {
        $count = pendaftaran::where('dokter_id', $pendaftaran->dokter_id)
            ->whereDate('tanggal_pendaftaran', $pendaftaran->tanggal_pendaftaran)
            ->where('jam_praktek_id', $pendaftaran->jam_praktek_id)
            ->where('shiff', $pendaftaran->shiff)
            ->where('id', '!=', $pendaftaran->id)->count() + 1;

//        $jam = JamPraktek::find( $pendaftaran->jam_praktek_id)->jam_praktek;
//        $on_int = (int) substr($jam, 0, 2);
        $antrian = $pendaftaran->dokter->code .'-'. sprintf("%03d", $count);
//        if ($on_int >= 18){
//            $antrian = $pendaftaran->dokter->code .'-'. sprintf("%03d", $count).'-M';
//        }
        if ($pendaftaran->shiff == 'malam'){
            $antrian = $pendaftaran->dokter->code .'-'. sprintf("%03d", $count).'-M';
        }
        $pendaftaran->update([
            'antrian' => $antrian
        ]);

        event(new \App\Events\NomorAntrianEvent());
    }

    /**
     * Handle the pendaftaran "updated" event.
     *
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return void
     */
    public function updated(pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Handle the pendaftaran "deleted" event.
     *
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return void
     */
    public function deleted(pendaftaran $pendaftaran)
    {
        event(new \App\Events\NomorAntrianEvent());
    }

    /**
     * Handle the pendaftaran "restored" event.
     *
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return void
     */
    public function restored(pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Handle the pendaftaran "force deleted" event.
     *
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return void
     */
    public function forceDeleted(pendaftaran $pendaftaran)
    {
        //
    }
}
