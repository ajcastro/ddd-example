<?php

namespace App\Modules\Books\Infrastructure\Providers;

use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;
use App\Modules\Books\Infrastructure\Repositories\BookRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class BooksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
