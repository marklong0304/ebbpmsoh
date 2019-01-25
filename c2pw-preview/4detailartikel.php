<?php
// connect to the database
include('connect-db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title> Homepage Nutrafor White Beauty | www.nutraforwhitebeauty.co.id
</title>
			
	<meta name="keywords" 				   content="Nutrafor White Beauty">	
<meta property="og:url"                content="" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="Homepage Nutrafor White Beauty | www.nutraforwhitebeauty.co.id" />
<meta property="og:description"        content="" />
<meta property="og:image"              content="" />
	<link type="image/ico" rel="shortcut icon" href="../assets/c2pw/assets/images/nwb/logo_thromecon.ico">
	<!-- CSRF Token -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="" />
	    
    <link rel="stylesheet" href="../assets/c2pw/assetbaru/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/font-awesome.css" type="text/css">
	<link rel="stylesheet" href="../assets/c2pw/assetbaru/css/style-nwb.css" type="text/css">
	
</head>
<body>

<div id="wrapper">	
	<!-- HEADER & NAV -->
	<header>
		<div class="container">
			<div id="header-top">
				<div id="logo">
					<a href="/"><img src="../assets/c2pw/assets/images/nwb/logo_nwb.png" class="logo" width=""></a>
				</div>
				<div id="login" class="pull-right">
					<ul>
												<li><a href="#menulogin" id="loginbutton" data-toggle="modal"><i class="fa fa-unlock-alt" style="color: #748C87"></i> Login</a></li>
						<li><a href="/register"><i class="fa fa-sign-in" style="color: #748C87"></i> Register</a></li>
											</ul>
					<a href="/"><img src="../assets/c2pw/assets/images/nwb/follow_on_facebook.png" class="" width="180"></a>
				</div>
				<div id="menulogin" class="modal fade">
					<div class="modal-dialog" style="width: 300px;">
						<div class="modal-content flat">
							<div class="modal-body">
								<div class="leftFtr" id="menulogin">
								<div class="bgSign">
									<form method="post" action="/login" enctype="multipart/form-data">
										<input type="hidden" name="_token" value="LlQguba5jSBofaEtovcpAkdkiKV460NjwvE8Jdk6"> 
										<div class="form-group">
											<strong>Silahkan masukan <br /> Email & Password Anda ! </strong>
										</div>
										<div class="form-group">
											<input name="email" type="email" placeholder="Email Anda" />
										</div>
										<div class="form-group">
											<input name="password" type="password" placeholder="Password Anda" />
										</div>
										<div class="form-group">
											<input type="submit" value="Masuk" class="btnCari" /> 
										</div>
										<div>
											Belum punya akun, <a href="/register" style="color: #cc0000;">Registrasi disini!</a>
										</div>
										<div>
											Lupa Password, <a href="/lupapassword" style="color: #cc0000;">Klik disini!</a>
										</div>
									</form>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div id="wrapper-nav" class="">
		<div class="container">
			<nav class="navbar navbar-default nav-thromecon flat">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed flat" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><img src="../assets/c2pw/assets/images/nwb/logo_nwb.png" class="logo" width=""></a>
				</div>
				<div id="navbar" class="navbar-collapse collapse navbar-thromecon">
					<ul class="nav navbar-nav">
						<li>
                            <a id="menuHome"  href="#">Beranda</a>
                        </li>
                        <li>
                            <a id="menuProduk" href="#">Produk Kami</a>
                        </li>
                        <li>
                            <a id="menuArtikel" href="#">Tips Kesehatan</a>
                        </li>
                        <li>
                            <a id="menuOutlet" href="#">Beli dimana ?</a>
                        </li>
                        <li>
                            <a id="menuTestimoni" href="#">Testimoni</a>
                        </li>
                        <li>
                            <a id="menuKeluhan" href="#">Hubungi Kami</a>
                        </li>
					</ul>
				</div>
			</nav>
		</div>
	</div>

	<!-- PAGE CONTENT -->
    <section id="page-content">
		<div class="container">
			<div class="content" style="padding-top:0px;">
				<div class="article" style="padding-left:25px;padding-right:25px;">
					<div class="row">
						<div class="col-md-8 col-xs-12">
							<div class="isi-article">
								<?php
								 $id = $_GET['id'];
								 if ($result = $mysqli->query("SELECT * FROM artikel where iArtikelid ='$id'")) {
									// display records if there are records to display
										if ($result->num_rows > 0)
										{						
											while ($row = $result->fetch_object())
											{
												$date = $row->created_at;
												$format = date('d-m-Y | H:i:s', strtotime($date ));
																		
													if (!$row->vImages == '') {
											    		echo '
															<img class="" src="../'. $row->vImages . '">		
														';
													}
											    	else {
											    		echo '
															<img src="../assets/c2pw/assets/images/no-image-nwb.jpg" class="">		
														';
													}	
													echo '<p class="overlay no-padding-top">'.$format.' - oleh :'.$row->vEditor.'</p>
														<h2 class="judul-article">'.$row->vJudul.'</h2>';				
												echo '	
													<div class="teks-article">
														'.$row->vLengkap.'
													</div>	';
											}
										
										}
										else
										{
											echo "No results to display!";
										}
									}
										else
										{
										echo "Error: " . $mysqli->error;
									}
								?>
								
                                <div class="clearfix"></div>
								<div class="teks-article">
									
									<div class="article-footer">
										<p class="article-copyright">( © 2017 | Customer Health Care - PT. Novell Pharmaceutical Labs. )</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12">
							<div class="sidebar-article">
								<div class="text-center head-sidebar-article">
									<h4>Tips & Artikel</h4>
								</div>
                                <?php
											 $id = $_GET['id'];
											 $idgroup = $_GET['cGroup2'];
											 if ($result = $mysqli->query("SELECT * FROM artikel where eType='ARTIKEL' And ldeleted ='0' And cGroup2='$idgroup'   ORDER BY created_at DESC limit 5 ")) {
												// display records if there are records to display
													if ($result->num_rows > 0)
													{						
														while ($row = $result->fetch_object())
														{
															echo '
															<div class="sidebar-article-item">
									<div class="media">
										<div class="media-left">
											                                                
										
																	
															';							
																if (!$row->vImages == '') {
														    		echo '<a href="/artikel-6/Pembekuan-Darah-3">
                                                    <img class="media-object" src="../'. $row->vImages . '" width="100px">		
                                                </a>
                                            										</div>';
																}
														    	else {
														    		echo '<a href="/artikel-6/Pembekuan-Darah-3">
                                                    <img class="media-object" src="../assets/c2pw/assets/images/no-image-nwb.jpg" width="100px">		
                                                </a>
                                            										</div>';
																}				
															echo '	
															<div class="media-body">
											<a href="/artikel-6-Pembekuan-Darah-3">'.$row->vJudul.'</a>
										</div>
									</div>
								</div>';
														}
													
													}
													else
													{
														echo "No results to display!";
													}
												}
													else
													{
													echo "Error: " . $mysqli->error;
												}
											?>
                                
                                								
                                								<a href="http://www.thromecon.co.id/artikel" class="btn btn-block flat" style="color:#444;"><b>Selengkapnya &raquo;</b></a>
							</div>
						</div>
					</div>
					<div>
						<div>
							<link rel="stylesheet" href="../assets/c2pw/assets/css/sosmed.css" type="text/css" media="screen" />
							<h3>Bagikan Artikel ini : </h3>
							<div class="component">
						        <a href="javascript: void(0)" onclick="popup_sosmed('http://www.facebook.com/sharer.php?u=http://www.c2fit.co.id/artikel-13-Artikel-2')"  class="icon icon-slide facebook">facebook</a>
						        <a href="javascript: void(0)" onclick="popup_sosmed('https://twitter.com/share')" class="icon icon-slide twitter">twitter</a>
						        <a href="javascript: void(0)" onclick="popup_sosmed('https://plus.google.com/share?url=http://www.c2fit.co.id/artikel-13-Artikel-2')" class="icon icon-slide googleplus">google+</a>
						    </div>
						</div>	
					</div>	
				</div>
				<script type="text/javascript">
					var el = document.getElementById("menuArtikel");
					el.classList.add("active");
				</script>
			</div>
		</div>
	</section>

    
    <div class="footer">
        <p>Copyright &copy; 2017  | All rights reserved</p>
    </div>
    
    <script type="text/javascript" src="../assets/c2pw/assetbaru/js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="../assets/c2pw/assetbaru/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/c2pw/assetbaru/js/thromecon.js"></script>
	<script>
		function check_availability(){
			  var username = $('#email').val(); 
			  $.ajax({
			  	beforeSend: function(){	
						$('#loading').html('<img src="../assets/c2pw/assets/images/camera-loader.gif" alt="loading" />'); 
					},	
				  type:'GET',
				  url:'/checkemail/'+username,
				  data:'_token = LlQguba5jSBofaEtovcpAkdkiKV460NjwvE8Jdk6',
				  success:function(data){
					  if(data.msg=="true"){
						  $("#loading").html("Email Sudah Terdaftar");
						  $('input[type="submit"]').attr('disabled','disabled');
					  }else{
						  $("#loading").html("");
						  $('input[type="submit"]').removeAttr('disabled');
					  }
				  }
			  });
		  }
		  
		function check_password(){
			  var password = $('#password').val(); 
			  var password2 = $('#password2').val();
			  if(password!=password2){
						  $("#passcek").html("Password Tidak Sama");
						  $('input[type="submit"]').attr('disabled','disabled');
			  }else{
						  $("#passcek").html("");
						  $('input[type="submit"]').removeAttr('disabled');
			  }
		 }
		  
		  function check_password2(){
				var password = $('#password').val(); 
				var password2 = $('#password2').val();
				if(password!=password2){
							$("#passcek").html("Password Tidak Sama");
				}else{
							$("#passcek").html("");
				}
		 }
		  
		  document.addEventListener("DOMContentLoaded", function() {
		  var elements = document.getElementsByTagName("INPUT");
		  for (var i = 0; i < elements.length; i++) {
			  elements[i].oninvalid = function(e) {
				  e.target.setCustomValidity("");
				  if (!e.target.validity.valid) {
					  $("#blank").html("*Semua Field Wajib Diisi");
				  }
			  };
			  elements[i].oninput = function(e) {
				  e.target.setCustomValidity("");
			  };
		  }
	  })
	  </script>
		<script>
	     	CKEDITOR.replace( 'iKomentar',
				{
					toolbar :
					[
						{ name: 'basicstyles', items : [ 'Bold','Italic', ] },
						{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
						
						{ name: 'font', items : [ 'Font','TextColor'] }		
																	
					]
					
					
				});
	     </script>
	  <script type="text/javascript">
			function popup_sosmed(url) 
			{
				 var width  = 600;
				 var height = 350;
				 var left   = (screen.width  - width)/2;
				 var top    = (screen.height - height)/2;
				 var params = 'width='+width+', height='+height;
				 params += ', top='+top+', left='+left;
				 params += ', directories=no';
				 params += ', location=no';
				 params += ', menubar=no';
				 params += ', resizable=no';
				 params += ', scrollbars=no';
				 params += ', status=no';
				 params += ', toolbar=no';
				 newwin=window.open(url,'windowname5', params);
				 if (window.focus) {newwin.focus()}
				 return false;
			}
		</script>
		</body>
</html>


