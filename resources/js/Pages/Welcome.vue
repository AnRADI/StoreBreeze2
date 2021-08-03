<template>
	<main-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Главная </title>
		</head>

		<form @submit.prevent="form.post(route('submit.welcome'))">
			<input type="number" v-model.number="form.top" min="1" max="9000">
			<button type="submit">Отправить</button>
		</form>
		<div>{{form.top}}</div>
		<div>{{top}}</div>

		<div class="container">
			<h1>Все товары</h1>
			<div class="row">
				<product-card v-for="product in products" :product="product" :key="product.id" />
			</div>
		</div>

	</main-layout>
</template>

<script>
    import ProductCard from '@/Components/ProductCard'
    import MainLayout from "@/Layouts/MainLayout";
    import {mapMutations, mapState} from "vuex";

    export default {

        data() {
            return {

				form: this.$inertia.form({
					top: 1
				})
			}
		},

        components: {
            MainLayout,
            ProductCard,
		},

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
			products: Array,
			cartCollection: Object,
			top: Number
        },

        methods: {
            ...mapMutations([

                'cartCollectionM'
            ]),
        },

        computed: {
            ...mapState([
                'cartCollectionS',
            ]),
        },

        watch: {

            cartCollection: {

                handler(value) {

					if(Object.keys(value) != 0 && Object.keys(this.cartCollectionS) == 0) {

                        this.cartCollectionM(value);
					}
                },
                immediate: true
            }

        }
    }
</script>