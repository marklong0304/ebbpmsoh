<!--- Bagian Dari JqGrid-->

<div style="overflow:auto;" class="boxContent">
 

<div class="full_colums">
<div class="top_form_head">
    <span class="form_head top-head-content"> Version Monitoring </span>
</div>
</div>
<div class="clear"></div>  
<div class="full_colums">  

<?php   
    $db = $this->db_schedulercheck->query('SELECT * FROM hrd.svn_info s where s.vDescription is not null 
            order by s.vDescription LIMIT 5')->result_array();

    foreach ($db as $d) { 

        $getEnd = end(explode('/',$d['vURL']));
        if ($getEnd == 'tags') {
            $tags = '';
        }else if ($getEnd == 'trunk'){
            $tags = '';
        }else{
            $tags = '/tags';
        }

        $cmd = "svn log -v --username machine --password irobot  ".$d['vURL'].$tags." | awk '/^ *A/ { print $2 }' | grep -v RC | head -1"; 
        exec($cmd, $output, $return_var); 
        $v = $output[0];  
        unset($output);
        echo $d['vDescription'].' :: '.$v.'<br>';
    }
?>

</div>   

 
</div>

 
 