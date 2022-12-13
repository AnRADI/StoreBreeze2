<template>
	<div class="modal fade" id="cartId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div v-if="isCartData" class="modal-content">
				<div class="modal-header">
					<h1>Корзина</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="starter-template">
					<p>Оформление заказа</p>

					<div class="panel">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Название</th>
									<th>Кол-во</th>
									<th>Цена</th>
									<th>Стоимость</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="product in cartCollection" :key="product.code">
									<td>
										<Link @click.stop="hideCart" :href="route('products.category.product.show', [product.categories[0].slug, product.id])">

											<img style="height: 56px" :src="product.image">
											{{ product.name }}

										</Link>
									</td>
									<td>
										<div class="btn-group">
											<form class="cart-form">

												<button :disabled="product.pivot.quantity <= 1" @click="addToCart(product.categories[0].slug, product.id, --product.pivot.quantity)" class="btn btn-danger cart-button-minus" type="button">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">-</span>
												</button>

												<input type="number"
													   @input="addToCart(product.categories[0].slug, product.id, product.pivot.quantity)"
													   v-model.number="product.pivot.quantity">

												<button @click="addToCart(product.categories[0].slug, product.id, ++product.pivot.quantity)" class="btn btn-success cart-button-plus" type="button">
													<span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
												</button>

											</form>
										</div>
									</td>
									<td>{{ product.price }}</td>
									<td>{{ getCartProductCost(product) }}</td>
								</tr>
								<tr>
									<td colspan="3">Общая стоимость: {{ cartTotalCost }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div v-else class="modal-content">
				<div class="modal-header">
					<h1>Корзина пуста</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</template>


<script>

    import useCart from "@/Composables/useCart";


    export default {

        setup() {

            const {
                cartForm,
                cartCollection,
                isCartData,
                cartTotalCost,
                hideCart,
                addToCart,
                getCartProductCost,

            } = useCart();


            return {
                cartForm,
                cartCollection,
                isCartData,
                cartTotalCost,
                hideCart,
                addToCart,
                getCartProductCost,
            }
        },

	};

</script>


<style lang="scss">

	.starter-template {
		margin-left: 16px;
	}

	.badge {
		color: black;
		font-size: 20px;
	}

	.modal.fade .modal-dialog {
		transform: none;
	}

	.modal-header {
		border-bottom: none;
	}

	.align-icons {
		justify-content: center;
	}

	.cart-form {
		display: inline-block;
		position: relative;
		width: 100px;
	}

	.cart-form input[type="number"],
	.cart-form input[type="number"]:hover,
	.cart-form input[type="number"]:focus {
		display: block;
		height: 32px;
		line-height: 32px;
		width: 100%;
		padding: 0;
		margin: 0;
		box-sizing: border-box;
		text-align: center;
		-moz-appearance: textfield;
		-webkit-appearance: textfield;
		appearance: none;
		outline: none;
	}

	.cart-form input[type="number"]::-webkit-outer-spin-button,
	.cart-form input[type="number"]::-webkit-inner-spin-button {
		-webkit-appearance: none;
	}

	.cart-button-plus, .cart-button-minus {
		display: flex !important;
		justify-content: center;
		align-items: center;
		width: 20px;
		padding: 0;
	}

	.cart-button-minus {
		position: absolute;
		top: 1px;
		left: 1px;
		bottom: 1px;
	}

	.cart-button-plus {
		position: absolute;
		top: 1px;
		right: 1px;
		bottom: 1px;
	}

</style>
