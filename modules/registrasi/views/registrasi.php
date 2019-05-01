<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Registrasi Pelanggan</title>
		<meta name='generator' content='CRUDBooster'/>
		<meta name='robots' content='noindex,nofollow'/>
		<link rel="shortcut icon"
		href="{{ CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">

		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- Bootstrap 3.3.2 -->
		<link href="<?php echo base_url()?>/assets/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<!-- Font Awesome Icons -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<!-- Theme style -->
		<link href="<?php echo base_url()?>/assets/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>

		<!-- support rtl-->
		@if (in_array(App::getLocale(), ['ar', 'fa']))
		<link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
		<link href="{{ asset("vendor/crudbooster/assets/rtl.css")}}" rel="stylesheet" type="text/css"/>
		@endif

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/main.css")}}'/>
		<link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/tambahan.css")}}'/>
		<style type="text/css">
			.login-page2, .register-page2 {
				background: {{ CRUDBooster:: getSetting("login_background_color") ?:'#dddddd'}} url('{{ CRUDBooster::getSetting("login_background_image")?asset(CRUDBooster::getSetting("login_background_image")):asset('vendor/crudbooster/assets/bg_blur3.jpg') }}');
				color: {{ CRUDBooster::getSetting("login_font_color")?:'#ffffff' }}  !important;
				background-repeat: no-repeat;
				background-position: center;
				background-size: cover;
			}
			.login-page, .register-page {
				/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f9f9f9+1,c789f9+12,ffffff+100 */
				background: #f9f9f9; /* Old browsers */
				background: -moz-linear-gradient(top, #f9f9f9 1%, #c789f9 12%, #ffffff 100%); /* FF3.6-15 */
				background: -webkit-linear-gradient(top, #f9f9f9 1%,#c789f9 12%,#ffffff 100%); /* Chrome10-25,Safari5.1-6 */
				background: linear-gradient(to bottom, #f9f9f9 1%,#c789f9 12%,#ffffff 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9f9f9', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
			}
			.register-box {
				width:65%;
				margin: 2% auto;
			}
			.login-box-body {
				box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.8);
				background: rgba(255, 255, 255, 0.9);
				color: {{ CRUDBooster:: getSetting("login_font_color") ?:'#666666' }}  !important;
			}
			html, body {
				
			}
		</style>
	</head>

	<body class="login-page"  style="background: url(<?php echo base_url()?>/assets/bbpmsoh/purple-background.jpg)">
		<div class="register-box">
			<div class="login-logo" align="center">
			<a href="#"><a href="#"> <img title='Logo BBPMSOH' src='<?php echo base_url()?>/assets/bbpmsoh//logo-bbpmsoh.png' style='max-width: 100%;max-height:170px'/></a></a>
			<h3>Sistem Terpadu <br /> Pengujian Mutu dan Sertifikasi Obat Hewan</h3>
		</div>
		</div>
		<div class="register-box panel panel-default" style="text-align: left;">			
			<div class="panel-heading" align="center">
				<h3>Registrasi Pelanggan Baru</h3>
			</div>

			<div class="panel-body" style="padding:20px 0px 0px 0px">
				<form class="form-horizontal" action="{!! url('admin/postRegister') !!}" method="post" enctype="multipart/form-data">

				{{ csrf_field() }}

					<div class="box-body" id="parent-form-area">
						<div class="row">
							<div class="col-md-6" style="padding-left: 50px;">
								<div class="" style="">					              
					              <h3 class="text-light-blue" >Data Pelanggan</h3>
					            </div>
					            <div class="form-group col-sm-12">
				                	<label for="">Nama </label>
				                  	<input type="text" class="form-control" id="name" name="name" placeholder="Nama anda" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                	<label for="">Email</label>
				                  	<input type="email" class="form-control" id="emailPribadi" name="emailPribadi" placeholder="Email anda" required="">
				                </div>
				                <div class="">
					              <h4 class="text-light-blue">Email ini ( Perusahaan ) akan menjadi <br />  username pada saat login portal</h4>
					            </div>
					            <div class="form-group col-sm-12">
				                	<label for="">Email</label>
				                  	<input type="email" class="form-control" id="email" name="email" placeholder="Email Perusahaan" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                	<label for="">Password</label>
				                  	<input type="password" class="form-control" id="password" name="password" placeholder="Buat kode masuk" required="">
				                </div>
				                <!--
				                <div class="form-group col-sm-12">
				                	<label for="">Ulangi Password</label>
				                  	<input type="password" class="form-control" id="name" name="name" placeholder="Ulangi kode masuk">
				                </div>
				                -->
				                <div class="form-group col-sm-12">
				                  	<label for="">Alamat </label>
				                  	<textarea class="form-control" rows="3" id="vAlamatPribadi" name="vAlamatPribadi" placeholder="Enter ..." required=""></textarea>
				                </div>
								<div class="form-group col-sm-12">
				                	<label for="">No. Telepon </label>
				                  	<input type="tel" class="form-control" id="vTelponPribadi" name="vTelponPribadi" placeholder="No. Telepon" required="">
				                </div>

							</div>
							<div class="col-md-6">
								<div class="">
					              <h3 class="text-light-blue">Data Perusahaan</h3>
					            </div>
					            <div class="form-group col-sm-12">
				                	<label for="">Nama Perusahaan</label>
				                  	<input type="text" class="form-control" id="namePerusahaan" name="namePerusahaan" placeholder="Alamat anda" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                  	<label for="">Alamat Perusahaan</label>
				                  	<textarea class="form-control" rows="3" id="vAlamatPerusahaan" name="vAlamatPerusahaan" placeholder="Enter ..." required=""></textarea>
				                </div>
								<div class="form-group col-sm-12">
				                	<label for="">No. Telepon </label>
				                  	<input type="tel" class="form-control" id="vTelponPerusahaan" name="vTelponPerusahaan" placeholder="No. Telepon" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                	<label for="">No. Fax.</label>
				                  	<input type="tel" class="form-control" id="vFaxPerusahaan" name="vFaxPerusahaan" placeholder="No. Fax" required="">
				                </div>

							</div>
						</div>



					</div><!-- /.box-body -->

					<div class="box-footer" style="background: #F5F5F5">

						<div class="form-group">
							<label class="control-label col-sm-2"></label>
							<div class="col-sm-10">
								<a href="login" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>								
								<input type="submit" name="submit" value="Kirim" class="btn btn-success">

							</div>
						</div>

					</div><!-- /.box-footer-->

				</form>

			</div>
		</div>



		<!-- jQuery 2.1.3 -->
		<script src="{{asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="{{asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	</body>
</html>