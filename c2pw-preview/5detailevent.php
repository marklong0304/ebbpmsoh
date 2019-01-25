<?php // connect to the database
include ('connect-db.php');
?>
<!-- BREAK -->

<!-- BREAK -->

<!-- BREAK -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title> Event Temui booth kami di tempat Gym dan dapatkan promo menarik </title>
		<meta name="keyword" 				   content="fitamino | Suplemen Kesehatan, " />
		<meta property="og:url"                content="" />
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="Temui booth kami di tempat Gym dan dapatkan promo menarik" />
		<meta property="og:description"        content="" />
		<meta property="og:image"              content="../assets/c2pw/" />
		<meta name="csrf-token" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link type="image/ico" rel="shortcut icon" href="../assets/c2pw/fitamino/images/fitamino/logo_fitamino.png">
		<!-- CSRF Token -->
		<noscript>
			<link rel="stylesheet" href="../assets/c2pw/fitamino/css/style.css" />
		</noscript>

	</head>
	<body id="top">
		<!-- HEADER -->
		<header id="header" class="skel-layers-fixed">
			<div class="tophead">
				<div class="wrapper sosmed">

					<!--
					<a href="#"><img src="../assets/c2pw/fitamino/images/fitamino/fb_fitamino.png" height="34" /></a>
					<a href="#"><img src="../assets/c2pw/fitamino/images/fitamino/ig_fitamino.png" height="34" /></a>
					-->
					<ul class="icons" style="color: #fff; font-size: 14px;">
						<li>
							Follow Us :
						</li>
						<li>
							<a href="#" class="icon fa-facebook" style="color: #257cd5;"><span class="label">Facebook</span><span  style="color: #fff;"> Fitamino12jam</span></a>
						</li>
						<li>
							<a href="#" class="icon fa-instagram" style="color: #f261c9"><span class="label"  style="color: #fff;">Instagram</span><span  style="color: #fff;"> Fitamino12jam</span></a>
						</li>
						<li>
							|
							<a href="#login"><i class="fa fa-unlock-alt" style="color: #E27A7A"></i> <span style="color: #fff;"> Login</span></a>

						</li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="wrapper boxmenu" style="">
				<a href="#"><img src="../assets/c2pw/fitamino/images/fitamino/logo_fitamino.png" class="logo" /></a>
				<nav id="nav">
					<div class="boxUserMobile">
						<div>
							<a href="#login"><i class="fa fa-unlock-alt" style="color: #E27A7A"></i> <span style="color: #fff;"> Login</span></a>

						</div>
					</div>
					<ul>
						<li>
							<a id="menuHome"  href="#"> Beranda </a>
						</li>
						<li>
							<a id="menuProduk" href="#"> Produk </a>
						</li>
						<li>
							<a id="menuArtikel" href="#"> Artikel </a>
						</li>
						<li>
							<a id="menuBeli" href="#"> Beli dimana ? </a>
						</li>
						<li>
							<a id="menuEvent" href="#"> Event </a>
						</li>
						<li>
							<a id="menuPromo" href="#"> Promo </a>
						</li>
						<li>
							<a id="menuTestimoni" href="#"> Testimoni </a>
						</li>
						<li>
							<a id="menuKeluhan" href="#"> Keluhan & Pertanyaan </a>
						</li>
					</ul>
					<div class="boxUserMobile">
						<div>
							Follow Us :
							<br />
							<a href="#" class="icon fa-facebook" style="color: #257cd5;"><span class="label">Facebook</span><span  style="color: #fff;"> Fitamino12jam</span></a>
							<br />
							<a href="#" class="icon fa-instagram" style="color: #f261c9"><span class="label"  style="color: #fff;">Instagram</span><span  style="color: #fff;"> Fitamino12jam</span></a>
						</div>
				</nav>
			</div>
		</header>

		<!-- Slideshow -->
		<section class="boxSLide wrapper">
			<div class="inner">

			</div>
		</section>

		<!-- konten -->
		<div class="wrapper">
			<div class="divwrap">
				<div class="divcontent">
					<section>
						<?php $id = $_GET['id'];
						$cGroup2 = $_GET['cGroup2'];
						if ($result = $mysqli -> query("SELECT * FROM smsc.event where iEventid ='$id' And cGroup2 ='$cGroup2' ")) {
							// display records if there are records to display
							if ($result -> num_rows > 0) {
								while ($row = $result -> fetch_object()) {
									$date = $row -> created_at;
									$format = date('d-m-Y | H:i:s', strtotime($date));
									
									if (!file_exists('../'.$row->vImageUtama) || $row->vImageUtama == ''){
										$fotonya = '../assets/c2pw/fitamino/images/fitamino/no-image-fitamino.png';										
									} else {											
										$fotonya = '../'.$row->vImageUtama;	
									}
									
									echo '
									    
										<div class="boxJudul">
											<h2 class="judulHed">' . $row -> vJudul . '</h2>
											Tanggal Acara : ' . date('d-m-Y', strtotime($row -> vTglAcaraStart)) . ' -  ' . date('d-m-Y', strtotime($row -> vTglAcaraFinish)) . '
										</div>
										<img class="image fitDetimg" src="'.$fotonya.'" class="imgListArtklFullEvent">
										<div class="datePost">'.$format.' | oleh : Admin</div>
										<div class="clear"></div><br>
										<div>' . $row -> vLengkap . '</div>
										 ';
									
								}

							} else {
								echo "No results to display!";
							}
						} else {
							echo "Error: " . $mysqli -> error;
						}
						?>
						
						<?php $id = $_GET['id'];
						if ($result = $mysqli -> query("SELECT * FROM smsc.eventimages where iEventid ='$id'")) {
							// display records if there are records to display
							if ($result -> num_rows > 0) {
								while ($row = $result -> fetch_object()) {
									$date = $row -> created_at;
									$format = date('d-m-Y | H:i:s', strtotime($date));
									
									if (!file_exists('../'.$row->vImages) || $row->vImages == ''){
										$fotonya = '../assets/c2pw/fitamino/images/fitamino/no-image-fitamino.png';										
									} else {											
										$fotonya = '../'.$row->vImages;	
									}
									
									echo '
										<div class="boxTiga">
												<section class="special ">
													<a href="'.$fotonya.'" class="fresco"	data-fresco-group="events" data-fresco-caption="Temui booth kami di tempat Gym dan dapatkan promo menarik"> 
													<img src="'.$fotonya.'"  class="image fit"/> 
													</a>
												</section> 
											</div> ';
									
								}

							} else {
								//echo "No results to display!";
							}
						} else {
							echo "Error: " . $mysqli -> error;
						}
						?>
						<div class="clear"></div>
						<div class="boxBTN23" align="center">
							<a href="https://www.instagram.com/fitamino12jam/" target="_blank"class="linkArtFull">More Photos ... </a>
							<br />						
						</div>
					</section>
					<ul class="icons">
						<li>
							Bagikan :
						</li>
						<li>
							<a href="javascript: void(0)" onclick="popup_sosmed('https://twitter.com/share')" class="icon fa-twitter"><span class="label">Twitter</span></a>
						</li>
						<li>
							<a href="javascript: void(0)" onclick="popup_sosmed('http://www.facebook.com/sharer.php?u=http://www.fitamino.co.id/event-13-Temui-booth-kami-di-tempat-Gym-dan-dapatkan-promo-menarik')"  class="icon fa-facebook"><span class="label">Facebook</span></a>
						</li>
					</ul>
				</div>
				<div class="divright">
					<div class="special">
						<h3 style="font-weight: normal;">Event lain</h3>
						<?php
								$id = $_GET['id'];
								$cGroup2 = $_GET['cGroup2'];
								if ($result = $mysqli->query("SELECT * FROM event where ldeleted = '0' and cGroup2 ='$cGroup2'  ORDER BY RAND() limit 5" )) {
								// display records if there are records to display
								if ($result->num_rows > 0)
								{						
									while ($row = $result->fetch_object())
									{
										if (!file_exists('../'.$row->vImageUtama) || $row->vImageUtama == ''){
											$fotonya = '../assets/c2pw/fitamino/images/fitamino/no-image-fitamino.png';										
										} else {											
											$fotonya = '../'.$row->vImageUtama;	
										}
										echo '
											<section class="">
												<div class="boxImgeList">
													<a href="/event-13-Temui-booth-kami-di-tempat-Gym-dan-dapatkan-promo-menarik"> <img src="' . $fotonya . '" class="image fit"> </a>
												</div>
												<div class="boxlistJudul">
													<p>
														'.$row->vJudul.'
													</p>
												</div>
											</section>
											<div class="clear"></div>
											
										';
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
										
					</div>

				</div>
			</div>
			<hr class="major" />
		</div>
		<div class="clear"></div>

		<script type="text/javascript" src="../assets/c2pw/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#menuEvent').addClass('button special');
			});
		</script>
		<script type="text/javascript" src="../assets/c2pw/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../assets/c2pw/js/fresco.js"></script>
		<link href="../assets/c2pw/css/fresco/fresco.css" rel="stylesheet" type="text/css" media="screen" />

		<!-- Footer -->
		<footer>
			<div id="boxLog">
				<div class="wrapper" id="login">
					<div class="btm">
						<div class="RightFtr">
							<div class="bgSign">
								<h2>Sign Up / Sign In</h2>
								<div>
									<!-- <form action="http://c2fit.co.id/submitlogin" class="form_horizontal" method="post" id="flogin"> -->
									<form method="post" action="/login" enctype="multipart/form-data">
										<input type="hidden" name="_token" value="WWICRkD8gNcx7HyJs92GshFvkamP3Ly4AmjbZCak">
										<p>
											Daftarkan email anda dan dapatkan info-info terbaru dari C2FIT, atau kirim kritik dan saran kamu tentang C2FIT
										</p>
										<div class="formInpt">
											<input type="email" name="email" id="email" placeholder="Masukan Email Anda" class="input_rows1"  />
										</div>
										<div class="formInpt">
											<input type="password" name="password" id="password" placeholder="Masukan Password Anda" class="input_rows1"  />
										</div>
										<!--
										<div class="formInpt">
										<textarea name="isi" placeholder="Komentar dan Saran" class="textE100"></textarea>
										</div> -->
										<div class="boxBTN23">
											<input type="submit" value="Masuk" class="btnCari" />
										</div>
										<div>
											Belum punya akun, <a href="/register" style="color: #cc0000;">Registrasi disini!</a>
										</div>
										<div>
											Lupa Password, <a href="/lupapassword" style="color: #cc0000;">Klik disini!</a>
										</div>

									</form>
									<!-- </form> -->
								</div>

							</div>
						</div>
						<div class="leftFtr">
							<img src="../assets/c2pw/fitamino/images/fitamino/footer_logo.png"  class="logoFotter">
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</footer>
		<div id="boxFtr">

		</div>

		<script type="text/javascript" src="../assets/c2pw/fitamino/js/jquery.min.js"></script>
		<script src="../assets/c2pw/js/functionC2fit.js"></script>
		<script type="text/javascript" src="../assets/c2pw/js/texteditor/ckeditor/ckeditor.js"></script>
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
		<script src="../assets/c2pw/js/jquery.validate.min.js"></script>
		<script>
			function check_availability() {
				var username = $('#email').val();
				$.ajax({
					beforeSend : function() {
						$('#loading').html('<img src="../assets/c2pw/fitamino/images/camera-loader.gif" alt="loading" />');
					},
					type : 'GET',
					url : '/checkemail/' + username,
					data : '_token = WWICRkD8gNcx7HyJs92GshFvkamP3Ly4AmjbZCak',
					success : function(data) {
						if (data.msg == "true") {
							$("#loading").html("<span style='color:#ce296d;'>Email Sudah Terdaftar</span>");
							$('input[type="submit"]').attr('disabled', 'disabled');
						} else {
							$("#loading").html("");
							$('input[type="submit"]').removeAttr('disabled');
						}
					}
				});
			}

			function check_password() {
				var password = $('#password').val();
				var password2 = $('#password2').val();
				if (password != password2) {
					$("#passcek").html("<span style='color:#ce296d;'>Password Tidak Sama</span>");
					$('input[type="submit"]').attr('disabled', 'disabled');
				} else {
					$("#passcek").html("");
					$('input[type="submit"]').removeAttr('disabled');
				}
			}

			function check_password2() {
				var password = $('#password').val();
				var password2 = $('#password2').val();
				if (password != password2) {
					$("#passcek").html("<span style='color:#ce296d;'>Password Tidak Sama</span>");
				} else {
					$("#passcek").html("");
				}
			}


			document.addEventListener("DOMContentLoaded", function() {
				var elements = document.getElementsByTagName("INPUT");
				for (var i = 0; i < elements.length; i++) {
					elements[i].oninvalid = function(e) {
						e.target.setCustomValidity("");
						if (!e.target.validity.valid) {
							$("#blank").html("<span style='color:#ce296d;'>* Semua Field Wajib Diisi</span>");
						}
					};
					elements[i].oninput = function(e) {
						e.target.setCustomValidity("");
					};
				}
			})
		</script>

		<!-- the jScrollPane script -->
		<script type="text/javascript" src="../assets/c2pw/fitamino/js/skel.min.js"></script>
		<script type="text/javascript" src="../assets/c2pw/fitamino/js/skel-layers.min.js"></script>
		<script>
			(function($) {

				skel.init({
					reset : 'full',
					breakpoints : {

						// Global.
						global : {
							range : '*',
							href : '../assets/c2pw/fitamino/css/style.css',
							containers : 1400,
							grid : {
								gutters : {
									vertical : '4em',
									horizontal : 0
								}
							}
						},

						// XLarge.
						xlarge : {
							range : '-1680',
							href : '../assets/c2pw/fitamino/css/style-xlarge.css',
							containers : 1200
						},

						// Large.
						large : {
							range : '-1280',
							href : '../assets/c2pw/fitamino/css/style-large.css',
							containers : 960,
							grid : {
								gutters : {
									vertical : '2.5em'
								}
							},
							viewport : {
								scalable : false
							}
						},

						// Medium.
						medium : {
							range : '-980',
							href : '../assets/c2pw/fitamino/css/style-medium.css',
							containers : '90%',
							grid : {
								collapse : 1
							}
						},

						// Small.
						small : {
							range : '-736',
							href : '../assets/c2pw/fitamino/css/style-small.css',
							containers : '90%',
							grid : {
								gutters : {
									vertical : '1.25em'
								}
							}
						},

						// XSmall.
						xsmall : {
							range : '-480',
							href : '../assets/c2pw/fitamino/css/style-xsmall.css',
							grid : {
								collapse : 2
							}
						}

					},
					plugins : {
						layers : {

							// Config.
							config : {
								transform : true
							},

							// Navigation Panel.
							navPanel : {
								animation : 'pushX',
								breakpoints : 'medium',
								clickToHide : true,
								height : '100%',
								hidden : true,
								html : '<div data-action="moveElement" data-args="nav"></div>',
								orientation : 'vertical',
								position : 'top-left',
								side : 'left',
								width : 250
							},

							// Navigation Button.
							navButton : {
								breakpoints : 'medium',
								height : '4em',
								html : '<span class="toggle" data-action="toggleLayer" data-args="navPanel"></span><div class="divLogo"><a href="#"><img src="../assets/c2pw/fitamino/images/fitamino/logo_fitamino.png" class="logo" /></a></div>',
								position : 'top-left',
								side : 'top',
								width : '100%'
							}

						}
					}
				});

				$(function() {

					// jQuery ready stuff.

				});

			})(jQuery);
		</script>
		<link rel="stylesheet" href="../assets/c2pw/fitamino/css/style-m.css" />
	</body>
	<script type="text/javascript">
		function popup_sosmed(url) {
			var width = 600;
			var height = 350;
			var left = (screen.width - width) / 2;
			var top = (screen.height - height) / 2;
			var params = 'width=' + width + ', height=' + height;
			params += ', top=' + top + ', left=' + left;
			params += ', directories=no';
			params += ', location=no';
			params += ', menubar=no';
			params += ', resizable=no';
			params += ', scrollbars=no';
			params += ', status=no';
			params += ', toolbar=no';
			newwin = window.open(url, 'windowname5', params);
			if (window.focus) {
				newwin.focus()
			}
			return false;
		}

	</script>
</html>
