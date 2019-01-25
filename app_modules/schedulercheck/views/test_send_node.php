<div class="content">
	<div class="box_content_form">
		<div class="full_colums">
			<div class="top_form_head">									
				<span class="form_head top-head-content">Sending Message</span>
			</div>
			<form class="form_horizontal_plc" enctype="multipart/form-data" method="post" action="<?php echo $urlform ?>" id="form_create_<?php echo $field?>">
				<div class="rows_group" style="overflow:auto;">
					<label for="<?php echo $field?>_to" class="rows_label">To <span class="required_bintang">*</span></label>
					<div class="rows_input">
						<input name="<?php echo $field?>_to" id="<?php echo $field?>_to" class="input_rows1 required" size="25" type="text" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="rows_group" style="overflow:auto;">
					<label for="<?php echo $field?>_cc" class="rows_label">CC <span class="required_bintang">*</span></label>
					<div class="rows_input">
						<input name="<?php echo $field?>_cc" id="<?php echo $field?>_cc" class="input_rows1 required" size="25" type="text" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="rows_group" style="overflow:auto;">
					<label for="<?php echo $field?>_subject" class="rows_label">Subject <span class="required_bintang">*</span></label>
					<div class="rows_input">
						<input name="<?php echo $field?>_subject" id="<?php echo $field?>_subject" class="input_rows1 required" size="25" type="text">
					</div>
				</div>
				<div class="rows_group" style="overflow:auto;">
					<label for="<?php echo $field?>_message" class="rows_label">Message<span class="required_bintang">*</span></label>
					<div class="rows_input">
						<textarea name="<?php echo $field?>_message" id="<?php echo $field?>_message" style="width: 350px; height: 100px;" size="250" class="input_rows1 required"></textarea>
					</div>
				</div>
			</form>
			<em><span class="required_bintang">*</span> Fields Required</em>
		</div>
		<div class="clear"></div>
		<div class="control-group-btn">
			<div class="left1-control-group-btn"></div>
			<div class="left-control-group-btn">
				<?php echo $button ?>			
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	function send_nodejs_tes(){
		grid = 'send_mail';
		var socket = io.connect( 'http://10.1.49.8:19391' );
		var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
		var conf=0;
		var alert_message = '';
		var uploadField = $('#form_create_'+grid+' input.multifile');
		var uploadLimit = 0;

		$.each(req, function(i,v){
			$(this).removeClass('error_text');
			if($(this).val() == '') {
				var id = $(this).attr('id');
				var label = $("label[for='"+id+"']").text();
				label = label.replace('*','');
				alert_message += '<br /><b>'+label+'</b> '+required_message;			
				$(this).addClass('error_text');			
				conf++;
			}		
		})
		if(conf > 0) {
			_custom_alert(alert_message,'Error!','info',grid, 1, 5000);
		}else{
			custom_confirm(comfirm_message,function(){
				$.ajax({
					url: $('#form_create_'+grid).attr('action'),
					type: 'post',
					data: $('#form_create_'+grid).serialize(),
					success: function(data) {
						var o = $.parseJSON(data);
						var info = 'Info';
						var header = 'Info';
						if(o.status == true){
							nilai=o.datacount;
							socket.emit('new_count_message', { 
						        new_count_message: nilai
						   	});
							 req.val('');
							_custom_alert('Data Berhasil Dikirim !',header,info, grid, 1, 20000);
		                    
						}else{							
							_custom_alert(o.message,header,info, grid, 1, 20000);
							info = 'info';
							header = 'Info';
						}				
					}
				})
			});
		}
	}
</script>