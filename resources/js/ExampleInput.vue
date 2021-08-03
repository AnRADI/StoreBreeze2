<template>
	<input type="text" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
</template>

<script>
    export default {
        emits: ['update:modelValue'],
		props: ['modelValue'],

    }
</script>

<style>

</style>