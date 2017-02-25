<?php
require_once  APPPATH."third_party/YT/Controller.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class YT_ControllerAdmin extends MX_Controller
{
    /**
     *
     * @var YT_AModel 
     */
	public $model;
        public $data=array();
	function __construct()	{
	   
		parent::__construct();	
       
                $this->load->library('adminclass_model');
                if(!$_SESSION['admin_id']&&!($this->uri->segment(1)=='user'&&$this->uri->segment(2)=='login')) {
                    redirect (base_url()."user/login");
                }
                    
		$user_group_id		= $this->session->userdata('admin_group_id');//1;
                
		$this->lang->load( 'global', $this->config->item('language_admin'));
		$this->load->library('form_validation');
		$this->module_name		= $this->uri->segment(1);
		//$this->config->load('define',TRUE);
                //$this->model=$this->load->model('test_model');
                $this->data['return_url']=$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:base_url().$this->uri->segment(1); 
                
                //$this->data['controller']=$this;
                //$this->data['model']=$this->model;
                $this->config->item('time_zone')?date_default_timezone_set($this->config->item('time_zone')):"";
	}	
        public function search($array_fillter){
            if(is_numeric($array_fillter['key'])){
                $this->model->where=array($this->model->table_name.".".$this->model->id_field=>$array_fillter['key']);
            }else{
                
                
                if($array_fillter['from']){
                    $date=  explode("/", $array_fillter['from']);
                    $fromdate=intval($date[2])."-".intval($date[1])."-".intval($date[0]);
                    $this->model->where['create_date >=']=$fromdate;
                }
                if($array_fillter['to']){
                    $date=  explode("/", $array_fillter['to']);
                    $fromto=intval($date[2])."-".intval($date[1])."-".intval($date[0])." 23:59:59";
                    $this->model->where['create_date <=']=  $fromto;
                }
                if($array_fillter['key']){
                    $this->model->like=array('name',''.$array_fillter['key'].'');
                }
                
                if($array_fillter['key1']){
                    $this->model->like=array('email',''.$array_fillter['key1'].''); 
                }
            }
            //return $this->index();
	}
        public function quick_trash(){
            $return=$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:$this->uri->segment(1);
            $ids=$this->input->get('ids');
            $ids=  explode(",", $ids);
            foreach ($ids as $index=> $id) {
                if(!is_numeric($id)){
                    unset($ids[$index]);
                }
            }
            $this->model->where_in[]=array($this->model->id_field,$ids);
            $this->model->update(array($this->model->status_field=>2));
            $this->model->on_data_change();
            redirect($return);
            
        }
        public function delete(){
            $return=$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:$this->uri->segment(1);
            $ids=$this->input->get('ids');
            $ids=  explode(",", $ids);
            foreach ($ids as $index=> $id) {
                if(!is_numeric($id)){
                    unset($ids[$index]);
                }
            }
            foreach ($ids as $id) {
                $this->model->delete($id);
            }
            $this->model->on_data_change();
            redirect($return);
        }
        public function hidden(){
            $return=$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:$this->uri->segment(1);
            $ids=$this->input->get('ids');
            $ids=  explode(",", $ids);
            foreach ($ids as $index=> $id) {
                if(!is_numeric($id)){
                    unset($ids[$index]);
                }
            }
            $this->model->where_in[]=array($this->model->id_field,$ids);
            $this->model->update(array($this->model->status_field=>0));
            $this->model->on_data_change();
            redirect($return);
        }
        public function show(){
            $return=$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:$this->uri->segment(1);
            $ids=$this->input->get('ids');
            $ids=  explode(",", $ids);
            foreach ($ids as $index=> $id) {
                if(!is_numeric($id)){
                    unset($ids[$index]);
                }
            }
            $this->model->where_in[]=array($this->model->id_field,$ids);
            $this->model->update(array($this->model->status_field=>1));
            $this->model->on_data_change();
            redirect($return);
        }
	public function index(){
                if($this->input->get('search')){
                    $this->search($this->input->get('search'));
                }
		$input = $this->input->get();
                if($input['order']){
                    $pattern=  explode(" ", $input['order']);
                    if($this->model->fields[$pattern[0]]){
                        $this->model->order=$this->model->table_name.".".$pattern[0]." ".(in_array(strtolower( $pattern[1]),array('desc','asc'))?$pattern[1]:'');
                    }else
                    if($this->model->fields_lang[$pattern[0]]){
                        $this->model->order=$this->model->table_name_lang.".".$pattern[0]." ".(in_array(strtolower( $pattern[1]),array('desc','asc'))?$pattern[1]:'');
                    }
                }else{
                    $this->model->order=$this->model->table_name.".".$this->model->id_field." desc";
                }
                if($this->model->fields[$this->model->status_field]){
                    if(!$input['trash']){
                        $this->model->where[$this->model->status_field." !="]=2;
                    }else{
                        $this->model->where[$this->model->status_field." ="]=2;
                    }
                }
                $this->model->single_table_mode=false;
 		$this->data['content']  		= $this->model->get_page_list("{$this->uri->segment(1)}/index",30,3);  
                
                foreach ($this->data['content']['pageList'] as $value) {
                    $roption['row']=$value;
                    $roption['controller']=$this;
                    $roption['model']=$this->model;
                    $value->row_option= $this->load->view('row_option', $roption,true);
                }
                
                $this->data['controller']=$this;
                $this->data['model']=$this->model;
                
                
                
                $this->data['form_search']= $this->load->view('form_search', $this->data,true);
                
                
                if($this->model->table_name_lang){
                    if(intval($_GET['id'])){
                        $id=intval($_GET['id']); 
                    }
                    
                    
                    
                    $this->model_lang=$this->load->model('language/language_model');
                    $this->model_lang->single_table_mode=true; 
                    $this->data['langlist']=$this->model_lang->get_list(); 
                    $this->model->getDB()->from($this->model->table_name_lang);
                    $this->model->getDB()->where(array($this->model->id_lang_rel=>intval($id)));
                    $langfields=$this->model->getDB()->get()->result(); 
                    foreach ($langfields as $value){
                        $this->data['mlang'][$value->lang_id]=$value;
                    }
                    foreach ($this->data['langlist'] as $index => $lang) {
                        if($lang->default){
                            unset($this->data['langlist'][$index]);
                            array_unshift($this->data['langlist'],$lang);
                        }
                    }
                }
                
//                $this->data['option']['quick_trash']=1;
//                $this->data['option']['quick_delete']=1;
            //print_r($this->data); exit;
		$this->template->build('list', $this->data);
	}
        function update_status($id){
            $value=array('status'=>$_REQUEST['status'],$this->model->id_field=>$id);
            $this->model->where[$this->model->id_field]=$id;
            //$this->model->where_in[]=array($this->model->id_field,$ids);
            $this->model->update(array($this->model->status_field=>$_REQUEST['status']));
            $this->model->on_data_change();
            if(isset($_GET['return'])) redirect($this->data['return_url'] );
            else echo json_encode($value);exit;
        }
        
        function addedit($id=0){
            $this->model->where[$this->model->id_field]=  intval($id);
            $this->data['obj']=$this->model->get_object_by_where();
         
            
            $this->data['model']=$this->model;
            $this->data['controller']=$this;
            if($this->model->table_name_lang){
                $this->model_lang=$this->load->model('language/language_model');
                $this->model_lang->single_table_mode=true;
        
                $this->data['langlist']=$this->model_lang->get_list();
          
                
                
                $this->model->getDB()->from($this->model->table_name_lang);
                $this->model->getDB()->where(array($this->model->id_lang_rel=>intval($id)));
                $langfields=$this->model->getDB()->get()->result();
            
                foreach ($langfields as $value){
                    $this->data['mlang'][$value->lang_id]=$value;
                }
                foreach ($this->data['langlist'] as $index => $lang) {
                    if($lang->default){
                        unset($this->data['langlist'][$index]);
                        array_unshift($this->data['langlist'],$lang);
                    }
                }
            }
      
            $this->template->build('addedit', $this->data);
            
        }
        function addedit_process(){
            $result=array('status'=>1,'id'=>0);
            $input=$this->input->post("data");
            $id=$this->model->store_data($this->input->post("data"));
            if($id){
                $afterpc=$this->on_after_addedit_process($id);
                if(is_array($afterpc)){
                    $result=array_merge($result, $afterpc) ;
                }
                $result['id']=$id;// redirect("user", 'refresh');
            }else{
                $result['status']=0;
            }			
            echo json_encode($result);exit;
        }
        function on_after_addedit_process($id){
            $this->model->on_data_change();
            return array();
        }
        function dialog_search($callback="callback_function"){
                if($this->input->get('key')){
                    $this->search($_GET);
                }
		$input = $this->input->get();
                if($this->model->fields[$this->model->status_field]){
                    if(!$input['trash']){
                        $this->model->where[$this->model->status_field." !="]=2;
                    }else{
                        $this->model->where[$this->model->status_field." ="]=2;
                    }
                }
                $this->model->single_table_mode=false;
 		$this->data['list_item']  		= $this->model->get_list_language(100); 
                $this->data['callback']=$callback;
                $this->data['model']=$this->model;
                $this->data['controller']=$this;
            echo $this->load->view('dialog_search', $this->data,true);
            exit;
        }
         /***/
        function up($id,$step=1){
            //echo $id.":".$step;
            $id=intval($id);
            $step=intval($step);
            $primary_field=$this->model->id_field;
            $order_field=$this->model->order_field;
            //get current obj
            $this->model->getDB()->from($this->model->table_name);
            $this->model->getDB()->where(array($primary_field=>$id));
            $obj=current($this->model->getDB()->get()->result());
            //get max value
            $this->model->getDB()->select("max(`$order_field`) as _maxorder,min(`$order_field`) as _minorder",false);
            $this->model->getDB()->from($this->model->table_name);
            $sobj=current($this->model->getDB()->get()->result());
            $mymax=$obj->$order_field+$step>$sobj->_maxorder?$sobj->_maxorder:$obj->$order_field+$step;
            $mymix=$obj->$order_field-$step<$sobj->_minorder?$sobj->_minorder:$obj->$order_field-$step;
            
           
            if($obj->$primary_field){
            //$obj->$primary_field
            //$obj->$order_field
                $this->model->getDB()->set($this->model->order_field, "`{$order_field}`-1",false);
                $this->model->getDB()->where(array($order_field." <="=>$obj->$order_field+$step,$order_field." >"=>$obj->$order_field));
               $this->model->getDB()->update($this->model->table_name);
               
               $this->model->getDB()->set($this->model->order_field, $mymax);
                $this->model->getDB()->where(array($primary_field=>$id));
               $this->model->getDB()->update($this->model->table_name);
            }
           redirect($this->data['return_url']);
        }
        function down($id,$step=1){
           
            $id=intval($id);
            $step=intval($step);
            $primary_field=$this->model->id_field;
            $order_field=$this->model->order_field;
            //get current obj
            $this->model->getDB()->from($this->model->table_name);
            $this->model->getDB()->where(array($primary_field=>$id));
            $obj=current($this->model->getDB()->get()->result());
            //get max value
            $this->model->getDB()->select("max(`$order_field`) as _maxorder,min(`$order_field`) as _minorder",false);
            $this->model->getDB()->from($this->model->table_name);
            $sobj=current($this->model->getDB()->get()->result());
            $mymax=$obj->$order_field+$step>$sobj->_maxorder?$sobj->_maxorder:$obj->$order_field+$step;
            $mymix=$obj->$order_field-$step<$sobj->_minorder?$sobj->_minorder:$obj->$order_field-$step;
            if($obj->$primary_field){
            //$obj->$primary_field
            //$obj->$order_field
                $this->model->getDB()->set($this->model->order_field, "`{$order_field}`+1",false);
                $this->model->getDB()->where(array($order_field." >="=>$obj->$order_field-$step,$order_field." <"=>$obj->$order_field));
               $this->model->getDB()->update($this->model->table_name);
               
               $this->model->getDB()->set($this->model->order_field, $mymix,false);
                $this->model->getDB()->where(array($primary_field=>$id));
               $this->model->getDB()->update($this->model->table_name);
            }
           redirect($this->data['return_url']);
        }
        function down_bottom($id){
           $id=intval($id);
            $step=intval($step);
            $primary_field=$this->model->id_field;
            $order_field=$this->model->order_field;
            //get current obj
            $this->model->getDB()->from($this->model->table_name);
            $this->model->getDB()->where(array($primary_field=>$id));
            $obj=current($this->model->getDB()->get()->result());
            //get max value
            $this->model->getDB()->select("max(`$order_field`) as _maxorder,min(`$order_field`) as _minorder",false);
            $this->model->getDB()->from($this->model->table_name);
            $sobj=current($this->model->getDB()->get()->result());
            //$mymax=$obj->$order_field+$step>$sobj->_maxorder?$sobj->_maxorder:$obj->$order_field+$step;
            //$mymix=$obj->$order_field-$step<$sobj->_minorder?$sobj->_minorder:$obj->$order_field-$step;
            $mymax=$sobj->_maxorder;
            $mymix=$sobj->_minorder;
            if($obj->$primary_field){
               $this->model->getDB()->set($this->model->order_field, "`{$order_field}`+1",false);
               $this->model->getDB()->where(array($order_field." <"=>$obj->$order_field));
               $this->model->getDB()->update($this->model->table_name);
               
                $this->model->getDB()->set($this->model->order_field, $mymix);
                $this->model->getDB()->where(array($this->model->id_field=>$id));
               $this->model->getDB()->update($this->model->table_name);
            }
           redirect($this->data['return_url']);
        }
        function up_top($id){
           $id=intval($id);
            $step=intval($step);
            $primary_field=$this->model->id_field;
            $order_field=$this->model->order_field;
           //get current obj
            $this->model->getDB()->from($this->model->table_name);
            $this->model->getDB()->where(array($primary_field=>$id));
            $obj=current($this->model->getDB()->get()->result());
            //get max value
            $this->model->getDB()->select("max(`$order_field`) as _maxorder,min(`$order_field`) as _minorder",false);
            $this->model->getDB()->from($this->model->table_name);
            $sobj=current($this->model->getDB()->get()->result());
            //$mymax=$obj->$order_field+$step>$sobj->_maxorder?$sobj->_maxorder:$obj->$order_field+$step;
            //$mymix=$obj->$order_field-$step<$sobj->_minorder?$sobj->_minorder:$obj->$order_field-$step;
            $mymax=$sobj->_maxorder;
            $mymix=$sobj->_minorder;
            if($obj->$primary_field){
                $this->model->getDB()->set($this->model->order_field, "`{$order_field}`-1",false);
                $this->model->getDB()->where(array($order_field." >"=>$obj->$order_field));
                $this->model->getDB()->update($this->model->table_name);

                $this->model->getDB()->set($this->model->order_field,$mymax);
                $this->model->getDB()->where(array($this->model->id_field=>$id));
                $this->model->getDB()->update($this->model->table_name);
            }
           redirect($this->data['return_url']);
        }
        /***/
        function change_link($parram='',$value){
            $input=$this->input->get();
            if($parram)
            $input[$parram]=$value;
            if($input)
            return  $this->base_link()."?".http_build_query($input);
            return $this->base_link();
        }
        function base_link(){
            return base_url().rtrim($this->uri->uri_string(),"/")."/";
        }
	 function sort_link($field){
            $to=$this->input->get('order')==$field.' asc'? $field.' desc':$field.' asc';
            return $this->change_link('order',$to);
        }
        function check_access($permision=array()){
            if(is_string($permision)){
                if(!check_permision($permision)){
                    //show_deny();
                }
            }
            if(is_array($permision))
            foreach ($permision as $p) {
                if(!check_permision($p)){
                    //show_deny();
                }
            }
        }
	 
}
