<?php

namespace App\Providers;

use App\Models\Dokter;
use App\Models\pendaftaran;
use App\Models\Riwayat;
use App\Observers\DokterObserver;
use App\Observers\PendaftaranObserver;
use App\Observers\RiwayatObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Dokter::observe(DokterObserver::class);
        pendaftaran::observe(PendaftaranObserver::class);
        Riwayat::observe(RiwayatObserver::class);
    }
}
