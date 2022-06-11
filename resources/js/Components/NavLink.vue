<template>
	<component :is="tag" :href="url" :class="[{ active: isActive }, 'nav-link']">

		<i v-if="navLink.leftIcon" :class="navLink.leftIcon"></i>
		<p>
			{{ navLink.name }}
			<i v-if="navLink.rightIcon" :class="navLink.rightIcon"></i>
		</p>

	</component>
</template>

<script>
    export default {

        props: {
            navLink: Object
		},

		emits: ['active'],

        computed: {

			tag() {
			    return this.navLink.innerNavLinks ? 'a' : 'Link';
			},

			url() {
			    return this.tag === 'Link' ? this.navLink.url : '#';
			},

			isActive() {
			    return this.currentUrl === this.url;
			}
		},

        data() {
            return {
                currentUrl: window.location.protocol +
                    '//' + window.location.host +
                    window.location.pathname,
			}
		},

		methods: {

            sendActive() {
                if(this.isActive)
                    this.$emit('active', this.isActive);
			}
		},

		mounted() {
            this.sendActive();
        }

    }
</script>

<style lang="scss">

	.sidebar-menu {

		.menu-open > .nav-link {
			background-color: rgba(255, 255, 255, 0.1) !important;
			color: #fff !important;
		}
	}

</style>