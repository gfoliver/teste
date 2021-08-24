<?php

namespace App\Providers;

use App\Core\Repositories\AddressRepository;
use App\Core\Repositories\Contracts\IAddressRepository;
use App\Core\Repositories\Contracts\IUserRepository;
use App\Core\Repositories\UserRepository;
use App\Core\Services\AddressService;
use App\Core\Services\Contracts\IAddressService;
use App\Core\Services\Contracts\IUserService;
use App\Core\Services\UserService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Repositories
        $this->app->singleton(IUserRepository::class, UserRepository::class);
        $this->app->singleton(IAddressRepository::class, AddressRepository::class);

        // Services
        $this->app->singleton(IUserService::class, UserService::class);
        $this->app->singleton(IAddressService::class, AddressService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
