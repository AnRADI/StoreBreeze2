<template>
	<div style="text-align: right" @click="revertStr">{{line}}</div>
</template>

<script>
    export default {
        data() {
            return {
                line: 'stroka'
			}
		},

		methods: {
            revertStr() {
                this.line = this.line.split('').reverse().join('');
			}
		}
    }
</script>

<style lang="scss">

</style>