<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Administrator
 */

class YT_AModel extends MY_Model{
        public $where="";
        public $where_in=array();
        public $order="";
        public $join=array();
        public $field_string="*";
        public $limit=array();
        public $dbmode="master";
        
        var $fields=array();
         var $fields_lang=array();
         var $table_name='';
         var $table_name_lang='';
         var $id_field='';
         var $id_field_lang='';
         var $id_lang_rel='';
         var $status_field='status';
         var $cat_field='cat_id';
         var $order_field='sort_order';
         var $image_field=array('image'=>'');
        function __construct() {
            parent::__construct();
            /*
         $this->fields=array(
            'content_id'=>'1',
            'code'=>'1',
            'image'=>'1',
            'cat_id'=>'1',
            'tag_id_list'=>'1',
            'create_date'=>'1',
            'modify_date'=>'1',
            'publish_date'=>'1',
            'status'=>'1',
        );
         $this->fields_lang=array(
            'content_id'=>'1',
             'name'=>'1',
            'description'=>'1',
            'content'=>'1',
            'lang_id'=>'1',
        );
         $this->table_name='test';
         $this->table_name_lang='test_lang';
         $this->id_field='content_id';
         $this->id_field_lang='conlg_id';
         $this->status_field='status';
         $this->cat_field='cat_id';
         $this->order_field='sort_order';
         $this->image_field=array('image'=>'');
         $this->id_lang_rel=$this->id_field;
         */
        }
        public function dbmode($mode='master'){
            $this->dbmode=$mode;
        }
        /**
         * @return CI_DB_active_record return current connection
         */
        public function getDB(){
            static $db_instance;
            if(is_object($db_instance[$this->dbmode])){
                return $db_instance[$this->dbmode];
            }
            if( $this->dbmode=='master'){
                return $db_instance[$this->dbmode]=$this->load->database('master', TRUE);
            }
            
            
            return $db_instance[$this->dbmode]=$this->load->database('slave', TRUE);
            
        }
        public function setLimit($from,$to){
            $this->limit[0]=$from;
            $this->limit[1]=$to;
        }
       function getTableName(){
           //$this->config->load('database');
           return $this->getDB()->dbprefix.$this->table_name;
       }
    function count_row(){
        $this->from?$this->getDB()->from($this->from):$this->getDB()->from($this->getTableName());
        if($this->join){
                   foreach ($this->join as $join)
                   $this->getDB()->join($join[0],$join[1]);
        }
        if(!$this->single_table_mode&&$this->table_name_lang)
                $this->getDB()->join($this->table_name_lang," {$this->table_name}.{$this->id_field}={$this->table_name_lang}.{$this->id_lang_rel}");
        $this->where?$this->getDB()->where($this->where):"";
         if($this->where_in){
                   foreach ($this->where_in as $where_in)
                   $this->getDB()->where_in($where_in[0],$where_in[1]);
        }
        $this->like?$this->getDB()->like($this->like[0],$this->like[1]):'';
        if(!$this->single_table_mode&&$this->table_name_lang){
            $this->getDB()->select("COUNT(DISTINCT `".$this->table_name."`.`".$this->id_field."`) as countrows",false);
            $row= $this->getDB()->get()->result();
            return intval($row['countrows']);
        }
         return $this->getDB()->count_all_results();
    }
     public function get_object_by_where($with_language=false){   
                $this->getDB()->select($this->field_string);
                $this->from?$this->getDB()->from($this->from):$this->getDB()->from($this->getTableName());
               if($this->join){
                   foreach ($this->join as $join)
                   $this->getDB()->join($join[0],$join[1]);
               }
               if($with_language)
                $this->getDB()->join($this->table_name_lang," {$this->table_name}.{$this->id_field}={$this->table_name_lang}.{$this->id_lang_rel}");
//		
		//$array = array('status' => 1,'lang_id' => 2);
                 //print_r($this->join);exit;
                if($this->where)
		$this->getDB()->where($this->where);
		 
                if($this->order)
                     $this->getDB()->order_by ($this->order);
                //if($this->limit[1])
		$this->getDB()->limit(1,0);
		$result_arr = $this->getDB()->get()->result();
                
		$this->reset_query();
		
		return current($result_arr); 
		 
	}
    public function get_list($limit=null){   
                $this->getDB()->select($this->field_string);
                $this->from?$this->getDB()->from($this->from):$this->getDB()->from($this->getTableName());
                 if($this->join){
                   foreach ($this->join as $join)
                   $this->getDB()->join($join[0],$join[1]);
                }
               if(!$this->single_table_mode&&$this->table_name_lang)
                $this->getDB()->join($this->table_name_lang," {$this->table_name}.{$this->id_field}={$this->table_name_lang}.{$this->id_lang_rel}");
                $this->build_condition();
		 if($limit){
                     $this->limit[0]=0;
                     $this->limit[1]=$limit;
                }
                if($this->order)
                     $this->getDB()->order_by ($this->order);
                if($this->limit[1])
    		$this->getDB()->limit($this->limit[1],$this->limit[0]);
    		$result = $this->getDB()->get()->result();
                if($this->group_by_id){
                    if($id_field=$this->id_field){
                        foreach ($result as $obj){
                            $result_arr[$obj->$id_field]=$obj;
                        }
                    }
                }
		$this->reset_query();
		return $result_arr? $result_arr: $result; 
		 
	}
        /**
         * divide language by variable
         * @param type $limit
         */
        public function get_list_language($limit=null){   
                $this->select?$this->getDB()->select($this->select):$this->getDB()->select($this->table_name.".*");
                $this->from?$this->getDB()->from($this->from):$this->getDB()->from($this->getTableName());
                
                if($this->join){
                   foreach ($this->join as $join)
                   $this->getDB()->join($join[0],$join[1]);
                }
                if(!$this->single_table_mode&&$this->table_name_lang)
                $this->getDB()->join($this->table_name_lang," {$this->table_name}.{$this->id_field}={$this->table_name_lang}.{$this->id_lang_rel}");
                $this->build_condition();
		 if($limit){
                     $this->limit[0]=0;
                     $this->limit[1]=$limit;
                }
                if($this->order)
                     $this->getDB()->order_by ($this->order);
                else $this->getDB()->order_by ($this->id_field,'desc');
                if($this->limit[1])
		$this->getDB()->limit($this->limit[1],$this->limit[0]);
                $this->getDB()->group_by($this->id_field);
		$result = $this->getDB()->get()->result();
        
 
                $ids=array();
                if($id_field=$this->id_field){
                        foreach ($result as $obj){
                            $result_arr[$obj->$id_field]=$obj;
                            $ids[]=$obj->$id_field;
                        }
                 }
                 
                       
        
                if($this->table_name_lang){
                    $this->getDB()->select("*");
                    $this->getDB()->from($this->table_name_lang);
                    $this->getDB()->where_in($ids);
                    $langs = $this->getDB()->get()->result();
                    $rel_id=$this->id_lang_rel;
                     
                    foreach ($langs as $litem){
                        if($result_arr[$litem->$rel_id]){
                        $result_arr[$litem->$rel_id]->_mlang[$litem->lang_id]=$litem;
                        }
                    }
                }
		$this->reset_query();
		return $result_arr?$result_arr:$result; 
        }
        /**
         * 
         * @param string $path not inclide base_url
         * @param int $limit
         */
	public function get_page_list($path,$per_page,$uri_segment){
                $result=array();
                $this->load->library('pagination');
                
                $config['base_url'] = base_url().$path;
                
                $config['total_rows'] = $this->count_row();
                $config['per_page'] = $per_page; 
                $config['uri_segment']=$uri_segment;
                $config['first_link']			= '<i class="fa fa-chevron-left">|</i>';
                $config['next_link']			= '<i class="fa fa-chevron-right"></i>';
                $config['prev_link']			= '<i class="fa fa-chevron-left"></i>';
                $config['last_link']			= '<i class="fa fa-chevron-right">|</i>';
                //$config['uri_segment']		= 3;
                $config['full_tag_open']		= ' <div class="col-sm-5 text-right text-center-xs wrapper"><ul class="pagination pagination-sm m-t-none m-b-none">';
                $config['full_tag_close']		= '</ul></div>';
                $config['first_tag_open']		= '<li>';
                $config['first_tag_close']	= '</li>';
                $config['last_tag_open']		= '<li>';
                $config['last_tag_close']		= '</li>';
                $config['first_url']			= ''; // Alternative URL for the First Page.
                $config['cur_tag_open']		= '<li class="active" ><a>';
                $config['cur_tag_close']		= '</a></li>';
                $config['next_tag_open']		= '<li>';
                $config['next_tag_close']		= '</li>';
                $config['prev_tag_open']		= '<li>';
                $config['prev_tag_close']		= '</li>';
                $config['num_tag_open']		= '<li>';
                $config['num_tag_close']		= '</li>';
                $config['use_page_numbers']=true;
                //$config['query_string_segment'] = 'per_page';
                
                $this->pagination->initialize($config); 
                $result['paging']=$this->pagination->create_links("admin_paging");
                $result['total']=$config['total_rows'];
                if(!$this->pagination->cur_page) $this->pagination->cur_page=1;
                $this->limit=array(($this->pagination->cur_page-1)*$per_page,$per_page);
                $result['pageList']=$this->get_list_language();
                $this->reset_query();
                return $result;
                
	}
	public function reset_query()	{		
		//$this->field_string="*";
                $this->where="";
                $this->order="";
                $this->field_string="*";
                $this->limit=array();
	}
        function build_condition(){
            if($this->where)
		$this->getDB()->where($this->where);
             if($this->where_in){
                   foreach ($this->where_in as $where_in)
                   $this->getDB()->where_in($where_in[0],$where_in[1]);
             }
             $this->like?$this->getDB()->like($this->like[0],$this->like[1]):'';
        }
        
	
	public function edit($id)	{
		$this->getDB()->select('*');
		$this->getDB()->where($this->id_field,$id);		
		$query 			= $this->getDB()->get($this->table_name);			
		if($query->num_rows()>0){
			$data 		= $query->row_array();				
			return $data;
		}
		return 0;
	}
	public function delete($id)	{
                $this->getDB()->from($this->table_name);
                $this->getDB()->where($this->id_field, $id);
                $result=$this->getDB()->get()->result();
                $this->on_data_delete(current($result));
                $this->getDB()->from($this->table_name);
		$this->getDB()->where($this->id_field, $id);
		return $this->getDB()->delete($this->table_name); 			
	}
	public function on_data_delete($returnid){
            return;
        }
	public function publish($id, $publish)	{
		$data['publish'] 	= ($publish=='publish') ? 0 : 1;
		$data['id'] 		= $id;			
		$this->getDB()->where('id', $id);
		return $this->getDB()->update($this->table_name, $data); 			
	}
	
