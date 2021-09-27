<template>
	<main-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Главная </title>
		</head>
		<form class="cart-form">
			<button class="cart-button-minus" type="button">-</button>
			<input @input="mm" type="number" v-model.number="form.top" min="1" max="9000">
			<button class="cart-button-plus" type="button">+</button>
		</form>
		<div>{{form.top}}</div>
		<div>{{top}}</div>

		<div class="container">
			<h1>Все товары</h1>
			<div class="row">
				<product-card v-for="product in products" :product="product" :cart-collection-s="cartCollectionS" :key="product.id" />
			</div>
		</div>

	</main-layout>
</template>

<script>
    import ProductCard from '@/Components/ProductCard'
    import MainLayout from "@/Layouts/MainLayout";
    import {mapMutations, mapState} from "vuex";
    import Script from "@/Components/Script";

    export default {

        data() {
            return {
				form: this.$inertia.form({
					top: 1
				}),
			}
		},

        components: {
            MainLayout,
            ProductCard,
			Script
		},

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
			products: Array,
			cartCollection: [Object, Array],
			top: Number,
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

                    this.cartCollectionM(value);
					// if(Object.keys(this.cartCollection).length != 0 && Object.keys(this.cartCollectionS).length == 0) {
					//
                    //     this.cartCollectionM(value);
					// }
                },
                immediate: true
            }

        }
    }
</script>

<style lang="scss">


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
	}
	.cart-form input[type="number"]::-webkit-outer-spin-button,
	.cart-form input[type="number"]::-webkit-inner-spin-button {
		-webkit-appearance: none;
	}
	.cart-button-minus {
		position: absolute;
		top: 1px;
		left: 1px;
		bottom: 1px;
		width: 20px;
		padding: 0;
		display: block;
		text-align: center;
		border: none;
		border-right: 1px solid #ddd;
		font-size: 16px;
		font-weight: 600;
	}
	.cart-button-plus {
		position: absolute;
		top: 1px;
		right: 1px;
		bottom: 1px;
		width: 20px;
		padding: 0;
		display: block;
		text-align: center;
		border: none;
		border-left: 1px solid #ddd;
		font-size: 16px;
		font-weight: 600;
	}

</style>