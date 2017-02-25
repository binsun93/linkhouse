<?php 
class HT_ModelFront extends MY_Model {
 
    public $dbmode = "db_master"; 

    function __construct() { 
        parent::__construct();
        
    }

    public function dbmode($mode = 'slave') {
        $this->dbmode = $mode;
    }

    /**
     * @return CI_DB_active_record return current connection
     */
    public function getDB() {
        static $db_instance;
        if (is_object($db_instance[$this->dbmode])) {
            return $db_instance[$this->dbmode];
        }
        if ($this->dbmode == 'slave') {
            return $db_instance[$this->dbmode] = $this->load->database('slave', TRUE);
        }


        return $db_instance[$this->dbmode] = $this->load->database('slave', TRUE);
    }

  
    function getTableName() {
        //$this->config->load('database');
        return $this->getDB()->dbprefix . $this->_dTbl['module_table'];
    }

    
    /*
	Ham select all
	Du lieu truyen vao neu co:
		***** Chi Tiet *****
		$where['id'] = 123;    

		***** Theo Ngay *****
		$where['create_date >='] = '2015-07-01';
		$where['create_date <='] = '2015-08-02 23:59:59';
	
		***** Tim Kiem *****
		$like = " name LIKE '%abc%' and email LIKE '%abcccc%' ..... "; 

		***** Sap Xep *****
		$order_by['id'] = "DESC"; 

		***** Group *****
		$group_by = "email, name ,.... "; 

		***** Lien Ke Tbl khac *****
		$join['tbl_category'] = 'tbl_category.id = tbl_mathang.id';
		$join['tbl_admin'] = 'tbl_admin.id = tbl_mathang.admin_id';
        
        ***** Limit *****
		$limit['num'] = '10';
		$limit['start'] = '0';
        

	*/
	public function getList($where = false , $like = false , $order_by = false , $group_by = false , $join = false , $select = false ,$limit = false){
		// Check select orther
		if($select != false){
			$this->getDB()->select($select);
		}else{
			$this->getDB()->select('*');
		} 
		// Table query
		$this->getDB()->from($this->getTableName()); 
		// Check have join
		if($join != false){
			foreach($join as $k=>$v){
				$this->getDB()->join($k , $v , 'LEFT');
			}
		} 
		// Check where orther
		if($where != false){
			$this->getDB()->where($where);
		}  
		// Check search
		if($like != false){
			$this->getDB()->where($like);
		} 
        if($limit != false){
			$this->getDB()->limit($limit['num'] , $limit['start']);
		} 
		// Check order by
		if($order_by){
            foreach($order_by as $key=>$value){
                $this->getDB()->order_by($key, $value);
            }
        }else{
            $this->getDB()->order_by($this->_dTbl['module_id'], "desc");
        } 
		// Check group by
		if($group_by != false){
			$this->getDB()->group_by($group_by);
		} 
		$result = $this->getDB()->get()->result(); 
        //echo $this->getDB()->last_query(); 
		return $result;
	}

	public function getOne($where = false , $like = false , $order_by = false , $group_by = false , $join = false , $select = false ){
        // Check select orther
        if($select != false){
            $this->getDB()->select($select);
        }else{
            $this->getDB()->select('*');
        } 
        // Table query
        $this->getDB()->from($this->getTableName()); 
        // Check have join
        if($join != false){
            foreach($join as $k=>$v){
                $this->getDB()->join($k , $v , 'LEFT');
            }
        } 
        // Check where orther
        if($where != false){
            $this->getDB()->where($where);
        }  
        // Check search
        if($like != false){
            $this->getDB()->where($like);
        } 
    
        // Check order by
        if($order_by){
            
            foreach($order_by as $key=>$value){
                $this->getDB()->order_by($this->getTableName() . '.'.$key, $value);
            }
        }else{
            $this->getDB()->order_by($this->getTableName() . '.'.$this->_dTbl['module_id'], "desc");
        } 
        // Check group by
        if($group_by != false){
            $this->getDB()->group_by($group_by);
        } 
        $result = $this->getDB()->get()->result(); 
        //echo $this->getDB()->last_query(); 
        return $result;
    }
	
