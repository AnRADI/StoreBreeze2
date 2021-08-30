<template>
	<main-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Dashboard </title>
		</head>

		<div class="container pt-5">
			<form @submit.prevent="logOutForm.post(route('logout'))">
				<button class="log-out-button" type="submit">Log Out</button>
			</form>
		</div>

	</main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";

    export default {

        components: {
            MainLayout
        },

		data() {
          	return {

          	    logOutForm: this.$inertia.form(),
			}
		},

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        },
    }
</script>

<style>
	.log-out-button {
		border: 0;
		background: transparent;
		padding: 0;
		color: black;
	}
</style>