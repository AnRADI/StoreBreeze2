<template>
	<div v-if="form.hasErrors" class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="Close">×</button>
		<template v-if="numberFormErrors == 1">Есть ошибка формы.</template>
		<template v-else>Есть ошибки формы.</template>
	</div>
	<div v-if="form.wasSuccessful" class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="Close">×</button>
		{{ form.successfulMessage }}
	</div>
</template>

<script>

    export default {

		props: {
		    form: Object,
		},

		computed: {

            numberFormErrors() {
                return Object.keys(this.form.errors).length;
            },
		},
    }
</script>