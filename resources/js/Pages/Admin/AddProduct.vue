<template>
	<admin-layout>

		<head>
			<title> Добавить продукт </title>
		</head>

		<div class="add-product content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"></h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<form @submit.prevent="submitAddProduct" class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-primary">
<!--								<form @submit.prevent="submitAddProduct">-->
<!--									<div class="card-body">-->
<!--										<div class="form-group">-->
<!--											<label for="exampleInputEmail1">Имя</label>-->
<!--											<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Введите имя продукта">-->
<!--										</div>-->
<!--										<div class="form-group">-->
<!--											<label>Описание</label>-->
<!--											<textarea name="description" class="form-control" rows="5" placeholder="Введите описание продукта"></textarea>-->
<!--										</div>-->
<!--										<div class="form-group">-->
<!--											<label>Категория</label>-->
<!--											<select name="category_id" class="custom-select category" style="width: 100%;">-->
<!--												<option selected disabled value="">Выберите категорию</option>-->
<!--												<option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>-->
<!--											</select>-->
<!--										</div>-->
<!--										<div class="form-group">-->
<!--											<label>Цена</label>-->
<!--											<input name="price" type="number" class="price form-control" min="1" max="10000000">-->
<!--										</div>-->
<!--									</div>-->

<!--									<div class="card-footer">-->
<!--										<button type="submit" class="btn btn-primary">Добавить</button>-->
<!--									</div>-->
<!--								</form>-->

								<div class="card-body">
									<success-or-failed :form="form"></success-or-failed>
									<div class="form-group">
										<label for="exampleInputname">Имя</label>
										<input type="text" v-model="form.name" class="form-control" id="exampleInputname" placeholder="Введите имя продукта">
										<div class="errors" v-if="form.errors.name">{{ form.errors.name }}</div>
									</div>
									<div class="form-group">
										<label>Описание</label>
										<textarea v-model="form.description" class="form-control" rows="5" placeholder="Введите описание продукта"></textarea>
									</div>
									<div class="errors" v-if="form.errors.description">{{ form.errors.description }}</div>
									<div class="form-group">
										<label>Категории</label>
<!--											v-model="form.categories_id"-->
										<select multiple="multiple" class="custom-select categories" style="width: 100%;">
<!--												<option disabled value="">Выберите категорию или категории</option>-->
<!--												<option value="8">Ошибочная категория</option>-->
											<option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
										</select>
										<div class="errors" v-if="form.errors.categories_id">{{ form.errors.categories_id }}</div>
									</div>
									<div class="form-group">
										<label>Цена</label>
										<input v-model="form.price" type="number" class="price form-control" step="0.01" min="1" max="1000000000">
										<div class="errors" v-if="form.errors.price">{{ form.errors.price }}</div>
									</div>
								</div>

								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Добавить</button>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-primary">
								<div class="card-body">
									<div class="form-group">

										<label>Изображение</label>

										<div v-if="imageState == 'empty'" class="img-fluid image-preview" @click="clickInput">
											<i class="fa fa-plus text-success"></i>
										</div>
										<img v-else-if="imageState == 'ready'" :src="imageSrc" class="img-fluid image-preview" @click="clickInput" alt="">

										<input class="upload-file d-none" type="file" name="image" accept="image/*" @change="fileInputChange">

										<div class="errors" v-if="form.errors.image">{{ form.errors.image }}</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!-- /.content -->
		</div>

	</admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import SuccessOrFailed from "@/Components/SuccessOrFailed";

    export default {

        components: {
            SuccessOrFailed,
            AdminLayout,
        },

		props: {
            categories: Array,
            flash: Object,
		},

		data() {
            return {
				form: this.$inertia.form({
					name: '',
					description: null,
					categories_id: [],
					price: null,
					image: '',
					_method: 'delete'
				}),
                imageState: 'empty',
                imageSrc: '',
				//resetForm: {}
			}
		},

		mounted() {

			//this.resetForm = JSON.parse(JSON.stringify(this.form));
            this.selectCategories();
        },

		computed: {

            selectClass() {

                return $('.add-product .categories');
			}
		},

		methods: {

            clickInput() {
                document.querySelector('.upload-file').click();
            },

            fileInputChange(event) {

                this.form.image = event.target.files[0];
                const reader = new FileReader();

                reader.onload = e => {

                    this.imageState = 'ready';
                    this.imageSrc = e.target.result;
                };

                reader.readAsDataURL(this.form.image);
            },

            submitAddProduct() {

                this.form.post(route('dashboard.submit.add-product'), {

                    onSuccess: () => {
                		this.form.successfulMessage = this.$page.props.flash.message;
                        this.form.reset();
                        this.selectClass.val(null).trigger('change');
					},
					// onError: () => {
                    //     console.log(this.form.errors);
					// }
				});

				// try {
                //     let response = await axios.post(route('dashboard.submit.add-product'), this.form);
				//
                //     this.form.successfulMessage = response.data;
				//
                //     this.form.wasSuccessful = true;
                //     this.form.hasErrors = false;
                //     this.form.errors = {};
				//
				// 	this.form.reset();
                //     this.selectClass.val(null).trigger('change');
				//
				// } catch (error) {
				//
                //     if(error.response.status == 422) {
				//
                //         console.clear();
				//
                //         this.form.wasSuccessful = false;
                //         this.form.hasErrors = true;
				// 		this.form.errors = error.response.data.errors;
				// 	}
                // }
				//
                // window.scrollTo({
                //     top: 0,
                //     behavior: "smooth"
                // });

				// axios.post(route('dashboard.submit.add-product'), this.form)
                // 	.then(response => {
				//
				// 		this.form.hasErrors = false;
				// 		this.form.wasSuccessful = true;
				// 		this.form.errors = {};
				//
				// 		this.form.reset();
                // 	})
                // 	.catch(error => {
				//
                // 	    if(error.response.status == 422) {
				//
                //             this.form.wasSuccessful = false;
				// 			this.form.hasErrors = true;
				// 			this.form.errors = error.response.data.errors;
                // 		}
                // 	});




				// if(response.status == 200)
				//     this.form = JSON.parse(JSON.stringify(this.resetForm));

			},

            selectCategories() {

                this.selectClass.select2();

                this.selectClass.on('select2:select', (e) => {

                    this.form.categories_id.push(e.params.data.id);
                });

                this.selectClass.on('select2:unselect', (e) => {

                    let index = this.form.categories_id.indexOf(e.params.data.id);

                    this.form.categories_id.splice(index, 1);
                });
			}
		}

    }
</script>

<style lang="scss">


	.add-product {

		.image-preview {
			display: flex;
			align-items: center;
			justify-content: center;
			border: 1px dashed green;
			cursor: pointer;
			height: 365px;
		}

		img.image-preview {
			border: none;
		}

		.price {
			width: auto;
		}

		.errors {
			margin-top: .25rem;
			font-size: .875em;
			color: #dc3545;
		}

	}

</style>