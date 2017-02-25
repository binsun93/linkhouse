<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SEO
 *
 * @author Administrator
 */
class SEO {
    /**
     * 
     * @param type $obj object
     * @param string $type category,post,video
     */
    function build_link($obj,$type='hot-teen',$data=array()){
        switch ($type) { 
            case "profile": 
                $rs = "hot-teen/".$obj->slug; 
                break;
            case "posts": 
                $rs = "tin-hot/".$obj->slug; 
                break;
            case "videos": 
                $rs = "videos/".$obj->slug;      
                break; 
            default:
                $rs =  $type;    
                break;
        }
        // ALIAS

        $rs = base_url($rs);
        return $rs;
    }

    public $title;
    public $name;
    public $description;
    public $mtitle;
    public $mdescription;
    public $mkeyword;
    public $ogtitle;
    public $obdescription;
    public $ogimage;
    
    
    public $keywords;
    function build_meta($obj,$type='home'){
        global $CFG;
        switch ($type) {
            case 'profile':
                if($obj->mtitle) $this->title=$obj->mtitle;
                    else $this->title=$obj->title?$obj->title:$obj->title_short;
                if($obj->mdescription) $this->description=$obj->mdescription;
                else
                    $this->description=$obj->summary_short?$obj->summary_short:$obj->summary;
                //$this->keywords=$obj->keywords;
                $this->ogimage=$CFG->config['img_path']."470x320xt".$obj->image;
                $this->ogwidth=470;
                $this->ogheight=320;     
                $this->ogtitle=$this->title;
                $this->obdescription=$this->description;
                break;
            case 'posts':       
                $this->title=$obj->title; 
                $this->ogtitle=$this->title; 
                $this->mtitle=$this->title;  
                $this->description = $obj->description?$obj->description:$obj->title;
                $this->obdescription = $this->description; 
                $this->ogimage = $obj->image?$obj->image:'hinh logo'; 
            break;    

            case 'videos':
				// print_r($obj);exit;
                $this->title=$obj[0]->title; 
                $this->ogtitle=$this->title; 
                $this->mtitle=$this->title;  
                $this->description = $obj[0]->mdescription?$obj[0]->mdescription:$obj[0]->title;
                $this->obdescription = $this->description; 
                $this->ogimage = $obj[0]->image_banner?$obj[0]->image_banner:'hinh logo'; 
            break;   
            case 'category_post':       
                $this->title=$obj->name.' | Bài viết'; 
                $this->ogtitle=$this->title; 
                $this->mtitle=$this->title;  
                $this->description = $obj->description?$obj->description:$obj->name;
                $this->obdescription = $this->description; 
                $this->ogimage = $obj->image_page?$obj->image:'hinh logo'; 
            break;  


            default:
                if($obj->mtitle) 
                    $this->title=$obj->mtitle;
                else 
                    $this->title=$obj->name; 
                if($obj->mdescription)
                    $this->description=$obj->mdescription;
                else
                    $this->description=$obj->decription?$obj->decription:$obj->decription_short; 
                if($obj->ogtitle)
                    $this->ogtitle=$obj->ogtitle; 
                if($obj->obdescription)
                    $this->obdescription=$obj->obdescription;  
                break;
        }
    }
    function init_meta_site(){
        global $_SEO;
        if(!isset($_SEO->obj))  return;
		// print_r($_SEO);exit;
        /*$this->mtitle=$_SEO->obj->title?$_SEO->obj->title:$this->title;
        $this->mkeyword=$_SEO->obj->keyword?$_SEO->obj->keyword:$this->keyword;*/
        $this->mtitle=$_SEO->obj->title?$_SEO->obj->title:$this->title;
        // print_r($this);exit;
        $this->mdescription=$_SEO->obj->description?$_SEO->obj->description:$this->description;
        $this->mkeyword=$_SEO->obj->keyword?$_SEO->obj->keyword:$this->keyword;
        
        $this->ogtitle=$_SEO->obj->ogtitle?$_SEO->obj->ogtitle:$this->ogtitle;
        $this->obdescription=$_SEO->obj->obdescription?$_SEO->obj->obdescription:$this->obdescription;
    }
    function build_metavideo($obj,$type='video'){
        global $CFG;
        switch ($type) {
            case 'video':
                if($obj->mname) $this->name=$obj->mname;
                else $this->name=$obj->name;
                break;
                

            default:
                if($obj->mname) $this->name=$obj->mname;
                else 
                $this->name=$obj->namename;
                
                break;
        }
    }
    function init_meta_sitevideo(){
        global $_SEO;
        $this->mname=$_SEO->obj->name?$_SEO->obj->name:$this->name;
        $this->mkeyword=$_SEO->obj->keyword?$_SEO->obj->keyword:$this->keyword;
    }
}
