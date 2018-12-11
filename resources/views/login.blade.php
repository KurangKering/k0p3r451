
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KOPERASI</title>

	<!-- Global stylesheets -->
	<link href="{{ asset('templates/material/https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('templates/material/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('templates/material/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('templates/material/assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('templates/material/assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('templates/material/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/ui/nicescroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/ui/drilldown.js') }}"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/core/app.js') }}"></script>

	<script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container">

	


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Simple login form -->
				<form action="{{ route('login') }}" method="POST">
					@csrf
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
							<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
						</div>
						@if (count($errors) > 0)

						<div class="alert alert-danger text-center">
							@if ($errors->has('active'))
							<span>Anggota Belum Di Setujui</span>
							@else
							<span>Username / Password Salah</span>
							@endif

						</div>

						@endif
						<div class="form-group has-feedback has-feedback-left">
							{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>

						<div class="form-group has-feedback has-feedback-left">
							{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn bg-pink-400 btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
						</div>

						<div class="text-center">
							<a href="{{ url('daftar') }}">Belum Punya Akun ?</a>
						</div>
					</div>
				</form>
				<!-- /simple login form -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->


	<!-- Footer -->
	<div class="footer text-muted text-center"></div>
	<!-- /footer -->

</body>
</html>
