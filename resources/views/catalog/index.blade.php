@extends('layouts.app')

@section('content')

<h1>Каталог</h1>

<table class="products-table" border="1" cellpadding="5">
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
<form method="GET">

    <input type="hidden" name="sort" value="{{ request('sort') }}">
    <input type="hidden" name="direction" value="{{ request('direction') }}">

    <label>Товаров на странице:</label>

    <select name="per_page" onchange="this.form.submit()">
        <option value="6" {{ $perPage == 6 ? 'selected' : '' }}>6</option>
        <option value="12" {{ $perPage == 12 ? 'selected' : '' }}>12</option>
        <option value="18" {{ $perPage == 18 ? 'selected' : '' }}>18</option>
    </select>

</form>

@endsection