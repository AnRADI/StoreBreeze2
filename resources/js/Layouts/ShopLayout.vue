<template>
	<div>
		<div class="shop-layout container pt-4">
			<div v-if="canLogin" class="d-flex justify-content-end">
				<ul class="d-flex" style="list-style: none">
					<li>
						<inertia-link :href="route('welcome')" class="ml-4 text-muted">
							Главная
						</inertia-link>
					</li>
					<li>
						<inertia-link :href="route('categories')" class="ml-4 text-muted">
							Категории
						</inertia-link>
					</li>
					<li class="dropdown">
<!--						<form @submit.prevent="languageForm.post(route('language.locale', 'ru'))" class="ml-4 text-muted">-->
<!--							<button :href="route('language.locale', 'ru')" class="submit-cart text-muted" type="submit">Переключить язык</button>-->
<!--						</form>-->
<!--						<a class="dropdown-toggle ml-4 text-muted" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--							Переключить язык-->
<!--						</a>-->
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<inertia-link :href="route('language.locale', 'en')" class="dropdown-item text-muted" href="#">en</inertia-link>
							<inertia-link :href="route('language.locale', 'es')" class="dropdown-item text-muted" href="#">es</inertia-link>
							<inertia-link :href="route('language.locale', 'ru')" class="dropdown-item text-muted" href="#">ru</inertia-link>
						</div>
					</li>
					<li>
						<a href="#" @click.prevent="cartM" class="ml-4 text-muted">Корзина</a>
						<cart></cart>
					</li>
					<li v-if="can('logout')"> <!-- user -->
						<form @submit.prevent="logOutForm.post(route('logout'))" class="ml-4">
							<button class="submit-log-out text-muted" type="submit">Log Out</button>
						</form>
					</li>
					<template v-if="can('login and register')"> <!-- guest -->
						<li>
							<inertia-link :href="route('login')" class="ml-4 text-muted">
								Log in
							</inertia-link>
						</li>
						<li>
							<inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-muted">
								Register
							</inertia-link>
						</li>
					</template>
				</ul>
			</div>
		</div>

		<slot></slot>
	</div>
</template>

<script>

    import Cart from "@/Pages/Shop/Cart";
    import Script from "@/Components/Script";

    export default {

        components: {
            Script,
            Cart
		},

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
		},

        data() {
            return {
                logOutForm: this.$inertia.form(),
                languageForm: this.$inertia.form(),
            }
        },

        mounted() {

            this.getCart();
        },

		methods: {

            getCart() {

                let cartCollection = this.$page.props.cartCollection;

                if(Object.keys(cartCollection).length != 0 && Object.keys(this.cartCollectionS).length == 0) {

                    this.cartCollectionM(cartCollection);
                }
			}
		}

    }
</script>


<style lang="scss">

	@import '~bootstrap/scss/bootstrap';

	.shop-layout {

		.dropdown-toggle:hover {
			text-decoration: none;
		}

		.dropdown-item.active, .dropdown-item:active {
			background: transparent;
		}

		.submit-cart:hover, .submit-log-out:hover {
			text-decoration: underline;
		}

	}

</style>