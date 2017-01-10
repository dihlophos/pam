<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Route::model('disease_type', App\Models\DiseaseType::class);
        Route::model('disease', App\Models\Disease::class);
        Route::model('animal_category', App\Models\AnimalCategory::class);
        Route::model('animal_type', App\Models\AnimalType::class);
        Route::model('service_category', App\Models\ServiceCategory::class);
        Route::model('measure', App\Models\Measure::class);
        Route::model('preparation_measure', App\Models\PreparationMeasure::class);
        Route::model('basic_document', App\Models\BasicDocument::class);
        Route::model('lab_jurisdiction', App\Models\LabJurisdiction::class);
        Route::model('executor_category', App\Models\ExecutorCategory::class);
        Route::model('executor', App\Models\Executor::class);
        Route::model('material_type', App\Models\MaterialType::class);
        Route::model('research_category', App\Models\ResearchCategory::class);
        Route::model('so_measure', App\Models\SOMeasure::class);
        Route::model('work_type', App\Models\WorkType::class);
        Route::model('service', App\Models\Service::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
