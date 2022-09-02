<template>
	<form class="filter row">

		<div class="form-group">
			<text-input class="text-input" v-model="price.price_from" :label="{ text: 'Цена от' }" :input="{ class: 'input' }" :error="filterForm.errors.price_from" />
			<text-input class="text-input" v-model="price.price_to" :label="{ text: 'до' }" :input="{ class: 'input' }" />
			<button @click.prevent="storeFilter" class="btn btn-primary button-ok">OK</button>
		</div>
		<div class="form-group">
			<checkbox-input v-for="(label, i) in labels" :key="label.id"
							:value="label.id" v-model="filterForm.label_ids"
							:label="{ name: this.labels[i].name, nameLocation: 'right'}"
							class="checkbox-input"
			/>
			<array-errors class="array-errors errors" array-name="label_ids" :errors="filterForm.errors" />
		</div>

	</form>
</template>

<script>

    import CheckboxInput from '@/Components/Checkbox';
    import TextInput from "@/Components/Input";
    import ArrayErrors from "@/Components/ArrayErrors";

    export default {

        components: {
            CheckboxInput,
            TextInput,
			ArrayErrors
        },

        props: {
            url: String,
            labels: Array,
        },

        data() {
            return {

                // form data
                filterForm: this.$inertia.form({
                    label_ids: [],
                }),

                price: {
                    price_from: undefined,
                    price_to: undefined
                },
                // ---------
            }
        },

        methods: {

            storeFilter() {

                this.filterForm = this.filterForm.transform((data) => ({
                    ...data,
                    ...this.price
                }));

                this.filterForm.get(this.url, {

					preserveState: true,
                    preserveScroll: true,
                });
            },
        },


        watch: {
            'filterForm.label_ids': {
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

		.errors {
			margin-top: .25rem;
			font-size: .875em;
			color: #dc3545;
		}
	}
</style>