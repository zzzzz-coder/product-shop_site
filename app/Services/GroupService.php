<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public function buildTree($groups, $productCounts, $parentId = 0)
    {
        $branch = [];

        foreach ($groups as $group) {
            if ($group->id_parent == $parentId) {

                $children = $this->buildTree($groups, $productCounts, $group->id);

                $ownCount = $productCounts[$group->id] ?? 0;
                $childrenCount = collect($children)->sum('total_count');

                $group->total_count = $ownCount + $childrenCount;

                if ($children) {
                    $group->childrenTree = $children;
                }

                $branch[] = $group;
            }
        }

        return $branch;
    }
    public function getBreadcrumbs($group)
    {
        $breadcrumbs = [];

        while ($group) {
            array_unshift($breadcrumbs, $group);
            $group = $group->parent;
        }

        return $breadcrumbs;
    }
}