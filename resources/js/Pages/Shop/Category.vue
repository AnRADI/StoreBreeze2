<template>
	<div>

		<Head>
			<title> Категория </title>
		</Head>

		<div class="category container">

			<div>
				<h1> {{ category.name }} </h1>
				<p> {{ category.description }} </p>

				<Filter :url="route('category_slug', category.slug)"
						:labels="labels"
						:filter-request="filterRequest">
				</Filter>

				<div class="row">
					<product-card
						v-for="product in category.products.data" :key="product.id"
						:product="product" :category-slug="category.slug"
					/>
				</div>
			</div>

			<pagination class="pg-style" :links="category.products.links"></pagination>
		</div>

	</div>
</template>

<script>

    import ProductCard from "@/Components/ProductCard";
    import ShopLayout from "@/Layouts/ShopLayout";
    import Pagination from "@/Components/Pagination";
    import Filter from "@/Components/Filter";

    export default {

        layout: ShopLayout,

        components: {
            Filter,
            ProductCard,
            Pagination,
        },

        props: {
            category: Object,
            labels: Array,
            filterRequest: Object,
        },

    }
</script>


<style lang="scss">

	.category {

		// Pagination

		.pg-style {
			display: flex;
			justify-content: center;
			margin-bottom: 1.5rem;
		}

		p {
			margin-bottom: 0;
		}
	}

</style>