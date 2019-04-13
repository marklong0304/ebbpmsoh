<?php
$grid="mt01";
$nmmodule="pengujian";
$nmTable="tb_details_".$grid;
$pager="pager_tb_details_".$grid;
$caption = "";
$isubmit=isset($isubmit)?$isubmit:0;
$arrSearch=array('upload_file'=>'Nama File','vket'=>'Keterangan','action'=>'Action');
$wsearch=array('upload_file'=>300,'vket'=>300,'action'=>180);
$alsearch=array('action'=>'center');
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
<table id="<?php echo $nmTable ?>"></table>
<div id="<?php echo $pager ?>"></div>
<iframe height="0" width="0" id="iframe_preview_<?php echo $grid; ?>"></iframe>
<script type="text/javascript">
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
    $(document).ready(function(){
        $grid.jqGrid({
            url: base_url+"processor/<?php echo $getUrl ?>?action=get_data_prev&<?php echo $g ?>",
            postData: {id:'<?php echo $id ?>'},
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
    })
    

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
                var s=JSON.parse("["+n+"]");
                var rlast = parseInt(Math.max.apply(Math, s)) +1;
            }
            var sa=[["<input type='hidden' class='num_rows_<?php echo $nmTable ?>' value='"+rlast+"' /><input type='file' id='<?php echo $grid; ?>_upload_file_"+rlast+"' class='fileupload1 multi multifile required' name='<?php echo $grid; ?>_upload_file[]' style='width: 90%' /> *","<textarea class='' id='<?php echo $grid; ?>_fileketerangan_"+rlast+"' name='<?php echo $grid; ?>_fileketerangan[]' style='width: 290px; height: 50px;' size='290'></textarea>", "<button id='ihapus_<?php echo $nmTable ?>' class='ui-button-text icon_hapus' style='width:75px' onclick='javascript:hapus_row_<?php echo $nmTable ?>("+rlast+")' type='button'>Hapus</button>"]];
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

</script>