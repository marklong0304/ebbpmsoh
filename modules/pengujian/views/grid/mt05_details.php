<?php
//Config Variable//
$grid="pengujian_".$url;
$nmmodule=$field;
$nmTable="tb_details_".$grid;
$pager="pager_tb_details_".$grid;
$caption = "";
$isubmit=isset($isubmit)?$isubmit:0;
$pk=isset($pk)?$pk:0;
$arrSearch=array('iAction'=>'Del','vnomor_03'=>'Nomor Pengujian','vNama_sample'=>'Nama Sample','vNama_produsen'=>'Produsen','vZat_aktif'=>'Zat Aktif / Strain','vNo_registrasi'=>'No. Registrasi','vBatch_lot'=>'No. Batch','dTgl_kadaluarsa'=>'Waktu Kadaluarsa','vKemasan'=>'Kemasan','iJumlah_diserahkan'=>'Jumlah Sample','cKode'=>'Keterangan');
$wsearch=array('iAction'=>30,'vnomor_03'=>250,'vNama_sample'=>250,'vNama_produsen'=>200);
$alsearch=array('iAction'=>'center');
foreach ($get as $kget => $vget) {
    if($kget!="action"){
        $in[]=$kget."=".$vget;
    }elseif($kget=="action"){
        $in[]="act=".$vget;
    }
}

$g=implode("&", $in);
$g=$g."&isubmit=".$isubmit;
$getUrl=str_replace('_','/',$grid);
$getUrl=$nmmodule.'/'.$getUrl;
?>

