<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SuratTugasIsDeleted' => [
            'App\Listeners\DetachSuratTugasUser',
            'App\Listeners\RemoveLaporanSuratTugas',
        ],
        'App\Events\PengajuanKeuanganIsCreated' => [
            'App\Listeners\SynchronizePaguTahunanBalanceFromCreatePengajuanKeuangan',
        ],
        'App\Events\PengajuanKeuanganIsUpdated' => [
            'App\Listeners\SynchronizePaguTahunanBalanceFromUpdatePengajuanKeuangan',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
