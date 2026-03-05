<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Product;
use App\Services\GroupService;
use App\Services\ProductSortService;
class GroupController extends Controller
{
    public function show(
        Request $request,
        Group $group,
        ProductSortService $sortService,
        GroupService $groupService
    ) {

        $ids = $group->getAllChildrenIds();
        $ids[] = $group->id;

        $query = Product::with('price')
            ->whereIn('id_group', $ids);

        $sort = $request->get('sort');
        $direction = $request->get('direction');

        $query = $sortService->apply($query, $sort, $direction);

        $products = $query->paginate(20);

        return view('group', [
            'group' => $group,
            'products' => $products,
            'breadcrumbs' => $groupService->getBreadcrumbs($group),
            'sort' => $sort,
            'direction' => $direction,
            'currentGroup' => $group
        ]);
    }
}
