<template>
	<div>

		<Head>
			<title> Категории </title>
		</Head>

		<div class="container">
			<div class="starter-template">

				<div v-for="category in categories" :key="category.id" class="panel">
					<Link :href="route('categories.category.show', category.slug)">
						<!--					<img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">-->
						<h2>{{ category.name }}</h2>
					</Link>
					<p>
						{{ category.description }}
					</p>
				</div>
				<div v-for="cat in totalCats" class="d-flex">
					<div>{{cat.name}}</div>
					<img :src="cat.image" alt="">
					<div>{{cat.character}}</div>
				</div>
			</div>
		</div>

	</div>
</template>

<script>

    import ShopLayout from "@/Layouts/ShopLayout";
    import debounce from 'lodash/debounce'

    export default {

        layout: ShopLayout,

        props: {
		    categories: Array,
            cats: [Array, Object],
		},

		data() {
            return {
                totalCats: this.cats.data,
				onceScrollCats: false,
                catForm: this.$inertia.form({
					//offset: 0,
				}),
				debounceFunc: debounce(this.scrollCats, 400),
			}
		},

		methods: {

            scrollCats() {

                let scrollTop = document.documentElement.scrollTop;
				let viewportHeight = window.innerHeight;
				let totalHeight = document.documentElement.offsetHeight;

                let atTheBottom =
					(scrollTop + viewportHeight) >= totalHeight;


                if(atTheBottom) {

                    if(this.onceScrollCats) return;
                    this.onceScrollCats = true;

                    //this.catForm.offset = this.totalCats.length;

                    this.catForm.get(this.cats.next_page_url, {

                        preserveScroll: true,
                        preserveState: true,
						only: ['cats'],
						onSuccess:() => {
                            this.totalCats = this.totalCats.concat(this.cats.data);
                            this.onceScrollCats = false;
						}
                    });


                }
			}
		},

        created() {
			document.addEventListener('scroll', this.debounceFunc);
        },

        beforeUnmount() {
            document.removeEventListener('scroll', this.debounceFunc);
		}

    }
</script>


<!--<style lang="scss" src="resources/sass/_reset.scss"></style>-->

<style lang="scss">

</style>