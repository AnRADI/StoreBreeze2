<template>
	<div>

		<Head>
			<title> Категории </title>
		</Head>

		<div class="container">
			<div class="starter-template">
				<div v-for="category in categories" :key="category.id" class="panel">
					<Link :href="route('category_slug', category.slug)">
						<!--					<img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">-->
						<h2>{{ category.name }}</h2>
					</Link>
					<p>
						{{ category.description }}
					</p>
				</div>
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