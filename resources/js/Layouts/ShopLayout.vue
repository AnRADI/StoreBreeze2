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
<!--					<li class="dropdown">-->

<!--						<a class="dropdown-toggle ml-4 text-muted" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--							Переключить язык-->
<!--						</a>-->
<!--						<div @click.prevent="language" class="dropdown-menu" aria-labelledby="dropdownMenuLink">-->
<!--							<a class="dropdown-item text-muted" href="#">en</a>-->
<!--							<a class="dropdown-item text-muted" href="#">ru</a>-->
<!--						</div>-->
<!--&lt;!&ndash;						<form @submit.prevent="languageForm.patch(route('language.languageLocale', 'ru'))">&ndash;&gt;-->
<!--&lt;!&ndash;							<input ref="languageLocale" type="submit">&ndash;&gt;-->
<!--&lt;!&ndash;						</form>&ndash;&gt;-->
<!--					</li>-->
<!--					<li>{{ __('Product added') }}</li>-->

					<li>
						<a href="#" @click.prevent="cart" class="ml-4 text-muted">Корзина</a>
						<cart></cart>
					</li>
					<li v-if="can('logout')"> <!-- user -->
						<a @click.prevent="logOutForm.post(route('logout.store'))" href="#" class="ml-4 text-muted">
							Log Out
						</a>
<!--						<form @submit.prevent="logOutForm.post(route('logout'))" class="ml-4">-->
<!--							<button class="submit-log-out text-muted" type="submit">Log Out</button>-->
<!--						</form>-->
					</li>
					<template v-if="can('login and register')"> <!-- guest -->
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

            currentRouteName() {
                return this.$page.props.currentRouteName;
			}
		},

        data() {
            return {
                logOutForm: this.$inertia.form(),
                languageForm: this.$inertia.form(),
            }
        },

        methods: {

			cart() {

                this.cartM();
			},

			language(e) {

                this.languageForm.patch(route('language.language_locale', e.target.innerText));
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