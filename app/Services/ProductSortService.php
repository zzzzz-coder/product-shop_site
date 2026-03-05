<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class ProductSortService
{
    public function apply(Builder $query, ?string $sort, ?string $direction): Builder
    {
        if (!in_array($sort, ['name', 'price'])) {
            return $query;
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            return $query;
        }

        if ($sort === 'price') {
            $query->join('prices', 'products.id', '=', 'prices.id_product')
                ->orderBy('prices.price', $direction)
                ->select('products.*');
        }

        if ($sort === 'name') {
            $query->orderBy('products.name', $direction);
        }

        return $query;
    }
}