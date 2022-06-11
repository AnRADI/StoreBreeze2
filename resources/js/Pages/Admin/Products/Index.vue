<template>
	<admin-layout>

		<Head>
			<title> Products </title>
		</Head>

		<div class="all-products content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<success-or-failed></success-or-failed>
							<h1 class="m-0">Все продукты</h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card">
						<div class="card-body p-0">
							<table class="table table-striped projects">
								<thead>
									<tr>
										<th>
											Код
										</th>
										<th style="width: 15%">
											Название
										</th>
										<th>
											Цена
										</th>
										<th>
											Категории
										</th>
										<th style="width: 10%">
											Изображение
										</th>
										<th>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="product in products.data" :key="product.id">
										<td>
											{{ product.code }}
										</td>
										<td>
											{{ product.name }}
										</td>
										<td>
											{{ product.price }}
										</td>
										<td>
											<template v-for="category in product.categories" :key="category.id">
												{{ category.name }} <br>
											</template>
										</td>
										<td>
											<img class="img-size" :src="product.image">
										</td>
										<td class="project-actions text-right">
											<Link class="btn btn-info btn-sm" :href="route('dashboard.products.product_code.edit', product.code)">
												<i class="fas fa-pencil-alt">
												</i>
												Редактировать
											</Link>
											<a class="btn btn-danger btn-sm" href="#">
												<i class="fas fa-trash">
												</i>
												Удалить
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<pagination class="pg-style" :links="products.links"></pagination>
				</div>
			</div>
		</div>
	</admin-layout>
</template>

<script>

    import AdminLayout from "@/Layouts/AdminLayout";
    import Pagination from "@/Components/Pagination";
    import SuccessOrFailed from "@/Components/SuccessOrFailed";

    export default {



        components: {
			Pagination,
			SuccessOrFailed,
			AdminLayout
        },

		props: {
            products: [Array, Object]
		},

    }
</script>

<style lang="scss">

	.all-products {

		.project-actions a+a {
			margin-left: 5px;
		}

		.img-size {
			width: 100px;
			height: 100px;
		}

		.pg-style {
			margin-top: 1.5rem;
		}
	}

</style>