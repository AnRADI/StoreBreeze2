<template>
	<div>

		<Head>
			<title> Главная </title>
		</Head>

		<div class="welcome container">

			<h1>Все товары</h1>

			<Filter :url="route('welcome')" :labels="labels"></Filter>

			<div class="row">
				<product-card
					v-for="product in products.data" :key="product.id"
					:product="product" :category-slug="product.categories[0].slug"
				/>
			</div>

			<pagination class="pagination" :products="products"></pagination>
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

		mounted() {
			//let ll = ['dobi', 'koBi', 'milo'];
            // ll.filter((e) => /bi/i.test(e))
			//console.log("my@gmail.com @ prackikanrad@gmail.com.ua".match(/([-\w]+\.)+(com)/g));
        },

        props: {
            products: [Object, Array],
			labels: Array,
            requestItems: Object,
        },
    }
</script>

<style lang="scss">


	.welcome {

		// Pagination

		.pagination {
			justify-content: center;
			margin-bottom: 1.5rem;
		}
	}

</style>