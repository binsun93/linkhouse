<?php



class Preload {



    private $model;

    private $redis;



    public function index() { 
        $this->urlalias();

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $CI = &get_instance();  
        $debug = false; 
        if (isset($_GET['htvdebug'])) { 
            $CI->output->enable_profiler(TRUE); 
            $debug = true; 
        } 
        $this->model = $CI->model_home;

        $this->redis = $CI->redis;

        $CI->load->library('Display'); 
        if(  $debug != FALSE  ||  isset($_POST['no_cache'])  || isset($_GET['no_cache']) || isset($_GET['ajax']) || isset($_POST['ajax']) ){

          return true;

        } 

 

        if (APP_TYPE == 'front') { // front-end  

            $module = $CI->router->fetch_class(); 

            if($module=="logview"){

              return true;

            } 

 

            // +++++++++++++++++++  Cache 304 +++++++++++++++++++++++

            // +++++++++++++++++++  Cache 304 +++++++++++++++++++++++

            $currentUrl = $CI->redis->getCurrentUrlWithQueryRedis();

            $lastmdf = $CI->redis->get('server1' , 'lastmdfurl:' . $currentUrl);

            if ($lastmdf === FALSE) {

                $lastmdf = md5(date('Y-m-d H:i:s'));

                $lastmdf = substr($lastmdf, 0, 20);

                $CI->redis->set('server1' , 'lastmdfurl:' . $currentUrl, $lastmdf, CACHE3);

            }

            if (isset($_SERVER["HTTP_IF_MODIFIED_SINCE"])) {

                $if_modified_since = preg_replace("/;.*$/", "", $_SERVER["HTTP_IF_MODIFIED_SINCE"]);

                if ($lastmdf == $if_modified_since) {

                    header("HTTP/1.1 304 Not Modified");

                    header('Cache-Control: max-age=9999, must-revalidate');

                    header('Accept-Encoding: gzip, deflate');

                    exit1();

                }

            } 

            // +++++++++++++++++++  Etag +++++++++++++++++++++++

            // +++++++++++++++++++  Etag +++++++++++++++++++++++ 

            $etagURL = $CI->redis->get('server1' , 'lastmdfurl:' . $currentUrl); 

            if ($etagURL === FALSE) {  

                $etagURL = $lastmdf; 

            }

            if (!empty($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] == $etagURL) {

                header("HTTP/1.1 304 Not Modified");

                header('Cache-Control: max-age=9999, must-revalidate');

                header('Accept-Encoding: gzip, deflate');

                exit1();

            } 

            $time = time() + (3600 * 10);

            header('Last-Modified: ' . $lastmdf); 

            header("Etag: ".$etagURL); 

            header("Expires: " . gmdate("D, d M Y H:i:s", $time) . " GMT");

            header('Cache-Control: max-age=9999, must-revalidate'); 
            // +++++++++++++++++++  Cache Page +++++++++++++++++++++++ 
            // +++++++++++++++++++  Cache Page +++++++++++++++++++++++  
            $html_cache = $CI->redis->hGet('server1' , 'html_cache:html_cache' , $_SERVER['REQUEST_URI']);  
            if ($html_cache !== FALSE) {     
                echo $html_cache; exit1(); 
            } 
        } else { 
        } 
    }

    function urlalias()
    { 
        global $CFG,$OUT,$_SEO;$_SEO->obj=new stdClass();
        
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
            $rows=$iDB->query("select * from tbg_urlalias  where `status`=1")->result(); 
            $_SEO->alias_real=array();
            $_SEO->real_alias=array();
            $_SEO->rows=$rows;
            foreach($rows as $row){
                $_SEO->real_alias[$base_url."/".$row->realurl]=$base_url."/".$row->aliasurl;
                $_SEO->alias_real[$base_url."/".$row->aliasurl]=$base_url."/".$row->realurl;
                               // if($basenscript."/".$row->aliasurl==$_SERVER['REQUEST_URI']) {        $_SEO->obj=$row;                }
            }
            $keys=  serialize($_SEO); 
            $keys=$redis->set("urlalias",$keys);
        }else{
            // echo 345;exit;
            $_SEO=  unserialize($keys);
        }
        foreach($_SEO->rows as $row){
                if($basenscript."/".$row->aliasurl==$_SERVER['REQUEST_URI']) {      $_SEO->obj=$row;                }
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



   

}

?>