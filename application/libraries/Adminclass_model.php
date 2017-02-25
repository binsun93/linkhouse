<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adminclass_model extends MY_Model{	 
	private $per_page	= 5;
	//Thu
	public function paginationInit($new_config = array()) {
		 
		$data_url 	= $this->uri->ruri_to_assoc();
		 
		$config['per_page'] 	= 8;
		$config['cur_page'] 	= @$data_url['page'];
		
		$config['first_link']		= '';
		$config['next_link']		= '<span class="nextP"></span>';
		$config['prev_link']		= '<span class="preP"></span>';
		$config['last_link']		= '';
		$config['cur_tag_open']		= '<a class="active"><span>';
		$config['cur_tag_close']	= '</span></li>';
		$config['first_tag_open']	= '<a>';
		$config['first_tag_close']	= '</a>';
		$config['last_tag_open']	= '<a>';
		$config['last_tag_close']	= '</a>';
		$config['next_tag_open']	= '<a>';
		$config['next_tag_close']	= '</a>';
		$config['prev_tag_open']	= '<a>';
		$config['prev_tag_close']	= '</a>';
		$config['num_tag_open']		= '<a>';
		$config['num_tag_close']	= '</a>';
		
		//$config = array_merge($config, $new_config);
		 
		//const
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
	} 
	
	public function getUploadBy(){
		$arr = array(array('id'=>11306,'username'=>'XuanNguyen'),
					array('id'=>11376,'username'=>'Philip'),
					array('id'=>15515,'username'=>'collection0210'),
					array('id'=>19447,'username'=>'candy19872013'),
					array('id'=>19554,'username'=>'dungvu'),
					array('id'=>19597,'username'=>'canh.luong.524'),
					array('id'=>21343,'username'=>'Susan'),
					array('id'=>21756,'username'=>'loihuynh0210'),
					array('id'=>23450,'username'=>'nguyentam339'),
					array('id'=>25523,'username'=>'tam.collection0210'),
					array('id'=>27881,'username'=>'luococa'),
					array('id'=>27884,'username'=>'phongSP'),
					array('id'=>27885,'username'=>'PhongCa'),
					array('id'=>27886,'username'=>'voicoi'),
					array('id'=>27887,'username'=>'Ruby'),
					array('id'=>27888,'username'=>'ThuDuong'),
					array('id'=>27889,'username'=>'HuyenThu'),
					array('id'=>27890,'username'=>'Duongqk'),
					array('id'=>27892,'username'=>'SonyTV'),
					array('id'=>27893,'username'=>'NhatTruong')				
					);
		$key = array_rand($arr);$rand_key = $arr[$key];
		if(@$rand_key['id']>0) return $rand_key['username'];
		else return 'Susan';
	}
	 public function showQuanlity() {
        $rows = array(array('id' => 'HD', 'name' => 'Film HD'),
            array('id' => 'FullHD', 'name' => 'Film Full HD'),
            array('id' => 'FullHD-HD', 'name' => 'Film Full HD - HD'),
            array('id' => 'SD', 'name' => 'Film SD'),
            array('id' => 'SDHD', 'name' => 'Film HD & SD'),
            array('id' => 'TS', 'name' => 'Film TS'),
            array('id' => 'DVDrip', 'name' => 'DVDrip'),
            array('id' => 'DVDSRC', 'name' => 'DVDSRC'),
            array('id' => 'BRRip', 'name' => 'BRRip'),
            array('id' => 'Cam', 'name' => 'Cam'),
            array('id' => 'R5', 'name' => 'R5'),
            array('id' => 'Workprint', 'name' => 'Workprint'));
        return $rows;
    }
	public function remove_mark($text){
		$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
		"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
		,"ế","ệ","ể","ễ",
		"ì","í","ị","ỉ","ĩ",
		"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
		,"ờ","ớ","ợ","ở","ỡ",
		"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
		"ỳ","ý","ỵ","ỷ","ỹ",
		"đ",
		"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
		,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
		"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
		"Ì","Í","Ị","Ỉ","Ĩ",
		"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
		,"Ờ","Ớ","Ợ","Ở","Ỡ",
		"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
		"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
		"Đ");
		
		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
		,"a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o"
		,"o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d",
		"A","A","A","A","A","A","A","A","A","A","A","A"
		,"A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O"
		,"O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D");
		$text = str_replace($marTViet,$marKoDau,$text);
		return $text;
	}
	function Rewrite($text) {
        $text = trim($text);
        $text = str_replace(
                array('(', ')','- ', ' ', '%', "/", "\\", '"', '?', '<', '>', "#", "^", "`", "'", "=", "!", ":", ",,", "..", "*", "&", "__", "▄", "-", "─", "–", "—", "―", "‗", "−", "─"), array('', '', '-', '-', '', '', '', '', '', '', '', '', '', '', '', '-', '', '-', '', '', '', "va", "-", "-", "-", "", "", "", "", "", "", ""), $text);

        $chars = array("a", "A", "e", "E", "o", "O", "u", "U", "i", "I", "d", "D", "y", "Y");

        $uni[0] = array("á", "à", "ạ", "ả", "ã", "â", "ấ", "ầ", "ậ", "ẩ", "ẫ", "ă", "ắ", "ằ", "ặ", "ẳ", "� �");
        $uni[1] = array("Á", "À", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ắ", "Ằ", "Ặ", "Ẳ", "� �");
        $uni[2] = array("é", "è", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ệ", "ể", "ễ");
        $uni[3] = array("É", "È", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ệ", "Ể", "Ễ");
        $uni[4] = array("ó", "ò", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ộ", "ổ", "ỗ", "ơ", "ớ", "ờ", "ợ", "ở", "ỡ", "� �");
        $uni[5] = array("Ó", "Ò", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ộ", "Ổ", "Ỗ", "Ơ", "Ớ", "Ờ", "Ợ", "Ở", "Ỡ", "� �");
        $uni[6] = array("ú", "ù", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ự", "ử", "ữ");
        $uni[7] = array("Ú", "Ù", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ự", "Ử", "Ữ");
        $uni[8] = array("í", "ì", "ị", "ỉ", "ĩ");
        $uni[9] = array("Í", "Ì", "Ị", "Ỉ", "Ĩ");
        $uni[10] = array("đ");
        $uni[11] = array("Đ");
        $uni[12] = array("ý", "ỳ", "ỵ", "ỷ", "ỹ");
        $uni[13] = array("Ý", "Ỳ", "Ỵ", "Ỷ", "Ỹ");

        for ($i = 0; $i <= 13; $i++) {
            $text = str_replace($uni[$i], $chars[$i], $text);
        }

        return strtolower($text);
    }
	// permission *****************************************************************
	public function permission_login($user_group_id=0,$modules){return true;
		unset($this->db);
		$this->db	= $this;		
		
		if($user_group_id==0) redirect(PAGE_DEFAULT_LOGIN, 'refresh');
		//Lay thong tin id module
		$sql_mod 	= "select id from modules where name = '".$modules."'  ";	
		
		$query_mod	= $this->db->query($sql_mod);
		$data_mod	= $query_mod->row_array(); 	
		
		if($query_mod->num_rows()>0){
			$sql 		= "select modules_id,permissions from permissions where user_group_id = '".$user_group_id."' and modules_id  = '".$data_mod['id']."' ";	
			$query 		= $this->db->query($sql);
			$data		= $query->row_array(); 	
			 // chua check permissions theo quyen chi tiet	 
					
			if(empty($data))   redirect(PAGE_DEFAULT_LOGIN, 'refresh');
			else return $data['modules_id'];
		} else  redirect(PAGE_DEFAULT_LOGIN, 'refresh');
	}
	// paging	
	
	public function loadIndex($url,$total=0,$str_search=""){
		$this->load->library('pagination');		
		$config['base_url'] 		= $url.$str_search;
        $config["total_rows"] 		= $total;		
        $config["per_page"] 		= $this->per_page;
		$config['full_tag_open'] 	= '<div class="paging_full_numbers">';
		$config['cur_tag_open'] 	= "<div class='paginate_button'>";								
		$config['cur_tag_close']	 = "</div>";
		$config['num_tag_open'] 	= "<div class='paginate_button'>";								
		$config['num_tag_close'] 	= "</div>";
		$config['full_tag_close'] 	= '</div>';
        $config["uri_segment"] 		= 3;		
		$config["num_links"] 		= 3;
		$config['use_page_numbers'] = TRUE;		
		$config['first_tag_open'] 	= "<div class='first paginate_button'>";
		$config['first_link'] 		= "First";
		$config['first_tag_close'] 	= "</div>";		
		$config['prev_tag_open'] 	= "<div class='previous paginate_button'>";
		$config['prev_link'] 		= "Previous";	
		$config['prev_tag_close'] 	= "</div>";			
		$config['next_tag_open'] 	= "<div class='next paginate_button'>";
		$config['next_link'] 		= "Next";									
		$config['next_tag_close']	 = "</div>";		
		$config['last_tag_open'] 	= "<div class='last paginate_button'>";
		$config['last_link'] 		= "Last";
		$config['last_tag_close'] 	= "</div>";		
		$this->pagination->initialize($config);		
		return $this->pagination->create_links();	
	}
		public function loadIndex_esp($url,$total=0,$str_search=""){
		$this->load->library('pagination');		
		$config['base_url'] 		= $url.$str_search;
        $config["total_rows"] 		= $total;		
        $config["per_page"] 		= $this->per_page;
		$config['full_tag_open'] 	= '<div class="paging_full_numbers">';
		$config['cur_tag_open'] 	= "<div class='paginate_button'>";								
		$config['cur_tag_close']	 = "</div>";
		$config['num_tag_open'] 	= "<div class='paginate_button'>";								
		$config['num_tag_close'] 	= "</div>";
		$config['full_tag_close'] 	= '</div>';
        $config["uri_segment"] 		= 4;		
		$config["num_links"] 		= 3;
		$config['use_page_numbers'] = TRUE;		
		$config['first_tag_open'] 	= "<div class='first paginate_button'>";
		$config['first_link'] 		= "First";
		$config['first_tag_close'] 	= "</div>";		
		$config['prev_tag_open'] 	= "<div class='previous paginate_button'>";
		$config['prev_link'] 		= "Previous";	
		$config['prev_tag_close'] 	= "</div>";			
		$config['next_tag_open'] 	= "<div class='next paginate_button'>";
		$config['next_link'] 		= "Next";									
		$config['next_tag_close']	 = "</div>";		
		$config['last_tag_open'] 	= "<div class='last paginate_button'>";
		$config['last_link'] 		= "Last";
		$config['last_tag_close'] 	= "</div>";		
		$this->pagination->initialize($config);		
		return $this->pagination->create_links();	
	}
	//select ****************************************************************************
	public function count_Items($where ="",$table_name,$select=" count(id) " ){ 
			
		$sql	= "select ".$select." idd from ".$table_name." where 1=1 ".$where;//print $sql;
		$query	= $this->db_slave->query($sql);
		$row	= $query->row();
		return $row->idd;
	}
	public function get_list($limit, $start,$where=" where 1=1 ", $order=" order by id desc",$table_name,$select = "*"){   
		$sql			= "select ".$select." from ".$table_name." where 1=1 ".$where.$order." limit ".$start.",".$limit;//print $sql;//exit;
		$query			= $this->db_master->query($sql);		
		return $query->result_array();
	}
	public function get_item($select=" name ",$table_name,$where= " and id=0 "){
		$limit			= "1";
		$start			= 0;
		$order			=" order by id desc";
		return $this->get_list($limit,$start,$where,$order,$table_name,$select);
	}
	public function get_field_item($table="film",$field="name",$where= "1=1"){
		
		$sql			= "select ".$field." as value from ".$table." where ".$where." limit 0,1 ";
		$query			= $this->db_slave->query($sql);
		$row			= $query->row();
		return $row->value;
		
	}
	public function getCountry(){
		$limit			= "200";
		$start			= 0;
		$order			=" order by id desc";
		$select 		= " id,country_name ";
		$table_name		= " country ";
		$where			= " and publish ='1' ";
		return $this->get_list($limit,$start,$where,$order,$table_name,$select);
	}
	public function getSubsite(){
		$limit			= "200";
		$start			= 0;
		$order			=" order by id desc";
		$select 		= " id,name ";
		$table_name		= " subsite ";
		$where			= " and publish ='1' ";
		return $this->get_list($limit,$start,$where,$order,$table_name,$select);
	}
	
	// log ***************************************************************************
	public function add_logmodule($data=array()){
		if($this->session->userdata("admin_id")==0)
			$this->permission_login(0,'');
		
		$data['create_date']	= date('Y-m-d h:m:s');
		$data['id_user']		= $this->session->userdata("admin_id");
		$data['idmod']			= $this->getIdmodule();
		//var_dump($data);die();
		$table_name				= "logeditmodule";
			
		$this->db_master->insert($table_name, $data); 		
	}
	public function getIdmodule(){
		$sql					= "select id from modules where name='".$this->uri->segment(1)."' limit 0,1";//print $sql;
		unset($this->db);
		$this->db				= $this;	
		$query					= $this->db_slave->query($sql);
		$row					= $query->row();
		return $row->id>0?$row->id:0;
	}
	//*filter string and id ***************************************************************
	public function filter_id_list($listId){
                if($listId == ''){
                    $list = '';
                }else{
                    $listId = substr($listId, 0, strlen($listId) - 1);
                    $data = explode(";",$listId);
                    $list = ",";
                    foreach($data as $row){
                            $record = explode(":",$row);
							$c = count($record)>1?count($record)-1:1;

                            $list .= $record[$c].",";
                    }     
					$list = $str = str_replace(",,", ",", $list);              
                    $list = $str = str_replace(" ", "", $list);
					$list = strlen(@$list)<2?'':$list;
                }
		//echo $list;exit;
		return $list;
		
	}
	/*,id,*******************************************************************************/
	
	public function filter_name_list($listId='',$table="film_cat",$field="name"){		
	$list = '';
		  if($listId == ''){
                   
                }else{      
					$Object = ','.$listId.',';     
					$Object = str_replace(',,','',$Object);     
					$sql	= " select id,".$field." as name from ".$table. " where id in (".$Object.") order by id desc";//print $sql;
					$query	= $this->db_slave->query($sql);
					$data	= $query->result_array();
                    
                    foreach($data as $row){                           
                            $list .= $row['name'].":".$row['id'].";";
                    }    
					$list = $str = str_replace(" ", "", $list); 
					$list = $str = str_replace(";;", ";", $list);                   
					$list = strlen(@$list)<3?'':$list;
                }
		//echo $list;exit;
		return $list;
		
	}
	/********************************************************************************/
	public function filter_name_noid_list($listId='',$table="film_cat",$field="name"){		
	$list = '';
		  if($listId == ''){
                   
                }else{      
					$Object = ','.$listId.',';     
					$Object = str_replace(',,','',$Object);     
					$sql	= " select id,".$field." as name from ".$table. " where id in (".$Object.") order by id desc";
					$query	= $this->db_slave->query($sql);
					$data	= $query->result_array();
                    
                    foreach($data as $row){                           
                            $list .= $row['name']." ,";
                    }    
					$list = $str = str_replace(" ", "", $list); 
					$list = $str = str_replace(",,", ",", $list);                   
					$list = strlen(@$list)<3?'':$list;
                }
		//echo $list;exit;
		return $list;
		
	}
	/* upload*******************************************************************************/
	public function do_upload_image($module){
		$this->load->library('upload');
		
		$config['upload_path'] 		= UPLOAD_LINK_IMAGE.$module.'/'.date('Y-m-d'.'/');
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size'] 		= '100';
		$config['max_width'] 		= '1024';
		$config['max_height'] 		= '768';

		$this->load->library('upload', $config);
		
		
	}
	
	public function do_upload_other(){
		$this->load->library('upload');
	}
	//encode sub************************************************************************************
	 // read sun and encode sub
    function readSub($filename) { //$filename = "source.sub";
        $fp = fopen($filename, "r");
        $content = fread($fp, filesize($filename));
        //$lines = explode("\n", $content);
        fclose($fp);
        return $content;
    }

    
	
	//*************************************************************************************
}

?>