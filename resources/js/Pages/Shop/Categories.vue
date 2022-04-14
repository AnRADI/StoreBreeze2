<template>
	<head>
		<title> Категории </title>
	</head>

	<div class="container">
		<div class="starter-template">
			<div v-for="category in categories" :key="category.id" class="panel">
				<inertia-link :href="route('category_slug', category.slug)">
					<img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
					<h2>{{ category.name }}</h2>
				</inertia-link>
				<p>
					{{ category.description }}
				</p>
			</div>
		</div>
	</div>
</template>

<script>

    import ShopLayout from "@/Layouts/ShopLayout";


    export default {

        layout: ShopLayout,

        props: {
		    categories: Array,
		},

    }
</script>


<!--<style lang="scss" src="resources/sass/_reset.scss"></style>-->

<style lang="scss">

</style>