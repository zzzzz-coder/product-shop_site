@extends('layouts.app')

@section('content')

<h1>Каталог</h1>

<table border="1" cellpadding="5">
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
                    {{ route('catalog.index') }}
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
                {{ route('catalog.index') }}
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
                <a href="{{ route('product.show', $product->id) }}">
                    {{ $product->name }}
                </a>
            </td>
            <td>{{ number_format($product->price->price ?? 0, 2, '.', ' ') }} ₽</td>
        </tr>
    @endforeach
</table>

{{ $products->appends(request()->query())->links() }}

@endsection