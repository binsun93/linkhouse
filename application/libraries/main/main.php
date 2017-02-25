<?php



class Main extends MX_Controller {



    private $model;



    public function __construct() {

        $this->model = $this->model_home;

    }



    public function banner($pro_id, $cat_id) {

        $this->model->db_slave->select('name, image, link, target');

        $this->model->db_slave->from('tbl_banner_slider');

        $arr = array(

            'status' => 1,

            'pro_id' => $pro_id,

            'cat_id' => $cat_id

        );

        $this->model->db_slave->where($arr);

        $this->model->db_slave->order_by('sort_order', "asc");

        $data['banner'] = $this->model->db_slave->get()->result();

        $result = $this->load->view('home/banner', $data, true);

        $this->redis->set('banner-' . $pro_id . '-' . $cat_id, $result, CACHE5);

        return $result;

    }



    function get_id_url($url, $sep = "-") {

        $url = str_replace(".html", "", $url);

        $url = explode($sep, $url);

        $id = $url[count($url) - 1];

        return is_numeric($id) ? $id : 0;

    }



    public function check_ip_client() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

            $ip = $_SERVER['HTTP_CLIENT_IP'];

        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        } else {

            $ip = $_SERVER['REMOTE_ADDR'];

        }

        $_SERVER['REMOTE_ADDR'] = $ip;

        return $ip;

    }



    //convert s -> H:i:s

    public function convertSecondToTime($s) {

        $h = intval($s / 3600);

        $i = intval(($s - (3600 * $h)) / 60);

        $s = ($s - ((3600 * $h) + (60 * $i)));

        return $h . ':' . $i . ':' . $s;

    }



    // convert s -> i:s

    public function convertSecondToMinute($s, $returnS = false) {

        $i = intval($s / 60);

        if ($returnS) {

            $s = $s - ($i * 60);

            return $i . ':' . $s;

        }

        return $i;

    }



    public function breadcrumb(array $data, $name = '') {

        

        $name = ucfirst(strtolower($name)); 

        /*

		$html = '<div class="breadcrumbs-wrap">';

        $html .= '<div class="breadcrumbs-inner"><ul class="breadcrumbs">';

        $html .= '<li itemtype = "http://data-vocabulary.org/Breadcrumb" itemscope><a href = "'.base_url().'" itemprop = "url"><span itemprop = "title" class="icon-arr"></span></a></li>';

        if (!empty($data)) {

            $count = count($data); 

            for ($i = 0; $i < $count; $i++) {

                $data[$i]['name'] = ucfirst(strtolower($data[$i]['name']));

                $html .= '<li itemtype = "http://data-vocabulary.org/Breadcrumb" itemscope><a href = "' . base_url($data[$i]['url']) . '" itemprop = "url">' . $data[$i]['name'] . '<span itemprop = "title" class="icon-arr"></span></a></li>';

            } 

        }

        if (!empty($name)) {

            $html .= '<li itemtype="http://data-vocabulary.org/Breadcrumb" ><span class="underline" itemprop="title">' . $name . '</span></li>';

        }

        

        $html .= '</ul></div>';

        $html .= '</div>'; 

		*/
 
		$html = '<div class="container container_breakcum">';

		$html .= '<div class="row">'; 

			$html .= '<div class="col-xs-12 col-sm-9 col-md-10">'; 

				$html .= '<ol class="breadcrumb">'; 

					$html .= '<li itemtype = "http://data-vocabulary.org/Breadcrumb" itemscope>'; 

					$html .= '<a href= "'.base_url().'" itemprop = "url"><i itemprop = "title" class="fa fa-home"></i> </a>'; 

					$html .= '</li>'; 

					

					if (!empty($data)) {

						$count = count($data); 

						for ($i = 0; $i < $count; $i++) {

							$data[$i]['name'] = ucfirst(strtolower($data[$i]['name'])); 
							$html .= '<li itemtype = "http://data-vocabulary.org/Breadcrumb" itemscope><a href = "' . base_url($data[$i]['url']) . '" itemprop = "url"><i class="fa fa-angle-double-right">     ' . $data[$i]['name'] . '</i></a></li>'; 
                            //$html .= '<li><i class="fa fa-angle-double-right"></i></li>';  
						} 

					}

					if (!empty($name)) {




						$html .= '<li itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="title" class="active"><i class="fa fa-angle-double-right">    '.$name.'</i></li>'; 

					}  

				$html .= '</ol>';  

			$html .= '</div>';   

		$html .= '</div>'; 

		$html .= '</div>';   

        return $html; 

    }



    public function getModuleFromCat($cat_id) {

        switch ($cat_id) {

            case 1:

                $rs['module'] = 'phimle';

                $rs['func'] = 'theloai';

                break;

            case 2:

                $rs['module'] = 'phimbo';

                $rs['func'] = 'quocgia';

                break;

            case 3:

                $rs['module'] = 'show';

                $rs['func'] = 'quocgia';

                break;

            case 4:

                $rs['module'] = 'clip';

                $rs['func'] = 'theloai';

                break;

        }

        return $rs;

    }



    public function tooltip($data, $size) {

        $SEO = $this->load->library('SEO');

        $result = '';

        if (!empty($data)) {  
		        $linkProfile = $SEO->build_link($data,"profile");

				// $img = $data->image_poster!=''?$data->image_poster:THEME_FRONT.DEFAULT_PROFILE_POSTER; 

				$img = base_url_image($data->image_poster, $size);

				$result .= '<div class="block-grid mb10">';

					$result .= '<div class="thumb">';

						$result .= '<a href="'.$linkProfile.'" title="'.$data->title.'">'; 

						$result .= '<img src="'.$img.'" alt="'.$data->title.'" class="img-responsive lage_image">';

						$result .= '</a>';

						$result .= '<ul class="ui-options position">';

							$result .= '<li>';

								$result .= '<a href="'.$linkProfile.'/video" class="icon-facetime-video"><i class="fa fa-video-camera"></i> </a>';

							$result .= '</li>';

							$result .= '<li>';

								$result .= '<a href="'.$linkProfile.'/hinh-anh" class="icon-camera"><i class="fa fa-camera"></i> </a>';

							$result .= '</li>';

							$result .= '<li>';

								$result .= '<a href="'.$linkProfile.'" class="icon-info-sign"><i class="fa fa-info"></i> </a>';

							$result .= '</li>';

						$result .= '</ul>';

					$result .= '</div>';

	

					$result .= '<section class="description">';

					$result .= '<div class="rating-star">';

					$result .= '<img src="'.THEME_FRONT.'img/star.png" alt="">';

					$result .= '</div>';

					$result .= '<h4 class="title ellipsis"><a href="#">'.$data->title.'</a></h4>';

					$result .= '<p class="blockEllipsis">'. substr($data->description , 0 , 50) . '...'  .'</p>';

					$result .= '</section>'; 
					$result .= '<div class="item-options clearfix">';

					$result .= '<a href="" class="ui-wishlist pull-left"> <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <span class="glyphicon-text">'.number_format($data->like).'</span> </a>';

					$result .= '<a href="#" class="ui-comments pull-left"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <span class="glyphicon-text">'.number_format($data->comment).'</span> </a>';

					$result .= '<span class="ui-view pull-left"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <span class="glyphicon-text">'.number_format($data->view).'</span> </span>';

					$result .= '</div>';

					//$result .= '<span class="indexid">#1</span>';

					$result .= '</div>'; 
                    $result .= '<div class="rating">'; 
                        for($i = 0 ; $i <= $data->rating ; $i++){ 
                            $result .= '<span class="icon icon-star"></span>'; 
                        }  
                    $result .= '</div>';
 	                

        }

        return $result;

    }


    public function tooltip_list($v) {

        $SEO = $this->load->library('SEO');

        $result = '';

        if (!empty($v)) {  
                $linkProfile = $SEO->build_link($v,"profile");  
                $v->rating = rand(0 , 5);
                if($v->rating < 3){ 
                    $img = $v->image_banner!=''?$v->image_banner:THEME_FRONT.DEFAULT_PROFILE_POSTER;  
                    $img = '<img async  style="height:200px;" src="'.$img.'" height="200" width="225" alt="" class="img-responsive" />'; 
                }else{ 
                    $img = $v->image_poster!=''?$v->image_poster:THEME_FRONT.DEFAULT_PROFILE_POSTER;  
                    $img = '<img async   src="'.$img.'" alt="" class="img-responsive" />'; 
                }   
                $result .= '<div class="grid-item">'; 
                    $result .= '<div class="block-grid">'; 
                        $result .= '<div class="thumb">'; 
                            $result .= '<a href="'.$linkProfile.'" title="'.$v->title.'">';  
                            $result .= $img;

                            $result .= '</a>';

                            $result .= '<ul class="ui-options position">';

                                $result .= '<li>';

                                    $result .= '<a href="'.$linkProfile.'/video" class="icon-facetime-video"><i class="fa fa-video-camera"></i> </a>';

                                $result .= '</li>';

                                $result .= '<li>';

                                    $result .= '<a href="'.$linkProfile.'/hinh-anh" class="icon-camera"><i class="fa fa-camera"></i> </a>';

                                $result .= '</li>';

                                $result .= '<li>';

                                    $result .= '<a href="'.$linkProfile.'" class="icon-info-sign"><i class="fa fa-info"></i> </a>';

                                $result .= '</li>';

                            $result .= '</ul>';

                        $result .= '</div>'; 
                        $result .= '<section class="description">'; 
                            $result .= '<div class="rating-star">';  
                            $rand = rand();
                            if($rand % 3 == 0) {
                                $result .= '<img src="'.THEME_FRONT.'img/new-icon.gif" alt="">'; 
                            } else if($rand % 3 == 1) {
                                $result .= '<img src="'.THEME_FRONT.'img/hot.gif" alt="">'; 
                            } else {
                                $result .= '<img src="'.THEME_FRONT.'img/hot.gif" alt="">'; 
                                $result .= '<img src="'.THEME_FRONT.'img/new-icon.gif" alt="">'; 
                            }
                            
                            $result .= '</div>'; 
                            $result .= '<h4 class="title"><a href="#">'.$v->title.'</a></h4>'; 
                            //$result .= '<p>'. substr($v->description , 0 , 50) . '...'  .'</p>'; 
                        $result .= '</section>';  
                        /*
                        $result .= '<div class="item-options clearfix">'; 
                            $result .= '<a href="" class="ui-wishlist pull-left"> <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <span class="glyphicon-text">'.number_format($v->like).'</span> </a>'; 
                            $result .= '<a href="#" class="ui-comments pull-left"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <span class="glyphicon-text">'.number_format($v->comment).'</span> </a>';

                            $result .= '<span class="ui-view pull-left"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <span class="glyphicon-text">'.number_format($v->view).'</span> </span>'; 
                        $result .= '</div>';  
                        */
                    $result .= '</div>'; 
                  
                    $result .= '</div>'; 
                $result .= '<div class="gutter-sizer"></div>'; 
        }

        return $result;

    }


    public function checkLinkYoutube($link) {

        $pos = strpos($link, 'youtube');

        return ($pos === false) ? false : true;

    }



    public function paging($base_url, $total, $per_page, $uri_segment, $num_links = 3, $cur_page = 0, $prefix = '') {

        $this->load->library('pagination');

        $config['base_url'] = $base_url;

        $config['total_rows'] = $total;

        $config['per_page'] = $per_page;

        //$config['num_links'] = $num_links;

        $config['uri_segment'] = $uri_segment;

  

 

        $config['use_page_numbers']=true;  

        if ($cur_page !== 0 && is_numeric($cur_page)) {

           $config['cur_page'] = $cur_page; 

        }

        if (!empty($prefix)) {

           $config['prefix'] = 'trang-';

        }

        $this->pagination->initialize($config);

        return $this->pagination->create_links();

    }



    public function getCurrentUrlWithQuery($md5 = 1, $query = 1) {

        $currentUrl = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . str_replace('\\', '/', $_SERVER['REQUEST_URI']);

        $queryUrl = http_build_query($_GET, '', "&");

        if ($query === 1 && $queryUrl !== '') {

            $currentUrl .= '?' . $queryUrl;

        }

        $currentUrl = rtrim(trim($currentUrl), '/');

        if ($md5) {

            $currentUrl = md5($currentUrl);

        }

        return $currentUrl;

    }



    public function getNameContent($str) {

        $arr = explode('(', $str);

        $result['name_main'] = (isset($arr[1])) ? substr($str, 0, strpos($str, "(")) . substr($str, strpos($str, ')') + 1, strlen($str)) : $str;

        $result['name_ext'] = (isset($arr[1])) ? substr($str, strpos($str, "(") + 1, strpos($str, ")") - strpos($str, "(") - 1) : '';



        $result['name_main'] = trim($result['name_main']);

        $result['name_ext'] = trim($result['name_ext']);

        return $result;

    }



    public function getNameFullTextSearch($str) {



        $str = trim($str);

        $arr = array();

        $arr = explode('-', $str);

        foreach ($arr as $k => $v) {

            if (strlen($v) == 1)

                $arr[$k] = $v . '00';

            if (strlen($v) == 2)

                $arr[$k] = $v . '0';

        }

        $str = implode('-', $arr);

        return $str;

    }



    public function btn_facebook($url) {

        echo '<div class="widget-social"><div class="fanpage">';

        echo '<div class="fb-like" data-href="' . $url . '" data-layout="button_count" data-action="like" data-width="180" data-show-faces="true" data-share="true"></div>';

        echo '<div class="g-plus" data-action="share" data-href="' . $url . '" data-annotation="none"></div>';

        echo '</div></div>';

    }



    public function info_img($type, $obj) {

        $name = "";

        $type2 = 'Phim';

        if (isset($obj->event_name)) {

            $name = $obj->event_name;

            $type2 = 'Event';

        }

        if ($type == 'Avatar')

            $type2 = '';

        if (isset($obj->name)) {

            $name = $obj->name;

            if (isset($obj->cat_id)) {

                switch ($obj->cat_id) {

                    case 3:

                        $type2 = 'Show';

                        break;

                    case 4:

                        $type2 = 'Clip';

                        break;

                }

            }

        }

        $name = htmlspecialchars($name, ENT_QUOTES);

        return "alt='$type $type2 $name'";

    }



    public function link_html_title($obj) {

        $type2 = 'Phim';

        if (isset($obj->name)) {

            $name = $obj->name;

            if (isset($obj->cat_id)) {

                switch ($obj->cat_id) {

                    case 3:

                        $type2 = 'Show';

                        break;

                    case 4:

                        $type2 = 'Clip';

                        break;

                }

            }

        }

        $name = htmlspecialchars($name, ENT_QUOTES);

        return " title='$type2 $name' ";

    }

 



    public function fanpage() {

        echo '<div class="box sb-box fb-page">';

        echo '<div class="fb-page" data-href="https://www.facebook.com/VNmegabox?ref=ts&amp;amp;fref=ts" data-width="300" data-height="520" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/VNmegabox?ref=ts&amp;amp%3Bfref=ts"><a href="https://www.facebook.com/VNmegabox?ref=ts&amp;amp%3Bfref=ts">Megabox.vn</a></blockquote></div></div>';

        echo '</div>';

    }



    public function tab_block() {

        $this->load->model('tag/model_tag', 'tag');

        $tag = $this->tag->getHomeTags();

        if (!empty($tag)) {

            echo '<div class="tagCloud">';

            echo '<div class="tagCloud-title">TAG</div>';

            echo '<div class="tagCloud-container">';

            foreach ($tag as $v) {

                echo "<a href='" . base_url('t/' . remove_accent($v->name) . '-' . $v->tag_id) . "'><span class='bg-tag-left'><span class='bg-tag-body'>" . $v->name . "</span></span></a>";

            }

            echo '</div></div>';

        }

    } 

    public function formatView($num) {

        return number_format($num, 0, ',', '.');

    } 

    public function getTypeTextConfigHome($type){
        switch ($type) {
            case 1:
                $rs = 'Banner';
                break;
            case 2:
                $rs = 'Text';
                break;
            case 3:
                $rs = 'Reason';
                break;
            case 4:
                $rs = 'About Me';
                break; 
            default:
                $rs = '';
                break;
        }
        return $rs;
    }

    public function getTypeTextProviderPeople($type){
        switch ($type) {
            case 1:
                $rs = 'Đối tác';
                break;
            case 2:
                $rs = 'Người thật việc thật';
                break;  
            default:
                $rs = '';
                break;
        }
        return $rs;
    }




}



?>