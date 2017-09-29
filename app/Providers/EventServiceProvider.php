<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Observers\DiagnosticTestObserver;
use App\Observers\PreventionObserver;
use App\Observers\SanitaryWorkObserver;
use App\Models\DiagnosticTest;
use App\Models\Prevention;
use App\Models\SanitaryWork;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
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
        DiagnosticTest::observe(DiagnosticTestObserver::class);
        Prevention::observe(PreventionObserver::class);
        SanitaryWork::observe(SanitaryWorkObserver::class);
    }
}
