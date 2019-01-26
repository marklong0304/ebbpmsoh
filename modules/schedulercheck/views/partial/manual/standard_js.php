<script type="text/javascript">
    // datepicker
     $(".tanggal").datepicker({changeMonth:true,
                                changeYear:true,
                                dateFormat:"yy-mm-dd" });

    // input number
       $(".angka").numeric();

    /*erp Message*/
    var full = $("#infomodule").text().split(':');
    var part1 = full[1].split('/');

function save_draft_btn_multiupload(grid, url, dis, isdraft) {
    
    var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
    var conf=0;
    var alert_message = '';
    var uploadField = $('#form_create_'+grid+' input.multifile');
    var uploadLimit = 0;
    var isUpload = uploadField.length;
    
    if(isUpload) {
        uploadLimit = 5242880;//$('#'+grid+'_fileupload').attr('limit');
    }

    if(isdraft != undefined) {
        $('#form_create_'+grid+' #isdraft').val(isdraft);
    }
    
    /*untuk draft tidak ada pengecekan required field*/
    /*$.each(req, function(i,v){
        $(this).removeClass('error_text');
        if($(this).val() == '') {
            var id = $(this).attr('id');
            var label = $("label[for='"+id+"']").text();
            label = label.replace('*','');
            alert_message += '<br /><b>'+label+'</b> '+required_message;            
            $(this).addClass('error_text');         
            conf++;
        }       
    })*/

    
    if(conf > 0) {
        _custom_alert(alert_message,'Error!','info',grid, 1, 5000);
    }
    else {
        custom_confirm(comfirm_message,function(){
            if(isUpload && !isValidAFileSize('#form_create_'+grid+' input.multifile', uploadLimit)) {
                alert('File maks 5MB!');
            } else {
                $.ajax({
                    url: $('#form_create_'+grid).attr('action'),
                    type: 'post',
                    data: $('#form_create_'+grid).serialize(),
                    success: function(data) {   
                        var o = $.parseJSON(data);                                              
                        var info = 'Info';
                        var header = 'Info';
                        var last_id = o.last_id;
                        var company_id = o.company_id;
                        var group_id = o.group_id;
                        var modul_id = o.modul_id;      
                        if(o.status == true) {
                            if(isUpload) {
                                var iframe = $('<iframe name='+grid+'"_frame"/>');
                                iframe.attr({'id':grid+'_frame'});
                                $('#form_create_'+grid).parent().append(iframe);
                                
                                var formAction = $('#form_create_'+grid).attr('action');
                                formAction+='&isUpload=1';
                                formAction+='&lastId='+o.last_id;
                                formAction+='&uploadLimit='+uploadLimit;
                                formAction+='&company_id='+o.company_id;
                                formAction+='&isdraft='+isdraft;
                                
                                $('#form_create_'+grid).attr('action',formAction);
                                $('#form_create_'+grid).attr('target',grid+'_frame');

                                uploadfile('form_create_'+grid, grid, formAction, url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id);                             
                            }else{
                                _custom_alert('Data Berhasil Disimpan !',header,info, grid, 1, 20000);
                                $('#grid_'+grid).trigger('reloadGrid');
                                reload_grid_new(part1[1],grid);
                                
                                $.get(url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id, function(data) {
                                    $('div#form_'+grid).html(data);
                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                });

                            }
                            $('#grid_'+grid).trigger('reloadGrid');
                            reload_grid_new(part1[1],grid);
                            
                                                    
                        }
                        else{
                            _custom_alert(o.message,header,info, grid, 1, 20000);
                            info = 'info';
                            header = 'Info';
                        }
                        
                    }

                })
                
            }
        })
    }   
}

