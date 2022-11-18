<template>
	<div>
		<Head>
			<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
		</Head>
		<div v-if="currentRouteName != 'login'" class="shop-layout container pt-4">
			<div class="d-flex justify-content-end">
				<ul class="d-flex" style="list-style: none">
					<li>
						<Link :href="route('welcome')" class="ml-4 text-muted">
							Главная
						</Link>
					</li>
					<li>
						<Link :href="route('categories')" class="ml-4 text-muted">
							Категории
						</Link>
					</li>
					<li>
						<a href="#" @click.prevent="cart" class="ml-4 text-muted">Корзина</a>
						<cart></cart>
					</li>
					<li v-if="can('logout')">
						<a @click.prevent="logOutForm.post(route('logout.store'))" href="#" class="ml-4 text-muted">
							Log Out
						</a>
					</li>
					<template v-if="guest">
						<li>
							<Link :href="route('login.create')" class="ml-4 text-muted">
								Log in
							</Link>
						</li>
						<li>
							<Link :href="route('register.create')" class="ml-4 text-muted">
								Register
							</Link>
						</li>
					</template>
				</ul>
			</div>
		</div>
		<slot></slot>
	</div>
</template>

<script>

    require('bootstrap');

    import Cart from "@/Pages/Shop/Cart";
    import Script from "@/Components/Script";

    export default {

        components: {
            Script,
            Cart
		},



        computed: {

            guest() {
                return this.$page.props.guest;
			},

            currentRouteName() {
                return this.$page.props.currentRouteName;
			}
		},

        data() {
            return {
                logOutForm: this.$inertia.form(),
            }
        },

        methods: {

			cart() {

                this.cartM();
			},

		}

    }
</script>


<style lang="scss">

	@import '~bootstrap/scss/bootstrap';

	@import "resources/sass/Plugins/reset";


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
