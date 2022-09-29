<template>
	<div class="product-card col-sm-6 col-md-4">
		<div class="thumbnail">
			<div class="labels">
				<div v-for="label in product.labels"
					 :key="label.id"
					 :class="[label.class, 'badge']">
					{{ label.name }}
				</div>
			</div>
			<img class="img-fluid" :src="product.image">
			<div class="caption">
				<h3>
					<Link :href="route('products.category.product.show', [categorySlug, product.id])">
						{{ product.name }}
					</Link>
				</h3>
				<div style="margin-bottom: 5px">
					{{ product.price }} руб.
				</div>
				<h5>
					<form v-if="cartCollection[product.id]" @submit.prevent="cart">
						<button type="submit" class="btn btn-primary" role="button">В корзинe</button>
					</form>
					<form v-else @submit.prevent="addToCart(categorySlug, product.id)">
<!--						<input type="number" name="quantity" value="1" min="1" max="9000">-->
						<button type="submit" class="btn btn-success" role="button">В корзинy</button>
					</form>

				</h5>
				<br>
			</div>
		</div>
	</div>
</template>

<script>

    import {cartMixin} from "@/Mixins/cart-mixin";

    export default {

        mixins: [cartMixin],

        props: {
		    product: Object,
			categorySlug: String,
		},

    }
</script>

<style lang="scss">

	.product-card {

		.labels {
			position: absolute;
		}

		.labels .badge {
			display: block;
		}

		.badge.badge-success {
			color: #fff;
			background-color: #28a745;
		}

		.badge.badge-warning {
			color: #fff;
			background-color: #dc3545;
		}

		.badge.badge-danger {
			color: #212529;
			background-color: #ffc107;
		}
	}

</style>