function save_btn_multiupload(grid, url, dis) {
    var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
    var conf=0;
    var alert_message = '';
    var uploadField = $('#form_create_'+grid+' input.multifile');
    var uploadLimit = 0;
    var isUpload = uploadField.length;
    
    if(isUpload) {
        uploadLimit = 5242880;
    }


    
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
    if($("#ppic_memo_busdev_cPIC").val()==''){
            $("#ppic_memo_busdev_cPIC_text").addClass('error_text');    
            conf++;
        }
        if($("#ppic_memo_busdev_iupb_id").val()==''){
            $("#ppic_memo_busdev_iupb_id_dis").addClass('error_text');  
            conf++;
        }

    
    if(conf > 0) {
        _custom_alert(alert_message,'Error!','info',grid, 1, 5000);
    }
    else {
        custom_confirm(comfirm_message,function(){
            if(isUpload && !isValidAFileSize('#form_create_'+grid+' input.multifile', uploadLimit)) {
                alert('File maks 5MB!');
            } else {
                $.ajax({
                url: $('#form_create_'+grid).attr('action'),
                type: 'post',
                data: $('#form_create_'+grid).serialize(),
                success: function(data) {
                    var o = $.parseJSON(data);
                    var info = 'Info';
                    var header = 'Info';
                    var last_id = o.last_id;
                    var company_id = o.company_id;
                    var group_id = o.group_id;
                    var modul_id = o.modul_id;
                        if(o.status == true){
                            if(isUpload) {
                                var iframe = $('<iframe name='+grid+'"_frame"/>');
                                iframe.attr({'id':grid+'_frame'});
                                $('#form_create_'+grid).parent().append(iframe);
                                
                                var formAction = $('#form_create_'+grid).attr('action');
                                formAction+='&isUpload=1';
                                formAction+='&lastId='+o.last_id;
                                formAction+='&uploadLimit='+uploadLimit;
                                formAction+='&company_id='+o.company_id;
                                
                                $('#form_create_'+grid).attr('action',formAction);
                                $('#form_create_'+grid).attr('target',grid+'_frame');

                                uploadfile('form_create_'+grid, grid, formAction, url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id);

                            }else{
                                _custom_alert(o.message,header,info, grid, 1, 20000);
                                $('#grid_'+grid).trigger('reloadGrid');
                                reload_grid_new(part1[1],grid);
                                info = 'info';
                                header = 'Info';
                                
                                $.get(url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id, function(data) {
                                        $('div#form_'+grid).html(data);
                                        $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                }); 
                            }
                            $('#grid_'+grid).trigger('reloadGrid');
                            reload_grid_new(part1[1],grid);
                        }
                        else{
                            
                            _custom_alert(o.message,header,info, grid, 1, 20000);
                            info = 'info';
                            header = 'Info';
                        }   
                    }
                    
                })
            }
        })
    }       
}

function update_draft_btn(grid, url, dis, isdraft) {
    var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
    var conf=0;
    var alert_message = '';
    var uploadField = $('#form_update_'+grid+' input.multifile');
    var uploadLimit = 0;
    var isUpload = uploadField.length;
    
    if(isdraft ==true) {
        $('#form_update_'+grid+' #isdraft').val(isdraft);
    }
    if(isUpload) {
        uploadLimit = 5242880;
    }
    
    /*untuk draft tidak ada pengecekan required*/
    /*$.each(req, function(i,v){
        $(this).removeClass('error_text');
        if($(this).val() == '') {
            var id = $(this).attr('id');
            var label = $("label[for='"+id+"']").text();
            label = label.replace('*','');
            alert_message += '<br /><b>'+label+'</b> '+required_message;            
            $(this).addClass('error_text');         
            conf++;
        }       
    })*/

    if(conf > 0) {
        _custom_alert(alert_message,'Error!','info',grid, 1, 5000);
    }
    else {
        custom_confirm(comfirm_message,function(){
            if(isUpload && !isValidAFileSize('#form_update_'+grid+' input.multifile', uploadLimit)) {

            } else {                
                $.ajax({
                url: $('#form_update_'+grid).attr('action'),
                type: 'post',
                data: $('#form_update_'+grid).serialize(),
                success: function(data) {
                    var o = $.parseJSON(data);
                    var info = 'Info';
                    var header = 'Info';
                    var last_id = o.last_id;
                    var company_id = o.company_id;
                    var group_id = o.group_id;
                    var modul_id = o.modul_id;
                    if(o.status == true){
                        if(isUpload) {

                            var iframe = $('<iframe name='+grid+'"_frame"/>');
                            iframe.attr({'id':grid+'_frame'});
                            $('#form_update_'+grid).parent().append(iframe);
                            
                            var formAction = $('#form_update_'+grid).attr('action');
                            formAction+='&isUpload=1';
                            formAction+='&lastId='+o.last_id;
                            formAction+='&uploadLimit='+uploadLimit;
                            formAction+='&company_id='+o.company_id;
                            formAction+='&isdraft='+isdraft;
                            
                            $('#form_update_'+grid).attr('action',formAction);
                            $('#form_update_'+grid).attr('target',grid+'_frame');

                            uploadfile('form_update_'+grid, grid, formAction, url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id);
                            
                                                    
                            }else{
                            _custom_alert('Data Berhasil Disimpan!',header,info, grid, 1, 20000);
                            $.get(url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id, function(data) {
                                    $('div#form_'+grid).html(data);
                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                            });
                        }
                        $('#grid_'+grid).trigger('reloadGrid');
                        reload_grid_new(part1[1],grid);
                        
                    }
                    else{
                        
                        _custom_alert(o.message,header,info, grid, 1, 20000);
                        info = 'info';
                        header = 'Info';
                    }               
                }
                })
                }
        })      
    }
}

