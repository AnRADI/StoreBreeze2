<template>
	<div :class="$attrs.class">
		<div v-if="paginate" class="d-flex">

			<template v-for="(link, key) in products.links">
				<div v-if="link.url === null" class="pagination-arrow" :key="key" v-html="link.label"></div>
				<Link v-else :class="['pagination-link', { 'active': link.active }]" :key="`link-${key}`" :href="link.url" v-html="link.label" preserve-state></Link>
			</template>

		</div>
		<div v-else-if="simplePaginate" class="d-flex">

			<div v-if="products.prev_page_url === null" class="pagination-arrow">&laquo; Previous</div>
			<Link v-else class="pagination-link" :href="products.prev_page_url" preserve-state>&laquo; Previous</Link>
			<div v-if="products.next_page_url === null" class="pagination-arrow">Next &raquo;</div>
			<Link v-else class="pagination-link" :href="products.next_page_url" preserve-state>Next &raquo;</Link>

		</div>
	</div>
</template>

<script>

    export default {

        inheritAttrs: false,

        props: {
            products: [Array, Object]
        },

		computed: {

			paginate() {
			    return this.products.links &&
					this.products.links.length > 3;
			},

			simplePaginate() {
			    return this.products.links === undefined;
			}
		}
    }
</script>

<style lang="scss">

	.pagination {

		.pagination-link, .pagination-arrow {
			padding: .75rem 1rem;
			margin-right: .25rem;
			font-size: .875rem;
			line-height: 1rem;
			border: 1px solid #e2e8f0;
			border-radius: .25rem;
			color: rgb(51, 65, 85);
		}

		.pagination-link:hover, .active {
			background-color: rgba(255,255,255, 1);
			text-decoration: none;
		}

		.pagination-arrow {
			color: rgba(148,163,184, 1);
		}
	}

</style>