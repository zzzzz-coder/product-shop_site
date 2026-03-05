<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Group;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_has_price()
    {
        $group = Group::create([
            'name' => 'Test',
            'id_parent' => 0
        ]);

        $product = Product::create([
            'name' => 'Phone',
            'id_group' => $group->id
        ]);

        Price::create([
            'id_product' => $product->id,
            'price' => 100
        ]);

        $this->assertEquals(
            100,
            $product->price->price
        );
    }

    public function test_group_has_products()
    {
        $group = Group::create([
            'name' => 'Phones',
            'id_parent' => 0
        ]);

        Product::create([
            'name' => 'iPhone',
            'id_group' => $group->id
        ]);

        $this->assertCount(
            1,
            $group->products
        );
    }

    public function test_group_children()
    {
        $parent = Group::create([
            'name' => 'Electronics',
            'id_parent' => 0
        ]);

        $child = Group::create([
            'name' => 'Phones',
            'id_parent' => $parent->id
        ]);

        $this->assertEquals(
            $parent->id,
            $child->parent->id
        );
    }
}