function update_btn(grid, url, dis) {
    var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
    var conf=0;
    var alert_message = '';
    var uploadField = $('#form_update_'+grid+' input.multifile');
    var uploadLimit = 0;
    var isUpload = uploadField.length;
    
    if(isUpload) {
        uploadLimit = 5242880;
    }
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
    }
    else {
        custom_confirm(comfirm_message,function(){
            $.ajax({
                url: $('#form_update_'+grid).attr('action'),
                type: 'post',
                data: $('#form_update_'+grid).serialize(),
                success: function(data) {
                    var o = $.parseJSON(data);
                    var info = 'Info';
                    var header = 'Info';
                    var last_id = o.last_id;
                    var company_id = o.company_id;
                    var group_id = o.group_id;
                    var modul_id = o.modul_id;
                    if(o.status == true) {
                        //$('#form_update_'+grid)[0].reset();
                        info = 'info';
                        header = 'Info';
                    }
                    _custom_alert('Data Berhasil Disimpan !',header,info, grid, 1, 20000);
                    $('#grid_'+grid).trigger('reloadGrid');
                    reload_grid_new(part1[1],grid);
                }
            })
        })
    }       
}

function update_btn_back(grid, url, dis) {
    var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
    var conf=0;
    var alert_message = '';
    //alert("test");
    var uploadField = $('#form_update_'+grid+' input.multifile');
    var uploadLimit = 0;
    var isUpload = uploadField.length;
    
    if(isUpload) {
        uploadLimit = 5242880;
    }
    
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
    }
    else {
        custom_confirm(comfirm_message,function(){
            if(isUpload && !isValidAFileSize('#form_update_'+grid+' input.multifile', uploadLimit)) {
                alert('File maks 5MB!');
            } 
            else{
                $.ajax({
                url: $('#form_update_'+grid).attr('action'),
                type: 'post',
                data: $('#form_update_'+grid).serialize(),
                success: function(data) {
                    
                    //alert(isUpload);
                    var o = $.parseJSON(data);
                    var info = 'Info';
                    var header = 'Info';
                    var last_id = o.last_id;
                    var company_id = o.company_id;
                    var group_id = o.group_id;
                    var modul_id = o.modul_id;
                    if(o.status == true){
                        if(isUpload > 0) {              
                            //alert('tes');                             
                            var iframe = $('<iframe name="'+grid+'_frame"/>');
                            iframe.attr({'id':grid+'_frame'});
                            $('#form_update_'+grid).parent().append(iframe);
                            
                            var formAction = $('#form_update_'+grid).attr('action');
                            formAction+='&isUpload=1';
                            formAction+='&lastId='+o.last_id;
                            formAction+='&uploadLimit='+uploadLimit;
                            formAction+='&company_id='+o.company_id;
                            $('#form_update_'+grid).attr('action',formAction);
                            $('#form_update_'+grid).attr('target',grid+'_frame');
                            
                            uploadfile('form_update_'+grid, grid, formAction, url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id);

                         }else{
                            _custom_alert('Data Berhasil Disimpan !',header,info, grid, 1, 20000);
                            info = 'info';
                            header = 'Info';
                            
                            $.get(url+'&action=update&foreign_key=0&company_id='+company_id+'&id='+last_id+'&group_id='+group_id+'&modul_id='+modul_id, function(data) {
                                    $('div#form_'+grid).html(data);
                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                            });
                        }
                        $('#grid_'+grid).trigger('reloadGrid');
                        reload_grid_new(part1[1],grid);
                    }
                    else{
                        
                        _custom_alert(o.message,header,info, grid, 1, 20000);
                        info = 'info';
                        header = 'Info';
                    }
                }
                })
             }  
            
    })      
}
}   
</script>

