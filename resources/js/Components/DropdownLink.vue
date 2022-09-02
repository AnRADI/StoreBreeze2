<template>
	<button type="submit" @click="$emit('clicked')" class="dropdown-item px-4" v-if="as == 'button'">
		<slot></slot>
	</button>

	<Link :href="href" class="dropdown-item px-4" v-else>
		<slot></slot>
	</Link>
</template>

<script>
    export default {
        emits: ['clicked'],
        props: ['href', 'as']
    }
</script>
