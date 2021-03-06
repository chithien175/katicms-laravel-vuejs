
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Hệ thống quản trị nội dung - {{ getFieldCompany('company.name') }}</title>

	<link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
@php
	$user_current = App\User::with('roles')->findOrFail(auth()->user()->id);
	$modules = [
		'blog' 		=> Module::find('blog')->get('active'),
		'menu' 		=> Module::find('menu')->get('active'),
		'ecommerce' => Module::find('ecommerce')->get('active'),
		'booking' 	=> Module::find('booking')->get('active'),
	];
@endphp
	@if($user_current->status == 'active')
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<!-- Profile Dropdown Menu -->
			<li class="nav-item dropdown user-menu">
				<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
					<img src="{{ url('/images/profile') .'/'. $user_current->photo }}" class="img-circle elevation-2" alt="User Image">
					<span class="d-none d-sm-inline blue">{{ $user_current->name }}</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<router-link to="/admin/profile" class="dropdown-item blue">
					<i class="fas fa-user mr-2"></i> Trang cá nhân
					</router-link>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item dropdown-footer blue" href="{{ route('logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					<i class="mr-2 nav-icon fa fa-power-off"></i> Thoát
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
		</ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
		<a href="{{ route('katitheme.homepage') }}" target="_blank" class="brand-link">
			<img src="{{ url('/images/profile/') }}/profile.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
				style="opacity: .8">
			<span class="brand-text font-weight-light">{{ getFieldCompany('company.name') }}</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar Menu -->
			<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Bảng điền khiển -->
				<li class="nav-item">
				<router-link to="/admin/dashboard" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>
					Bảng điều khiển
					</p>
				</router-link>
				</li>

				<!-- Nội dung trang web -->
				@if( $user_current->can('manage-page') || ($user_current->can('manage-blog') && $modules['blog']) || ($user_current->can('manage-menu') && $modules['menu']) )
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-newspaper"></i>
						<p>
						Nội dung website
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						@if($user_current->can('manage-page'))
							<li class="nav-item">
								<router-link to="/admin/page" class="nav-link">
									<i class="fas fa-file-alt nav-icon"></i>
									<p>Trang</p>
								</router-link>
							<li>
						@endif
						@if($user_current->can('manage-blog') && $modules['blog'])
						<li class="nav-item">
							<router-link to="/admin/post" class="nav-link">
								<i class="fas fa-file-alt nav-icon"></i>
								<p>Bài viết - Blog</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/admin/category" class="nav-link">
								<i class="fas fa-folder-open nav-icon"></i>
								<p>Chuyên mục</p>
							</router-link>
						</li>
						@endif
						@if($user_current->can('manage-menu') && $modules['menu'])
						<li class="nav-item">
							<router-link to="/admin/menu" class="nav-link">
								<i class="far fa-compass nav-icon"></i>
								<p>Trình đơn - Menu</p>
							</router-link>
						</li>
						@endif
					</ul>
				</li>
				@endif

				<!-- Thương mại điện tử -->
				@if($user_current->can('manage-ecommerce') && $modules['ecommerce'])
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-shopping-cart"></i>
						<p>
						Thương mại điện tử
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<router-link to="/admin/product" class="nav-link">
								<i class="fas fa-dolly nav-icon"></i>
								<p>Sản phẩm</p>
							</router-link>
						<li>
						<li class="nav-item">
							<router-link to="/admin/p-category" class="nav-link">
								<i class="fas fa-folder-open nav-icon"></i>
								<p>Danh mục sản phẩm</p>
							</router-link>
						</li>
					</ul>
				</li>
				@endif

				<!-- Khách sạn - Căn hộ -->
				@if($user_current->can('manage-booking') && $modules['booking'])
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-hotel"></i>
						<p>
						Đặt phòng khách sạn
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<router-link to="/admin/room" class="nav-link">
								<i class="fas fa-bed nav-icon"></i>
								<p>Khách sạn - Căn hộ</p>
							</router-link>
						<li>
					</ul>
				</li>
				@endif
				
				<!-- Cài đặt cơ bản -->
				@if($user_current->can('manage-company|manage-media|manage-gallery'))
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-sliders-h"></i>
						<p>
						Quản trị cơ bản
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						@permission('manage-media')
						<li class="nav-item">
							<router-link to="/admin/media" class="nav-link">
								<i class="fas fa-photo-video nav-icon"></i>
								<p>Quản lý tập tin</p>
							</router-link>
						</li>
						@endpermission
						@permission('manage-gallery')
						<li class="nav-item">
							<router-link to="/admin/gallery" class="nav-link">
								<i class="fas fa-camera nav-icon"></i>
								<p>Bộ sưu tập ảnh</p>
							</router-link>
						</li>
						@endpermission
						@permission('manage-company')
						<li class="nav-item">
							<router-link to="/admin/company" class="nav-link">
								<i class="fas fa-building nav-icon"></i>
								<p>Thông tin công ty</p>
							</router-link>
						</li>
						@endpermission
					</ul>
				</li>
				@endif

				@if($user_current->can('manage-developer|manage-logs'))
				<!-- Quản trị hệ thống -->
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-cogs"></i>
						<p>
						Quản trị hệ thống
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						@role('superadmin')
						<li class="nav-item">
							<router-link to="/admin/user" class="nav-link">
								<i class="fas fa-user nav-icon"></i>
								<p>Quản trị người dùng</p>
							</router-link>
						</li>
						@endrole

						@role('superadmin')
						<li class="nav-item">
							<router-link to="/admin/role" class="nav-link">
								<i class="fas fa-user-tag nav-icon"></i>
								<p>Nhóm và phân quyền</p>
							</router-link>
						</li>
						@endrole

						@role('superadmin')
						<li class="nav-item">
							<router-link to="/admin/module" class="nav-link">
								<i class="fa fa-plug nav-icon"></i>
								<p>Chức năng mở rộng</p>
							</router-link>
						</li>
						@endrole

						@permission('manage-logs')
						<li class="nav-item">
							<router-link to="/admin/logviewer" class="nav-link">
								<i class="fas fa-clipboard-list nav-icon"></i>
								<p>Nhật ký hệ thống</p>
							</router-link>
						</li>
						@endpermission
					</ul>
				</li>
				@endif
			</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <router-view></router-view>
    <!-- /.content-wrapper -->

    <vue-progress-bar></vue-progress-bar>

    <!-- Main Footer -->
    <footer class="main-footer">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">
			Hệ thống quản trị nội dung.
		</div>
		<!-- Default to the left -->
		&copy; 2019 Bản quyền thuộc <strong>KaTiSoft</strong>.
    </footer>
	@else
	<h1 class="blue">Tài khoản chưa được kích hoạt. Vui lòng liên hệ quản trị viên!</h1>
	@endif
</div>
<!-- ./wrapper -->

@auth
<script>
	window.user = @json($user_current);
	window.modules = @json($modules);
</script>
@endauth

<script src="/js/app.js"></script>
</body>
</html>
