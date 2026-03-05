@extends('layouts.app')
@section('content')

<nav class="mb-3">
    <a href="{{ route('catalog.index') }}">Главная</a>

    @foreach($breadcrumbs as $crumb)
        &gt;
        <a href="{{ route('group.show',$crumb->id) }}">
            {{ $crumb->name }}
        </a>
    @endforeach

    &gt; <span>{{ $product->name }}</span>
</nav>

<h2>{{ $product->name }}</h2>
<p><strong>Цена:</strong> {{ $product->price->price }} руб.</p>

@endsection
