@php
    use App\Models\Group;

    $current = $currentGroup ?? null;

    $rootGroups = Group::whereNull('id_parent')->get();

    function isActiveBranch($group, $current) {
        while ($current) {
            if ($current->id == $group->id) return true;
            $current = $current->parent;
        }
        return false;
    }

    function renderBranch($group, $current) {

        $active = isActiveBranch($group, $current);
        $color = $active ? 'green' : 'blue';

        echo '<li>';
        echo '<a style="color:'.$color.'; text-decoration:none;" href="'.route('group.show',$group->id).'">';
        echo $group->name;
        echo '</a>';

        if ($active) {
            $children = $group->children;
            if ($children->count()) {
                echo '<ul style="list-style:none; padding-left:15px;">';
                foreach ($children as $child) {
                    renderBranch($child, $current);
                }
                echo '</ul>';
            }
        }

        echo '</li>';
    }
@endphp

<h4>Группы</h4>

<ul style="list-style:none; padding-left:0;">
@foreach($rootGroups as $group)
    @php renderBranch($group, $current); @endphp
@endforeach
</ul>