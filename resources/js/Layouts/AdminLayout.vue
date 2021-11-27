<template>
	<div>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<!-- Google Font: Source Sans Pro -->
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

			<!-- Ionicons -->
<!--			<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
<!--			&lt;!&ndash; Tempusdominus Bootstrap 4 &ndash;&gt;-->
<!--			<link rel="stylesheet" :href="mix('Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')">-->
<!--			&lt;!&ndash; iCheck &ndash;&gt;-->
<!--			<link rel="stylesheet" :href="mix('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')">-->
<!--			&lt;!&ndash; JQVMap &ndash;&gt;-->
<!--			<link rel="stylesheet" :href="mix('Admin/plugins/jqvmap/jqvmap.min.css')">-->
<!--			&lt;!&ndash; overlayScrollbars &ndash;&gt;-->
<!--			<link rel="stylesheet" :href="mix('Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')">-->
<!--			&lt;!&ndash; Daterange picker &ndash;&gt;-->
<!--			<link rel="stylesheet" :href="mix('Admin/plugins/daterangepicker/daterangepicker.css')">-->
<!--			&lt;!&ndash; summernote &ndash;&gt;-->
<!--			<link rel="stylesheet" :href="mix('Admin/plugins/summernote/summernote-bs4.min.css')">-->

			<!-- Font Awesome -->
			<Script src="https://kit.fontawesome.com/cb2ba445f2.js" crossorigin="anonymous"></Script>
		</head>


		<div class="admin-layout hold-transition sidebar-mini layout-fixed">
			<div class="wrapper">

<!--				&lt;!&ndash; Preloader &ndash;&gt;-->
<!--				<div class="preloader flex-column justify-content-center align-items-center">-->
<!--					<img class="animation__shake" src="/Admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
<!--				</div>-->

				<!-- Main Sidebar Container -->
				<aside class="main-sidebar sidebar-dark-primary elevation-4">
					<!-- Brand Logo -->
					<a href="index3.html" class="brand-link">
						<img :src="mix('/images/AdminSidebar/AdminLTELogo.png')" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
						<span class="brand-text font-weight-light">Админ-панель</span>
					</a>

					<!-- Sidebar -->
					<div class="sidebar">
						<!-- Sidebar user panel (optional) -->
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
							<div class="image">
								<img :src="mix('/images/AdminSidebar/user2-160x160.jpg')" class="img-circle elevation-2" alt="User Image">
							</div>
							<div class="info">
								<a href="#" class="d-block">{{ $page.props.auth.user.name }}</a>
							</div>
						</div>

						<!-- Sidebar Menu -->
						<nav class="mt-2">
							<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
								<!-- Add icons to the links using the .nav-icon class
									 with font-awesome or any other icon font library -->
								<li class="nav-item">
									<inertia-link :href="route('dashboard')" class="nav-link">
										<i class="nav-icon fas fa-tachometer-alt"></i>
										<p>
											Главная
										</p>
									</inertia-link>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="nav-icon fas fa-newspaper"></i>
										<p>
											Блог
											<i class="right fas fa-angle-left"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<a href="./index.html" class="nav-link">
												<p>Все статьи</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="./index.html" class="nav-link">
												<p>Добавить статью</p>
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="nav-icon fas fa-align-left"></i>
										<p>
											Продукты
											<i class="right fas fa-angle-left"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<inertia-link :href="route('dashboard.products')" class="nav-link">
												<p>Все продукты</p>
											</inertia-link>
										</li>
										<li class="nav-item">
											<inertia-link :href="route('dashboard.add-product')" class="nav-link">
												<p>Добавить продукт</p>
											</inertia-link>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<form @submit.prevent="form.post(route('logout'))">
										<button class="nav-link log-out-button" type="submit">
											<i class="nav-icon fas fa-align-left"></i>
											Log Out
										</button>
									</form>
								</li>
							</ul>
						</nav>
						<!-- /.sidebar-menu -->
					</div>
					<!-- /.sidebar -->
				</aside>

				<!-- Content Wrapper. Contains page content -->
				<slot></slot>
				<!-- /.content-wrapper -->

				<!-- Control Sidebar -->
				<aside class="control-sidebar control-sidebar-dark">
					<!-- Control sidebar content goes here -->
				</aside>
				<!-- /.control-sidebar -->
			</div>
			<!-- ./wrapper -->

<!--			<Script :src="mix('Admin/plugins/jquery-ui/jquery-ui.min.js')"></Script>-->
<!--			&lt;!&ndash; Resolve conflict in jQuery UI tooltip with Bootstrap tooltip &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/jquery-ui/addition-jquery-ui.js')"></Script>-->
<!--			&lt;!&ndash; ChartJS &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/chart.js/Chart.min.js')"></Script>-->
<!--			&lt;!&ndash; Sparkline &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/sparklines/sparkline.js')"></Script>-->
<!--			&lt;!&ndash; JQVMap &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/jqvmap/jquery.vmap.min.js')"></Script>-->
<!--			<Script :src="mix('Admin/plugins/jqvmap/maps/jquery.vmap.usa.js')"></Script>-->
<!--			&lt;!&ndash; jQuery Knob Chart &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/jquery-knob/jquery.knob.min.js')"></Script>-->
<!--			&lt;!&ndash; daterangepicker &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/moment/moment.min.js')"></Script>-->
<!--			<Script :src="mix('Admin/plugins/daterangepicker/daterangepicker.js')"></Script>-->
<!--			&lt;!&ndash; Tempusdominus Bootstrap 4 &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')"></Script>-->
<!--			&lt;!&ndash; Summernote &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/summernote/summernote-bs4.min.js')"></Script>-->
<!--			&lt;!&ndash; overlayScrollbars &ndash;&gt;-->
<!--			<Script :src="mix('Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')"></Script>-->
			<!-- AdminLTE App -->
<!--			<Script :src="mix('Admin/dist/js/adminlte.js')"></Script>-->

		</div>
	</div>
</template>


<script>

    import Script from "@/Components/Script";
    require('admin-lte');
    require('~/admin-lte/plugins/select2/js/select2.full.min.js');

    export default {

        components: {
            Script
		},

        mounted() {

            this.initTreeview();
            this.activeLink();
        },

		data() {
            return {

                form: this.$inertia.form(),
            }
		},

        methods: {

            initTreeview() {

                $('[data-widget="treeview"]').Treeview('init');
			},

            activeLink() {

                let url = window.location.protocol + '//' + window.location.host + window.location.pathname;
                let link = '';

                let items = document.querySelectorAll('.nav-link');


                items.forEach(item => {

                    link = item.href;

                    if(link == url) {

                        item.classList.add('active');

                        if(item.parentElement.parentElement.parentElement.tagName == 'LI') {

                            item.parentElement.parentElement.parentElement.classList.add('menu-is-opening', 'menu-open');
                        }
                    }
                });
            },
        }
    }
</script>



<style lang="scss">
	@import "~admin-lte/build/scss/adminlte";
	@import "~admin-lte/plugins/select2/css/select2.min.css";
	@import "~admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css";

	.admin-layout {

		.sidebar-mini, .content-wrapper {
			height: 100vh !important;
		}

		.log-out-button {
			color: #c2c7d0;
			text-align: left;
		}

		.log-out-button:hover {
			background-color: rgba(255, 255, 255, 0.1);
			color: #fff !important;
		}

		.nav-link i {
			color: #c2c7d0;
		}
	}


</style>