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
								<tr v-for="product in cartCollectionS" :key="product.code">
									<td>
										<inertia-link @click.stop="hideCartModal" :href="route('category.product', [categorySlug, product.code])">

											<img style="height: 56px" :src="product.image">
											{{ product.name }}

										</inertia-link>
									</td>
									<td>
<!--										<span class="badge">{{ product.quantity }}</span>-->
										<div class="btn-group">
<!--											<form @submit.prevent="removeProductCart(product.code)">-->
<!--												<button type="submit" class="btn btn-danger">-->
<!--													<span class="glyphicon glyphicon-minus" aria-hidden="true">-</span>-->
<!--												</button>-->
<!--											</form>-->
<!--											<form @submit.prevent="addProductCart(product.code)">-->
<!--												<button type="submit" class="btn btn-success">-->
<!--													<span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>-->
<!--												</button>-->
<!--											</form>-->
											<form class="cart-form">
												<button @click.stop="addProductCart(product.code, {quantity: --product.quantity})" class="btn btn-danger cart-button-minus" type="button">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">-</span>
												</button>

												<input type="number"
													   @input="addProductCart(product.code, {quantity: product.quantity})"
													   v-model.number="product.quantity">

												<button @click.stop="addProductCart(product.code, {quantity: ++product.quantity})" class="btn btn-success cart-button-plus" type="button">
													<span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
												</button>
											</form>
<!--											<form @submit.prevent="removeProductCart(product.code, getCartForm($event))">-->
<!--												<button type="submit" class="btn btn-danger">Удалить</button>-->
<!--												<input type="hidden" name="delete" value="true">-->
<!--											</form>-->
										</div>
									</td>

									<td>{{ product.price }}</td>
									<td>{{ getProductCost(product) }}</td>
								</tr>
								<tr>
									<td colspan="3">Общая стоимость: {{ getCartTotalCost() }}</td>
									<td></td>
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

	export default {

        data() {
            return {
                categorySlug: '',
			}
		},

        computed: {

            cartId() {
                return $('#cartId');
            },

            isCartData() {

                return Object.keys(this.cartCollectionS).length;
            }
        },


        watch: {

            cartS() {

                this.cart();
			},

            addProductCartS(params) {

                this.addProductCart(params.productCode);
            },
		},


        methods: {

            async cart() {

				let cartResponse = await axios.get(route('cart'));

				this.cartCollectionM(cartResponse.data);


                this.cartId.modal('show');
            },

            async addProductCart(productCode, cartForm = { quantity: 1 }) {

                if(cartForm.quantity != '') {

                    if(cartForm.quantity <= 0) {

                        cartForm.quantity = 1;
					}

                    let cartResponse =
                        await axios.post(route('add.product.cart', productCode), cartForm);


                    this.cartCollectionM(cartResponse.data);


                    if(!this.cartId.hasClass('show'))
                        this.cartId.modal('show');
				}
            },

            // async removeProductCart(productCode, cartForm = { quantity: 1, _method: 'delete' }) {
			//
            //     let cartResponse = await axios.post(route('remove.product.cart', productCode), cartForm);
			//
            //     this.cartCollectionM(cartResponse.data);
            // },

			hideCartModal() {

                this.cartId.modal('hide');
			},

            // getRemoveProductCartForm(event) {
			//
            //     let cartForm = new FormData(event.currentTarget);
			//
            //     cartForm.append('_method', 'delete');
			//
            //     return cartForm;
            // },

            getProductCost(product) {

                product.cost = product.quantity * product.price;

                return product.cost;
            },

            getCartTotalCost() {

                let cartTotalCost = 0;
                let cartCollection = this.cartCollectionS;

                for(let productCode in cartCollection) {

                    cartTotalCost += cartCollection[productCode].cost;
                }

                return cartTotalCost;
            },
		}
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

	.cart-button-minus {
		position: absolute;
		top: 1px;
		left: 1px;
		bottom: 1px;
		width: 20px;
		padding: 0;
		display: block;
		text-align: center;
		border: none;
		border-right: 1px solid #ddd;
		font-size: 16px;
		font-weight: 600;
	}

	.cart-button-plus {
		position: absolute;
		top: 1px;
		right: 1px;
		bottom: 1px;
		width: 20px;
		padding: 0;
		display: block;
		text-align: center;
		border: none;
		border-left: 1px solid #ddd;
		font-size: 16px;
		font-weight: 600;
	}
</style>