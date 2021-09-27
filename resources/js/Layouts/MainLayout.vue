<template>
	<div>
		<div class="container pt-4">
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
					<li>
						<a href="/cart" @click.stop.prevent="cartM" class="ml-4 text-muted">
							Корзина
						</a>
						<cart></cart>
					</li>
					<li v-if="$page.props.auth.user">
						<form @submit.prevent="logOutForm.post(route('logout'))" class="ml-4">
							<button class="log-out-button text-muted" type="submit">Log Out</button>
						</form>
					</li>
					<template v-else>
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
    import 	{mapMutations} from 'vuex'
    import Cart from "@/Pages/Shop/Cart";
    import Script from "@/Components/Script";
    require('bootstrap');

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
            }
        },

		methods: {
            ...mapMutations([
                'cartM'
			])
		}

    }
</script>

<style lang="scss">

	@import '~bootstrap/scss/bootstrap';

	.log-out-button {
		border: 0;
		background: transparent;
		padding: 0;
	}

</style>