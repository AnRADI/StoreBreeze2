<template>
	<admin-layout>

		<head>
			<title> Products </title>
		</head>


	</admin-layout>
</template>

<script>

    import AdminLayout from "@/Layouts/AdminLayout";

    export default {

        components: {
            AdminLayout
        },

		props: {
            products: Array,
		}

    }
</script>

<style>

</style>