@extends('layouts.app')

@section('content')
<h2>Группы</h2>
<ul>
@foreach($homes as $home)
    <li><a href="{{ route('home.show',$home->id) }}">{{ $home->name }}</a></li>
@endforeach
</ul>

<h2>Товары</h2>

<table class="table table-bordered">
<tr>
    <th>
        @php
            $nextDirection = 'asc';

            if ($sort === 'name' && $direction === 'asc') {
                $nextDirection = 'desc';
            } elseif ($sort === 'name' && $direction === 'desc') {
                $nextDirection = null;
            }
        @endphp

        <a href="
            @if($nextDirection)
                {{ request()->fullUrlWithQuery(['sort'=>'name','direction'=>$nextDirection]) }}
            @else
                {{ route('home.show', $home->id) }}
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

            if ($sort === 'price' && $direction === 'asc') {
                $nextDirection = 'desc';
            } elseif ($sort === 'price' && $direction === 'desc') {
                $nextDirection = null;
            }
        @endphp

        <a href="
            @if($nextDirection)
                {{ request()->fullUrlWithQuery(['sort'=>'price','direction'=>$nextDirection]) }}
            @else
                {{ route('home.show', $home->id) }}
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
<td><a href="{{ route('product.show',$product->id) }}">{{ $product->name }}</a></td>
<td>{{ $product->price->price ?? '' }} руб.</td>
</tr>
@endforeach
</table>

{{ $products->appends(request()->query())->links() }}
@endsection
