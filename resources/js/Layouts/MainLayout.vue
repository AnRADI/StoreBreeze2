<template>
	<div>
		<div class="container-fluid p-4">
			<div class="col-12">
				<div v-if="canLogin" class="d-flex justify-content-end">
					<div>
						<inertia-link v-if="$page.props.auth.user" href="/dashboard" class="text-muted">
							Dashboard
						</inertia-link>

						<template v-else>
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
							</ul>
						</template>
					</div>
				</div>
			</div>
		</div>

		<slot></slot>
	</div>
</template>

<script>
    import 	{mapMutations} from 'vuex'
    import Cart from "@/Pages/Shop/Cart";

    export default {

        components: {
            Cart
		},

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
		},

		methods: {

            ...mapMutations([
                'cartM'
			])
		}

    }
</script>

<style>

</style>