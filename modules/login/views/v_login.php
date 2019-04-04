	<script type="text/javascript">
		$(document).ready(function(){
			var username = $( "#username" ),
				password = $( "#password" ),
				company  = $( "#company" ),
				allFields = $( [] ).add( username ).add( password );
				tips = $( ".validateTips" );
				baseUrl = '<?php echo site_url();?>'
				
			$( "#loginBox" ).dialog({
				title:'',
				autoOpen: true,
				width: 350,
				modal: true,
				draggable: false,
				resizable: false,
				closeText: "hide" ,
				dialogClass: "noClose",
				position: { my: "top-55%", at: "center", of: window  },
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
	
	<div id="loginBox">
		<div class="login-logo" align="center">
			<a href="#"><a href="#"> <img title='Logo BBPMSOH' src='<?php echo base_url()?>/assets/bbpmsoh/LogoBBPMSOH.png' style='max-width: 100%;max-height:170px'/></a></a>
			<h3>Sistem Terpadu  <br /> Pengujian Mutu dan Sertifikasi Obat Hewan</h3>
		</div><!-- /.login-logo -->
		<p class="validateTips"></p>
		<form id="formLogin">
			<fieldset>
				<label for="name"><?php echo $this->lang->line('login_box_name');?></label>
				<input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
				<label for="password"><?php echo $this->lang->line('login_box_pass');?></label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
				<label for="company">Instansi <!-- <?php echo $this->lang->line('login_box_comp');?> --></label>
				<select name="company" id="company" class="text ui-widget-content ui-corner-all" style="cursor:pointer;"><?php echo $getCompany;?></select>
			</fieldset>
			<div class='row'>
                <div class='col-xs-12' align="left">
                	<p style="padding:10px 0px 10px 0px">
	                	<a href='<?php echo base_url()?>registrasi'><strong>Form Registrasi</strong></a>, 
	                	<!-- <br /> Jika Anda lupa Password 
	                	<a href='<?php echo base_url()?>lupapassword'><strong>Klik disini!</strong></a> -->
                	</p>
                </div>
            </div>
		</form>
	</div>
	