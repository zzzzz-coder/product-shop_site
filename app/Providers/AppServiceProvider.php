<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Group;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use App\Services\GroupService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(GroupService $groupService)
    {
        Paginator::useBootstrapFour();
        View::composer('*', function ($view) use ($groupService) {

            $groups = Group::all();
            $products = Product::select('id_group')->get();

            $counts = $products->groupBy('id_group')
                ->map(fn($items) => $items->count())
                ->toArray();

            $tree = $groupService->buildTree($groups, $counts);

            $view->with('groupTree', $tree);
        });
    }
}
