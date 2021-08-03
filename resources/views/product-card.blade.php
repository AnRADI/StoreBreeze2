<div class="col-sm-6 col-md-4">
	<div class="thumbnail">
		<img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg" alt="iPhone X 64GB">
		<div class="caption">
			<h3>
				{{ $product->name }}
			</h3>
			<h4>
				{{ $product->category->name }}
			</h4>
			<p>
				{{ $product->price }} руб.
			</p>


			<form>
				<button @click.prevent="cartAddProduct('{{ $product->slug }}')" type="submit" class="btn btn-primary" role="button">В корзину</button>
				<a href="{{ route('product', $product->slug) }}" class="btn btn-default" role="button">
					Подробнее
				</a>
			</form>

		</div>
	</div>
</div>