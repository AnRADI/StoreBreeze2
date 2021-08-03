<template>
	<div>
		<div>{{gg}}</div>
		<input type="checkbox" v-model="gg">
<!--		<input type="checkbox" :checked="gg" @change="gg = $event.target.checked">-->
		<div>{{ searchText }}</div>
		<example-input v-model="searchText" />
	</div>
</template>

<script>
	import ExampleInput from "@/ExampleInput";

    export default {

        data() {
            return {
                gg: true,
                searchText: 'xx'
			}
		},

        components: {
            ExampleInput,
		},

		methods: {
            ros(tt) {
                console.log(tt)
			}
		},

        mounted() {

        },
    }
</script>

<style>

</style>