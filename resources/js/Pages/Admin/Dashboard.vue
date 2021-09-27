<template>
	<admin-layout>

		<head>
			<title> Dashboard </title>
		</head>

		<p>
			<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				Ссылка с атрибутом href
			</a>
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				Кнопка с атрибутом data-target
			</button>
		</p>
		<div class="collapse" id="collapseExample">
			<div class="card card-body">
				Некоторый заполнитель для компонента сворачивания. Эта панель по умолчанию скрыта, но открывается, когда пользователь активирует соответствующий триггер.
			</div>
		</div>

		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Главная</h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<!-- Small boxes (Stat box) -->
					<div class="row">
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-info">
								<div class="inner">
									<h3>{{ categoriesCount }}</h3>

									<p>New Orders</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-success">
								<div class="inner">
									<h3>53<sup style="font-size: 20px">%</sup></h3>

									<p>Bounce Rate</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-warning">
								<div class="inner">
									<h3>44</h3>

									<p>User Registrations</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-danger">
								<div class="inner">
									<h3>65</h3>

									<p>Unique Visitors</p>
								</div>
								<div class="icon">
									<i class="ion ion-pie-graph"></i>
								</div>
								<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
<!--		<div class="container pt-5">-->
<!--			<form @submit.prevent="logOutForm.post(route('logout'))">-->
<!--				<button class="log-out-button" type="submit">Log Out</button>-->
<!--			</form>-->
<!--		</div>-->
	</admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";

    export default {

        components: {
            AdminLayout
        },

		mounted() {

			this.activeLink();

        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            categoriesCount: Number,
        },

        data() {
          	return {

          	    logOutForm: this.$inertia.form(),
			}
		},

		methods: {

            activeLink() {

                let url = window.location.protocol + '//' + window.location.host + window.location.pathname;
                let link = '';

                let items = document.querySelectorAll('.nav-link');


                items.forEach(item => {

                    link = item.href;

                    if(link == url) {

                        item.classList.add('active');
                    }
                });
			},
		}


    }
</script>

<style>
	/*html, body, body > div, body > div > div {*/
	/*	height: 100% !important;*/
	/*}*/

	.log-out-button {
		border: 0;
		background: transparent;
		padding: 0;
		color: black;
	}
</style>