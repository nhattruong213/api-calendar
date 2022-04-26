<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Repositories\Task\TaskRepository;
use Repositories\Task\TaskRepositoryInterFace;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(TaskRepositoryInterFace::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
