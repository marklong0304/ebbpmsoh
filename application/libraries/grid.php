<?php
class Grid{


	private $ci;
	
	/*Add Default Table Connection*/
	public $_default_connections = '';
	/*Add Default Table Connection*/
	
	private $addBtn = 'Add New'; 
	private $delBtn = 'Delete Selected(s)';
	private $button_view = '0';
	private $search_caption;
	private $pk = NULL;
	private $fields = array();
	private $list = array();
	private $renderList = array();
	private $label = array();
	private $search = array();
	private $required = array();
	private $change_s = array();
	private $change_ft = array();
	private $change_fl = array();
	private $change_val = array();
	private $change_fields = array();
	private $align = array();
	private $width = array();
	private $relation = array();
	private $join_table = array();
	private $queries = array();
	private $input_get = array();
	private $required_fields;
	private $tableFields;
	private $tableName;
	private $title; 
	private $sort_by;
	private $sort_order;
	private $group_by;
	private $url = '';
	private $esql = '';
	private $esqlCond = '';
	private $esqlOrder = '';
	private $incSearch = TRUE;
	private $searchOperand = array();
	
	/*Start Hide Title*/
	private $hideTitleCol = array();
	/*End Hide Title*/ 
	
	/*Start NotSort Col*/
	private $notSortCol = array();
	/*End NotSort Col*/
	
	//start form width
	private $formwidth = array();
	//end form width
	
	//Start Upload Form
	private $formUpload = '';
	private $uploadPath = '';
	private $allowedTypes = '';
	private $maxSize = '';
	//End Upload Form
	
	private $grid_view = 'grid';
	private $view = 'view';
	private $create_view = 'create';
	private $update_view = 'update';
	
	//Start Tambah
	private $company_id = '';
	private $group_id = '';
	private $modul_id = '';	
	//End Tambah
	
	//Start multi select
	private $multi_select = false;
	//end multi select
	
	

	//start deleted key
	private $deleted_key = 'ldeleted';
	//end deleted key
	
	//start insertPrivilege
	private $insert_privilege = true;
	
	//start deletePrivilege
	private $delete_privilege = true;
        
	//start parent key
	public $foreign_key = NULL;
	
	private $sess_auth;
	
	function __construct($dbset = 'default') {
		$this->ci=&get_instance();
		
		$this->ci->load->library('Zend', 'Zend/Session/Namespace');
		$this->sess_auth = new Zend_Session_Namespace('auth');
		$this->ci->lang->load('display', $this->sess_auth->lang);
		
		set_db($dbset, TRUE);
		$this->addBtn = $this->ci->lang->line('dt_btn_add');
		$this->delBtn = $this->ci->lang->line('dt_btn_dels');
		
		/*$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		$this->url = $urlpages[1];*/
	}

	public function setSql($v) {
		if($v == '') {
			$this->esql = 'kosongcuy';
		}
		else {
			$this->esql = $v;
		}
	}

	public function setSqlCond($v) {
		if($v == '') {
			$this->esqlCond = 'kosongcuy';
		}
		else {
			$this->esqlCond = $v;
		}
	}

	public function setSqlOrder($v) {
		if($v == '') {
			$this->esqlOrder = 'kosongcuy';
		}
		else {
			$this->esqlOrder = $v;
		}
	}

	

	public function geteSql() {
		
		//echo $this->esql;
		return $this->esql;
	}

	public function geteSqlCond() {
		
		//echo $this->esqlCond;
		return $this->esqlCond;
	}

	public function geteSqlOrder() {
		
		//echo $this->esqlOrder;
		return $this->esqlOrder;
	}





	
	public function searchOperand($name, $value) {
		$this->searchOperand[$name] = $value;
	}
	
	public function hideTitleCol($name, $value=TRUE) {
		$this->hideTitleCol[$name] = $value;
	}
	
	public function notSortCol($name, $value=TRUE) {
		$this->notSortCol[$name] = $value;
	}
	
	public function setInputGet($name, $value) {
		if($value != '') {
			$this->input_get[$name] = $value;
		} 
	}
	
	public function setFormUpload($value = FALSE) {
		if($value) {
			$this->formUpload = 'enctype="multipart/form-data"';
		}
	}
	public function setUploadPath($field, $value) {
		$this->uploadPath[$field] = $value;
	}
	public function setAllowedTypes($field, $value) {
		$this->allowedTypes[$field] = $value;
	}
	public function setMaxSize($field, $value) {
		$this->maxSize[$field] = $value;
	}
	
	//multi select atau tidak
	public function setMultiSelect($value) {
		$this->multi_select = $value;
	}
	
	public function getMultiSelect() {
		return $this->multi_select;
	}
	//end multi select atau tidak;
	
	//deleted key 
	public function setDeletedKey($value) {
		$this->deleted_key = $value;
	}
	
	public function getDeletedKey() {
		return $this->deleted_key;
	}
	
	//Start Tambah Lagi
	public function setCompanyID($value) {
		$this->company_id = $value;
	}


	public function setGroupID($value) {
		$this->group_id = $value;
	}
	public function setModulID($value) {
		$this->modul_id = $value;
	}
	public function getCompanyID() {
		return $this->company_id != '' ? $this->company_id : $this->ci->input->get('company_id');
	}
	public function getGroupID() {
		return $this->group_id != '' ? $this->group_id : $this->ci->input->get('group_id');
	}
	public function getModulID() {
		return $this->modul_id != '' ? $this->modul_id : $this->ci->input->get('modul_id');
	}
	//End Tambah Lagi
	
	//
	public function setInsertPrivilege($insert_privilege) {
		$this->insert_privilege = $insert_privilege;
	}
	
	public function getInsertPrivilege() {
		return $this->insert_privilege;
	}
	//
	
	public function setAddBtn($name) {
		$this->addBtn = $name;
	}
	public function setDelBtn($name) {
		$this->delBtn = $name;
	}
	
	public function setButtonView($value) {
		$this->button_view = $value;
	}
	
	public function setTable($tableName) {
    	$this->tableName = $tableName;
	}	
	private function getTable() {
		return $this->tableName;
	}
	