<script type="text/javascript">
	$("label[for='<?php echo $id ?>']").parent().html('<div style="padding-left:10px"><table id="<?php echo $nmTable ?>"></table><div id="<?php echo $pager ?>"></div><iframe height="0" width="0" id="iframe_preview_<?php echo $grid; ?>"></iframe></div>');
    $grid=$("#<?php echo $nmTable ?>");
    <?php
    $nmf=array();
    foreach ($arrSearch as $kv => $vv) {
        $nmf[]="'".$kv."'";
        $cn[]="'".$vv."'";
        $wi=isset($wsearch[$kv])?",width: ".$wsearch[$kv]:"";
        $al=isset($alsearch[$kv])?",align: '".$alsearch[$kv]."'":"";
        $cm[]="{name:'".$kv."'".$wi.$al."}";
    }
    ?>
    var outerwidth = $grid.parent().width() - 20;
    $grid.jqGrid({
        url: base_url+"processor/<?php echo $urlpath ?>?action=get_data_prev",
        postData: {id:'<?php echo $pk ?>',nmTable:'<?php echo $nmTable ?>',grid:'<?php echo $grid ?>'},
        datatype: "json",
        mtype:'POST',
        colNames: [<?php echo implode(",", $cn)?>],
        colModel: [
           <?php echo implode(",", $cm); ?> 
        ],
        loadonce: true,
        rowNum: '1000',
        pager:'#<?php echo $pager; ?>',
        width:outerwidth,
        shrinkToFit:false,
        rownumbers:true,

        pgbuttons: false,
        pginput: false,
        pgtext: "",

        caption:"<?php echo $caption ?>",
        autowidth:false,
        cmTemplate: {
            title: false,
            sortable: false
        },
        gridComplete: function () {
            $('#lbl_rowcount').val($grid.getGridParam('records'));
            $(".icon-play").button({
                icons:{
                    primary: "ui-icon-play"
                },
                text: true
            });
            $(".icon-extlink").button({
                icons:{
                    primary: "ui-icon-extlink"
                },
                text: true
            }); 
            $(".icon-disk").button({
                icons:{
                    primary: "ui-icon-disk"
                },
                text: true
            });
            $(".icon-pause").button({
                icons:{
                    primary: "ui-icon-pause"
                },
                text: true
            });
            $(".icon-stop").button({
                icons:{
                    primary: "ui-icon-stop"
                },
                text: true
            });

            $( "button.icon_hapus" ).button({
                icons: {
                    primary: "ui-icon-close"
                },
                text: true
            });
        }

    });

    jQuery("#<?php echo $nmTable ?>").jqGrid('gridResize',{minWidth:300,maxWidth:790,minHeight:80, maxHeight:370}).navGrid('#<?php echo $pager; ?>',{edit:false,add:false,del:false,search:false,refresh:false})
   <?php if($get['action']!='view' and $isubmit==0){ ?>
            .navButtonAdd('#<?php echo $pager; ?>',{
               caption:"Tambah", 
               buttonicon:"ui-icon-plus", 
               onClickButton: function(){ 
                addrow_<?php echo $nmTable; ?>();
               }, 
               position:"last"
            })
    <?php 
    }
    ?>
    

    function addrow_<?php echo $nmTable; ?>(){
            //get last num rows
            var n='';
            var i=0;
            $.each($(".num_rows_<?php echo $nmTable; ?>"),function(){
                if(i==0){
                    n+=$(this).val();
                }else{
                    n+=','+$(this).val();
                }
                i++;
            });
            if(n==""){
                var rlast=1;   
            }else{
                alert('Hanya 1 Penerimaan');
                return false;
                var s=JSON.parse("["+n+"]");
                var rlast = parseInt(Math.max.apply(Math, s)) +1;
            }
            var sa=[["<input type='hidden' class='num_rows_<?php echo $nmTable ?>' value='"+rlast+"' /><a href='javascript:;' onclick='javascript:hapus_row_<?php echo $nmTable ?>("+rlast+")'><center><span class='ui-icon ui-icon-trash'></span></center></a>","<input type='text' name='grid_details_nomor_request[]' id='grid_details_nomor_request_"+rlast+"' class='get_sample_req required' size='25'><input type='hidden' name='grid_details_iMt01[0][]' id='grid_details_iMt01_"+rlast+"' class='required' size='25'>" <?php 
	            $ss=0;
				foreach ($arrSearch as $keyv => $valv) {
					if($ss>1){
						?>,"<p id='grid_<?php echo $keyv ?>_"+rlast+"'>-</p>"
						<?php
					}
					$ss++;
				}
            ?>]];
            var lastr=jQuery("#<?php echo $nmTable; ?>").jqGrid('getGridParam', 'records');
            var names = [<?php $sas = implode(',', $nmf); echo $sas;?>];
            var mydata = [];
            for (var i = 0; i < sa.length; i++) {
                mydata[i] = {};
                for (var j = 0; j < sa[i].length; j++) {
                    mydata[i][names[j]] = sa[i][j];
                }
            }
            $("#<?php echo $nmTable; ?>").jqGrid('addRowData', rlast, mydata[0]);
            $( "button.icon_hapus" ).button({
                icons: {
                    primary: "ui-icon-close"
                },
                text: true
            });
    }

    function hapus_row_<?php echo $nmTable ?>(rowId){
        var lastr=jQuery("#<?php echo $nmTable; ?>").jqGrid('getGridParam', 'records');
        if(lastr<=1){
             _custom_alert("Tidak Bisa, Minimal 1 Upload","Info","info", "<?php echo $grid ?>", 1, 20000);
             return false;
        }else{
            custom_confirm('Anda Yakin ?',function(){
                $('#<?php echo $nmTable; ?>').jqGrid('delRowData',rowId);
            });
        }
    }


    $(document).ready(function() {
		$( ".get_sample_req" ).livequery(function() {
		 	$( this ).autocomplete({
		 		source: function( request, response) {
					$.ajax({
						url: base_url+"processor/<?php echo $urlpath ?>?action=getDetailsReq",
						dataType: "json",
						data: {
							term: request.term,
						},
						success: function( data ) {
							response( data );
						}
					});
				},
				select: function(event, ui){
					var id = $(this).attr("id");
					var num = id.replace("grid_details_nomor_request_","");
					$( this ).val(ui.item.vnomor_03);
					$("p#grid_vNama_sample_"+num).html(ui.item.vNama_sample);
					$("p#grid_vNama_produsen_"+num).html(ui.item.vNama_produsen);
					$("p#grid_vZat_aktif_"+num).html(ui.item.vZat_aktif);
					$("p#grid_vNo_registrasi_"+num).html(ui.item.vNo_registrasi);
					$("p#grid_vBatch_lot_"+num).html(ui.item.vBatch_lot);
					$("p#grid_dTgl_kadaluarsa_"+num).html(ui.item.dTgl_kadaluarsa);
					$("p#grid_vKemasan_"+num).html(ui.item.vKemasan);
					$("p#grid_iJumlah_diserahkan_"+num).html(ui.item.iJumlah_diserahkan);
					$("#grid_details_iMt01_"+num).val(ui.item.iMt01);
					$("p#grid_cKode_"+num).html(ui.item.cKode);
					return false;
				},
				minLength: 2,
				autoFocus: true,
		 	});
		});
	});

</script>