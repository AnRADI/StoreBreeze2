<template>
	<div :class="$attrs.class" v-for="errorKey in arrayErrorKeys">{{ errors[errorKey] }}</div>
</template>

<script>
    export default {

        inheritAttrs: false,

		props: {
		    arrayName: String,
			errors: Object
		},

		data() {
		    return {
		        arrayErrorKeys: []
			}
		},

        watch: {

            errors: {
                handler: function () {

                    let arrayKeys = Object.keys(this.errors);

                    if(arrayKeys.length) {

                        this.arrayErrorKeys =
                            arrayKeys.filter((e) => e.includes(this.arrayName));
                    }
				},
                deep: true
            },
        },
    }
</script>


<style lang="scss">

	.array-errors {

	}

</style>