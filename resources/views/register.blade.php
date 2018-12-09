
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form Pendaftaran Anggota</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
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
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('templates/material/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('templates/material/assets/js/pages/login.js') }}"></script>

	<script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/ui/ripple.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/axios/dist/axios.min.js') }}"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-indigo">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ '' }}"><img src="{{ asset('templates/material/assets/images/logo_light.png') }}" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="{{ url('login') }}">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>

				

				
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Registration form -->
					{!! Form::open(['id' => 'form-register','route' => 'anggota.store', 'files' => true]) !!}
					
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3">
							<div class="panel registration-form">
								<div class="panel-body">
									<div class="text-center">
										<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
										<h5 class="content-group-lg">Daftar Anggota <small class="display-block">Harap isi semua field</small></h5>
									</div>

									
									<div id="error-message">

									</div>
									{!! Form::open(['route' => 'anggota.store', 'files' => true]) !!}

									<div class="row">

										<div class="col-xs-12 col-sm-12 col-md-6">
											<div class="form-group">

												<strong>Username:</strong>
												{!! Form::text('username', null, array('class' => 'form-control')) !!}        

											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6">

											<div class="form-group">

												<strong>Name:</strong>

												{!! Form::text('name', null, array('class' => 'form-control')) !!}

											</div>

										</div>

										<div class="col-xs-12 col-sm-12 col-md-12">

											<div class="form-group">

												<strong>Email:</strong>

												{!! Form::text('email', null, array('class' => 'form-control')) !!}

											</div>

										</div>

										<div class="col-xs-12 col-sm-12 col-md-6">

											<div class="form-group">

												<strong>Password:</strong>

												{!! Form::password('password', array('class' => 'form-control')) !!}

											</div>

										</div>

										<div class="col-xs-12 col-sm-12 col-md-6">

											<div class="form-group">

												<strong>Confirm Password:</strong>

												{!! Form::password('confirm-password', array('class' => 'form-control')) !!}

											</div>

										</div>
										<div class="col-xs-12 col-sm-12 col-md-12">

											<div class="form-group">

												<strong>NIP</strong>

												{!! Form::text('nip',null, array('class' => 'form-control')) !!}

											</div>

										</div>

										

										
										
										<div class="col-xs-12 col-sm-12 col-md-12">

											<div class="form-group">

												<strong>No Telepon</strong>

												{!! Form::text('no_telepon',null, array('class' => 'form-control')) !!}

											</div>

										</div>
										
										<div class="col-xs-12 col-sm-12 col-md-6">

											<div class="form-group">

												<strong>Tanggal Lahir</strong>

												{!! Form::date('tanggal_lahir',null, array('class' => 'form-control')) !!}

											</div>

										</div>
										<div class="col-xs-12 col-sm-12 col-md-6">

											<div class="form-group">

												<strong>Jenis Kelamin</strong>

												{!! Form::select('jenis_kelamin', Config::get('enums.jenis_kelamin'),null, array('class' => 'form-control')) !!}

											</div>

										</div>
										<div class="col-xs-12 col-sm-12 col-md-12">

											<div class="form-group">

												<strong>Alamat</strong>

												{!! Form::textarea('alamat',null, array('class' => 'form-control')) !!}

											</div>

										</div>

										<div class="col-xs-12 col-sm-12 col-md-12">

											<div class="form-group">

												<strong>Pas Foto</strong>

												{!! Form::file('foto',null, array('class' => 'form-control')) !!}

											</div>

										</div>


										<div class="col-xs-12 col-sm-12 col-md-12 text-center">

											<button type="submit" class="btn btn-info">Submit</button>

										</div>

									</div>






								</div>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
					
					<!-- /registration form -->


					<!-- Footer -->
					<div class="footer text-muted text-center"></div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<script>
		$("#form-register").submit(function(event) {
			event.preventDefault();		
			$("button[type=submit]").attr('disabled', true);
			let formData = new FormData(this);
			axios.post("{{ route('anggota.store') }}", 
				formData
				)
			.then(resp => {
				res = resp.data;
				console.log(res);
				if (res.success) {

					swal({
						icon : 'success',
						title : 'Sukses',
						text : 'Berhasil Daftar. Silahkan Tunggu Konfirmasi Admin',
						closeOnClickOutside : false,
					})
					.then(clicked => {
						location.href = '{{ route('login') }}';
					})
				}
				$("button[type=submit]").attr('disabled', false);

			})	
			.catch(err => {
				$("button[type=submit]").attr('disabled', false);
				
				var errors = err.response.data.errors;
				var list = '';
				$.each(errors, function(index, val) {
					$.each(val, function(index2, val2) {
						list += "<li>" + val2 + "</li>";
					});
				});
				$('#error-message').html("");
				$("#error-message").html(
					"<div class=\"alert alert-danger\">\
					<ul>\
					"+list+"\
					</ul>\
					</div>\
					");

				$('html, body').animate({scrollTop: $("#error-message").offset().top}, 'fast');
				$("button[type=submit]").attr('disabled', false);

			})
		});
	</script>
</body>
</html>
