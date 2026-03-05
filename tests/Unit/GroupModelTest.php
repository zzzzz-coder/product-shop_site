<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_children_ids()
    {
        $parent = Group::create(['name' => 'Parent', 'id_parent' => 0]);
        $child = Group::create(['name' => 'Child', 'id_parent' => $parent->id]);
        $subChild = Group::create(['name' => 'SubChild', 'id_parent' => $child->id]);

        $ids = $parent->getAllChildrenIds();

        $this->assertContains($child->id, $ids);
        $this->assertContains($subChild->id, $ids);
    }
}