
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<link rel="icon" href="{{ asset('asset/img/ut_bogor.jpeg') }}" type="image/png" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	
<link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css') }}">
@yield('link')
	<link rel="stylesheet" href="{{ asset('asset/css/adminlte.min.css') }}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
	
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-footer-fixed layout-fixed">
	<div class="wrapper">

	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
			<li class="nav-item d-none d-sm-inline-block"><a href="/" class="nav-link">Home</a></li>
			<li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Contact</a></li>
		</ul>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<!-- Navbar Search -->
			<li class="nav-item">
				<a class="nav-link" data-widget="navbar-search" href="#" role="button">
					<i class="fas fa-search"></i>
				</a>
				<div class="navbar-search-block">
					<form class="form-inline">
					<div class="input-group input-group-sm">
						<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
						<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
						</button>
						<button class="btn btn-navbar" type="button" data-widget="navbar-search">
							<i class="fas fa-times"></i>
						</button>
						</div>
					</div>
					</form>
				</div>
			</li>

			<li class="nav-item"><a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a></li>
			<li class="nav-item"><a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i>	</a></li>
		</ul>
	</nav>

	@include('layouts.lte.sidebar')

	@yield('content')

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
	<div class="p-3">
		<h5>Title</h5>
		<p>Sidebar content</p>
	</div>
	</aside>

	@include('layouts.lte.footer')


	<script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	@yield('script')
	<script src="{{ asset('asset/js/adminlte.min.js') }}"></script>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{$error}}")
                @endforeach
            @endif
            
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break; 
            }
            @endif 
        </script>
</body>
</html>
