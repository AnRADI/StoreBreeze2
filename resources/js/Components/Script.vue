<template>
	<div id="insertHere"></div>
</template>

<script>
    export default {

		props: {
		    src: String,
			defer: String,
			async: String,
		},

		mounted() {

            let script = document.createElement('script');
			let insertHere = document.querySelector('#insertHere');

			// if(this.src) {

			script.src = this.src;

			if (this.async == '') script.async = true;
			else script.async = false;

			if (this.defer == '') script.defer = true;
            // }
			// else {
			// 	//console.log(this.$slots.default()[0].children)
            //     script.src = '';
			// 	script.innerHTML = insertHere.innerHTML;
			// }

            insertHere.after(script);
            insertHere.remove();
		}

    }
</script>