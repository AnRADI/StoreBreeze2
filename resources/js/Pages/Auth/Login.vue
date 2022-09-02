<template>
	<div>

		<div class="container">
			<div class="row justify-content-center my-5">
				<div class="col-sm-12 col-md-8 col-lg-5 my-5">
					<div class="d-flex justify-content-center mb-3">
						<Link href="/">
							<breeze-application-logo width="82" />
						</Link>
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
									<text-input type="email" v-model="form.email" :label="{ text: 'Email' }" required autofocus />
								</div>
								<div class="form-group">
									<text-input type="password" v-model="form.password" :label="{ text: 'Password' }" required autocomplete="current-password" />
								</div>

								<div class="form-group">
									<breeze-checkbox v-model:checked="form.remember" :label="{ name: 'Remember me', nameLocation: 'right'}" />
								</div>

								<div class="mb-0">
									<div class="d-flex justify-content-end align-items-baseline">
<!--										<Link :href="route('password.request')" class="text-muted mr-3">-->
<!--											Forgot your password?-->
<!--										</Link>-->

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

	</div>
</template>


<script>
    import BreezeButton from '@/Components/Button'
    import ShopLayout from "@/Layouts/ShopLayout"
    import TextInput from '@/Components/Input'
    import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'


    export default {

        layout: ShopLayout,

        components: {
            ShopLayout,
            BreezeButton,
            TextInput,
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
                    remember: false,
                }),

                checkboxInput: {
                    label: {
                        name: 'Remember me',
                        nameLocation: 'right',
                    }
				}
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login.store'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