	private function getTableList() {		
		$query = "DESC ".$this->ci->db->dbprefix($this->getTable())."";
		return $this->tableFields = $this->ci->db->query($query)->result_array();
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	private function getTitle() {
		return $this->title;
	}
	
	public function setGridView($view) {
		$this->grid_view = $view;
	}
	private function getGridView() {
		return $this->grid_view;
	}
	
	public function setView($view) {
		$this->view = $view;
	}
	private function getView() {
		return $this->view;
	}
	
	public function setCreateView($view) {
		$this->create_view = $view;
	}
	private function getCreateView() {
		return $this->create_view;
	}
	
	public function setUpdateView($view) {
		$this->update_view = $view;
	}
	private function getUpdateView() {
		return $this->update_view;
	}
	
	public function setIncSearch($set) {
		$this->incSearch = $set;
	}
	
	public function setPk($pk) {
		$this->pk = $pk;
	}
        
	public function setForeignKey($foreign_key) {
		$this->foreign_key = $foreign_key;
	}
	
	public function getForeignKey() {
		return $this->foreign_key;
	}
	
	public function setSortBy($v) {
		$this->sort_by = $v;
	}
	
	public function setSortOrder($v) {
		$this->sort_order = $v;
	}
	
	public function setGroupBy($v) {
		$this->group_by = $v;
	}
	
	public function setUrl($v = '') {
		if($v == '') {
			$this->url = $this->ci->uri->segment(1);
		}
		else {
			$this->url = $v;
		}
	}
	
	private function getPk() {
		foreach($this->getTableList() as $row) {
			if($row['Key'] == 'PRI') {
				$this->pk = $row['Field'];
			}
		}
		
		return $this->pk;
	}
	
	public function addList() {
		$numargs = func_num_args();
	    $arg_list = func_get_args();
	    for ($i = 0; $i < $numargs; $i++) {
	    	$this->list[] = $arg_list[$i];	    	
	    }
		return $this->list;
	}
	
	public function addFields() {
		$numargs = func_num_args();
	    $arg_list = func_get_args();
	    for ($i = 0; $i < $numargs; $i++) {
	    	$this->fields[] = $arg_list[$i];	    	
	    }
		return $this->fields;
	}
	
	public function setSearch() {
		$numargs = func_num_args();
                $arg_list = func_get_args();
                for ($i = 0; $i < $numargs; $i++) {
                    $this->search[$arg_list[$i]] = TRUE;	    	
                }
		return $this->search;
	}
	
	private function getSearch() {
		$searchs = array();
		//print_r($this->change_s);
		//print_r($this->search);
		//echo '<pre>';print_r($this->tableFields);echo '</pre>';
		foreach($this->search as $k => $v) {
			if(array_key_exists($k, $this->change_s)) {
				$searchs[$k] = array('fields' => $k, 'type' => 'between');
			}
			else {
				$stype = 'varchar';
				foreach($this->tableFields as $tf) {								
					if($k == $tf['Field']) {
						$stype = $this->replace_char($tf['Type']);
					}													
				}
				$searchs[$k] = array('fields' => $k, 'type' => $stype);
			}
		}
		//print_r($searchs);
		return $searchs;
	}
	
	public function setAlign($field, $replace) {
		$this->align[$field] = $replace;	    	
	    return $this->align;
	}
	
	public function setWidth($field, $replace) {
		$this->width[$field] = $replace;	    	
	    return $this->width;
	}
	
	public function setFormWidth($field, $replace) {
		$this->formwidth[$field] = $replace;
		return $this->formwidth;
	}
	
	public function setRequired() {
		$numargs = func_num_args();
	    $arg_list = func_get_args();
	    for ($i = 0; $i < $numargs; $i++) {
	    	$this->required[$arg_list[$i]] = TRUE;	    	
	    }
		return $this->required;
	}
	
	public function setLabel($field, $replace) {
		$this->label[$field] = $replace;	    	
	    return $this->label;
	}
	
	public function changeSearch($field, $type) {
		$this->change_s[$field] = $type;
	}
	
	public function changeFieldType($field, $type, $lenght='',$value = array()) {
		$this->change_ft[$field] = $type;
		$this->change_fl[$field] = $lenght;
		$this->change_val[$field] = $value;
		
		$this->change_fields[$field] = array(
									'type' => $this->change_ft[$field],
									'lenght' => $this->change_fl[$field],
									'value' => $this->change_val[$field],
								);
	}
	
	public function setRelation($field, $table, $fk, $view_as = NULL, $as = NULL, $type = 'INNER', $where = '', $order = '') {
		$vas = empty($view_as) ? $field : $view_as;
		$sas = empty($as) ? '' : $as;
		$this->relation[$field] = array('field'=>$field, 'join_table'=>$table, 'foreign_key'=>$fk, 'view_as'=>$vas, 'as'=>$sas, 'type'=>$type, 'where'=>$where, 'order'=>$order);
	}
	
	public function setJoinTable($table, $glue, $type='inner') {
		$this->join_table[$table] = array('table'=>$table, 'glue'=>$glue, 'type'=>$type);
	}
	
	public function setQuery($field, $value) {
		$this->queries[] = array($field=>$value);
	}


	
	private function getRenderList() {
		//echo '<pre>';print_r($this->list);echo '</pre>';
		foreach($this->list as $k => $v) {
			if(is_array($this->relation) && count($this->relation) > 0) {
				foreach($this->relation as $rel) {
					$dotrel = strpos($rel['field'], '.');
					if($dotrel) {
						$pisah = explode('.', $rel['field']);
						$akhir = count($pisah);
						$cakhir = intval($akhir) - 1;
						$relfield = $pisah[$cakhir];
					}
					else {
						$relfield = $rel['field'];
					}
					$ev = explode('.', $v);
					$cv = count($ev);
					$cvhir = intval($cv) - 1;
					$vnya = $ev[$cvhir];
					if($vnya == $relfield) {
					//if($this->search_array($v,$rel['field'])) {
						if($rel['as'] == '') {
							$this->renderList[$v] = $rel['view_as'];
						}
						else {
							$this->renderList[$v] = $rel['as'];
						}						
					}
					else {
						if(!isset($this->renderList[$v])) {
							$this->renderList[$v] = $v;
						}												
					}
				}
			}
			else {
				$this->renderList[$v] = $v;
			}
		}
		return $this->renderList;
	}
	
	public function setSearchCaption($caption) {
		$this->search_caption = $caption;
	}
	
	private function getSearchCaption() {
		if($this->search_caption == NULL) {
			$this->search_caption = $this->ci->lang->line('dt_search').' '.$this->title;
		}
		return $this->search_caption;
	}
	
	private function get_rel_combobox($rel) {
		$return = array(''=>'--Select--');
		$t = array();
		$wh = array();
		foreach($this->relation as $key => $r) {
			$dotrel = strpos($r['field'], '.');
			if($dotrel) {
				$pisah = explode('.', $r['field']);
				$akhir = count($pisah);
				$cakhir = intval($akhir) - 1;
				$relfield = $pisah[$cakhir];
				$r['field'] = $pisah[$cakhir];
			}
			if($rel == $r['field']) {
				if(is_array($r['where'])) {
					if(!empty($r['where'])) {
						foreach($r['where'] as $k => $v) {
							$this->ci->db->where(array($k => $v));
						}					
					}
				}
				else {
					if($r['where'] != '') {
						$whrs = explode('=', $r['where']);
						$this->ci->db->where($whrs[0], $whrs[1]);
					}
				}
				
				if(is_array($r['order'])) {
					if(!empty($r['order'])) {
						foreach($r['order'] as $k => $v) {
							$this->ci->db->order_by($k, $v);
						}				
					}
				}
				else {
					if($r['order'] != '') {
						$whrs = explode('=', $r['order']);
						$this->ci->db->order_by($whrs[0], $whrs[1]);
					}
				}
					
				if($r['as'] != '') {
					//$this->ci->db->select($r['join_table'].'.'.$r['view_as'] .' AS '.$r['as'], FALSE);
					$this->ci->db->select(array($r['foreign_key'],$r['view_as'] .' AS '.$r['as'], FALSE));
				}
				else {
					$this->ci->db->select(array($r['foreign_key'],$r['view_as']));
				}
				
				//$this->ci->db->select(array($r['foreign_key'],$r['view_as']));
				$rtn = $this->ci->db->get($r['join_table'])->result_array();
				//echo $this->ci->db->last_query().'<br />';				
			}						
		}		
		foreach($rtn as $key => $rt) {
			$t[] = array_values($rt);
		}
		foreach($t as $k => $v) {
			$return[$v[0]] = $v[1];
		}
		return $return;		
	}
	
	private function get_date_search($field, $url) {
		$return = array();
		$return['start'] = array('id'=>'search_grid_'.$url.'_'.$field, 'name'=>$field);
		return $return;
	}
	
	private function get_datetime_search($field, $url) {
		$return = array();
		$return['start'] = array('id'=>'search_grid_'.$url.'_'.$field.'_start', 'name'=>$field.'_start');
		$return['end'] = array('id'=>'search_grid_'.$url.'_'.$field.'_end', 'name'=>$field.'_end');
		return $return;
	}
	
	/*public function getControllerExtends() {
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);	
		
		if(file_exists(APPPATH.'/controllers/'.$urlpages[0].EXT)) {
			require_once APPPATH.'/controllers/'.$urlpages[0].EXT;
		}
		else 
		{
			require_once APPPATH.'../modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT;
		}
		return $con = New $urlpages[1];		
	}*/
	
	public function getControllerExtends() {
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);	
		
		if(file_exists(APPPATH.'../../erp_modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT)) {
			require_once APPPATH.'../../erp_modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT;
		}
		else 
		{
			require_once APPPATH.'../modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT;
		}
		return $con = New $urlpages[1];		
	}
	
	/*public function getControllerExtendsUrl() {
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		if(file_exists(APPPATH.'/controllers/'.$urlpages[0].EXT)) {
			$return = APPPATH.'/controllers/'.$urlpages[0].EXT;
		}
		else {
			//$return = APPPATH.'../modules/'.$url.'/controllers/'.$url.EXT;
			$return = APPPATH.'../modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT;
		}
		return $return;		
	}*/
	
	public function getControllerExtendsUrl() {
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		if(file_exists(APPPATH.'../../erp_modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT)) {
			$return = APPPATH.'../../erp_modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT;
		}
		else {
			//$return = APPPATH.'../modules/'.$url.'/controllers/'.$url.EXT;
			$return = APPPATH.'../modules/'.$urlpages[0].'/controllers/'.$urlpages[1].EXT;
		}
		return $return;		
	}
	
	public function render_function() {
		if($this->url == '') {
			$url = $this->ci->uri->segment(1);
		}
		else {
			$url = $this->url;
		}
		foreach($this->list as $l) {
			$lf = str_replace('.', '_', $l);
			$ln = str_replace('.', '__', $l);
			$function['list'][$ln] = array('box'=>'listBox_'.$url.'_' . $lf);
			$function['search'][$ln] = array('box'=>'searchBox_'.$url.'_' . $lf, 'post'=>'searchPost_'.$url.'_' . $lf);
		}
		foreach($this->search as $l) {
			$lf = str_replace('.', '_', $l);
			$ln = str_replace('.', '__', $l);
			$function['search'][$ln] = array('box'=>'searchBox_'.$url.'_' . $lf, 'post'=>'searchPost_'.$url.'_' . $lf);
		}
		foreach($this->fields as $f) {
			$function['insert'][$f] = array('box'=>'insertBox_'.$url.'_' . $f, 'check'=>'insertCheck_'.$url.'_' . $f, 'post'=>'insertPost_'.$url.'_' . $f);
			$function['update'][$f] = array('box'=>'updateBox_'.$url.'_' . $f, 'check'=>'updateCheck_'.$url.'_' . $f, 'post'=>'updatePost_'.$url.'_' . $f);
		}
		return $function;		
	}
	
	public function renderInsertButton() {
		$con = $this->getControllerExtends();
		if($this->url == '') {
			$url = $this->ci->uri->segment(1);
		}
		else {
			$url = $this->url;
		}
		
		$nu = explode('_', $url);
		$nurl = implode('/', $nu);
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		if($this->formUpload) {
			/*$button = array(
						'save' => '<button onclick="javascript:save_btn_upload(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_save_'.$url.'">Save</button>',
						'save_back' => '<button onclick="javascript:save_btn_back_upload(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_save_back_'.$url.'">Save &amp; Back to list</button>',
						'cancel' => '<button onclick="javascript:cancel_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\')" class="ui-button-text icon-cancel" id="button_cancel_'.$url.'">Back</button>'
			);*/
			$button = array(
						'save' => '<button onclick="javascript:save_btn_upload(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_save_'.$url.'">Save</button>',
						'goTop'  => '<span id="button_gotop_'.$url.'" class="ui-icon ui-icon-eject" onclick="javascript:goScrollTo(\''.$url.'\');"></span>'
						/*'save_back' => '<button onclick="javascript:save_btn_back_upload(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_save_back_'.$url.'">Save &amp; Back to list</button>',
						'cancel' => '<button onclick="javascript:cancel_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\')" class="ui-button-text icon-cancel" id="button_cancel_'.$url.'">Back</button>'*/
			);
			if(method_exists($con, 'manipulate_insert_button')) {
				$button = $con->manipulate_insert_button($button);
			}
		}
		else {
			$button = array(
						'save' => '<button onclick="javascript:save_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_save_'.$url.'">Save</button>',
						'goTop'  => '<span id="button_gotop_'.$url.'" class="ui-icon ui-icon-eject" onclick="javascript:goScrollTo(\''.$url.'\');"></span>'
						/*'save_back' => '<button onclick="javascript:save_btn_back(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_save_back_'.$url.'">Save &amp; Back to list</button>',
						'cancel' => '<button onclick="javascript:cancel_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\')" class="ui-button-text icon-cancel" id="button_cancel_'.$url.'">Back</button>'*/
			);
			if(method_exists($con, 'manipulate_insert_button')) {
				$button = $con->manipulate_insert_button($button);
			}
		}
		return $button;
	}
	
	public function renderUpdateButton($update_data) {
		$con = $this->getControllerExtends();
		if($this->url == '') {
			$url = $this->ci->uri->segment(1);
		}
		else {
			$url = $this->url;
		}
		
		$nu = explode('_', $url);
		$nurl = implode('/', $nu);
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		if($this->formUpload) {
			$button = array(
						'update' => '<button onclick="javascript:update_btn_upload(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_update_'.$url.'">Update</button>',
						'goTop'  => '<span id="button_gotop_'.$url.'" class="ui-icon ui-icon-eject" onclick="javascript:goScrollTo(\''.$url.'\');"></span>'
						/*'update_back' => '<button onclick="javascript:update_btn_back_upload(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_update_back_'.$url.'">Update &amp; Back to list</button>',
						'cancel' => '<button onclick="javascript:cancel_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\')" class="ui-button-text icon-cancel" id="button_cancel_'.$url.'">Back</button>'*/
			);
			if(method_exists($con, 'manipulate_update_button')) {
				$button = $con->manipulate_update_button($button, $update_data);
			}
		}
		else {
			/*$button = array(
						'update' => '<button onclick="javascript:update_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_update_'.$url.'">Update</button>',
						'update_back' => '<button onclick="javascript:update_btn_back(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_update_back_'.$url.'">Update &amp; Back to list</button>',
						'cancel' => '<button onclick="javascript:cancel_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\')" class="ui-button-text icon-cancel" id="button_cancel_'.$url.'">Back</button>'
			);*/
			
			$button = array(
						'update' => '<button onclick="javascript:update_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\', this)" class="ui-button-text icon-save" id="button_update_'.$url.'">Update</button>',
						'goTop'  => '<span id="button_gotop_'.$url.'" class="ui-icon ui-icon-eject" onclick="javascript:goScrollTo(\''.$url.'\');"></span>'
						/*'cancel' => '<button onclick="javascript:cancel_btn(\''.$url.'\', \''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\')" class="ui-button-text icon-cancel" id="button_cancel_'.$url.'">Back</button>'*/
			);
			
			
			if(method_exists($con, 'manipulate_update_button')) {
				$button = $con->manipulate_update_button($button, $update_data);
			}
		}
		return $button;
	}
	
	public function pre_render_grid() {
		$resp['title'] = $this->getTitle();				
		$resp['relations'] = $this->relation;
		if($this->url == '') {
			$resp['url'] = $this->ci->uri->segment(1);
		}
		else {
			$resp['url'] = $this->url;
		}		
		if($this->pk == NULL) {
			foreach($this->getTableList() as $row) {
				if($row['Key'] == 'PRI') {
					$resp['pk'] = $row['Field'];
				}
			}
		}
		else {
			$resp['pk'] = $this->getPk();
		}
		
		if($this->sort_by == '') {
			$resp['sort_by'] = $resp['pk'];
		}
		else {
			$resp['sort_by'] = $this->sort_by;
		}
		
		//group by
		if($this->group_by == '') {
			$resp['group_by'] = $resp['pk'];
		} else {
			$resp['group_by'] = $this->group_by;
		}
		
		
		if($this->sort_order == '' || (strtoupper($this->sort_order) != 'ASC') && (strtoupper($this->sort_order) != 'DESC')) {
			$resp['sort_order'] = 'ASC';
		}
		else {
			$resp['sort_order'] = $this->sort_order;
		}
		
		$theList = array();
		$c = 0;
		foreach($this->list as $k => $v) {
			$theList[$c]['field'] = $v;
			foreach($this->tableFields as $tf) {
				if($v == $tf['Field']) {
					$theList[$c]['type'] = $this->replace_char($tf['Type']);
				}
			}
			
			if($this->array_key_exists_r($v, $this->label)) {
				$theList[$c]['label'] = $this->label[$v];
			}
			else {
				$theList[$c]['label'] = ucwords(str_replace(array('-','_'), ' ', $v));
			}

			if($this->array_key_exists_r($v, $this->align)) {
				$theList[$c]['align'] = $this->align[$v];
			}
			else {
				$theList[$c]['align'] = 'left';
			}

			if($this->array_key_exists_r($v, $this->width)) {
				$theList[$c]['width'] = $this->width[$v];
			}
			else {
				$theList[$c]['width'] = 200;
			}
			
			//print_r($this->search);
			if($this->array_key_exists_r($v, $this->search)) {
				$theList[$c]['search'] = TRUE;
			}
			else {
				$theList[$c]['search'] = FALSE;
			}

			if($this->array_key_exists_r($v, $this->hideTitleCol)) {
				$theList[$c]['title'] = FALSE;
			}
			else {
				$theList[$c]['title'] = TRUE;
			}
			
			if($this->array_key_exists_r($v, $this->notSortCol)) {
				$theList[$c]['sortable'] = FALSE;
			}
			else {
				$theList[$c]['sortable'] = TRUE;
			}
			$c++;
		}	
		$resp['relations'] = $this->relation;
		$resp['join_table'] = $this->join_table;
		$resp['search'] = $this->search;
		$resp['list'] = $this->list;
		$resp['render_list'] = $this->getRenderList();
		$resp['theList'] = $theList;                
		
		return $resp;
	}


	public function render_grid() {
		//echo '<pre>';print_r($this->change_fields);echo '</pre>';
                //echo 'Foreign Key : '.$this->getForeignKey();
		$con = $this->getControllerExtends();
		$this->ci->load->helper('jqgrid_helper');
		$functions = $this->render_function();
		$result = $this->pre_render_grid();
		$set_columns = array();
		foreach($result['theList'] as $tl) {
			$ttype = isset($tl['type']) ? $tl['type'] : '';
			if(array_key_exists($tl['field'], $this->change_s)) {
				$ttype = 'between';
			}
			else {
				$ttype = $ttype;
			}
			$set_columns[$tl['field']] = array(
								'label' => $tl['label'],
								'name' => $tl['field'],
								'width' => $tl['width'],
								'align' => $tl['align'], 
								'search' =>$tl['search'],
								'title' =>$tl['title'],
								'sortable' =>$tl['sortable'],
								'type' => $ttype,
								'frozen'=>0,
							);
		};
		
		$nu = explode('_', $result['url']);
		$nurl = implode('/', $nu);
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		$inget = $this->input_get;
		$input_g = '';
		foreach ($inget as $k => $v) {
			$input_g .= '&'.$k.'='.$v;
		}
		
		$aData = array(
			//'source' => 'processor/'.$result['url'].'/index/json',
			'source' => 'processor/'.$urlpages[0].'/'.$nurl.'?action=json&foreign_key='.$this->getForeignKey().'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'&index='.$this->ci->input->get('index').$input_g,
			'sort_name' => $result['sort_by'],
			'sort_order' => $result['sort_order'],
			'group_by'  => $result['group_by'],
			'caption' => $result['title'],
			'primary_key' => $result['pk'],
			'grid_height' => 231,
		);
		//print_r($aData);
		$aData['relations'] = $result['relations'];
		$aData['join_table'] = $result['join_table'];
		$aData['set_columns'] = $set_columns;
		$aData['functions'] = $functions;
		$aData['the_url'] = $result['url'];
		$aData['div_name'] = 'grid_'.$result['url'];
		$aData['pager_name'] = 'pager_'.$result['url'];
		$aData['change_s'] = $this->change_s;
		$aData['change_fields'] = $this->change_fields;		
		$aData['button_view'] = $this->button_view;
		$aData['search'] = $this->getSearch();
		
		//start multi select
		$aData['multi_select'] = $this->getMultiSelect();
		//end multi select
		if($this->incSearch == TRUE) {
			$data['search'] = $this->renderSearch($set_columns, $result['url'], $this->relation, $functions);
		}
		else {
			$data['search'] = array();
		}
		
		$data['button'] = array();
		$data['the_url'] = $result['url'];
		$data['sarch_caption'] = $this->getSearchCaption();		
		//
		
		$sess_auth 	= new Zend_Session_Namespace('auth');
		
		$group_id 	= $this->getGroupID();
		$module_id 	= $this->getModulID();
		$company_id = $this->getCompanyID();
		$foreign_key = $this->getForeignKey();
		
		$id_PT = isset($company_id) ? $company_id : false;
		
		$GroupAndModul = array("group_id" => $group_id , "module_id" => $module_id, "company_id" => $company_id);
		//getAcl
		
		//
		//echo $group_id.' '.$module_id.' '.$company_id.' '.$acl;
		$buttons = array();
		if($this->ci->acl->hasPermission($GroupAndModul, 'create')) {
		//if (in_array($acl, $action['create'])) {
			//$buttons['create'] = array('label'=>$this->addBtn,'class'=>'addBtn','url'=>base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=create&foreign_key='.$foreign_key.'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID(),'name'=>'button_add_'.$result['url'],'id'=>'button_add_'.$result['url']);
			$buttons["create"] = "<button class='icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' 
					onclick='javascript:add_btn(\"".base_url()."processor/".$urlpages[0]."/".$nurl."?action=create&foreign_key=".$foreign_key."&company_id=".$this->getCompanyID()."&group_id=".$this->getGroupID()."&modul_id=".$this->getModulID()."\", \"".$result['url']."\");' 
					name='button_add_".$result['url']."' id='button_add_".$result['url']."'>".$this->addBtn."</button>";
			if ($this->getInsertPrivilege() == FALSE) {
				unset($buttons['create']);
			}
		}
		if($this->ci->acl->hasPermission($GroupAndModul, 'delete')) {
		//if($this->ci->acl->hasPermission($result['url'],'delete')) {
		//if (in_array($acl, $action['delete'])) {
			if ($this->getMultiSelect() == TRUE) {
				//$buttons['delete'] = array('label'=>$this->delBtn,'class'=>'delBtn','url'=>base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=delete&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID(),'name'=>'button_del_'.$result['url'],'id'=>'button_del_'.$result['url']);
				/*$buttons = array("delete"=>
					"<button class='delBtn' 
					onclick='javascript:del_btn(".base_url()."processor/".$urlpages[0]."/".$nurl."?action=delete&foreign_key=".$foreign_key."&company_id=".$this->getCompanyID()."&group_id=".$this->getGroupID()."&modul_id=".$this->getModulID().");' 
					name='button_add_".$result['url']."' id='button_add_".$result['url']."'>".$this->addBtn."</button>");*/
				
				$buttons['delete'] = " <button class='icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary'
					onclick='javascript:del_btn(\"".base_url()."processor/".$urlpages[0]."/".$nurl."?action=delete&foreign_key=".$foreign_key."&company_id=".$this->getCompanyID()."&group_id=".$this->getGroupID()."&modul_id=".$this->getModulID()."\");'
					name='button_del_".$result['url']."' id='button_del_".$result['url']."'>".$this->delBtn."</button>";
			} else {
				unset($buttons['delete']);
			}
		}
		
		//print_r($buttons);
		
		if(method_exists($con, 'manipulate_grid_button')) {
			$buttons = $con->manipulate_grid_button($buttons);
		}
		
		
		$data['button'] = $buttons;		
		$data['grid'] = buildGrid($aData);

		$this->ci->template->display($this->grid_view,$data);
	}
	
	private function get_between_search($field, $url) {
		$return = array();
		//$return['start'] = array('id'=>'search_grid_'.$url.'_'.$field.'_start', 'name'=>$field.'_start');
		//$return['end'] = array('id'=>'search_grid_'.$url.'_'.$field.'_end', 'name'=>$field.'_end');
                $return['start'] = array('id'=>'search_grid_'.$url.'_'.$field.'_start', 'name'=>'search_grid_'.$url.'_'.$field.'_start');
		$return['end'] = array('id'=>'search_grid_'.$url.'_'.$field.'_end', 'name'=>'search_grid_'.$url.'_'.$field.'_end');
		return $return;
	}
	
	private function renderSearch($column, $url, $rels, $funcs) {
		$con = $this->getControllerExtends();
		$cs = array();
		//echo '<pre>';print_r($funcs['search']);echo '</pre>';		
		$x = 0;		
		foreach($column as $c) {			
			if($c['search'] == TRUE) {
				//echo '<pre>';print_r($funcs['search']);echo '</pre>';
				//$c['name'] = str_replace('.', '_', $c['name']);
				//echo $funcs['search'][$c['name']]['box'];
				$csname = str_replace('.', '__', $c['name']);
				if(method_exists($con, $funcs['search'][$csname]['box'])) {
					$cname = str_replace('.', '__', $c['name']);
					$cs[$c['name']] = array(
								'label'=>$c['label'],
								//'name'=>$c['name'],
                                                                'name'=>'search_grid_'.$url.'_'.$c['name'],
								'ftype'=>'replace',
								'id'=>'search_grid_'.$url.'_'.$c['name'],
								'source' => $con->$funcs['search'][$csname]['box']($c, 'search_grid_'.$url.'_'.$cname),
							);
					
				}
				else {
					$cname = str_replace('.', '__', $c['name']);
					if($this->array_key_exists_r($c['name'], $this->change_s)) {
						$cs[$c['name']]['label'] = $c['label'];
						//$cs[$c['name']]['name'] = $c['name'];
                                                $cs[$c['name']]['name'] = 'search_grid_'.$url.'_'.$c['name'];
						$cs[$c['name']]['ftype'] = $this->change_s[$c['name']];
						$cs[$c['name']]['id'] = 'search_grid_'.$url.'_'.$cname;
						$cs[$c['name']]['source'] = $this->get_between_search($c['name'], $url);
					}
					elseif($this->array_key_exists_r($c['name'], $this->change_ft)) {
						$cs[$c['name']]['label'] = $c['label'];
						//$cs[$c['name']]['name'] = $c['name'];
                                                $cs[$c['name']]['name'] = 'search_grid_'.$url.'_'.$c['name'];
						if($this->change_ft[$c['name']] == 'combobox') {
							$cs[$c['name']]['source'] = $this->change_val[$c['name']];
						}
						$cs[$c['name']]['ftype'] = $this->change_ft[$c['name']];
						$cs[$c['name']]['id'] = 'search_grid_'.$url.'_'.$cname;
					}
					else {					
							if(is_array($rels) && count($rels) > 0) {
								foreach($rels as $rel) {
									$dotrel = strpos($rel['field'], '.');
									if($dotrel) {
										$pisah = explode('.', $rel['field']);
										$akhir = count($pisah);
										$cakhir = intval($akhir) - 1;
										$relfield = $pisah[$cakhir];
									}
									else {
										$relfield = $rel['field'];
									}
									//echo $c['name'].' = ';
									//echo $relfield.' <br />';
									$ec = explode('.', $c['name']);
									$cc = count($ec);
									$ccc = intval($cc) - 1;
									$cnewname = $ec[$ccc];
									if($cnewname == $relfield) {
										$cidname = str_replace('.', '__', $c['name']);
										$cs[$c['name']] = array(
											'label'=>$c['label'],
											//'name'=>$rel['field'],
                                            'name'=>'search_grid_'.$url.'_'.$rel['field'],
											'ftype'=>'combobox',
											'id'=>'search_grid_'.$url.'_'.$cidname,
											'source' => $this->get_rel_combobox($relfield),
										);						
									}
									else {
										if(!isset($cs[$c['name']])) {
											if($c['type'] == 'date') {
												$cs[$c['name']] = array(
														'label'=>$c['label'],
														//'name'=>$c['name'],
                                                        'name'=>'search_grid_'.$url.'_'.$c['name'],
														'ftype'=>$c['type'],									
														'id'=>'search_grid_'.$url.'_'.$cname,
														'source' => $this->get_date_search($c['name'], $url),
													);
											} else if ( $c['type'] == 'datetime' && $c['type'] == 'timestamp' ) {
												$cs[$c['name']] = array(
														'label'=>$c['label'],
														//'name'=>$c['name'],
                                                        'name'=>'search_grid_'.$url.'_'.$c['name'],
														'ftype'=>$c['type'],									
														'id'=>'search_grid_'.$url.'_'.$cname,
														'source' => $this->get_datetime_search($c['name'], $url),
													);
											}
											else {
												$cs[$c['name']] = array(
													'label'=>$c['label'],
													//'name'=>$c['name'],
                                                    'name'=>'search_grid_'.$url.'_'.$c['name'],
													'ftype'=>$c['type'],
													'id'=>'search_grid_'.$url.'_'.$cname,
												);
											}				
										}											
									}
								}
							}
							else {
								if($c['type'] == 'date') {
									$cs[$c['name']] = array(
											'label'=>$c['label'],
											//'name'=>$c['name'],
                                            'name'=>'search_grid_'.$url.'_'.$c['name'],
											'ftype'=>$c['type'],									
											'id'=>'search_grid_'.$url.'_'.$cname,
											'source' => $this->get_date_search($c['name'], $url),
										);
								} else if ($c['type'] == 'datetime' || $c['type'] == 'timestamp') {
									$cs[$c['name']] = array(
														'label'=>$c['label'],
														//'name'=>$c['name'],
                                                        'name'=>'search_grid_'.$url.'_'.$c['name'],
														'ftype'=>$c['type'],									
														'id'=>'search_grid_'.$url.'_'.$cname,
														'source' => $this->get_datetime_search($c['name'], $url),
													);
								}
								else {
									$cs[$c['name']] = array(
											'label'=>$c['label'],
											//'name'=>$c['name'],
                                            'name'=>'search_grid_'.$url.'_'.$c['name'],
											'ftype'=>$c['type'],
											'id'=>'search_grid_'.$url.'_'.$cname,
										);
								}
							}
						//}
					}
				}
			}
			$x++;	
		}
		foreach($this->getSearch() as $sc) {
			if(!array_key_exists($sc['fields'], $cs)) {
				$label = in_array($sc['fields'], $this->label) ? $this->label : $sc['fields'];
				$scfields = str_replace('.', '_', $sc['fields']);
				$cs[$sc['fields']] = array(
									'label' => $label,
									//'name' => $sc['fields'],
                                                                        'name' => 'search_grid_'.$url.'_'.$sc['fields'],
									'ftype' => 'varchar',
									//'id'=>'search_grid_'.$url.'_'.$sc['fields'],
									'id'=>'search_grid_'.$url.'_'.$scfields,
								);
			}
		}
		//echo '<pre>';print_r($cs);echo '</pre>';
		return $cs;
		
	}
	
	public function pre_render_form($id='', $parent_id='') {
		$con = $this->getControllerExtends();
		$funcs = $this->render_function();
		//echo '<pre>';print_r($this->tableFields);echo '</pre>';
		//echo '<pre>';print_r($this->fields);echo '</pre>';
		$resp['title'] = $this->getTitle();
		if($this->url == '') {
			$resp['url'] = $this->ci->uri->segment(1);
		}
		else {
			$resp['url'] = $this->url;
		}
		$resp['table'] = $this->tableName;
		
		$nu = explode('_', $resp['url']);
		$nurl = implode('/', $nu);
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		if($this->pk == NULL) {
			foreach($this->getTableList() as $row) {
				if($row['Key'] == 'PRI') {
					$resp['pk'] = $row['Field'];
				}
			}
		}
		else {
			$resp['pk'] = $this->getPk();
		}			
		$resp['relations'] = $this->relation;	
                
                //echo 'aaa : '.$parent_id;
		if($id != '') {
			$resp['id'] = $id;
			//$resp['form_action'] = base_url().$resp['url'].'/index/updateproses';
			$resp['form_action'] = base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=updateproses&foreign_key='.$parent_id.'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID();
			$resp['button_update_id'] = 'button_update_'.$resp['url'];
			$resp['button_update_back_id'] = 'button_update_back_'.$resp['url'];
			$resp['button_cancel_id'] = 'button_cancel_'.$resp['url'];			
			
			$update_data = $this->getUpdateData($this->tableName, $resp['pk'], $id);
			$resp['buttons'] = $this->renderUpdateButton($update_data);
			
			$theFields = array();
			$c = 0;			
			foreach($this->fields as $k => $v) {
				$theFields[$c]['field'] = $v;
				
				if(method_exists($con, $funcs['update'][$v]['box'])) {
					$theFields[$c]['type'] = 'free';							
					$theFields[$c]['lenght'] = 0;
					if(!isset($update_data[$v])) {
						$theValue = '';
					}
					else {
						$theValue = $update_data[$v];
					}
					$theFields[$c]['source'] = $con->$funcs['update'][$v]['box']($v, $resp['url'].'_'.$v, $theValue, $update_data);
				}
				else {					
					if($this->array_key_exists_r($v, $this->change_ft)) {					
						if($this->change_ft[$v] == 'combobox') {
							$theFields[$c]['source'] = $this->change_val[$v];
						}
						$theFields[$c]['type'] = $this->change_ft[$v];
						$theFields[$c]['lenght'] = $this->change_fl[$v];
					}
					else {
						foreach($this->tableFields as $tf) {							
								if(is_array($this->relation) && count($this->relation) > 0) {
									foreach($this->relation as $rel) {
										if($v == $rel['field']) {
											$theFields[$c]['type'] = 'combobox';
											$theFields[$c]['lenght'] = '';
											$theFields[$c]['source'] = $this->get_rel_combobox($rel['field']);														
										}
										if($v == $tf['Field']) {
											$theFields[$c]['type'] = $this->replace_char($tf['Type']);
											$theFields[$c]['lenght'] = $this->getLenght($tf['Type']);
										}
									}
								}
								else {
									if($v == $tf['Field']) {
										$theFields[$c]['type'] = $this->replace_char($tf['Type']);
										$theFields[$c]['lenght'] = $this->getLenght($tf['Type']);
									}							
								}
							//}				
						}
						if(!isset($theFields[$c]['type'])) {
							$theFields[$c]['type'] = 'free';
							if(method_exists($con, $funcs['update'][$v]['box'])) {
								$theFields[$c]['source'] = $con->$funcs['update'][$v]['box']($v, $resp['url'].'_'.$v, $update_data[$v]);
							}
							else {
								$theFields[$c]['source'] = '';
							}
						}
					}
				}
				if($this->array_key_exists_r($v, $this->label)) {
					$theFields[$c]['label'] = $this->label[$v];
				}
				else {
					$theFields[$c]['label'] = ucwords(str_replace(array('-','_'), ' ', $v));
				}
				if($this->array_key_exists_r($v, $this->search)) {
					$theFields[$c]['search'] = TRUE;
				}
				else {
					$theFields[$c]['search'] = FALSE;
				}
				
				if($this->array_key_exists_r($v, $this->required)) {
					$theFields[$c]['required'] = TRUE;
				}
				else {
					$theFields[$c]['required'] = FALSE;
				}				
				if(isset($update_data[$v])) {
					$theFields[$c]['value'] = $update_data[$v];
				}
				else {
					$theFields[$c]['value'] = '';
				}
				
				//start width column form
				if($this->array_key_exists_r($v, $this->formwidth)) {
					$theFields[$c]['size'] = $this->formwidth[$v];
				} else {
					$theFields[$c]['size'] = 50;
				}
				//end width column form
				
				$c++;
			}
		}
		else {
			//$resp['form_action'] = base_url().$resp['url'].'/index/createproses';
			$resp['form_action'] = base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=createproses&foreign_key='.$parent_id.'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID();
			$resp['button_save_id'] = 'button_save_'.$resp['url'];
			$resp['button_save_back_id'] = 'button_save_back_'.$resp['url'];
			$resp['button_cancel_id'] = 'button_cancel_'.$resp['url'];
			$resp['buttons'] = $this->renderInsertButton();
			
			$theFields = array();
			$c = 0;
			
			//print_r($this->change_ft);
			foreach($this->fields as $k => $v) {
				$theFields[$c]['field'] = $v;
				if(method_exists($con, $funcs['insert'][$v]['box'])) {
					$theFields[$c]['type'] = 'free';							
					$theFields[$c]['lenght'] = 0;
					$theFields[$c]['source'] = $con->$funcs['insert'][$v]['box']($v, $resp['url'].'_'.$v);
				}
				else {				
					if($this->array_key_exists_r($v, $this->change_ft)) {
						if($this->change_ft[$v] == 'combobox') {
							$theFields[$c]['source'] = $this->change_val[$v];
						} 			
						$theFields[$c]['type'] = $this->change_ft[$v];
						$theFields[$c]['lenght'] = $this->change_fl[$v];
					}
					else {
						foreach($this->tableFields as $tf) {							
							if(is_array($this->relation) && count($this->relation) > 0) {
								foreach($this->relation as $rel) {
									if($v == $rel['field']) {
										$theFields[$c]['type'] = 'combobox';
										$theFields[$c]['lenght'] = '';
										$theFields[$c]['source'] = $this->get_rel_combobox($rel['field']);														
									}
									if($v == $tf['Field']) {
										$theFields[$c]['type'] = $this->replace_char($tf['Type']);
										$theFields[$c]['lenght'] = $this->getLenght($tf['Type']);
									}
								}
							}
							else {
								if($v == $tf['Field']) {
									$theFields[$c]['type'] = $this->replace_char($tf['Type']);
									$theFields[$c]['lenght'] = $this->getLenght($tf['Type']);
								}							
							}								
						}	
						if(!isset($theFields[$c]['type'])) {
							$theFields[$c]['type'] = 'free';							
							$theFields[$c]['lenght'] = 0;
							if(method_exists($con, $funcs['insert'][$v]['box'])) {
								$theFields[$c]['source'] = $con->$funcs['insert'][$v]['box']($v, $resp['url'].'_'.$v);
							}
							else {
								$theFields[$c]['source'] = '';
							}		
						}				
					}
				}
				if($this->array_key_exists_r($v, $this->label)) {
					$theFields[$c]['label'] = $this->label[$v];
				}
				else {
					$theFields[$c]['label'] = ucwords(str_replace(array('-','_'), ' ', $v));
				}
				if($this->array_key_exists_r($v, $this->search)) {
					$theFields[$c]['search'] = TRUE;
				}
				else {
					$theFields[$c]['search'] = FALSE;
				}
				
				if($this->array_key_exists_r($v, $this->required)) {
					$theFields[$c]['required'] = TRUE;
				}
				else {
					$theFields[$c]['required'] = FALSE;
				}
				
				//start width column form
				if($this->array_key_exists_r($v, $this->formwidth)) {
					$theFields[$c]['size'] = $this->formwidth[$v];
				} else {
					$theFields[$c]['size'] = 50;
				}
				//end width column form
				$c++;
			}
		}
		$resp['relations'] = $this->relation;
		$resp['fields'] = $this->fields;	
		/*$theFields = array();
		$c = 0;
		foreach($this->fields as $k => $v) {
			$theFields[$c]['field'] = $v;
			foreach($this->tableFields as $tf) {
				if($v == $tf['Field']) {
					$theFields[$c]['type'] = $this->replace_char($tf['Type']);
				}
			}
			
			if($this->array_key_exists_r($v, $this->label)) {
				$theFields[$c]['label'] = $this->label[$v];
			}
			else {
				$theFields[$c]['label'] = ucwords(str_replace(array('-','_'), ' ', $v));
			}

			$c++;
		}*/		
		$resp['theFields'] = $theFields;
				
		return $resp;
	}

	public function render_form($id = '', $view = FALSE, $parent_id = '') {
		if($this->url == '') {
			$url = $this->ci->uri->segment(1);
		}
		else {
			$url = $this->url;
		}
		
		$nu = explode('_', $url);
		$nurl = implode('/', $nu);
		$nurl2 = implode('_', $nu);
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		$data = $this->pre_render_form($id, $parent_id);
		//echo '<pre>';print_r($data);echo '</pre>';
		if($id != '') {
			if($view == TRUE) {
				if(@file_exists(APPPATH.'../modules/'.$urlpages[0].'/views/'.$nurl2.'/view.php')) {				
					$this->ci->load->view($nurl2.'/view', $data);
				}
				else {
					$this->ci->template->display($this->view,$data);
				}
			}
			else {				
				if(@file_exists(APPPATH.'../modules/'.$urlpages[0].'/views/'.$nurl2.'/update.php')) {
					//die('1');
					$this->ci->load->view($nurl2.'/update', $data);
				}
				else {
					//die('2');
					if($this->formUpload) {
						$data['form_upload'] = $this->formUpload;
						$this->ci->template->display($this->update_view.'_upload',$data);
					}
					else {
						$this->ci->template->display($this->update_view,$data);
					}
				}			
			}
		}
		else {
			if(@file_exists(APPPATH.'../modules/'.$urlpages[0].'/views/'.$nurl2.'/create.php')) {				
				$this->ci->load->view($nurl2.'/create', $data);
			}
			else {
				if($this->formUpload) {
					$data['form_upload'] = $this->formUpload;
					$this->ci->template->display($this->create_view.'_upload',$data);
				}
				else {
                                    $this->ci->template->display($this->create_view,$data);
				}
			}
                        
                        //print_r($data);
		}		
	}
	
	public function saved_form() {
		//print_r($this->tableFields);
		if($this->url == '') {
			$url = $this->ci->uri->segment(1);
		}
		else {
			$url = $this->url;
		}
		
		$nu = explode('_', $url);
		$nurl = implode('/', $nu);
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		$con = $this->getControllerExtends();
		$funcs = $this->render_function();
		$func = $funcs['insert'];
		$post = $this->ci->input->post();
		$postsip = $this->ci->input->post();
		$postIp = array();
		$insert = array();
		$f_save = array();
		
		$lenUrl = strlen($url);
		foreach($post as $k=>$v) {
			$kx = substr($k, $lenUrl + 1);
			$postIp[$kx] = $v;
		}
		
		foreach($this->getTableList() as $row) {
				$f_save[] = $row['Field'];
		}
		
		$fieldType = array();			
		foreach($this->getTableList() as $list) {			
			foreach($list as $key=>$val) {
				if (!array_key_exists($list['Field'], $fieldType)) {					
					$fieldType[$list['Field']] = $list['Type'];
				}
			}
		}
		
		foreach($this->addFields() as $vf) {			
			if (in_array($vf, $f_save)) {
				$postIp[$vf]=!isset($postIp[$vf])?'':$postIp[$vf]; // dummy field
				if(method_exists($con, $func[$vf]['check'])) {
					if($con->$func[$vf]['check']($postIp[$vf], $vf, $postIp) != 1) {
						$message = $con->$func[$vf]['check']($postIp[$vf], $vf, $postIp) == NULL ? 'Checked Error' : $con->$func[$vf]['check']($postIp[$vf], $vf, $postIp);
						$r['status'] = FALSE;
						$r['message'] = $message;
						return json_encode($r);					
					}				
				}
				if(method_exists($con, $func[$vf]['post'])) {
					if(isset($postIp[$vf])) {
						$new_val = $con->$func[$vf]['post']($postIp[$vf], $vf, $postIp);
						$insert[$vf] = $new_val;
					}				
				}
				else {				
					if(isset($postIp[$vf])) {
						$insert[$vf] = $postIp[$vf];
					}
				}		
			}	
		}
		
        foreach($postIp as $key=>$val) {
		if(preg_match('/^search_(.*)$/' , $key , $match)){        
		   unset($postIp[$match[0]]);
		}
					
		if (in_array($key, $f_save)) {
		       if ($key != '0') $insert[$key] = $val;
		}
			 
			 
        }
                
        foreach($postsip as $key=>$val) {
           if(preg_match('/^search_(.*)$/' , $key , $match)){
              //print_r($match);
              unset($postsip[$match[0]]);
           }
           
           $postIp[$key] = $val;                    
           $insert[$key] = $val;
        }
                
        if (isset($postIp['Array'])) unset($postIp['Array']);               
        

		if(method_exists($con, 'before_insert_processor')) {
			//$insert = $con->before_insert_processor($this->addFields(), $postIp, $postsip);
			$insert = $con->before_insert_processor($this->addFields(), $postIp, $postsip);
		}
		
		
		
		foreach($insert as $k=>$v) {
			if (!in_array($k, $f_save) || $k == '0') {
				unset($insert[$k]);
			}
			
			$postIp[$k] = $v;
		}
		
		$filesx = array();
		foreach($_FILES as $k=>$v) {
			$filesx[] = $k;
		}

		//print_r($this->change_ft);
		if($this->formUpload) {
			foreach($this->change_ft as $kft => $vft) {
				if(strtolower($vft) == 'upload') {
					$config = array();				
					if(method_exists($con, $func[$kft]['post'])) {
						$new_val = $con->$func[$kft]['post']('name', $kft, $postIp);
						$config['file_name'] = $new_val;
					}
					else {
						//$new_val = $_FILES[$kft]['tmp_name'];
						if (in_array($url.'_'.$kft, $filesx)) $new_val = $_FILES[$url.'_'.$kft]['tmp_name'];
					}
					$config['upload_path'] = $this->uploadPath[$kft];
					$config['allowed_types'] = $this->allowedTypes[$kft];
					$config['max_size']	= $this->maxSize[$kft];
					$this->ci->load->library('upload', $config);
					if(array_key_exists($kft, $this->required)) {
						//if(!$this->ci->upload->do_upload($kft)) {
						if(!$this->ci->upload->do_upload($url.'_'.$kft)) {
							$r['status'] = FALSE;
							$r['message'] = $this->clear_ptag($this->ci->upload->display_errors());
							return json_encode($r);						
						}
						else {
							$data['message']=$this->ci->upload->data();
							$insert[$kft] = $data['message']['file_name'];
							//$insert[$kft] = $new_val;
						}
					}
					else {
						//if(!$this->ci->upload->do_upload($kft)) {
						if(!$this->ci->upload->do_upload($url.'_'.$kft)) {
							/*$r['status'] = FALSE;
							$r['message'] = $this->clear_ptag($this->ci->upload->display_errors());
							return json_encode($r);*/						
						}
						else {
							$data['message']=$this->ci->upload->data();
							$insert[$kft] = $data['message']['file_name'];
						}
					}						
				}
				
			}		
		}
		
		foreach($insert as $key=>$val) {
			$dataType = trim($fieldType[$key]);
			switch ($dataType) {
				case 'datetime' :					
					$this->ci->db->set($key, $val);
					break;				
				case 'date' :					
					$this->ci->db->set($key, $val);
					break;
				case 'text' :
					$this->ci->db->set($key, $val);
					break;
				case 'timestamp' :
					$this->ci->db->set($key, $val);
					break;
				default :
					if (substr($dataType, 0, 7) == 'varchar') {
						$this->ci->db->set($key, $val);
					} else if (substr($dataType, 0, 7) == 'tinyint') {
						$this->ci->db->set($key, (int)$val);
					} else if (substr($dataType, 0, 4) == 'char' || substr($dataType, 0, 4) == 'enum') {
						$this->ci->db->set($key, $val);
					} else if (substr($dataType, 0, 3) == 'int') {
						$this->ci->db->set($key, (int)$val);
					} else if (substr($dataType, 0, 3) == 'bit') {
						$this->ci->db->set($key, (int)$val);
					} else {
						$this->ci->db->set($key, $val);
					}
					break;
			}				
		}
		
		//print_r($insert);
		//exit;
		if($this->ci->db->insert($this->tableName)) {
			//echo $this->ci->db->last_query().'<br />';
			//exit;
			$r['last_id'] = $this->ci->db->insert_id();
                        //$r['foreign_id'] = $this->ci->input->get('foreign_key');
			$r['foreign_id'] = !isset($postIp['foreign_key']) ? 0 : $postIp['foreign_key'];//$this->ci->input->get('foreign_key');
			if(method_exists($con, 'after_insert_processor')) {
				$after = $con->after_insert_processor($this->addFields(), $this->ci->db->insert_id(), $postIp);
			}
			$r['status'] = TRUE;
			$r['company_id'] = $this->getCompanyID();
			$r['group_id'] = $this->getGroupID();
			$r['modul_id'] = $this->getModulID();
			//$r['message'] = 'Insert Success! <a href="javascript:;" onClick="javascript:edit_btn(\''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=update&id='.$r['last_id'].'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\',\''.$url.'\')">Click Here to Edit</a>';			
			$r['message'] = "Data Saved Successfuly";
			return json_encode($r);
		}
		else {
			$r['status'] = FALSE;
			$r['message'] = 'Kesalahan Query!';
			return json_encode($r);
		}
	}

	public function updated_form() {
		if($this->url == '') {
			$url = $this->ci->uri->segment(1);
		}
		else {
			$url = $this->url;
		}
		
		
		
		if($this->pk == NULL) {
			foreach($this->getTableList() as $row) {
				if($row['Key'] == 'PRI') {
					$pk = $row['Field'];
				}
			}
		}
		else {
			$pk = $this->getPk();
		}
		
		$pk = $url."_".$pk;
		
		$nu = explode('_', $url);
		$nurl = implode('/', $nu);
		$urlpage = _url_module(uri_string());
		$urlpages = explode('/', $urlpage);
		
		$con = $this->getControllerExtends();
		$funcs = $this->render_function();
		$func = $funcs['update'];
		$post = $this->ci->input->post();
		$postsip = $this->ci->input->post();
		$postIp = array();
		$f_save = array();				
		
		foreach($this->getTableList() as $row) {
			$f_save[] = $row['Field'];
		}
                
		$thisId = $post[$pk];
		$where  = substr($pk, strlen($url) + 1);
		
		$this->ci->db->where($where, $thisId);
		$old_data = $this->ci->db->get($this->tableName)->row_array();
		$update = array();    
                
		$lenUrl = strlen($url);
		foreach($post as $k=>$v) {
			if (substr($k, 0, $lenUrl) == $url) {
				$kx = substr($k, $lenUrl + 1);
				$postIp[$kx] = $v;
			}/* else {
				$postIp[$k] = $v;
			}*/
		}
		
		//echo "Save : ";
		//print_r($f_save);
		//print_r($postIp);
		//echo "a";
		//exit;
		
		$fieldType = array();			
		foreach($this->getTableList() as $list) {			
			foreach($list as $key=>$val) {
				if (!array_key_exists($list['Field'], $fieldType)) {					
					$fieldType[$list['Field']] = $list['Type'];
				}
			}
		}
        
		foreach($this->addFields() as $vf) {  
                        //if (!in_array($vf, $post)) unset($post[$vf]);
                        //if (!in_array($vf, $postsip)) unset($postsip[$vf]);
			//echo $vf.",";
			if (in_array($vf, $f_save)) {        
				$postIp[$vf]=!isset($postIp[$vf])?'':$postIp[$vf]; // dummy field
				if(method_exists($con, $func[$vf]['check'])) {
					if($con->$func[$vf]['check']($postIp[$vf], $vf, $postIp) != 1) {
						$message = $con->$func[$vf]['check']($postIp[$vf], $vf, $postIp) == NULL ? 'Checked Error' : $con->$func[$vf]['check']($postIp[$vf], $vf, $postIp);
						$r['status'] = FALSE;
						$r['message'] = $message;
						return json_encode($r);					
					}				
				}
				if(method_exists($con, $func[$vf]['post'])) {
					if(isset($postIp[$vf])) {
						$new_val = $con->$func[$vf]['post']($postIp[$vf], $vf, $postIp);
						$update[$vf] = $new_val;
					}				
				}
				else {								
					if(array_key_exists($vf, $postIp)) {
						$update[$vf] = $postIp[$vf];
					}
				}
			}
                        
		}
		//exit;
                
        foreach($postIp as $key=>$val) {
		if(preg_match('/^search_(.*)$/' , $key , $match)){
			//print_r($match);
			unset($postIp[$match[0]]);
		}
					
		if (in_array($key, $f_save)) {
			if ($key != '0') $update[$key] = $val;
		}
        }
                
        foreach($postsip as $key=>$val) {
		if(preg_match('/^search_(.*)$/' , $key , $match)){
		    //print_r($match);
		    unset($postsip[$match[0]]);
		}
		
		$postIp[$key] = $val;                    
		$update[$key] = $val;
        }
                
        if (isset($postIp['Array'])) unset($postIp['Array']);

		if(method_exists($con, 'before_update_processor')) {
			$update = $con->before_update_processor($this->addFields(), $postIp, $postsip, $update);
		}
		/*
		 * Tambahan
		 */
		foreach($update as $k=>$v) {
			if (!in_array($k, $f_save) || $k == '0') {
				unset($update[$k]);
			} 			
			$postIp[$k] = $v;
		}
		
		$filesx = array();
		foreach($_FILES as $k=>$v) {
			$filesx[] = $k;
		}

		if($this->formUpload) {
			foreach($this->change_ft as $kft => $vft) {
				if(strtolower($vft) == 'upload') {
					//if(isset($_FILES[$kft])) {
					//print_r($_FILES[$kft]['tmp_name']);
					//if(file_exists($_FILES[$kft]['tmp_name']) && is_uploaded_file($_FILES[$kft]['tmp_name'])) {
					if (in_array($url.'_'.$kft, $filesx)) {
						if(file_exists($_FILES[$url.'_'.$kft]['tmp_name']) && is_uploaded_file($_FILES[$url.'_'.$kft]['tmp_name'])) {
							if(method_exists($con, $func[$kft]['post'])) {
								$new_val = $con->$func[$kft]['post']('name', $kft, $postIp);
								$config['file_name'] = $new_val;
							}				
							$config['upload_path'] = $this->uploadPath[$kft];
							$config['allowed_types'] = $this->allowedTypes[$kft];
							$config['max_size']	= $this->maxSize[$kft];
							$this->ci->load->library('upload', $config);
							//if(!$this->ci->upload->do_upload($kft)) {
							if(!$this->ci->upload->do_upload($url.'_'.$kft)) {
								$r['status'] = FALSE;
								$r['message'] = $this->clear_ptag($this->ci->upload->display_errors());
								return json_encode($r);						
							}
							else {
								$data['message']=$this->ci->upload->data();
								$update[$kft] = $data['message']['file_name'];
							}
						}
					} else {
						unset($update[$kft]);
					}
				}
				
			}		
		}
		
		//print_r($this->ci->db->update($this->tableName, $update));
		//exit;
		//print_r($update);
		//exit;
		
		//print_r($pk);
		//print_r($postsip);
		//print_r($postIp);
		//exit;
		//echo "test";
		//print_r($post);
		
		$this->ci->db->where($where, $postIp[$where]);		
		foreach($update as $key=>$val) {
			$dataType = trim($fieldType[$key]);	
			switch ($dataType) {
				case 'datetime' :					
					$this->ci->db->set($key, $val);
					break;
				case 'date' :					
					$this->ci->db->set($key, $val);
					break;
				case 'text' :
					$this->ci->db->set($key, $val);
					break;
				case 'timestamp' :
					$this->ci->db->set($key, $val);
					break;
				default :
					if (substr($dataType, 0, 7) == 'varchar') {
						$this->ci->db->set($key, $val);
					} else if (substr($dataType, 0, 7) == 'tinyint') {
						$this->ci->db->set($key, (int)$val);
					} else if (substr($dataType, 0, 4) == 'char' || substr($dataType, 0, 4) == 'enum') {
						$this->ci->db->set($key, $val);
					} else if (substr($dataType, 0, 3) == 'int') {
						$this->ci->db->set($key, (int)$val);
					} else if (substr($dataType, 0, 3) == 'bit') {
						$this->ci->db->set($key, (int)$val);
					} else {
						$this->ci->db->set($key, $val);
					}
					break;
			}			
		}
		
		if($this->ci->db->update($this->tableName)) {
			//echo $this->ci->db->last_query().'<br />';
			//exit;
			if(method_exists($con, 'after_update_processor')) {
				$after = $con->after_update_processor($this->addFields(), $postIp[$where], $postIp, $old_data);
			}
                        //echo 'Foreign Key : '.$this->ci->input->get('foreign_key');
                        //print_r($post);

			$r['status'] = TRUE;
			$r['last_id'] = $postIp[$where];
			$r['foreign_id'] = !isset($post['foreign_key']) ? 0 : $postIp['foreign_key'];//$this->ci->input->get('foreign_key');
			$r['company_id'] = $this->getCompanyID();
			$r['group_id'] = $this->getGroupID();
			$r['modul_id'] = $this->getModulID();
			//$r['message'] = 'Data Updated! <a href="javascript:;" onClick="javascript:edit_btn(\''.base_url().'processor/'.$urlpages[0].'/'.$nurl.'?action=update&id='.$thisId.'&company_id='.$this->getCompanyID().'&group_id='.$this->getGroupID().'&modul_id='.$this->getModulID().'\',\''.$url.'\')">Click Here to Edit</a>';
			$r['message'] = "Data Updated Successfuly";
			//$r['message'] = $this->ci->db->last_query();			
			return json_encode($r);
		}
		else {
			$r['status'] = FALSE;
			$r['message'] = 'Kesalahan Query!';
			return json_encode($r);
		}
	}
	
	public function getJsonData() {
                
		$this->getControllerExtends();
		if($this->pk == NULL) {
			foreach($this->getTableList() as $row) {
				if($row['Key'] == 'PRI') {
					$pk = $row['Field'];
				}
			}
		}
		else {
			$pk = $this->getPk();
		}
		if(empty($this->renderList)) {
			$renderList = $this->getRenderList();
		}
		//print_r($renderList);
		if($this->url == '') {
			$url = $this->ci->uri->segment(1);
		}
		else {
			$url = $this->url;
		}
		$ur = explode('/', $url);
		$url = $ur[0];
		$functions = $this->render_function();
		$cont = new $url;
		
		buildGridData(
			array(
			'library' => 'grid',
			'button_view' => $this->button_view,
			'method' => 'json',
			'pkid' => $pk,
			'search' => $this->getSearch(),
			'relations' => $this->relation,
			'join_table' => $this->join_table,
			'change_fields' => $this->change_fields,
			'queries' => $this->queries,
			'cont' => $this->getControllerExtendsUrl(),
			'functions' => $functions['list'],
			'functions_search' => $functions['search'],
			'the_url' => $url,
			'table' => $this->tableName,
			'columns_list' => $this->list,
			'columns' => $renderList,
			'group_by' => $this->group_by,
			'searchOperand' => $this->searchOperand,
            'foreign_key' => $this->ci->input->get('foreign_key'),

             'vsql' =>$this->esql,
             'vsqlCond' =>$this->esqlCond,
             'vsqlOrder' =>$this->esqlOrder

			)
		);
	}
	
	private function getUpdateData($table, $pk_id, $pk_value) {
		return $this->ci->db->get_where($table, array($pk_id => $pk_value))->row_array();
	}

	public function json($paramArr) {
		//print_r($paramArr);
		$start = isset($paramArr['start']) ? $paramArr['start'] : NULL;
		$limit = isset($paramArr['limit']) ? $paramArr['limit'] : NULL;
		$sortField = isset($paramArr['sortField']) ? $paramArr['sortField'] : $paramArr['pk'];
		$groupField = isset($paramArr['groupField']) ? $paramArr['groupField'] : $paramArr['pk'];
		$sortOrder = isset($paramArr['sortOrder']) ? $paramArr['sortOrder'] : 'ASC';
		$searchParam = isset($paramArr['searchFields']) ? $paramArr['searchFields'] : NULL;
		$funcs = $paramArr['functions_search'];
		
		

		

		if($paramArr['vsql'] <> ''){
			//echo "atas";
			/*Order and limit Start*/
			/*if($limit <> ""){
				$cLimt = ' limit '.$limit.','.$start;

			}else{
				$cLimt = '';
			}*/

			if(!empty($start) && !empty($limit)) {
				//$this->ci->db->limit($limit, $start);
				//$cLimt = ' limit '.$limit.','.$start;
				$cLimt = ' limit '.$start.','.$limit;
			} else {
				//$this->ci->db->limit($this->ci->input->get('rows'), 0);
				$cLimt = ' limit '.'0'.','.$this->ci->input->get('rows');
			}


			$cSort = $paramArr['vsqlOrder'].$cLimt;
			/*Order and limit End*/

			$cCond = $paramArr['vsqlCond'].' ';
			/*Sql Condition Start*/
			if(!empty($searchParam)) {
				foreach($searchParam as $sp => $val) {


						// get all filed and push to array 
						$tabl = explode('.', $paramArr['table']);
						$getCol = $this->getCol($tabl[1]);
							// if $val['field'] in array ,  then $cCond .= 'AND '. $val['field']." = '".$value."'"; else just skip.
						if(in_array($val['field'], $getCol)){
							$efield = explode('__', $val['field']);
							$cfield = count($efield);
							if($cfield == 1) {
								$val['field'] = $paramArr['table'].'.'.$val['field'];
							}
							elseif($cfield == 2) {
								$val['field'] = $efield[0].'.'.$efield[1];
							}
							
							
							if($val['type'] == 'date') {
								if($val['value'] != '' && $val['value'] != '0000-00-00') {
									$value = $this->to_mysql($val['value']);

									$cCond .= 'AND '. $val['field']." = '".$value."'";
									//$this->ci->db->where($val['field']." = '".$value."'");
								}
							} elseif($val['type'] == 'datetime' || $val['type'] == 'timestamp') {
								if($val['value_start'] != '' && $val['value_end'] != '') {
									$value_start = $this->to_mysql($val['value_start']);
									$value_end = $this->to_mysql($val['value_end']);
									
									$value_start = $value_start.' 00:00:01';
									$value_end = $value_end.' 23:59:59';
									//$this->ci->db->where($val['field']." BETWEEN '".$value_start."' AND '".$value_end."'");
									$cCond .= 'AND '. $val['field']." BETWEEN '".$value_start."' AND '".$value_end."'";
								}										
							} elseif($val['type'] == 'between') {
								if($val['value_start'] != '' && $val['value_end'] != '') {
									//$this->ci->db->where($val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'");
									$cCond .= 'AND '. $val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'";
								}
							} elseif($val['type'] == 'int') {
								if ($val['value'] != '') {
									//$this->ci->db->where($val['field'] .' = '. $val['value']);
									$cCond .= 'AND '. $val['field'] .' = '. $val['value'];
								}
							} elseif($val['type'] == 'tinyint') {
								if ($val['value'] != '') {
									//$this->ci->db->where($val['field'] .' = '. $val['value']);
									$cCond .= 'AND '. $val['field'] .' = '. $val['value'];
								}
							} elseif(substr($val['type'], 0, 4) == 'enum') {
								if ($val['value'] != '') {
									//$this->ci->db->where($val['field'] ." = '". mysql_real_escape_string($val['value'])."'");
									$cCond .= 'AND '. $val['field'] ." = '". mysql_real_escape_string($val['value'])."'";
								}
							} else {
								$value = mysql_real_escape_string($val['value']);
								$sp = str_replace("__", ".", $sp);
								if($this->array_key_exists_r($sp, $paramArr['searchOperand'])) {
									if($value != '') {
										switch (strtolower($paramArr['searchOperand'][$sp])) {
											case 'eq':
												//$this->ci->db->where($val['field'], $value);
												$cCond .= 'AND '. $val['field'] .' = '. $value;
												break;
											case 'lt':
												//$this->ci->db->where($val['field'].' < \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' < \''.$value.'\'';
												break;
											default:
											case 'lteq':
												//$this->ci->db->where($val['field'].' <= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' <= \''.$value.'\'';
												break;
											case 'le':
												//$this->ci->db->where($val['field'].' <= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' <= \''.$value.'\'';
												break;
											default:
											case 'gt':
												//$this->ci->db->where($val['field'].' > \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' > \''.$value.'\'';
												break;
											default:
											case 'gteq':
												//$this->ci->db->where($val['field'].' >= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' >= \''.$value.'\'';
												break;
											case 'ge':
												//$this->ci->db->where($val['field'].' >= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' >= \''.$value.'\'';
												break;
											default:
												preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
												if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
													if($val['value'] != '') {
														//$this->ci->db->where($val['field'] .' = '. $value);
														$cCond .= 'AND '. $val['field'] .' = '. $value;
													}
												}
												else {
													//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
													$cCond .= 'AND '. $val['field'] .' LIKE \'%'. $value .'%\'';
												}
												break;
										}
									}
								}
								else {
									if($this->array_key_exists_r($sp, $paramArr['relations'])) {
										if($value != '') {
											//$this->ci->db->where($val['field'], mysql_real_escape_string($value));
											$cCond .= 'AND '. $val['field'] ." = '". mysql_real_escape_string($value)."'";
										}
									}
									else {
									
										if($value != '') {
											$eff = explode('.', $val['field']);
											$cff = count($eff);
											if($cff == 3) {
												if($eff[0].'.'.$eff[1] == $paramArr['table']) {
													$valf = $eff[2];
												}
												else {
													$valf = $val['field'];
												}																		
											}
											if($cff == 2) {
												if($eff[0] == $paramArr['table']) {
													$valf = $eff[1];
												}
												else {
													$valf = $val['field'];
												}									
											}
											$vpfield = str_replace('.', '__', $valf);
											if(method_exists($paramArr['con'], $funcs[$vpfield]['post'])) {
												$vfield = str_replace('.', '__', $val['field']);
												$valf_ = str_replace('.', '__', $valf);
												$value = $paramArr['con']->$funcs[$valf_]['post']($val['value'], $vfield);											
											}					
										}
										preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
										if(sizeOf($matches) > 0 || $val['type'] == 'bit'){
											if($val['value'] != '') {
												//$this->ci->db->where($val['field'] .' = '. $value .'');
												$cCond .= 'AND '. $val['field'] .' = '. $value;
											}						
										}
										else {								
											if ( $value != '' ) {
												//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
												$cCond .= 'AND '. $val['field'] .' LIKE \'%'. $value .'%\'';
											}
										}
									
									}	
								}			
							}	
						}
								
				}
			}
			/*Sql Condition End*/

			$sqlFull = $paramArr['vsql'].$cCond.$cSort;
			$query = $this->ci->db->query($sqlFull)->result();

		}else{
			//echo "bawah";
			if(!empty($start) && !empty($limit)) {
				$this->ci->db->limit($limit, $start);
			} else {
				$this->ci->db->limit($this->ci->input->get('rows'), 0);
			}
			
			if(!empty($searchParam)) {
				foreach($searchParam as $sp => $val) {
					$efield = explode('__', $val['field']);
					$cfield = count($efield);
					if($cfield == 1) {
						$val['field'] = $paramArr['table'].'.'.$val['field'];
					}
					elseif($cfield == 2) {
						$val['field'] = $efield[0].'.'.$efield[1];
					}
					
					
					if($val['type'] == 'date') {
						if($val['value'] != '' && $val['value'] != '0000-00-00') {
							$value = $this->to_mysql($val['value']);	
							$this->ci->db->where($val['field']." = '".$value."'");
						}
					} elseif($val['type'] == 'datetime' || $val['type'] == 'timestamp') {
						if($val['value_start'] != '' && $val['value_end'] != '') {
							$value_start = $this->to_mysql($val['value_start']);
							$value_end = $this->to_mysql($val['value_end']);
							
							$value_start = $value_start.' 00:00:01';
							$value_end = $value_end.' 23:59:59';
							$this->ci->db->where($val['field']." BETWEEN '".$value_start."' AND '".$value_end."'");
						}										
					} elseif($val['type'] == 'between') {
						if($val['value_start'] != '' && $val['value_end'] != '') {
							$this->ci->db->where($val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'");
						}
					} elseif($val['type'] == 'int') {
						if ($val['value'] != '') {
							$this->ci->db->where($val['field'] .' = '. $val['value']);
						}
					} elseif($val['type'] == 'tinyint') {
						if ($val['value'] != '') {
							$this->ci->db->where($val['field'] .' = '. $val['value']);
						}
					} elseif(substr($val['type'], 0, 4) == 'enum') {
						if ($val['value'] != '') {
							$this->ci->db->where($val['field'] ." = '". mysql_real_escape_string($val['value'])."'");
						}
					} else {
						$value = mysql_real_escape_string($val['value']);
						$sp = str_replace("__", ".", $sp);
						if($this->array_key_exists_r($sp, $paramArr['searchOperand'])) {
							if($value != '') {
								switch (strtolower($paramArr['searchOperand'][$sp])) {
									case 'eq':
										$this->ci->db->where($val['field'], $value);
										break;
									case 'lt':
										$this->ci->db->where($val['field'].' < \''.$value.'\'');
										break;
									default:
									case 'lteq':
										$this->ci->db->where($val['field'].' <= \''.$value.'\'');
										break;
									case 'le':
										$this->ci->db->where($val['field'].' <= \''.$value.'\'');
										break;
									default:
									case 'gt':
										$this->ci->db->where($val['field'].' > \''.$value.'\'');
										break;
									default:
									case 'gteq':
										$this->ci->db->where($val['field'].' >= \''.$value.'\'');
										break;
									case 'ge':
										$this->ci->db->where($val['field'].' >= \''.$value.'\'');
										break;
									default:
										preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
										if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
											if($val['value'] != '') {
												$this->ci->db->where($val['field'] .' = '. $value);
											}
										}
										else {
											$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
										}
										break;
								}
							}
						}
						else {
							if($this->array_key_exists_r($sp, $paramArr['relations'])) {
								if($value != '') {
									$this->ci->db->where($val['field'], mysql_real_escape_string($value));
								}
							}
							else {
							
								if($value != '') {
									$eff = explode('.', $val['field']);
									$cff = count($eff);
									if($cff == 3) {
										if($eff[0].'.'.$eff[1] == $paramArr['table']) {
											$valf = $eff[2];
										}
										else {
											$valf = $val['field'];
										}																		
									}
									if($cff == 2) {
										if($eff[0] == $paramArr['table']) {
											$valf = $eff[1];
										}
										else {
											$valf = $val['field'];
										}									
									}
									$vpfield = str_replace('.', '__', $valf);
									if(method_exists($paramArr['con'], $funcs[$vpfield]['post'])) {
										$vfield = str_replace('.', '__', $val['field']);
										$valf_ = str_replace('.', '__', $valf);
										$value = $paramArr['con']->$funcs[$valf_]['post']($val['value'], $vfield);											
									}					
								}
								preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
								if(sizeOf($matches) > 0 || $val['type'] == 'bit'){
									if($val['value'] != '') {
										$this->ci->db->where($val['field'] .' = '. $value .'');
									}						
								}
								else {								
									if ( $value != '' ) {
										$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
									}
								}
							
							}	
						}			
					}		
				}
			}

			if(is_array($paramArr['join_table']) && count($paramArr['join_table']) > 0) {
				foreach($paramArr['join_table'] as $r) {				
					foreach($paramArr['list'] as $kl => $vl) {
						$elist = explode('.', $vl);
						$clist = count($elist);
						$erlist = explode('.', $r['table']);
						$crlist = count($erlist);
						//echo $clist.' ';
						if($clist == 2) {
							$listt = $elist[0];
							$listl = $elist[1];
							if($crlist == 2) {
								$rtable = $erlist[1];
							}
							elseif($crlist == 1) {
								$rtable = $erlist[0];
							}
							if($listt == $rtable) {
								$this->ci->db->select($rtable.'.'.$listl .' AS '.$rtable.'__'.$listl, FALSE);
							}
						}
						
					}
					$this->ci->db->join($r['table'], $r['glue'], $r['type']);								
				}			
			}
			if(is_array($paramArr['relations']) && count($paramArr['relations']) > 0) {			
				foreach($paramArr['relations'] as $r) {
					$dotfield = strpos($r['field'], '.');
					if($dotfield) {
						$rfield = $r['field'];
					}
					else {
						$rfield = $paramArr['table'].'.'.$r['field'];
					}
					$this->ci->db->join($r['join_table'], $rfield.'='.$r['join_table'].'.'.$r['foreign_key'], $r['type']);
					if($r['as'] != '') {
						$this->ci->db->select($r['join_table'].'.'.$r['view_as'] .' AS '.$r['as'], FALSE);
					}
					else {
						$this->ci->db->select($r['join_table'].'.'.$r['view_as']);
					}				
				}			
			}		
			if(is_array($paramArr['queries']) && count($paramArr['queries']) > 0) {
				foreach($paramArr['queries'] as $k => $val) {									
					foreach($val as $kv => $vv) {
							$this->ci->db->where($kv, $vv);
					}				
				}			
			}
			
			$urlpage = explode('/', _url_module(uri_string()));
			$this->ci->db->select('/*'.$urlpage[1].'/'.$urlpage[1].'.php/'.$urlpage[2].'*/'.$paramArr['table'].'.*', FALSE);
			$this->ci->db->order_by($sortField, $sortOrder);
			$this->ci->db->group_by($groupField);

			$query = $this->ci->db->get($paramArr['table'])->result();	
			
		}

		

		
		//show query asli
		echo $this->ci->db->last_query();
		exit;

		
		
		return $query;
	}

	public function count_json($paramArr) {	
		

		$funcs = $paramArr['functions_search'];
		$searchParam = isset($paramArr['searchFields']) ? $paramArr['searchFields'] : NULL;

		if($paramArr['vsql'] <> ''){

			/*Order and limit Start*/
			/*if($limit <> ""){
				$cLimt = ' limit '.$limit.','.$start;

			}else{
				$cLimt = '';
			}*/

			$cSort = $paramArr['vsqlOrder']/*.$cLimt*/;
			/*Order and limit End*/

			$cCond = $paramArr['vsqlCond'].' ';
			/*Sql Condition Start*/
			if(!empty($searchParam)) {
				foreach($searchParam as $sp => $val) {


						// get all filed and push to array 
						$tabl = explode('.', $paramArr['table']);
						$getCol = $this->getCol($tabl[1]);
						
							// if $val['field'] in array ,  then $cCond .= 'AND '. $val['field']." = '".$value."'"; else just skip.
						if(in_array($val['field'], $getCol)){
							$efield = explode('__', $val['field']);
							$cfield = count($efield);
							if($cfield == 1) {
								$val['field'] = $paramArr['table'].'.'.$val['field'];
							}
							elseif($cfield == 2) {
								$val['field'] = $efield[0].'.'.$efield[1];
							}
							
							
							if($val['type'] == 'date') {
								if($val['value'] != '' && $val['value'] != '0000-00-00') {
									$value = $this->to_mysql($val['value']);

									$cCond .= 'AND '. $val['field']." = '".$value."'";
									//$this->ci->db->where($val['field']." = '".$value."'");
								}
							} elseif($val['type'] == 'datetime' || $val['type'] == 'timestamp') {
								if($val['value_start'] != '' && $val['value_end'] != '') {
									$value_start = $this->to_mysql($val['value_start']);
									$value_end = $this->to_mysql($val['value_end']);
									
									$value_start = $value_start.' 00:00:01';
									$value_end = $value_end.' 23:59:59';
									//$this->ci->db->where($val['field']." BETWEEN '".$value_start."' AND '".$value_end."'");
									$cCond .= 'AND '. $val['field']." BETWEEN '".$value_start."' AND '".$value_end."'";
								}										
							} elseif($val['type'] == 'between') {
								if($val['value_start'] != '' && $val['value_end'] != '') {
									//$this->ci->db->where($val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'");
									$cCond .= 'AND '. $val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'";
								}
							} elseif($val['type'] == 'int') {
								if ($val['value'] != '') {
									//$this->ci->db->where($val['field'] .' = '. $val['value']);
									$cCond .= 'AND '. $val['field'] .' = '. $val['value'];
								}
							} elseif($val['type'] == 'tinyint') {
								if ($val['value'] != '') {
									//$this->ci->db->where($val['field'] .' = '. $val['value']);
									$cCond .= 'AND '. $val['field'] .' = '. $val['value'];
								}
							} elseif(substr($val['type'], 0, 4) == 'enum') {
								if ($val['value'] != '') {
									//$this->ci->db->where($val['field'] ." = '". mysql_real_escape_string($val['value'])."'");
									$cCond .= 'AND '. $val['field'] ." = '". mysql_real_escape_string($val['value'])."'";
								}
							} else {
								$value = mysql_real_escape_string($val['value']);
								$sp = str_replace("__", ".", $sp);
								if($this->array_key_exists_r($sp, $paramArr['searchOperand'])) {
									if($value != '') {
										switch (strtolower($paramArr['searchOperand'][$sp])) {
											case 'eq':
												//$this->ci->db->where($val['field'], $value);
												$cCond .= 'AND '. $val['field'] .' = '. $value;
												break;
											case 'lt':
												//$this->ci->db->where($val['field'].' < \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' < \''.$value.'\'';
												break;
											default:
											case 'lteq':
												//$this->ci->db->where($val['field'].' <= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' <= \''.$value.'\'';
												break;
											case 'le':
												//$this->ci->db->where($val['field'].' <= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' <= \''.$value.'\'';
												break;
											default:
											case 'gt':
												//$this->ci->db->where($val['field'].' > \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' > \''.$value.'\'';
												break;
											default:
											case 'gteq':
												//$this->ci->db->where($val['field'].' >= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' >= \''.$value.'\'';
												break;
											case 'ge':
												//$this->ci->db->where($val['field'].' >= \''.$value.'\'');
												$cCond .= 'AND '. $val['field'].' >= \''.$value.'\'';
												break;
											default:
												preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
												if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
													if($val['value'] != '') {
														//$this->ci->db->where($val['field'] .' = '. $value);
														$cCond .= 'AND '. $val['field'] .' = '. $value;
													}
												}
												else {
													//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
													$cCond .= 'AND '. $val['field'] .' LIKE \'%'. $value .'%\'';
												}
												break;
										}
									}
								}
								else {
									if($this->array_key_exists_r($sp, $paramArr['relations'])) {
										if($value != '') {
											//$this->ci->db->where($val['field'], mysql_real_escape_string($value));
											$cCond .= 'AND '. $val['field'] ." = '". mysql_real_escape_string($value)."'";
										}
									}
									else {
									
										if($value != '') {
											$eff = explode('.', $val['field']);
											$cff = count($eff);
											if($cff == 3) {
												if($eff[0].'.'.$eff[1] == $paramArr['table']) {
													$valf = $eff[2];
												}
												else {
													$valf = $val['field'];
												}																		
											}
											if($cff == 2) {
												if($eff[0] == $paramArr['table']) {
													$valf = $eff[1];
												}
												else {
													$valf = $val['field'];
												}									
											}
											$vpfield = str_replace('.', '__', $valf);
											if(method_exists($paramArr['con'], $funcs[$vpfield]['post'])) {
												$vfield = str_replace('.', '__', $val['field']);
												$valf_ = str_replace('.', '__', $valf);
												$value = $paramArr['con']->$funcs[$valf_]['post']($val['value'], $vfield);											
											}					
										}
										preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
										if(sizeOf($matches) > 0 || $val['type'] == 'bit'){
											if($val['value'] != '') {
												//$this->ci->db->where($val['field'] .' = '. $value .'');
												$cCond .= 'AND '. $val['field'] .' = '. $value;
											}						
										}
										else {								
											if ( $value != '' ) {
												//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
												$cCond .= 'AND '. $val['field'] .' LIKE \'%'. $value .'%\'';
											}
										}
									
									}	
								}			
							}	
						}
								
				}
			}
			/*Sql Condition End*/

			$sqlFull = $paramArr['vsql'].$cCond.$cSort;
			$query = $this->ci->db->query($sqlFull)->num_rows();

		}else{
			if(!empty($searchParam)) {
				foreach($searchParam as $sp => $val) {
					$efield = explode('__', $val['field']);
					$cfield = count($efield);
					if($cfield == 1) {
						$val['field'] = $paramArr['table'].'.'.$val['field'];
					}
					elseif($cfield == 2) {
						$val['field'] = $efield[0].'.'.$efield[1];
					}
					if($val['type'] == 'date') {
						if($val['value'] != '' && $val['value'] != '0000-00-00') {
							$value = $this->to_mysql($val['value']);	
							$this->ci->db->where($val['field']." = '".$value."'");
						}
					}
					elseif($val['type'] == 'datetime' || $val['type'] == 'timestamp') {
						if($val['value_start'] != '' && $val['value_end'] != '') {
							$value_start = $this->to_mysql($val['value_start']);
							$value_end = $this->to_mysql($val['value_end']);
							
							$value_start = $value_start.' 00:00:01';
							$value_end = $value_end.' 23:59:59';
							$this->ci->db->where($val['field']." BETWEEN '".$value_start."' AND '".$value_end."'");
						}										
					} elseif($val['type'] == 'between') {
						if($val['value_start'] != '' && $val['value_end'] != '') {
							$this->ci->db->where($val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'");
						}
					} elseif($val['type'] == 'int') {
						if ($val['value'] != '') {
							$this->ci->db->where($val['field'] .' = '. $val['value']);
						}
					} elseif($val['type'] == 'tinyint') {
						if ($val['value'] != '') {
							$this->ci->db->where($val['field'] .' = '. $val['value']);
						}
					} elseif(substr($val['type'], 0, 4) == 'enum') {
						if ($val['value'] != '') {
							$this->ci->db->where($val['field'] ." = '". mysql_real_escape_string($val['value'])."'");
						}
					} else {
						$value = mysql_real_escape_string($val['value']);
						//$val['field'] = str_replace('_____', '.', $val['field']);
	                                        $sp = str_replace("__", ".", $sp);
						if($this->array_key_exists_r($sp, $paramArr['searchOperand'])) {
							if($value != '') {
								switch (strtolower($paramArr['searchOperand'][$sp])) {
									case 'eq':
										$this->ci->db->where($val['field'], $value);
										break;
									case 'lt':
										$this->ci->db->where($val['field'].' < \''.$value.'\'');
										break;
									default:
									case 'lteq':
										$this->ci->db->where($val['field'].' <= \''.$value.'\'');
										break;
									default:
									case 'gt':
										$this->ci->db->where($val['field'].' > \''.$value.'\'');
										break;
									default:
									case 'gteq':
										$this->ci->db->where($val['field'].' >= \''.$value.'\'');
										break;
									default:
										preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
										if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
											if($val['value'] != '') {
												$this->ci->db->where($val['field'] .' = '. $value);
											}
										} else {
											$this->ci->db->where($val['field'].' LIKE \'%'. $value .'%\'');
										}
										break;
								}
							}
						}
						else {
							if($this->array_key_exists_r($sp, $paramArr['relations'])) {
								if($value != '') {
									//$this->ci->db->where($paramArr['table'].'.'.$val['field'], $value);
									$this->ci->db->where($val['field'], $value);
								}
							
							}
							else {					
								
								if($value != '') {
									$eff = explode('.', $val['field']);
									$cff = count($eff);
									if($cff == 3) {
										if($eff[0].'.'.$eff[1] == $paramArr['table']) {
											$valf = $eff[2];
										}
										else {
											//$valf = $eff[1].'_'.$eff[2];
											$valf = $val['field'];
										}																		
									}
									if($cff == 2) {
										if($eff[0] == $paramArr['table']) {
											$valf = $eff[1];
										}
										else {
											//$valf = $eff[0].'_'.$eff[1];
											$valf = $val['field'];
										}									
									}
									$vpfield = str_replace('.', '__', $valf);
									if(method_exists($paramArr['con'], $funcs[$vpfield]['post'])) {
										$vfield = str_replace('.', '__', $val['field']);
										$valf_ = str_replace('.','__', $valf);
										$value = $paramArr['con']->$funcs[$valf_]['post']($val['value'], $vfield);											
									}								
								}
								preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
								if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
									if($val['value'] != '') {
										//$this->ci->db->where($paramArr['table'].'.'.$val['field'] .' LIKE \'%'. $value .'%\'');
										//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
										$this->ci->db->where($val['field'] .' = '. $value);
									}
								}
								else {
									//$this->ci->db->where($paramArr['table'].'.'.$val['field'] .' LIKE \'%'. $value .'%\'');
									if ( $value != '' ) {
										$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
									}
								}
							}
						}
					}
				}
			}
			if(is_array($paramArr['join_table']) && count($paramArr['join_table']) > 0) {
				foreach($paramArr['join_table'] as $r) {
					$this->ci->db->join($r['table'], $r['glue'], $r['type']);
				}
			}
			if(is_array($paramArr['relations']) && count($paramArr['relations']) > 0) {
				foreach($paramArr['relations'] as $r) {
					$dotfield = strpos($r['field'], '.');
					if($dotfield) {
						$rfield = $r['field'];
					}
					else {
						$rfield = $paramArr['table'].'.'.$r['field'];
					}
					$this->ci->db->join($r['join_table'], $rfield.'='.$r['join_table'].'.'.$r['foreign_key'], $r['type']);
				}
			}		
			if(is_array($paramArr['queries']) && count($paramArr['queries']) > 0) {
				foreach($paramArr['queries'] as $k => $val) {
					foreach($val as $kv => $vv) {
						$this->ci->db->where($kv, $vv);
					}
				}
			}
			$this->ci->db->from($paramArr['table']);
			$query = $this->ci->db->count_all_results();

			}
		
		
		return $query;
	}


	public function getCol($tabel){
		$arrCol = array();
		$sqCol = 'SELECT `COLUMN_NAME` 
				FROM `INFORMATION_SCHEMA`.`COLUMNS` 
				WHERE `TABLE_NAME`="'.$tabel.'"';
		$dataCol = $this->ci->db->query($sqCol)->result_array();

		foreach ($dataCol as $dCol ) {
			array_push($arrCol, $dCol['COLUMN_NAME']);
			
		}


		return $arrCol;

	}
	public function json2($paramArr) {
		//print_r($paramArr);
		$start = isset($paramArr['start']) ? $paramArr['start'] : NULL;
		$limit = isset($paramArr['limit']) ? $paramArr['limit'] : NULL;
		$sortField = isset($paramArr['sortField']) ? $paramArr['sortField'] : $paramArr['pk'];
		$groupField = isset($paramArr['groupField']) ? $paramArr['groupField'] : $paramArr['pk'];
		$sortOrder = isset($paramArr['sortOrder']) ? $paramArr['sortOrder'] : 'ASC';
		$searchParam = isset($paramArr['searchFields']) ? $paramArr['searchFields'] : NULL;
		$funcs = $paramArr['functions_search'];
		if(!empty($start) && !empty($limit)) {
			$this->ci->db->limit($limit, $start);
		} else {
			$this->ci->db->limit($this->ci->input->get('rows'), 0);
		}
		/*else {
			$page = $this->ci->input->get('page');
			$limit = $this->ci->input->get('rows');
			$start = $limit * $page - $limit;
			$this->ci->db->limit($limit, $start);
		}*/
		//$this->ci->db->select($paramArr['table'].'.*', FALSE);
		//print_r($searchParam);
		if(!empty($searchParam)) {
			foreach($searchParam as $sp => $val) {
				$efield = explode('__', $val['field']);
				$cfield = count($efield);
				if($cfield == 1) {
					$val['field'] = $paramArr['table'].'.'.$val['field'];
				}
				elseif($cfield == 2) {
					$val['field'] = $efield[0].'.'.$efield[1];
				}
				
				//$val['field'] = str_replace('_____', '.', $val['field']);
                                //echo $val['field']." => ".$val['type']."\n";
				if($val['type'] == 'date') {
					if($val['value'] != '' && $val['value'] != '0000-00-00') {
						$value = $this->to_mysql($val['value']);	
						$this->ci->db->where($val['field']." = '".$value."'");
					}
				} elseif($val['type'] == 'datetime' || $val['type'] == 'timestamp') {
					if($val['value_start'] != '' && $val['value_end'] != '') {
						$value_start = $this->to_mysql($val['value_start']);
						$value_end = $this->to_mysql($val['value_end']);
						
						$value_start = $value_start.' 00:00:01';
						$value_end = $value_end.' 23:59:59';
						$this->ci->db->where($val['field']." BETWEEN '".$value_start."' AND '".$value_end."'");
					}										
				} elseif($val['type'] == 'between') {
					if($val['value_start'] != '' && $val['value_end'] != '') {
						$this->ci->db->where($val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'");
					}
				} elseif($val['type'] == 'int') {
					if ($val['value'] != '') {
						$this->ci->db->where($val['field'] .' = '. $val['value']);
					}
				} elseif($val['type'] == 'tinyint') {
					if ($val['value'] != '') {
						$this->ci->db->where($val['field'] .' = '. $val['value']);
					}
				} elseif(substr($val['type'], 0, 4) == 'enum') {
					if ($val['value'] != '') {
						$this->ci->db->where($val['field'] ." = '". mysql_real_escape_string($val['value'])."'");
					}
				} else {
					$value = mysql_real_escape_string($val['value']);
					//$val['field'] = str_replace('_____', '.', $val['field']);
					$sp = str_replace("__", ".", $sp);
					if($this->array_key_exists_r($sp, $paramArr['searchOperand'])) {
						if($value != '') {
							switch (strtolower($paramArr['searchOperand'][$sp])) {
								case 'eq':
									$this->ci->db->where($val['field'], $value);
									break;
								case 'lt':
									$this->ci->db->where($val['field'].' < \''.$value.'\'');
									break;
								default:
								case 'lteq':
									$this->ci->db->where($val['field'].' <= \''.$value.'\'');
									break;
								case 'le':
									$this->ci->db->where($val['field'].' <= \''.$value.'\'');
									break;
								default:
								case 'gt':
									$this->ci->db->where($val['field'].' > \''.$value.'\'');
									break;
								default:
								case 'gteq':
									$this->ci->db->where($val['field'].' >= \''.$value.'\'');
									break;
								case 'ge':
									$this->ci->db->where($val['field'].' >= \''.$value.'\'');
									break;
								default:
									preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
									if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
										if($val['value'] != '') {
											//$this->ci->db->where($paramArr['table'].'.'.$val['field'] .' LIKE \'%'. $value .'%\'');
											//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
											$this->ci->db->where($val['field'] .' = '. $value);
										}
									}
									else {
										$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
									}
									break;
							}
						}
					}
					else {
						if($this->array_key_exists_r($sp, $paramArr['relations'])) {
							if($value != '') {
								//$this->ci->db->where($paramArr['table'].'.'.$val['field'], $value);
								$this->ci->db->where($val['field'], mysql_real_escape_string($value));
							}
						/*if(is_array($paramArr['relations']) && count($paramArr['relations']) > 0) {			
							foreach($paramArr['relations'] as $r) {
								$dotfield = strpos($r['field'], '.');
								if($dotfield) {
									$rfield = $r['field'];
								}
								else {
									$rfield = $paramArr['table'].'.'.$r['field'];
								}											
							}*/			
						}
						else {
						
							if($value != '') {
								$eff = explode('.', $val['field']);
								$cff = count($eff);
								if($cff == 3) {
									if($eff[0].'.'.$eff[1] == $paramArr['table']) {
										$valf = $eff[2];
									}
									else {
										//$valf = $eff[1].'__'.$eff[2];
										$valf = $val['field'];
									}																		
								}
								if($cff == 2) {
									if($eff[0] == $paramArr['table']) {
										$valf = $eff[1];
									}
									else {
										//$valf = $eff[0].'__'.$eff[1];
										$valf = $val['field'];
									}									
								}
								$vpfield = str_replace('.', '__', $valf);
								if(method_exists($paramArr['con'], $funcs[$vpfield]['post'])) {
									$vfield = str_replace('.', '__', $val['field']);
									$valf_ = str_replace('.', '__', $valf);
									$value = $paramArr['con']->$funcs[$valf_]['post']($val['value'], $vfield);											
								}					
							}
							preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
							if(sizeOf($matches) > 0 || $val['type'] == 'bit'){
								if($val['value'] != '') {
									//$this->ci->db->where($paramArr['table'].'.'.$val['field'] .' LIKE \'%'. $value .'%\'');
									//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
									$this->ci->db->where($val['field'] .' = '. $value .'');
								}						
							}
							else {								
								//$this->ci->db->where($paramArr['table'].'.'.$val['field'] .' LIKE \'%'. $value .'%\'');                                                               
								if ( $value != '' ) {
									$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
								}
							}
						
						}	
					}			
				}		
			}
		}
		//print_r($paramArr['join_table']);
		//print_r($paramArr['list']);
		if(is_array($paramArr['join_table']) && count($paramArr['join_table']) > 0) {
			foreach($paramArr['join_table'] as $r) {				
				foreach($paramArr['list'] as $kl => $vl) {
					$elist = explode('.', $vl);
					$clist = count($elist);
					$erlist = explode('.', $r['table']);
					$crlist = count($erlist);
					//echo $clist.' ';
					if($clist == 2) {
						$listt = $elist[0];
						$listl = $elist[1];
						if($crlist == 2) {
							$rtable = $erlist[1];
						}
						elseif($crlist == 1) {
							$rtable = $erlist[0];
						}
						//echo $listt .'=='. $rtable.'<br />';
						if($listt == $rtable) {
							//$this->ci->db->select($r['table'].'.'.$elist[2] .' AS '.$r['table'].'_'.$listl, FALSE);
							$this->ci->db->select($rtable.'.'.$listl .' AS '.$rtable.'__'.$listl, FALSE);
						}
					}
					//echo $listt.' ';
					/*if($clist == 2) {
						//if($elist[1] == $r['table']) {
						if($listt == $rtable) {
							//$this->ci->db->select($r['table'].'.'.$elist[2] .' AS '.$r['table'].'_'.$listl, FALSE);
							$this->ci->db->select($rtable.'.'.$listl .' AS '.$r['table'].'_'.$listl, FALSE);
						}						
					}*/
					/*elseif($clist == 2) {
						//if($elist[0] == $r['table']) {
						if($listt == $rtable) {
							$this->ci->db->select($r['table'].'.'.$elist[1] .' AS '.$r['table'].'_'.$elist[1], FALSE);
						}
					}*/
				}
				//$this->ci->db->select($r['table'].'.*', FALSE);
				$this->ci->db->join($r['table'], $r['glue'], $r['type']);								
			}			
		}
		if(is_array($paramArr['relations']) && count($paramArr['relations']) > 0) {			
			foreach($paramArr['relations'] as $r) {
				$dotfield = strpos($r['field'], '.');
				if($dotfield) {
					$rfield = $r['field'];
				}
				else {
					$rfield = $paramArr['table'].'.'.$r['field'];
				}
				$this->ci->db->join($r['join_table'], $rfield.'='.$r['join_table'].'.'.$r['foreign_key'], $r['type']);
				if($r['as'] != '') {
					$this->ci->db->select($r['join_table'].'.'.$r['view_as'] .' AS '.$r['as'], FALSE);
				}
				else {
					$this->ci->db->select($r['join_table'].'.'.$r['view_as']);
				}				
			}			
		}		
		if(is_array($paramArr['queries']) && count($paramArr['queries']) > 0) {
			foreach($paramArr['queries'] as $k => $val) {									
				foreach($val as $kv => $vv) {
					/*$tv = explode('.', $kv);
					if(count($tv) > 1) {
						$this->ci->db->where($tv[0].'.'.$tv[1], $vv);
					}
					else {*/
						$this->ci->db->where($kv, $vv);
					//}
				}				
			}			
		}
		
		$urlpage = explode('/', _url_module(uri_string()));
		$this->ci->db->select('/*'.$urlpage[1].'/'.$urlpage[1].'.php/'.$urlpage[2].'*/'.$paramArr['table'].'.*', FALSE);
		//$this->ci->db->select($paramArr['table'].'.*', FALSE);
		$this->ci->db->order_by($sortField, $sortOrder);
		$this->ci->db->group_by($groupField);
		

		

		if($paramArr['vsql'] <> ''){
			$query = $this->ci->db->query($paramArr['vsql'])->result();

		}else{
			$query = $this->ci->db->get($paramArr['table'])->result();	
		}

		

		//$query = $this->ci->db->query("SELECT * FROM pddetail.master_modul;");

		

		//$query = 'select * from pddetail.master_modul a ';
		/*//show query
		echo $this->ci->db->last_query();
		exit;*/

		
		//$query= $this->db->query($query1)->result_array();
		return $query;
	}
	


	public function count_json_back($paramArr) {		
		$funcs = $paramArr['functions_search'];
		$searchParam = isset($paramArr['searchFields']) ? $paramArr['searchFields'] : NULL;
		if(!empty($searchParam)) {
			foreach($searchParam as $sp => $val) {
				$efield = explode('__', $val['field']);
				$cfield = count($efield);
				if($cfield == 1) {
					$val['field'] = $paramArr['table'].'.'.$val['field'];
				}
				elseif($cfield == 2) {
					$val['field'] = $efield[0].'.'.$efield[1];
				}
				if($val['type'] == 'date') {
					if($val['value'] != '' && $val['value'] != '0000-00-00') {
						$value = $this->to_mysql($val['value']);	
						$this->ci->db->where($val['field']." = '".$value."'");
					}
				}
				elseif($val['type'] == 'datetime' || $val['type'] == 'timestamp') {
					if($val['value_start'] != '' && $val['value_end'] != '') {
						$value_start = $this->to_mysql($val['value_start']);
						$value_end = $this->to_mysql($val['value_end']);
						
						$value_start = $value_start.' 00:00:01';
						$value_end = $value_end.' 23:59:59';
						$this->ci->db->where($val['field']." BETWEEN '".$value_start."' AND '".$value_end."'");
					}										
				} elseif($val['type'] == 'between') {
					if($val['value_start'] != '' && $val['value_end'] != '') {
						$this->ci->db->where($val['field']." BETWEEN '".$val['value_start']."' AND '".$val['value_end']."'");
					}
				} elseif($val['type'] == 'int') {
					if ($val['value'] != '') {
						$this->ci->db->where($val['field'] .' = '. $val['value']);
					}
				} elseif($val['type'] == 'tinyint') {
					if ($val['value'] != '') {
						$this->ci->db->where($val['field'] .' = '. $val['value']);
					}
				} elseif(substr($val['type'], 0, 4) == 'enum') {
					if ($val['value'] != '') {
						$this->ci->db->where($val['field'] ." = '". mysql_real_escape_string($val['value'])."'");
					}
				} else {
					$value = mysql_real_escape_string($val['value']);
					//$val['field'] = str_replace('_____', '.', $val['field']);
                                        $sp = str_replace("__", ".", $sp);
					if($this->array_key_exists_r($sp, $paramArr['searchOperand'])) {
						if($value != '') {
							switch (strtolower($paramArr['searchOperand'][$sp])) {
								case 'eq':
									$this->ci->db->where($val['field'], $value);
									break;
								case 'lt':
									$this->ci->db->where($val['field'].' < \''.$value.'\'');
									break;
								default:
								case 'lteq':
									$this->ci->db->where($val['field'].' <= \''.$value.'\'');
									break;
								default:
								case 'gt':
									$this->ci->db->where($val['field'].' > \''.$value.'\'');
									break;
								default:
								case 'gteq':
									$this->ci->db->where($val['field'].' >= \''.$value.'\'');
									break;
								default:
									preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
									if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
										if($val['value'] != '') {
											$this->ci->db->where($val['field'] .' = '. $value);
										}
									} else {
										$this->ci->db->where($val['field'].' LIKE \'%'. $value .'%\'');
									}
									break;
							}
						}
					}
					else {
						if($this->array_key_exists_r($sp, $paramArr['relations'])) {
							if($value != '') {
								//$this->ci->db->where($paramArr['table'].'.'.$val['field'], $value);
								$this->ci->db->where($val['field'], $value);
							}
						/*if(is_array($paramArr['relations']) && count($paramArr['relations']) > 0) {			
							foreach($paramArr['relations'] as $r) {
								$dotfield = strpos($r['field'], '.');
								if($dotfield) {
									$rfield = $r['field'];
								}
								else {
									$rfield = $paramArr['table'].'.'.$r['field'];
								}											
							}*/			
						}
						else {					
							
							if($value != '') {
								$eff = explode('.', $val['field']);
								$cff = count($eff);
								if($cff == 3) {
									if($eff[0].'.'.$eff[1] == $paramArr['table']) {
										$valf = $eff[2];
									}
									else {
										//$valf = $eff[1].'_'.$eff[2];
										$valf = $val['field'];
									}																		
								}
								if($cff == 2) {
									if($eff[0] == $paramArr['table']) {
										$valf = $eff[1];
									}
									else {
										//$valf = $eff[0].'_'.$eff[1];
										$valf = $val['field'];
									}									
								}
								$vpfield = str_replace('.', '__', $valf);
								if(method_exists($paramArr['con'], $funcs[$vpfield]['post'])) {
									$vfield = str_replace('.', '__', $val['field']);
									$valf_ = str_replace('.','__', $valf);
									$value = $paramArr['con']->$funcs[$valf_]['post']($val['value'], $vfield);											
								}								
							}
							preg_match('/^int/', $val['type'], $matches, PREG_OFFSET_CAPTURE);
							if(sizeOf($matches) > 0 || $val['type'] == 'bit') {
								if($val['value'] != '') {
									//$this->ci->db->where($paramArr['table'].'.'.$val['field'] .' LIKE \'%'. $value .'%\'');
									//$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
									$this->ci->db->where($val['field'] .' = '. $value);
								}
							}
							else {
								//$this->ci->db->where($paramArr['table'].'.'.$val['field'] .' LIKE \'%'. $value .'%\'');
								if ( $value != '' ) {
									$this->ci->db->where($val['field'] .' LIKE \'%'. $value .'%\'');
								}
							}
						}
					}
				}
			}
		}
		if(is_array($paramArr['join_table']) && count($paramArr['join_table']) > 0) {
			foreach($paramArr['join_table'] as $r) {
				$this->ci->db->join($r['table'], $r['glue'], $r['type']);
			}
		}
		if(is_array($paramArr['relations']) && count($paramArr['relations']) > 0) {
			foreach($paramArr['relations'] as $r) {
				$dotfield = strpos($r['field'], '.');
				if($dotfield) {
					$rfield = $r['field'];
				}
				else {
					$rfield = $paramArr['table'].'.'.$r['field'];
				}
				$this->ci->db->join($r['join_table'], $rfield.'='.$r['join_table'].'.'.$r['foreign_key'], $r['type']);
			}
		}		
		if(is_array($paramArr['queries']) && count($paramArr['queries']) > 0) {
			foreach($paramArr['queries'] as $k => $val) {
				foreach($val as $kv => $vv) {
					$this->ci->db->where($kv, $vv);
				}
			}
		}
		$this->ci->db->from($paramArr['table']);
		$query = $this->ci->db->count_all_results();
		//echo $this->ci->db->last_query();
		return $query;
	}

	private function array_key_exists_r($needle, $haystack) {
	    $result = array_key_exists($needle, $haystack);
	    if ($result) return $result;
	    foreach ($haystack as $v) {
	        if (is_array($v)) {
	            $result = $this->array_key_exists_r($needle, $v);
	        }
	        if ($result) return $result;
	    }
	    return $result;
	}
	
	private function search_array($needle, $haystack) {
    	if(in_array($needle, $haystack)) {
        	return true;
     	}
     	foreach($haystack as $element) {
        	if(is_array($element) && $this->search_array($needle, $element))
            	return true;
     	}
   		return false;
	}
	
	private function getLenght($value) {
		$fadeOut = array('(',')');
		return str_replace($fadeOut, '', strstr($value, '('));
	}
	
	private function replace_char($char) {
		$no_include = array('1','2','3','4','5','6','7','8','9','0','(',')','[',']','{','}','+','-','*');
		return str_replace($no_include, '', $char);
	}
	public function get_enum_values( $table, $field ) {
	    $type = $this->ci->db->query( "SHOW COLUMNS FROM ".$this->ci->db->dbprefix($table)." WHERE Field = '".$field."'" )->row( 0 )->Type;
	    preg_match('/^enum\((.*)\)$/', $type, $matches);
	    foreach( explode(',', $matches[1]) as $value ) {
	         $enum[] = trim( $value, "'" );
	    }
	    return $enum;
	}
	
	private function to_mysql($date) {
		$d = substr($date, 0,2);
		$m = substr($date, 3,2);
		$y = substr($date, 6,4);
		
		return $y.'-'.$m.'-'.$d;
	}
	
	public function delete_row($db='hrd') {
		$dbset = $this->ci->load->database($db, true);
		$sql = "Update ".$this->getTable()." set ".($this->getDeletedKey() == '' ? "ldeleted" : $this->getDeletedKey())." = 1 where ".($this->getPk() == '' ? "id" : $this->getPk())." = '".$_GET['id']."'";
		try {
			$dbset->query($sql);
			$x = 1;	
		} catch(Exception $e) {
			die('Error ..'.$e);
			$x = 0;
		}
		
		return $x;
		
	}
	
	public function clear_ptag($string) {
		$no_include = array('<p>','</p>');
		return str_replace($no_include, '', $string);
	}
}
