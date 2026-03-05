@php
    $activeIds = $activeIds ?? [];

    if (isset($currentGroup) && $currentGroup) {
        $temp = $currentGroup;
        while ($temp) {
            $activeIds[] = $temp->id;
            $temp = $temp->parent;
        }
    }
@endphp

<div class="group-menu">

<ul style="list-style:none; padding-left:15px;">

@foreach ($groups as $group)

    @php
        $isActive = in_array($group->id, $activeIds);
    @endphp

    <li>

        <a href="{{ route('group.show', $group->id) }}"
           class="{{ $isActive ? 'active' : '' }}">
            {{ $group->name }} ({{ $group->total_count }})
        </a>

        {{-- Показывать детей только если группа в активной ветке --}}
        @if ($isActive && isset($group->childrenTree) && count($group->childrenTree))
            @include('partials.group-tree', [
                'groups' => $group->childrenTree,
                'activeIds' => $activeIds
            ])
        @endif

    </li>

@endforeach

</ul>

</div>