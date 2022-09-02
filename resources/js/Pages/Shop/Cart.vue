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
										<Link @click.stop="hideCartModal" :href="route('products.category.product.show', [product.categories[0].slug, product.id])">

											<img style="height: 56px" :src="product.image">
											{{ product.name }}

										</Link>
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

												<button @click="addToCart(product.categories[0].slug, product.id, {quantity: --product.quantity})" class="btn btn-danger cart-button-minus" type="button">
													<span class="glyphicon glyphicon-minus" aria-hidden="true">-</span>
												</button>

<!--												<input type="number"-->
<!--													   @input="addProductCart(product.code, {quantity: product.quantity})"-->
<!--													   v-model.number="product.quantity">-->

												<button @click="addToCart(product.categories[0].slug, product.id, {quantity: ++product.quantity})" class="btn btn-success cart-button-plus" type="button">
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
<!--									<td>{{cartForm.errors.zz}}</td>-->
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
				cartForm: this.$inertia.form()
			}
		},

        computed: {

            cartId() {
                return $('#cartId');
            },

            cartCollection() {
                return this.$page.props.cartCollection;
            },

            isCartData() {

                return Object.keys(this.cartCollection).length;
            }
        },

		watch: {

            cartS() {

                this.cart();
            },

            addToCartS(params) {

                this.addToCart(params.categorySlug, params.productId, params.cartForm)
			}
		},

        methods: {

            async cart() {

                this.cartId.modal('show');
            },


            async addToCart(categorySlug, productId, cartForm = { quantity: 1 }) {


                if(cartForm.quantity != '') {

                    if(cartForm.quantity <= 0) {

                        cartForm.quantity = 1;
					}

                    cartForm._method = 'patch';


                    this.cartForm = this.cartForm.transform((data) => ({
                        ...data,
                        ...cartForm
                    }));


                    this.cartForm.post(route('cart.category.product.update', [categorySlug, productId]), {

						preserveScroll: true,

                        onFinish: () => {
                            if(!this.cartId.hasClass('show'))
                                this.cartId.modal('show');
                        }
					});

				}
            },

            // async removeProductCart(productId, cartForm = { quantity: 1, _method: 'delete' }) {
			//
            //     let cartResponse = await axios.post(route('remove.product.cart', productId), cartForm);
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
                let cartCollection = this.cartCollection;

                for(let productId in cartCollection) {

                    cartTotalCost += cartCollection[productId].cost;
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