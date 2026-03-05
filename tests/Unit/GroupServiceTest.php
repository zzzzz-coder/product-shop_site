<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_build_tree_counts_products_correctly()
    {
        $parent = Group::create(['name' => 'Parent', 'id_parent' => 0]);
        $child = Group::create(['name' => 'Child', 'id_parent' => $parent->id]);

        $groups = Group::all();

        $counts = [
            $parent->id => 1,
            $child->id => 2
        ];

        $service = new GroupService();
        $tree = $service->buildTree($groups, $counts);

        $this->assertEquals(3, $tree[0]->total_count);
    }

    public function test_get_breadcrumbs_returns_correct_order()
    {
        $parent = Group::create(['name' => 'Parent', 'id_parent' => 0]);
        $child = Group::create(['name' => 'Child', 'id_parent' => $parent->id]);

        $service = new GroupService();
        $breadcrumbs = $service->getBreadcrumbs($child);

        $this->assertEquals('Parent', $breadcrumbs[0]->name);
        $this->assertEquals('Child', $breadcrumbs[1]->name);
    }
}