<template>
	<div class="pg" v-if="links.length > 3">
		<div class="d-flex">
			<template v-for="(link, key) in links">
				<div v-if="link.url === null" class="pg-arrow" :key="key" v-html="link.label"></div>
				<Link v-else class="pg-link" :class="{ 'active': link.active }" :key="`link-${key}`" :href="link.url" v-html="link.label"></Link>
			</template>
		</div>
	</div>
</template>

<script>

    export default {

        props: {
            links: Array,
        },
    }
</script>

<style lang="scss">

	.pg {

		.pg-link, .pg-arrow {
			padding: .75rem 1rem;
			margin-right: .25rem;
			font-size: .875rem;
			line-height: 1rem;
			border: 1px solid #e2e8f0;
			border-radius: .25rem;
			color: rgb(51, 65, 85);
		}

		.pg-link:hover, .active {
			background-color: rgba(255,255,255, 1);
			text-decoration: none;
		}

		.pg-arrow {
			color: rgba(148,163,184, 1);
		}
	}

</style>