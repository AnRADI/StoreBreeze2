<template>
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">
			<img class="img-fluid" :src="product.image">
			<div class="caption">
				<h3>
					<inertia-link :href="route('category_slug.product_code', [categorySlug, product.code])">
						{{ product.name }}
					</inertia-link>
				</h3>
<!--				<h4 v-if="product.categories">-->
<!--					<inertia-link :href="route('category_slug', product.categories[0].slug)">-->
<!--						{{ product.categories[0].name }}-->
<!--					</inertia-link>-->
<!--				</h4>-->
				<div style="margin-bottom: 5px">
					{{ product.price }} руб.
				</div>
				<h5>
					<form v-if="cartCollectionS[product.code]" @submit.prevent="cart">
						<button type="submit" class="btn btn-primary" role="button">В корзинe</button>
					</form>
					<form v-else @submit.prevent="addToCart(categorySlug, product.code)">
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

    import {cartMixin} from "@/mixins";

    export default {

        mixins: [cartMixin],

		props: {
		    product: Object,
			categorySlug: String,
		},



		methods: {
            // getCartForm(event) {
            //     return new FormData(event.currentTarget);
            // }
		},
    }
</script>

<style>

</style>