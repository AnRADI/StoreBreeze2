<template>
	<shop-layout>

		<head>
			<title> Главная </title>
		</head>

<!--		<form class="welcome cart-form">-->
<!--			<button class="cart-button-minus" type="button">-</button>-->
<!--			<input type="number" v-model.number="form.top" min="1" max="9000">-->
<!--			<button class="cart-button-plus" type="button">+</button>-->
<!--		</form>-->
		<div class="welcome container">
			<h1>Все товары</h1>
			<div class="row">
				<product-card
					v-for="product in products"
					:product="product"
					:category-slug="product.categories[0].slug"
					:key="product.id"
				/>
			</div>
		</div>

	</shop-layout>
</template>

<script>
    import ProductCard from '@/Components/ProductCard'
    import Script from "@/Components/Script";
    import ShopLayout from "@/Layouts/ShopLayout";



    export default {

        components: {
            ShopLayout,
            ProductCard,
            Script
        },


        data() {
            return {
				// form: this.$inertia.form({
				// 	top: 1
				// })
			}
		},



        props: {
            products: Array,
            //top: Number,

        },
    }
</script>

<style lang="scss">

	.welcome {

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

	}

</style>