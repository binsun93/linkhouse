<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 function urlalias()
{ global $CFG,$OUT,$_SEO;$_SEO->obj=new stdClass();
	
 //ini_set("pcre.recursion_limit", "16777");
    $config=get_config();
    $base_url=$config['base_url'];
    $basenscript= str_replace('\\','/',dirname($_SERVER['SCRIPT_NAME']));///vtvthethao.vn
    $script=  substr($_SERVER['REQUEST_URI'],   strlen($basenscript),  strlen($_SERVER['REQUEST_URI']));
    
	
    $base_url=rtrim($base_url,"/");
    if($basenscript=="/") $basenscript="";
	


    
    $redis=& load_class('Redis', 'libraries','My_');
    $keys=$redis->get("urlalias");
   // $redis->set("urlalias","kkkkkkkkkkkkkkkkk");

    if(!$keys){
        require_once BASEPATH.'database/DB'.EXT;
		
		
		// echo 123;exit;
        /* @var $iDB CI_DB_mysql_driver */
        $iDB=DB("slave");	
        $rows=$iDB->query("select * from urlalias  where `status`=1")->result();
		
        $_SEO->alias_real=array();
        $_SEO->real_alias=array();
		$_SEO->rows=$rows;
        foreach($rows as $row){
            $_SEO->real_alias[$base_url."/".$row->realurl]=$base_url."/".$row->aliasurl;
            $_SEO->alias_real[$base_url."/".$row->aliasurl]=$base_url."/".$row->realurl;
                           // if($basenscript."/".$row->aliasurl==$_SERVER['REQUEST_URI']) {		$_SEO->obj=$row;				}
        }
        $keys=  serialize($_SEO);
		
        $keys=$redis->set("urlalias",$keys);
    }else{
		// echo 345;exit;
        $_SEO=  unserialize($keys);
    }
	foreach($_SEO->rows as $row){
            if($basenscript."/".$row->aliasurl==$_SERVER['REQUEST_URI']) {		$_SEO->obj=$row;				}
    }
	
	if(!$_SEO->obj->title){
		foreach($_SEO->rows as $row){
			$new_url = current(explode("?",$_SERVER['REQUEST_URI']));
			if($basenscript."/".$row->aliasurl==$new_url) {	
				$_SEO->obj=$row;			
			}
		}
	}
	
    $_SERVER['REQUEST_SCRIPT']=ltrim($script,"/");
    $_SERVER['REQUEST_URI']=  strtr($base_url."/".ltrim($script,"/"),$_SEO->alias_real);
    $_SERVER['REQUEST_URI']=  substr($_SERVER['REQUEST_URI'],strlen($base_url),  strlen($_SERVER['REQUEST_URI']));
    $_SERVER['REQUEST_URI']=$basenscript.$_SERVER['REQUEST_URI'];
   



    

}
/* End of file compress.php */
/* Location: ./system/application/hooks/compress.php */