	public function delete_all($items){
		foreach($items as $value){
			$this->getDB()->where($this->id_field, $value);
			$this->getDB()->delete($this->table_name);
		}
		return true;			
	}
	public function field_all($items,$data){
		foreach($items as $value){
			$this->getDB()->where($this->id_field, $value);
			$this->getDB()->update($this->table_name,$data);
		}
		return true;			
	}
        public function update($data){
             $this->getDB()->from($this->getTableName());
            
             $this->build_condition();
            $this->getDB()->update($this->table_name,$data);
        }
        function review_url($id){
            return $this->uri->segment(1)."/review/".$id;
        }
        function store_data($array){
			echo 243;exit;
            $data=array();
            foreach ($this->fields as $key=>$value){
                isset($array[$key])?$data[$key]=$array[$key]:"";
            }
            $returnid=0;
            $id = $this->uri->segment(3);
            if($id == ''){
                $id = $data['id'];
            }
            if(!$id){
                $this->getDB()->insert($this->table_name, $data);
                $returnid = $this->getDB()->insert_id();
            }else{
           
                $this->getDB()->where(array('id'=>$id));
                $this->getDB()->update($this->table_name,$data);
                
          
                $returnid=$array[$this->id_field];
            }
         
            if($array['_mlang']&&$this->table_name_lang){
                foreach ($array['_mlang'] as $idx=> $lang){
                    $lang['lang_id']=$idx;
                    $this->store_data_lang($returnid,$lang);
                }
            }
            
            $this->on_data_change($returnid);
            return $returnid;
                
        }
        function store_data_lang($obj_id,$array){
      
            $data=array();
            $array[$this->id_lang_rel]=$obj_id;
            foreach ($this->fields_lang as $key=>$value){
                isset($array[$key])?$data[$key]=$array[$key]:"";
            }
             
            $this->getDB()->from($this->table_name_lang);
            $this->getDB()->where(array('lang_id'=>$array['lang_id'],$this->id_lang_rel=>$obj_id));
            $exist=$this->getDB()->get()->result();
            $obj=  current($exist);
            $id_lang_field=$this->id_field_lang; 
            if(!$obj->$id_lang_field){//exist
          
                $this->getDB()->insert($this->table_name_lang, $data); 
                return $this->getDB()->insert_id();
            }else{
          
                $this->getDB()->where(array('lang_id'=>$array['lang_id'],$this->id_lang_rel=>$obj_id));
                $this->getDB()->update($this->table_name_lang,$data);
            }
            return $obj->$id_lang_field;
                
        }
        function insert_if_not_exist($table,$data,$condition=null,$escap=false){
            if($condition===null) $condition=$data;
            $keys=array();
            $values=array();
            $count=0;
            foreach ($data as $key=>$value) {
                $count++;
                $keys[]="`$key`";
                $values[]="'$value' as val_".$count;
            }
            if($escap) $conds=$condition;
            else{
                $conds=array();
                foreach ($condition as $key=>$value) {
                    $conds[]="`$key`='$value'";
                }
                $conds=  implode(" AND ", $conds);
            }
            if(count($keys)){
            $query="INSERT INTO $table (".  implode(",", $keys).")
                            SELECT * FROM (SELECT ".  implode(",", $values).") AS tmp
                            WHERE NOT EXISTS (
                                SELECT ".  implode(",", $keys)." FROM $table WHERE $conds
                            );
                                ";
                        return $this->getDB()->query($query);
            }
            return false;
        }
        function insert_and_check($data,$condition,$escap=false){
            return $this->insert_if_not_exist($this->table_name, $data, $condition,$escap);
        }
        function insert_or_dup_update($table,$data){
           
            foreach ($data as $key=>$value) {
                $count++;
                $keys[]="`$key`";
                $values[]=$this->getDB()->escape($value);
                $update[]="`$key`=".$this->getDB()->escape($value);
            }
            if($keys&&$values){
                $key=  implode(",", $keys);
                $val=  implode(",", $values);
                $upd=implode(",", $update);
                $query="INSERT INTO $table ($key) VALUES ($val)
                        ON DUPLICATE KEY UPDATE $upd;";
                $this->getDB()->query($query);
            }
           // pr($this->getDB()->last_query());die;
                        
        }
        function on_data_change(){
            /* @var $caches MY_Caches */
            $caches=$this->load->library('Caches');
           $caches->on_data_change();
        }
        function get_one($id){
            if(!$this->fields[$this->id_field]) return null;
        $this->where(array($this->id_field=>$id));
        return current($this->get()->result());
    }
   
}
