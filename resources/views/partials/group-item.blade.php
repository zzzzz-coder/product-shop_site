<li>
    <a href="{{ route('group.show', $group->id) }}">
        {{ $group->name }}
    </a>

    @if($group->children->count())
        <ul style="margin-left:15px;">
            @foreach($group->children as $child)
                @include('partials.group-item', ['group' => $child])
            @endforeach
        </ul>
    @endif
</li>