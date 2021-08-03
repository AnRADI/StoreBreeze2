@extends('layouts.app')

@section('title', 'Категория ' . $category->name)

@section('content')
	<div class="container">
		<div class="starter-template">
		<h1> {{ $category->name }} {{ $category->products->count() }} </h1>
			<p> {{ $category->description }} </p>
			<div class="row">
				@foreach($category->products as $product)
					@include('includes.product-card', compact('product'))
				@endforeach
			</div>
		</div>
	</div>
@endsection
