<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('components.header', function ($view) {
            $currentCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($currentCart);
            $cart = $cart->products;
            $view->with('cart', $cart);
        });

        Paginator::useBootstrapFive();
//        Paginator::useBootstrapFour();
//
        $usersCount = User::count();
        $cardsCount = Card::count();
        $boxesCount = Card::count();

        view()->share('usersCount', $usersCount);
        view()->share('cardsCount', $cardsCount);
        view()->share('boxesCount', $boxesCount);
    }
}