	public function last_query(){
		return $this->getDB()->last_query(); 
	}
    
    public function count_row($where = false , $like = false , $order_by = false , $group_by = false , $join = false , $select = false ) {
        
        // Check select orther
		if($select != false){
			$this->getDB()->select($select);
		}else{
			$this->getDB()->select('*');
		} 
		// Table query
		$this->getDB()->from($this->getTableName()); 
		// Check have join
		if($join != false){
			foreach($join as $k=>$v){
				$this->getDB()->join($k , $v, 'LEFT');
			}
		} 
		// Check where orther
		if($where != false){
			$this->getDB()->where($where);
		}  
		// Check search
		if($like != false){
			$this->getDB()->where($like);
		}  
		// Check order by
        if($order_by){
            foreach($order_by as $key=>$value){
                $this->getDB()->order_by($this->getTableName() . '.'.$key, $value);
            }
        }else{
            $this->getDB()->order_by($this->getTableName() . '.'.$this->_dTbl['module_id'], "desc");
        } 
		// Check group by
		if($group_by != false){
			$this->getDB()->group_by($group_by);
		}  
		$result = $this->getDB()->count_all_results(); 
 
		return $result; 
    }
    
    
    public function getListPage($where = false , $like = false , $order_by = false , $group_by = false , $join = false , $select = false ,$limit = false ,$option=array()){
 
		if($select != false){
			$this->getDB()->select($select);
		}else{
			$this->getDB()->select('*');
		}  
		$this->getDB()->from($this->getTableName());  
		if($join != false){
			foreach($join as $k=>$v){
				$this->getDB()->join($k , $v, 'LEFT');
			}
		}  
		if($where != false){
			$this->getDB()->where($where);
		}   
		if($like != false){
			$this->getDB()->where($like);
		} 
        if($order_by){
            foreach($order_by as $key=>$value){
                $this->getDB()->order_by($this->getTableName() . '.'.$key, $value);
            }
        }else{
            $this->getDB()->order_by($this->getTableName() . '.'.$this->_dTbl['module_id'], "desc");
        } 
        $pagination=$this->load->library("Pagination");
        $result['total']=$config['total_rows'] = $this->getDB()->count_all_results();;
		$config['per_page'] = $limit;
        $option['base']?$option['base']=trim($option['base'],"/")."/":"latest";
        $config['base_url']=base_url().$option['base'];
        $config['use_page_numbers']=true;
        $config['uri_segment']=$option['uri_segment']?$option['uri_segment']:2;
        $pagination->initialize($config);
        $result['paging']=$pagination->create_links(); 
        // ======================================================
        // ======================================================
        // ======================================================
        // ======================================================
        // ======================================================
        if($select != false){
			$this->getDB()->select($select);
		}else{
			$this->getDB()->select('*');
		}  
		$this->getDB()->from($this->getTableName());  
		if($join != false){
			foreach($join as $k=>$v){
				$this->getDB()->join($k , $v);
			}
		}  
		if($where != false){
			$this->getDB()->where($where);
		}   
		if($like != false){
			$this->getDB()->where($like);
		} 
        if($order_by){
            foreach($order_by as $key=>$value){
                $this->getDB()->order_by($this->getTableName() . '.'.$key, $value);
            }
        }else{
            $this->getDB()->order_by($this->getTableName() . '.'.$this->_dTbl['module_id'], "desc");
        } 
         
        if($limit != false){
            $this->getDB()->limit($limit,$pagination->cur_page>1?($pagination->cur_page-1)*$limit:0); 
		}  
		 
		if($group_by != false){
			$this->getDB()->group_by($group_by);
		}  
        $result['cur_page']=$pagination->cur_page;
        $plist=$this->getDB()->get()->result();
        $result['pageList']=array();
        $pids=array();
        foreach ($plist as $p){
            $result['pageList'][$p->id]=$p;
             $pids[]=$p->id;
        }
		// print_r($result);exit; 
        return $result; 
	} 
 
     
    
}
