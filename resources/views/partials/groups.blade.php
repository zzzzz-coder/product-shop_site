<h3>Группы</h3>

<ul>
@foreach($menuGroups as $group)
    @include('partials.group-item', ['group' => $group])
@endforeach
</ul>