<?php

namespace App\Providers;

use App\Repositories\Book\BookRepository;
use App\Repositories\Book\IBookRepositoryInterface;
use App\Repositories\BookDetails\BookDetailsRepository;
use App\Repositories\BookDetails\IBookDetailsRepositoryInterface;
use App\Repositories\BookEntity\BookEntityRepository;
use App\Repositories\BookEntity\IBookEntityRepositoryInterface;
use App\Repositories\BookImages\BookImageRepository;
use App\Repositories\BookImages\IBookImageRepositoryInterface;
use App\Repositories\BookPage\BookPageRepository;
use App\Repositories\BookPage\IBookPageRepositoryInterface;
use App\Repositories\User\IUserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Regdddister any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(IBookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(IBookDetailsRepositoryInterface::class, BookDetailsRepository::class);
        $this->app->bind(IBookImageRepositoryInterface::class, BookImageRepository::class);
        $this->app->bind(IBookEntityRepositoryInterface::class, BookEntityRepository::class);
        $this->app->bind(IBookPageRepositoryInterface::class, BookPageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
