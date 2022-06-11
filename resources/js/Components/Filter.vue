<template>
	<form class="filter row">

		<div class="form-group">
			<text-input class="text-input" v-model="price.price_from" v-bind="textInput1" />
			<text-input class="text-input" v-model="price.price_to" v-bind="textInput2" />
			<button @click.prevent="storeFilter" class="btn btn-primary button-ok">OK</button>
		</div>
		<div class="form-group">
			<checkbox-input v-for="(label, index) in labels" :key="label.id"
							:value="label.name" v-model="filterForm.label_names"
							:checkbox-input="checkboxInputs[index]"
							class="checkbox-input"
			/>
			<div class="errors" v-if="filterForm.errors.label_names">{{ filterForm.errors.label_names }}</div>
		</div>

	</form>
</template>

<script>

    import CheckboxInput from '@/Components/Checkbox';
    import TextInput from "@/Components/Input";

    export default {

        components: {
            CheckboxInput,
            TextInput
        },

        props: {
            url: String,
            labels: Array,
            filterRequest: Object,
        },

        data() {
            return {

                // form data
                filterForm: this.$inertia.form({
                    label_names: this.filterRequest.label_names ?? [],
                }),

                price: {
                    price_from: this.filterRequest.price_from,
                    price_to: this.filterRequest.price_to
                },
                // ---------


				textInput1: {
					label: {
						text: 'Цена от'
					},
                    input: {
                        class: 'input'
                    }
				},

                textInput2: {
                    label: {
                        text: 'до'
                    },
                    input: {
                        class: 'input'
                    }
                },


                checkboxInputs: [
                    ...this.labels.map((v, i) => ({
                        label: {
                            name: this.labels[i].name,
                            nameLocation: 'right',
                        }
                    }))
                ]
            }
        },

        mounted() {

            // errors(for method get)
            this.filterForm.errors = this.$page.props.errors;
        },

        methods: {

            storeFilter() {

                this.filterForm = this.filterForm.transform((data) => ({
                    ...data,
                    ...this.price
                }));

                this.filterForm.get(this.url, {

                    preserveScroll: true,
                });
            },
        },

        computed: {
            watchFilterForm() {
                return this.filterForm.data();
            },
        },

        watch: {
            watchFilterForm: {
                handler: 'storeFilter',
                deep: true
            },
        }
    }
</script>

<style lang="scss">

	.filter {

		padding: 0 15px;
		align-items: center;

		.checkbox-input {
			display: inline-block;
		}

		.checkbox-input+.checkbox-input {
			margin-left: 1.5rem;
		}

		.text-input+.text-input {
			margin-left: 0.5rem;
		}

		.form-group {
			display: flex;
			align-items: center;
			margin-top: 1rem;
		}

		.form-group+.form-group {
			margin-left: 1.5rem;
		}

		.button-ok {
			margin-left: 1rem;
			font-size: 0.8rem;
		}

		.input {
			display: inline-block;
			width: 100px;
			margin-left: 0.5rem;
			height: 2rem;
		}
	}
</style>