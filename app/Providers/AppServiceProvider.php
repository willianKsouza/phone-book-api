<?php

namespace App\Providers;

use App\Interfaces\ContactRepositoryInterface;
use App\Repositories\ContactRepository;
use App\Services\DeleteContactAvatarService;
use App\Services\UploadContactAvatarService;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ContactRepositoryInterface::class,
            ContactRepository::class
        );

        $this->app->when([UploadContactAvatarService::class, DeleteContactAvatarService::class])
            ->needs(Filesystem::class)
            ->give(function () {
                return Storage::disk('public');
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
