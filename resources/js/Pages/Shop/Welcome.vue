<template>
	<div>

		<Head>
			<title> Главная </title>
		</Head>

		<div class="welcome container">

			<h1>Все товары</h1>

			<Filter :url="route('welcome')"
					:labels="labels"
					:filter-request="filterRequest">
			</Filter>

			<div class="row">
				<product-card
					v-for="product in products.data" :key="product.id"
					:product="product" :category-slug="product.categories[0].slug"
				/>
			</div>

			<pagination class="pg-style" :links="products.links"></pagination>
		</div>

	</div>
</template>

<script>

    import ProductCard from '@/Components/ProductCard';
    import ShopLayout from "@/Layouts/ShopLayout";
    import Pagination from "@/Components/Pagination";
    import Filter from "@/Components/Filter";

    export default {

        layout: ShopLayout,

        components: {
            Filter,
            Pagination,
            ProductCard,
        },

        props: {
            products: [Object, Array],
			labels: Array,
			filterRequest: Object,
        },
    }
</script>

<style lang="scss">


	.welcome {

		// Pagination

		.pg-style {
			display: flex;
			justify-content: center;
			margin-bottom: 1.5rem;
		}
	}

</style>