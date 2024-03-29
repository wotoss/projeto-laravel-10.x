<?php

namespace App\Providers;

use App\Repositories\{SupportEloquentORM};
use App\Repositories\{SupportRepositoryInterface};
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //fazendo (bind ou associação) de uma interface com uma classe concreta.
        $this->app->bind(
            //vou utilizar o bind, seria onde estiver uma classe abstrata eu vou utilizar uma classe concreta
            SupportRepositoryInterface::class, 
            //importantos a classe concreta
            SupportEloquentORM::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
