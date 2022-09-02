<template>
	<div class="checkbox">

		<input type="checkbox"
			   :id="id" class="custom-checkbox"
			   :value="value" :checked="checked" @change="sendResult">
		<label :class="checkbox.labelNameLocation" :for="id">
			{{ checkbox.labelName }}
		</label>

	</div>
</template>

<script>

    let id = 0;

    export default {

        emits: ['update:checked'],

        props: {
            checked: [Boolean, Number],
            value: Number,
			checkbox: Object
        },

        data() {
            id += 1;

			return {
                id: `checkbox-${id}`
			}
		},

		methods: {

            sendResult(e) {

                let result;

                if(this.value) result = e.target.checked ? e.target.value : null;
                else result = e.target.checked;

                this.$emit('update:checked', result);
			}
		}
    }
</script>

<style lang="scss">

	.checkbox {

		.custom-checkbox {
			position: absolute;
			z-index: -1;
			opacity: 0;
		}

		.custom-checkbox+label {
			display: inline-flex;
			align-items: center;
			user-select: none;
			cursor: pointer;
		}

		.custom-checkbox+.left::after, .custom-checkbox+.right::before {
			content: '';
			display: inline-block;
			width: 1rem;
			height: 1rem;
			border: 1px solid #adb5bd;
			border-radius: 0.25rem;
			margin-right: 0.5rem;
			background-repeat: no-repeat;
			background-position: center center;
			background-size: 60% 60%;
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
		}

		.custom-checkbox+.left::after {
			margin-left: 0.5rem;
		}

		.custom-checkbox+.right::before {
			margin-right: 0.5rem;
		}

		.custom-checkbox:checked+.left::after, .custom-checkbox:checked+.right::before {
			border-color: #0b76ef;
			background-color: #0b76ef;
		}

		label:not(.form-check-label):not(.custom-file-label) {
			font-weight: 400;
		}
	}
</style>