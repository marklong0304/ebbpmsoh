<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html class="home" lang="en"><!--<![endif]-->
	<head>
		<title>ERP - Enterprise Resource Planning</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="description" content="{mtDesc}">
		<meta name="author" content="{mtAuth}">
		<meta name="viewport" content="initial-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no">
		<meta charset="utf-8">
		<link rel="icon" href="<?php echo base_url()?>assets/image/button-blue.png">
		<link rel="shortcut icon" href="assets/image/button-blue.png">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/themes/redmond/jquery-ui-1.9.2.custom.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/style.css" />
		<?php
			$jsInclude 	= isset($jsInclude) ? $jsInclude : ""; echo $jsInclude;
			$jsScript 	= isset($jsScript) ? $jsScript : ""; echo $jsScript;
			$cssInclude = isset($cssInclude) ? $cssInclude : ""; echo $cssInclude;
			$cssStyle 	= isset($cssStyle) ? $cssStyle : ""; echo $cssStyle;
		?>
		<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
		<?php
			$jsInclude 	= isset($jsInclude) ? $jsInclude : ""; echo $jsInclude;
			$jsScript 	= isset($jsScript) ? $jsScript : ""; echo $jsScript;
		?>

</head>
<body style="background: url(<?php echo base_url()?>/assets/bbpmsoh/purple-background.jpg)">
	<script type="text/javascript">
		$(document).ready(function(){
			var username = $( "#username" ),
				password = $( "#password" ),
				company  = $( "#company" ),
				allFields = $( [] ).add( username ).add( password );
				tips = $( ".validateTips" );
				baseUrl = '<?php echo site_url();?>'
				
			$( "#regBox" ).dialog({
				title:'',
				autoOpen: true,
				width: 700,
				modal: true,
				draggable: false,
				resizable: false,
				closeText: "hide" ,
				dialogClass: "noClose",
				position: { my: "top-80%", at: "center", of: window  },
				buttons: {
					"<?php echo $this->lang->line('login_box_in');?>": function() {
						var bValid = true;
						allFields.removeClass( "ui-state-error" );
						bValid = bValid && checkLength( username, "username", 1, 7 );
						bValid = bValid;//&& checkLength( password, "password", 3, 16 );
						bValid = bValid;// && checkRegexp( username, /^[a-z]([0-9a-z_])+$/i, "<?php echo $this->lang->line('warning_regex_name');?>" );
						
						/*change by mansur 20181029 req by pak eddy on group WA Me Tech Tech*/
						//bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z~!@#$%^&*_+=`-])+$/, "<?php echo $this->lang->line('warning_regex_pass');?>" );
						if ( bValid ) {
							var uName = $( "#username" ).val();
							var uPass = $( "#password" ).val();
							var uComp = $( "#company" ).val();
							
							doLogin(uName, uPass, uComp);
						}
					},
					"<?php echo $this->lang->line('login_box_reset');?>": function() {
						resetForm('#formLogin');
					}
				},
				close: function() {
					allFields.val( "" ).removeClass( "ui-state-error" );
				}
			});
			
			$('#username').keyup(function(){
				$(this).val(String($(this).val()).toUpperCase());
			});
			
			focusCursor();
			$("#password").keypress(function(e){ 
			    var code = e.which; 
			    if(code==13)e.preventDefault();
			    if(code==32||code==13||code==188||code==186){
			    	var uName = $( "#username" ).val();
					var uPass = $( "#password" ).val();
					var uComp = $( "#company" ).val();
					doLogin(uName, uPass, uComp);
			    }
			});

		});
		
		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips("<?php echo $this->lang->line('warning_empty_field');?>");
				return false;
			} else {
				return true;
			}
		}
		
		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
		
		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		function resetForm(form) { 
			$(form).each(function(){ this.reset(); });
		}
		
		function getCompany() {
			$.ajax({ 
				type: 'GET', 
				url: baseUrl+'login/getComp', 
				data: '', 
				async: false, 
				dataType: 'json', 
				success: function(data) {
					var listComp = ''
					$.each(data.comp, function(i, item) {
						if (item.value == 3){
							listComp += '<option value="'+item.value+'" selected="selected">'+item.name+'</option>';
						}else{
							listComp += '<option value="'+item.value+'" >'+item.name+'</option>';
						}
					});
					$("#company").html(listComp);
				}
			});
		}
		
		function doLogin(uName, uPass, uComp){
			/*var params	= 'username='+encodeURIComponent(uName);
				params	+= '&password='+encodeURIComponent(uPass);
				params	+= '&company='+encodeURIComponent(uComp); */
			$.ajax({
				type: 'POST', 
				url: baseUrl+'login/signin', 
				//data: params, 
                                data: {username:uName, password:uPass, company:uComp}, 
				async: false,
				dataType: 'json', 
				success: function(data) {
					if (data.stat == 1){
						//window.location = baseUrl + 'home';
						window.location = baseUrl + 'home/'+uComp;
					}else{
						updateTips(data.message);
					} 
				}
			});
		}

		function focusCursor() {
		   if (formLogin.username.value!='') formLogin.userpassword.focus();
		   else formLogin.username.focus();
		}

		 
	</script>
	<link href="<?php echo base_url()?>/assets/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<!-- Font Awesome Icons -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<!-- Theme style -->
		<link href="<?php echo base_url()?>/assets/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
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
			.register-box2 {
				width:65%;
				margin: 2% auto;
			}
			.login-box-body {
				box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.8);
				background: rgba(255, 255, 255, 0.9);
				color: {{ CRUDBooster:: getSetting("login_font_color") ?:'#666666' }}  !important;
			}
			html, body {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 11px;
			}
		</style>
	
	<div class="register-box2 panel panel-default" style="text-align: left;">
		<div class="login-logo" align="center">
			<a href="#"><a href="#"> <img title='Logo BBPMSOH' src='<?php echo base_url()?>/assets/bbpmsoh//logo-bbpmsoh.png' style='max-width: 100%;max-height:170px'/></a></a>
			<h3>Portal Layanan Pengujian <br /> Sampel Obat Hewan Online
			(e-Sampel)</h3>
		</div><!-- /.login-logo -->
		<div class="panel-heading" align="center">
				<h3>Registrasi Pelanggan Baru</h3>
			</div>

			<div class="panel-body" style="padding:20px 0px 0px 0px">
				<form class="form-horizontal" action="<?php echo base_url()?>form/prosesregis" method="post" id="kirim" enctype="multipart/form-data">

			

					<div class="box-body" id="parent-form-area">
						<div class="row">
							<div class="col-md-6" style="padding-left: 50px;">
								<div class="" style="">					              
					              <h3 class="text-light-blue" >Data Pelanggan</h3>
					            </div>
					            <div class="form-group col-sm-12">
				                	<label for="">Nama </label>
				                  	<input type="text" class="form-control" id="vName" name="vName" placeholder="Nama anda" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                	<label for="">Email</label>
				                  	<input type="email" class="form-control" id="vEmail" name="vEmail" placeholder="Email anda" required="">
				                </div>
				                <div class="">
					              <h4 class="text-light-blue">Email ini ( Perusahaan ) akan menjadi <br />  username pada saat login portal</h4>
					            </div>
					            <div class="form-group col-sm-12">
				                	<label for="">Email</label>
				                  	<input type="email" class="form-control" id="vEmail_company" name="vEmail_company" placeholder="Email Perusahaan" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                	<label for="">Password</label>
				                  	<input type="password" class="form-control" id="vPassword" name="vPassword" placeholder="Buat kode masuk" required="">
				                </div>
				                <!--
				                <div class="form-group col-sm-12">
				                	<label for="">Ulangi Password</label>
				                  	<input type="password" class="form-control" id="name" name="name" placeholder="Ulangi kode masuk">
				                </div>
				                -->
				                <div class="form-group col-sm-12">
				                  	<label for="">Alamat </label>
				                  	<textarea class="form-control" rows="3" id="vAddress" name="vAddress" placeholder="Enter ..." required=""></textarea>
				                </div>
								<div class="form-group col-sm-12">
				                	<label for="">No. Telepon </label>
				                  	<input type="tel" class="form-control" id="vTelepon" name="vTelepon" placeholder="No. Telepon" required="">
				                </div>

							</div>
							<div class="col-md-6">
								<div class="">
					              <h3 class="text-light-blue">Data Perusahaan</h3>
					            </div>
					            <div class="form-group col-sm-12">
				                	<label for="">Nama Perusahaan</label>
				                  	<input type="text" class="form-control" id="vName_company" name="vName_company" placeholder="Alamat anda" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                  	<label for="">Alamat Perusahaan</label>
				                  	<textarea class="form-control" rows="3" id="vAddress_company" name="vAddress_company" placeholder="Enter ..." required=""></textarea>
				                </div>
								<div class="form-group col-sm-12">
				                	<label for="">No. Telepon </label>
				                  	<input type="tel" class="form-control" id="vTelepon_company" name="vTelepon_company" placeholder="No. Telepon" required="">
				                </div>
				                <div class="form-group col-sm-12">
				                	<label for="">No. Fax.</label>
				                  	<input type="tel" class="form-control" id="vFax_company" name="vFax_company" placeholder="No. Fax" required="">
				                </div>
							</div>
						</div>



					</div><!-- /.box-body -->

					<div class="box-footer" style="background: #F5F5F5">

						<div class="form-group">
							<label class="control-label col-sm-2"></label>
							<div class="col-sm-10">
								<a href="login" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>								
								<input type="submit" name="" value="Kirim" class="btn btn-success">

							</div>
						</div>

					</div><!-- /.box-footer-->

				</form>

			</div>	
	</div>
	<!--
	
	<div id="loginBox">
		
		<div class="login-logo" align="center">
			<a href="#"><a href="#"> <img title='Logo BBPMSOH' src='<?php echo base_url()?>/assets/bbpmsoh//logo-bbpmsoh.png' style='max-width: 100%;max-height:170px'/></a></a>
			<h3>Portal Layanan Pengujian <br /> Sampel Obat Hewan Online
			(e-Sampel)</h3>
		</div><!-- /.login-logo
		<p class="validateTips"></p>
		<form id="formLogin">
			<fieldset>
				<label for="name"><?php echo $this->lang->line('login_box_name');?></label>
				<input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
				<label for="password"><?php echo $this->lang->line('login_box_pass');?></label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
				<label for="company">Instansi <!-- <?php echo $this->lang->line('login_box_comp');?> </label>
				<select name="company" id="company" class="text ui-widget-content ui-corner-all" style="cursor:pointer;"><?php echo $getCompany;?></select>
			</fieldset>
			<div class='row'>
                <div class='col-xs-12' align="left">
                	<p style="padding:10px 0px 10px 0px">
                	<a href='<?php echo base_url()?>registrasi'><strong>Form Registrasi</strong></a>, <br /> Jika Anda lupa Password 
                	<a href='<?php echo base_url()?>lupapassword'><strong>Klik disini!</strong></a></p>
                </div>
            </div>
		</form>
	</div>
	 -->
	</body>
</html>	