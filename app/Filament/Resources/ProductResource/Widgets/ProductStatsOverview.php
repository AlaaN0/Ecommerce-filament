<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProductStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
       // $elec = Category::where('name', 'Electronics')->withCount('products')->first();

        return [
                Card::make('All Products', Product::all()->count()),
                //Card::make('Electronics', Product::where('category_id','1')->count()),
                //Card::make('Average time on page', '3:12'),

           ];
    }
}
