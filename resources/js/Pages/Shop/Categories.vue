<template>
	<main-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Категории </title>
		</head>

		<div class="container">
			<div class="starter-template">
				<div v-for="category in categories" :key="category.id" class="panel">
					<inertia-link :href="route('category', category.slug)">
						<img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
						<h2>{{ category.name }}</h2>
					</inertia-link>
					<p>
						{{ category.description }}
					</p>
				</div>
			</div>
		</div>

	</main-layout>
</template>

<script>

    import MainLayout from "@/Layouts/MainLayout";
    import {mapState} from "vuex";

    export default {

        components: {
            MainLayout
		},

        props: {
		    categories: Array,
			canLogin: Boolean,
			canRegister: Boolean,
		},

		computed: {
            ...mapState([
                'cartCollectionS'
            ]),
		}

    }
</script>

<style>

</style>