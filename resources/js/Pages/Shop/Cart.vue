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
										<inertia-link @click.stop="hideCartModal" :href="route('category.product', [product.category.slug, product.code])">

											<img height="56px" src="http://laravel-diplom-1.rdavydov.ru/storage/products/iphone_x.jpg">
											{{ product.name }}

										</inertia-link>
									</td>
									<td>
										<span class="badge">{{ product.quantity }}</span>
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
											<form @submit.prevent="removeProductCart(product.code)">
												<button type="submit" class="btn btn-danger">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">-</span>
												</button>
											</form>
											<form @submit.prevent="addProductCart(product.code)">
												<button type="submit" class="btn btn-success">
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

    import { mapState, mapMutations } from 'vuex'

	export default {

        computed: {

            ...mapState([
                'cartS',
				'addProductCartS',
				'cartCollectionS'
			]),

            cartId() {
                return $('#cartId');
            },

            isCartData() {

                return Object.keys(this.cartCollectionS).length > 0;
            }
        },

		watch: {

            cartS() {

                this.cart();
			},

            addProductCartS(params) {

                this.addProductCart(params.productCode);
            }
		},


        methods: {

            ...mapMutations([
                'cartCollectionM'
			]),

            async cart() {

				if(!this.isCartData) {

                    let cartResponse = await axios.get(route('cart'));

                    this.cartCollectionM(cartResponse.data);
                }

                this.cartId.modal('show');
            },

            async addProductCart(productCode, cartForm = { quantity: 1 }) {

                let cartResponse =
					await axios.post(route('add.product.cart', productCode), cartForm);


                this.cartCollectionM(cartResponse.data);


                if(!this.cartId.hasClass('show'))
                    this.cartId.modal('show');
            },

            async removeProductCart(productCode, cartForm = { quantity: 1, _method: 'delete' }) {

                let cartResponse = await axios.post(route('remove.product.cart', productCode), cartForm);

                this.cartCollectionM(cartResponse.data);
            },

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
</style>