@extends('layouts.app')

@section('content')

<nav class="mb-3">
    <a href="{{ route('catalog.index') }}">Главная</a>

    @foreach($breadcrumbs as $crumb)
        &gt;
        @if(!$loop->last)
            <a href="{{ route('group.show',$crumb->id) }}">
                {{ $crumb->name }}
            </a>
        @else
            <span>{{ $crumb->name }}</span>
        @endif
    @endforeach
</nav>

<h2>{{ $group->name }}</h2>

<table class="table table-striped">
<tr>
    <th>
        @php
            $nextDirection = 'asc';
            if ($sort === 'name' && $direction === 'asc') $nextDirection = 'desc';
            elseif ($sort === 'name' && $direction === 'desc') $nextDirection = null;
        @endphp

        <a href="
            @if($nextDirection)
                {{ request()->fullUrlWithQuery(['sort'=>'name','direction'=>$nextDirection]) }}
            @else
                {{ route('group.show', $group->id) }}
            @endif
        ">
            Название
            @if($sort === 'name')
                @if($direction === 'asc') ↑
                @elseif($direction === 'desc') ↓
                @endif
            @endif
        </a>
    </th>

    <th>
        @php
            $nextDirection = 'asc';
            if ($sort === 'price' && $direction === 'asc') $nextDirection = 'desc';
            elseif ($sort === 'price' && $direction === 'desc') $nextDirection = null;
        @endphp

        <a href="
            @if($nextDirection)
                {{ request()->fullUrlWithQuery(['sort'=>'price','direction'=>$nextDirection]) }}
            @else
                {{ route('group.show', $group->id) }}
            @endif
        ">
            Цена
            @if($sort === 'price')
                @if($direction === 'asc') ↑
                @elseif($direction === 'desc') ↓
                @endif
            @endif
        </a>
    </th>
</tr>

@foreach($products as $product)
<tr>
    <td>
        <a href="{{ route('product.show',$product->id) }}">
            {{ $product->name }}
        </a>
    </td>
    <td>{{ $product->price->price ?? '' }} руб.</td>
</tr>
@endforeach

</table>

{{ $products->appends(request()->query())->links() }}

@endsection