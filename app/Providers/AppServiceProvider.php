<?php

namespace App\Providers;

use App\Repositories\Block\BlockRepositoryInterface;
use App\Repositories\Block\BlockRepository;
use App\Repositories\BlockDetail\BlockDetailRepository;
use App\Repositories\BlockDetail\BlockDetailRepositoryInterface;
use App\Repositories\Hotel\HotelRepository;
use App\Repositories\Hotel\HotelRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\PaymentInformation\PaymentInformationRepository;
use App\Repositories\PaymentInformation\PaymentInformationRepositoryInterface;
use App\Repositories\RatingDetail\RatingDetailRepository;
use App\Repositories\RatingDetail\RatingDetailRepositoryInterface;
use App\Repositories\SearchHistory\SearchHistoryRepository;
use App\Repositories\SearchHistory\SearchHistoryRepositoryInterface;
use App\Repositories\TypeRoom\TypeRoomRepository;
use App\Repositories\TypeRoom\TypeRoomRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\WishList\WishListRepository;
use App\Repositories\WishList\WishListRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(BlockRepositoryInterface::class, BlockRepository::class);
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
        $this->app->bind(TypeRoomRepositoryInterface::class, TypeRoomRepository::class);
        $this->app->bind(BlockDetailRepositoryInterface::class, BlockDetailRepository::class);
        $this->app->bind(RatingDetailRepositoryInterface::class, RatingDetailRepository::class);
        $this->app->bind(PaymentInformationRepositoryInterface::class, PaymentInformationRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(WishListRepositoryInterface::class, WishListRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SearchHistoryRepositoryInterface::class, SearchHistoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
