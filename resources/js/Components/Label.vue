<template>
    <label>
        <template v-if="value">{{ value }}</template>
        <template v-else><slot></slot></template>
    </label>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
