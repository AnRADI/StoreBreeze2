<template>
	<div>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
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
						<img src="/images/AdminSidebar/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
						<span class="brand-text font-weight-light">Админ-панель</span>
					</a>

					<!-- Sidebar -->
					<div class="sidebar">
						<!-- Sidebar user panel (optional) -->
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
							<div class="image">
								<img src="/images/AdminSidebar/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
							</div>
							<div class="info">
								<a href="#" class="d-block">{{ $page.props.auth.user.name }}</a>
							</div>
						</div>

						<!-- Sidebar Menu -->
						<nav class="sidebar-menu mt-2">
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
											<inertia-link :href="route('dashboard.products.create')" class="nav-link">
												<p>Добавить продукт</p>
											</inertia-link>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a @click.prevent="form.post(route('logout.store'))" href="#" class="nav-link">
										<i class="nav-icon fas fa-align-left"></i>
										Log Out
									</a>
<!--									<form @submit.prevent="form.post(route('logout'))">-->
<!--										<button class="nav-link log-out-button" type="submit">-->
<!--											<i class="nav-icon fas fa-align-left"></i>-->
<!--											Log Out-->
<!--										</button>-->
<!--									</form>-->
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

		</div>
	</div>
</template>


<script>

    require('admin-lte');
    require('@/Plugins/fontawesome.js');
    require('~/admin-lte/plugins/select2/js/select2.full.min.js');


    export default {

        components: {

		},

        mounted() {
			$('[data-widget="treeview"]').Treeview('init');

            this.activeLink();

            // let menuOpens = document.querySelectorAll('[data-widget="treeview"] > .nav-item');
			//
			// for(let menuOpen of menuOpens) {
			//
            //     menuOpen.onclick = (e) => {
			//
            //         e.currentTarget.classList.toggle('menu-open');
            //         console.log(e.currentTarget);
            //     };
            // }
        },

		data() {
            return {

                form: this.$inertia.form(),
            }
		},

        methods: {

            activeLink() {

                let url = window.location.protocol + '//' + window.location.host + window.location.pathname;
                let navLink, navTreeview, navTreeviewItem;

                let navItems = document.querySelectorAll('.sidebar-menu .nav-item');


                for(let navItem of navItems) {


                    navLink = navItem.querySelector('.nav-link');

                    if(navLink.href == url) {

                        navLink.classList.add('active');

                        navTreeview = navLink.closest('.nav-treeview');

                        while(navTreeview) {

                            navTreeviewItem = navTreeview.closest('.nav-item');
                            navTreeviewItem.classList.add('menu-is-opening', 'menu-open');

                            navTreeview = navTreeviewItem.closest('.nav-treeview');
                        }

                        break;
                    }
                }
            },
        }
    }
</script>



<style lang="scss">

	@import "resources/sass/Plugins/select2-bootstrap4";
	@import "resources/sass/Plugins/select2";
	@import "~admin-lte/build/scss/adminlte";



	.admin-layout {

		.nav-inner-menu {
			display: none;
		}

		.wrapper {
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

		.main-sidebar {
			position: fixed !important;
		}

		.menu-open > .nav-link {
			background-color: rgba(255, 255, 255, 0.1) !important;
			color: #fff !important;
		}
	}


</style>