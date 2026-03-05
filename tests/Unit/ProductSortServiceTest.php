<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Price;
use App\Services\ProductSortService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Group;
class ProductSortServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_sort_by_name_ascending()
    {
        $group = Group::create([
            'id_parent' => 0,
            'name' => 'Test group'
        ]);

        Product::create([
            'name' => 'B',
            'id_group' => $group->id
        ]);

        Product::create([
            'name' => 'A',
            'id_group' => $group->id
        ]);

        $service = new ProductSortService();

        $query = Product::query();
        $products = $service->apply($query, 'name', 'asc')->get();

        $this->assertEquals('A', $products->first()->name);
    }

    public function test_sort_by_price_descending()
    {
        $group = Group::create([
            'id_parent' => 0,
            'name' => 'Test group'
        ]);

        $p1 = Product::create([
            'name' => 'A',
            'id_group' => $group->id
        ]);

        $p2 = Product::create([
            'name' => 'B',
            'id_group' => $group->id
        ]);

        Price::create(['id_product' => $p1->id, 'price' => 100]);
        Price::create(['id_product' => $p2->id, 'price' => 200]);

        $service = new ProductSortService();

        $query = Product::query();
        $products = $service->apply($query, 'price', 'desc')->get();

        $this->assertEquals(200, $products->first()->price->price);
    }
}