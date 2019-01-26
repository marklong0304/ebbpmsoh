<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class master_scheduler extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->dbset = $this->load->database('hrd', true);
        $this->user = $this->auth->user();
        $this->url = 'master_scheduler'; 
    }
    function index($action = '') {
        $action = $this->input->get('action');
        //Bikin Object Baru Nama nya $grid      
        $grid = new Grid;
        $grid->setTitle('Master Scheduler');
        //dc.m_vendor  database.tabel
        $grid->setTable('hrd.master_scheduler');     
        $grid->setUrl('master_scheduler');
        $grid->addList('vNama_Scheduler','vtype_scheduler','iDuration','tRunning_time','vAlert','vDescription');
        $grid->setSortBy('vNama_Scheduler');
        $grid->setSortOrder('asc'); //sort ordernya

        $grid->addFields('vNama_Scheduler','vtype_scheduler','iScheduler_grppic_id','cPic','iDuration','iRepeat','tRunning_time','vAlert','vDescription');

        //setting widht grid
        $grid ->setWidth('vNama_Scheduler', '200'); 
        $grid ->setWidth('vtype_scheduler', '100'); 
        $grid ->setWidth('iDuration', '100'); 
        $grid ->setWidth('tRunning_time', '100'); 
        $grid ->setWidth('vAlert', '100'); 
        $grid->setWidth('vDescription', '300'); 

        //modif label
        $grid->setLabel('vNama_Scheduler','Nama Scheduler'); //Ganti Label
        $grid->setLabel('vDescription','Keterangan');
        $grid->setLabel('vtype_scheduler','Tipe');
        $grid->setLabel('iScheduler_grppic_id','Group PIC');
        $grid->setLabel('iDuration','Durasi');
        $grid->setLabel('iRepeat','Repeat');
        
        $grid->setLabel('tRunning_time','Running Time');
        $grid->setLabel('vAlert','Re-Alert Time');
        $grid->setLabel('cPic','PIC');

        //align
        $grid->setAlign('vtype_scheduler','center');
        $grid->setAlign('iDuration','right');
        $grid->setAlign('tRunning_time','center');
        $grid->setAlign('vAlert','right');
        

        
        $grid->setQuery('lDeleted', 0);    
        $grid->setSearch('vNama_Scheduler');
        $grid->setRequired('vNama_Scheduler');    //Field yg mandatori
        $grid->setRequired('vDescription');  //Field yg mandatori
        $grid->setFormUpload(TRUE);
        
        
    // ini untuk dropdown jika ada field yang menggunakan pilihan
        //$grid->changeFieldType('vDescription','combobox','',array(''=>'Pilih',0=>'Yes',1=>'No'));
        $grid->setGridView('grid');
        
        switch ($action) {
                case 'json':
                        $grid->getJsonData();
                        break;
                case 'view':
                        $grid->render_form($this->input->get('id'), true);
                        break;
                case 'create':
                        $grid->render_form();
                        break;
                case 'getsatuan':
                        echo $this->getSatuan();
                        break;
                case 'createproses':
                        $key = $_POST['vNama_Scheduler'];
                        $cek_data = 'select * from hrd.master_scheduler  a where a.vNama_Scheduler = "'.$key.'" ';
                        $data_cek = $this->db_schedulercheck->query($cek_data)->row_array();
                        if (empty($data_cek) ) {
                             echo $grid->saved_form();
                        }else{
                            $r['status'] = FALSE;
                            $r['message'] = "Group Sudah ada";
                            echo json_encode($r);
                        }
                       
                        break;
                case 'update':
                        $grid->render_form($this->input->get('id'));
                        break;
                case 'updateproses':

                        $pk_chek = $_POST['vNama_Scheduler'];
                        $sql = 'select * 
                                from hrd.master_scheduler a
                                where a.lDeleted=0 
                                and a.vNama_Scheduler = "'.$pk_chek.'" ' ;
                        $result = $this->db_schedulercheck->query($sql)->row_array();


                        $id = $_POST['master_scheduler_iMaster_Scheduler_id'];
                        $sql2 = 'select * 
                                from hrd.master_scheduler a
                                where a.lDeleted=0 
                                and a.iMaster_Scheduler_id = "'.$id.'" ' ;
                        $old = $this->db_schedulercheck->query($sql2)->row_array();

                        


                        if (empty($result) or $old['vNama_Scheduler'] == $pk_chek) {
                            echo $grid->updated_form();
                        }else{
                            $r['status'] = FALSE;
                            $r['message'] = "Group Sudah ada";
                            echo json_encode($r);

                        }
                        break;

                case 'getPic':
                    echo $this->getPic();
                break;  

                case 'delete':
                        echo $grid->delete_row();
                        break;
                default:
                        $grid->render_grid();
                        break;
        }
    }

     /*manipulasi view object form begin*/
    function insertBox_master_scheduler_vNama_Scheduler($field, $id) {
        $return = '<input type="text" name="'.$field.'"  id="'.$id.'"   class="input_rows1 required" size="25" />';
        return $return;
    }
    function updateBox_master_scheduler_vNama_Scheduler($field, $id, $value, $rowData) {
        if ($this->input->get('action') == 'view') {
            $return= $value;

        }
        else{
            $return = '<input type="text" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 required" size="25" />';
        }
        return $return;
    }

    function insertBox_master_scheduler_vDescription($field, $id) {
        $return     = "<textarea name='".$field."' id='".$id."' style='width: 350px; height: 100px;'size='250'  class='required input_rows1'></textarea>";      
        return $return;
    }
    function updateBox_master_scheduler_vDescription($field, $id, $value, $rowData) {
        if ($this->input->get('action') == 'view') {
            $return= nl2br($value) ;
        }
        else{
            $return     = "<textarea name='".$field."' id='".$id."' style='width: 350px; height: 100px;'size='250'  class='required input_rows1'>".nl2br($value)."</textarea>";     
        }

        return $return;
    }


    function insertBox_master_scheduler_vtype_scheduler($field, $id) {
        $o='<select id="'.$id.'"  class="required combobox" name="'.$field.'">
                <option value="">--Select--</option>
                <option value="0">Solo</option>
                <option value="1">Group</option>
            </select>';
        $o .= '<script type="text/javascript">
                $("#'.$id.'").change(function(){
                    if ($(this).val()==0 ){
                        $(this).parent().parent().next().hide();
                        $(this).parent().parent().next().find("select").removeClass("required");
                        $(this).parent().parent().next().find("select").val("");

                        $(this).parent().parent().next().next().show();
                        $(this).parent().parent().next().next().find("input").addClass("required");
                        
                    }else{
                        $(this).parent().parent().next().show();
                        $(this).parent().parent().next().find("select").addClass("required");

                        $(this).parent().parent().next().next().hide();
                        $(this).parent().parent().next().next().find("input").removeClass("required");
                        $(this).parent().parent().next().next().find("input").val("");
                        
                    }
                });
                </script>';
        return $o;
        
    }

    function updateBox_master_scheduler_vtype_scheduler($field, $id, $value ,$rowData) {
         $kat = array(""=>'--Select--', 0=>'Solo', 1=>'Group');
         if ($this->input->get('action') == 'view') {
            $o = $kat[$value];
        } else {
            $o  = "<select id='".$id."' class='required combobox'  name='".$field."'>";            
            foreach($kat as $k=>$v) {
                if ($k == $value) $selected = " selected";
                else $selected = "";
                $o .= "<option {$selected} value='".$k."'>".$v."</option>";
            }            
            $o .= "</select>";
        }
        $o .= '<script type="text/javascript">
                
                if ($("#'.$id.'").val()==0 ){
                  //  alert("nol");
                    $("#'.$id.'").parent().parent().next().hide();
                }else{
                    //alert("satu");
                    $("#'.$id.'").parent().parent().next().next().hide();  
                }

                $("#'.$id.'").change(function(){
                    if ($(this).val()==0 ){
                        $(this).parent().parent().next().hide();
                        $(this).parent().parent().next().find("select").removeClass("required");
                        $(this).parent().parent().next().find("select").val("");

                        $(this).parent().parent().next().next().show();
                        $(this).parent().parent().next().next().find("input").addClass("required");
                        
                    }else{
                        $(this).parent().parent().next().show();
                        $(this).parent().parent().next().find("select").addClass("required");

                        $(this).parent().parent().next().next().hide();
                        $(this).parent().parent().next().next().find("input").removeClass("required");
                        $(this).parent().parent().next().next().find("input").val("");
                        
                    }
                });
                </script>';
        return $o;
       
    }


     function insertBox_master_scheduler_iScheduler_grppic_id($field, $id) {
        $teams = $this->db_schedulercheck->get_where('hrd.scheduler_group_pic', array('lDeleted' => 0))->result_array();
        $o = '<select  name="'.$id.'" id="'.$id.'">';
        $o .= '<option value="">--Select--</option>';
        foreach ($teams as $t) {
            $o .= '<option value="'.$t['iScheduler_grppic_id'].'">'.$t['vNama_group_pic'].'</option>';
        }
        $o .= '</select>';
        return $o;
    }
    
    function updateBox_master_scheduler_iScheduler_grppic_idx($field, $id, $value, $rowData) {
        $sql = "SELECT t.iScheduler_grppic_id,t.vNama_group_pic FROM hrd.scheduler_group_pic t
                WHERE t.lDeleted = '0'";
        $kat = $this->db_schedulercheck->query($sql)->result_array();
       
        if ($this->input->get('action') == 'view') {
            $o = $kat[$value];
        } else {
            $o  = "<select id='".$id."' class='required combobox'  name='".$field."'>";            
            foreach($kat as $k=>$v) {
                if ($k == $value) $selected = " selected";
                else $selected = "";
                $o .= "<option {$selected} value='".$k."'>".$v."</option>";
            }            
            $o .= "</select>";
        }
       
        return $o;



    }

    
    function updateBox_master_scheduler_iScheduler_grppic_id($field, $id, $value, $rowData) {
          $sql = "SELECT t.iScheduler_grppic_id,t.vNama_group_pic FROM hrd.scheduler_group_pic t
                WHERE t.lDeleted = '0'";
        $teams = $this->db_schedulercheck->query($sql)->result_array();
        $echo = '<select  name="'.$field.'" id="'.$id.'">';
        $echo .= '<option value="">--Pilih--</option>';
        foreach($teams as $t) {
            $selected = $rowData['iScheduler_grppic_id'] == $t['iScheduler_grppic_id'] ? 'selected' : '';
            $echo .= '<option '.$selected.' value="'.$t['iScheduler_grppic_id'].'">'.$t['vNama_group_pic'].'</option>';
        }
        $echo .= '</select>';
        return $echo;
    }





    function insertBox_master_scheduler_iDuration($field, $id) {
        $return = '<input type="text" name="'.$field.'"  id="'.$id.'"   class="input_rows1 angka required" size="5" /> Menit';
        $return.='
        <script type="text/javascript">
            // datepicker
             $(".tanggal").datepicker({changeMonth:true,
                                        changeYear:true,
                                        dateFormat:"yy-mm-dd" });

            // input number
               $(".angka").numeric();

        </script>
        ';
        return $return;
    }
    function updateBox_master_scheduler_iDuration($field, $id, $value, $rowData) {
            
            $return = '<input type="text" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 angka required" size="5" /> Menit';
             $return.='
            <script type="text/javascript">
                // datepicker
                 $(".tanggal").datepicker({changeMonth:true,
                                            changeYear:true,
                                            dateFormat:"yy-mm-dd" });

                // input number
                   $(".angka").numeric();

            </script>
            ';

        return $return;
    }

    function insertBox_master_scheduler_iRepeat($field, $id) {
        $return = '<input type="text" name="'.$field.'"  id="'.$id.'"   class="input_rows1 angka required" size="5" /> Menit';
        $return.='
        <script type="text/javascript">
            // datepicker
             $(".tanggal").datepicker({changeMonth:true,
                                        changeYear:true,
                                        dateFormat:"yy-mm-dd" });

            // input number
               $(".angka").numeric();

        </script>
        ';
        return $return;
    }
    function updateBox_master_scheduler_iRepeat($field, $id, $value, $rowData) {
            
            $return = '<input type="text" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 angka required" size="5" /> Menit';
             $return.='
            <script type="text/javascript">
                // datepicker
                 $(".tanggal").datepicker({changeMonth:true,
                                            changeYear:true,
                                            dateFormat:"yy-mm-dd" });

                // input number
                   $(".angka").numeric();

            </script>
            ';

        return $return;
    }


    function insertBox_master_scheduler_tRunning_time($field, $id) {
        $return = '<input type="time" name="'.$field.'"  id="'.$id.'"   class="timeentry input_rows1  required" size="6" />';
        $return.='
        <script type="text/javascript">
            // datepicker
             $(".tanggal").datepicker({changeMonth:true,
                                        changeYear:true,
                                        dateFormat:"yy-mm-dd" });

            // input number
               $(".angka").numeric();

            // input time
               $(".timeentry").mask("00:00:00");

        </script>
        ';
        return $return;
    }
    function updateBox_master_scheduler_tRunning_time($field, $id, $value, $rowData) {
            
            $return = '<input type="time" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class=" timeentry input_rows1  required" size="6" />';
             $return.='
            <script type="text/javascript">
                // datepicker
                 $(".tanggal").datepicker({changeMonth:true,
                                            changeYear:true,
                                            dateFormat:"yy-mm-dd" });

                // input number
                   $(".angka").numeric();

                // input time
                $(".timeentry").mask("00:00:00");

            </script>
            ';

        return $return;
    }

    function insertBox_master_scheduler_vAlert($field, $id) {
        $return = '<input type="text" name="'.$field.'"  id="'.$id.'"   class="input_rows1 angka required" size="5" /> Menit';
        $return.='
        <script type="text/javascript">
            // datepicker
             $(".tanggal").datepicker({changeMonth:true,
                                        changeYear:true,
                                        dateFormat:"yy-mm-dd" });

            // input number
               $(".angka").numeric();

        </script>
        ';
        return $return;
    }
    function updateBox_master_scheduler_vAlert($field, $id, $value, $rowData) {
            
            $return = '<input type="text" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 angka required" size="5" /> Menit';
             $return.='
            <script type="text/javascript">
                // datepicker
                 $(".tanggal").datepicker({changeMonth:true,
                                            changeYear:true,
                                            dateFormat:"yy-mm-dd" });

                // input number
                   $(".angka").numeric();

            </script>
            ';

        return $return;
    }

    function insertBox_master_scheduler_cPic($field, $id) {
        //$url = base_url().'processor/warehouse/deliver/fg/?action=getEmployee';
        $url = base_url().'processor/schedulercheck/master/scheduler/?action=getPic';
        $skg=date('Y-m-d H:i:s');
            $return = '
                  <script language="text/javascript">
                            var config = {
                                source: function( request, response) {
                                    $.ajax({
                                        url: "'.$url.'",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
                                        },
                                        success: function( data ) {
                                            response( data );
                                             $("#'.$id.'").val("");
                                            
                                        }
                                    });
                                },
                                select: function(event, ui){  
                                    $("#'.$id.'_dis").val(ui.item.nama);
                                    $("#'.$id.'").val(ui.item.nip);
                                    return false;
                                },

                                minLength: 3,
                                autoFocus: true,
                            };
                            $("#'.$id.'_dis").livequery(function() {
                                $( this ).autocomplete(config);
                            });
                        
                  </script>
                 ';
                $return .= "<div id='l_pic_aa'></div>";

                //$return .= '<input type="text" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 " size="20" />';
                $return .= '<input type="text" name="'.$field.'"  id="'.$id.'_dis" value="" class="input_rows1 " size="20" />';
                $return .= '<input type="hidden" name="'.$field.'"  id="'.$id.'" value="" class="input_rows1 " size="20" />';
            
            return $return;
    }


    function updateBox_master_scheduler_cPic($field, $id, $value, $rowData) {
        //$url = base_url().'processor/warehouse/deliver/fg/?action=getEmployee';
        $url = base_url().'processor/schedulercheck/master/scheduler/?action=getPic';
        $skg=date('Y-m-d H:i:s');
        $rows = $this->db_schedulercheck->get_where('hrd.employee', array('cNip'=>$value))->row_array();
        if (!empty($rows)) {
            $isi = $rows['vName'];   
        }else{
            $isi = '';  
        }
        

            if ($this->input->get('action') == 'view') {
                $return= $isi;

            }
            else{
              //  $return = $isi;

            
            $return = '
                  <script language="text/javascript">
                            var config = {
                                source: function( request, response) {
                                    $.ajax({
                                        url: "'.$url.'",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
                                        },
                                        success: function( data ) {
                                            response( data );
                                             $("#'.$id.'").val("");
                                            
                                        }
                                    });
                                },
                                select: function(event, ui){  
                                    $("#'.$id.'_dis").val(ui.item.nama);
                                    $("#'.$id.'").val(ui.item.nip);
                                    return false;
                                },

                                minLength: 3,
                                autoFocus: true,
                            };
                            $("#'.$id.'").livequery(function() {
                                $( this ).autocomplete(config);
                            });
                        
                  </script>
                 ';
                $return .= "<div id='l_pic_aa'></div>";

                //$return .= '<input type="text" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 " size="20" />';
                $return .= '<input type="text" name="'.$field.'"  id="'.$id.'_dis" value="'.$isi.'" class="input_rows1 " size="20" />';
                $return .= '<input type="hidden" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 " size="20" />';
            }
            
            return $return;
    }








    

    function manipulate_update_button($buttons) {
        if ($this->input->get('action') == 'view') {unset($buttons['update']);}

        else{

        }
        return $buttons;
    }


    function getPic() {
            $term = $this->input->get('term');      
            $data = array();
            $sql = "select * 
                    from hrd.employee a
                    join hrd.company b on a.iCompanyID=b.iCompanyId
                    where 
                    a.lDeleted=0
                    and a.iDivisionID in (6) 
                    and a.dresign='0000-00-00'
                    and  ( a.vName like '%".$term."%'  or a.cNip like '%".$term."%' )
                    ";
            $query = $this->db_schedulercheck->query($sql);
            if ($query->num_rows > 0) {
                foreach($query->result_array() as $line) {
                    $row_array['value'] = trim($line['cNip']).' - '.trim($line['vName']);
                    $row_array['nip']    = $line['cNip'];
                    $row_array['nama']    = trim($line['vName']);
                    $row_array['company']    = $line['vCompName'];
                    $row_array['status']    = $line['cEmpStat'];
                    $row_array['dPassProbation']    = $line['dPassProbation'];
                    

                    array_push($data, $row_array);
                }
            }
            echo json_encode($data);
            exit;
    }


    function before_insert_processor($row, $postData) {

        
            if($postData['vtype_scheduler']==1){
                $postData['cPic']=null;
            } 
            
        
        $postData['dCreate'] = date('Y-m-d H:i:s');
        $postData['cCreated'] =$this->user->gNIP;


        
        
        return $postData;

    }

    function before_update_processor($row, $postData) {
    
        // ubah status submit
        if($postData['vtype_scheduler']==1){
                $postData['cPic']=null;
        } 

        $postData['dupdate'] = date('Y-m-d H:i:s');
        $postData['cUpdate'] =$this->user->gNIP;
        
        return $postData;

    }

    function listBox_master_scheduler_vtype_scheduler($value) {
        if($value==0){$vstatus='Solo';}
        elseif($value==1){$vstatus='Group';}
        return $vstatus;
    }



     /*manipulasi view object form end*/

     /*Function Pendukung begin*/

     /*Function Pendukung end*/


    public function output(){
        $this->index($this->input->get('action'));
    }

}
