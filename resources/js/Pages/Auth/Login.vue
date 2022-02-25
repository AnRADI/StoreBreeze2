<template>
	<shop-layout>

		<div class="container">
			<div class="row justify-content-center my-5">
				<div class="col-sm-12 col-md-8 col-lg-5 my-5">
					<div class="d-flex justify-content-center mb-3">
						<inertia-link href="/">
							<breeze-application-logo width="82" />
						</inertia-link>
					</div>
					<div class="card shadow-sm px-3">
						<div class="card-body">

							<breeze-validation-errors class="mb-3" />

							<div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
								{{ status }}
							</div>

							<div v-if="flash.message419">{{ flash.message419 }}</div>

							<form @submit.prevent="submit">
								<div class="form-group">
									<breeze-label for="email" value="Email" />
									<breeze-input id="email" type="email" v-model="form.email" required autofocus />
									<div >{{form.errors}}</div>
								</div>

								<div class="form-group">
									<breeze-label for="password" value="Password" />
									<breeze-input id="password" type="password" v-model="form.password" required autocomplete="current-password" />
								</div>

								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<breeze-checkbox id="remember_me" v-model:checked="form.remember" />
										<label class="custom-control-label" for="remember_me">
											Remember Me
										</label>
									</div>
								</div>

								<div class="mb-0">
									<div class="d-flex justify-content-end align-items-baseline">
<!--										<inertia-link :href="route('password.request')" class="text-muted mr-3">-->
<!--											Forgot your password?-->
<!--										</inertia-link>-->

										<breeze-button class="ml-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
											Log in
										</breeze-button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</shop-layout>
</template>


<script>
    import BreezeButton from '@/Components/Button'
    import ShopLayout from "@/Layouts/ShopLayout"
    import BreezeInput from '@/Components/Input'
    import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'


    export default {


        components: {
            ShopLayout,
            BreezeButton,
            BreezeInput,
            BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors,
            BreezeApplicationLogo,
        },

        props: {
            status: String,
			flash: Object,
        },

        data() {
            return {

                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
