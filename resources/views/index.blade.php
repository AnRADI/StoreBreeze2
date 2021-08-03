@extends('layouts.app')

@section('title', 'Главная')

@section('content')
	<div class="container">
		<div class="starter-template">

			<h1>Все товары</h1>



			<div class="row">
				@foreach($products as $product)
					@include('includes.product-card', compact('product'))
				@endforeach
			</div>
		</div>



	</div>
@endsection
