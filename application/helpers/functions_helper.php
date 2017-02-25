<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 
function widget($name = '') {
    $ci = & get_instance();
    $ci->load->widget($name);
    if (isset($ci->$name))
        echo $ci->$name->run();
}

function checkpermit($name) {
    $ci = & get_instance();
    $ci->load->model('user');
    return $ci->user->checkPermit($name);
}

function checkAdmin($id = NULL) {
    if ($id == NULL) {
        $ci = & get_instance();
        if ($ci->input->cookie('uID')) {
            $userID = $ci->input->cookie('uID');
        } else if ($ci->session->userdata('ID')) {
            $userID = $ci->session->userdata('ID');
        }
        if (intval($userID) > 0) {
            $ci = & get_instance();
            $ci->load->model('user');
            $check = $ci->user->getByID($userID);
            if (isset($check['gid']) == true && $check['gid'] == 1) {
                return true;
            }
        }
    }
    return false;
}

function clear_utf8($string, $link = true, $lower = true) {
    $chars = array(
        'a' => array('ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'á', 'à', 'ả', 'ã', 'ạ', 'â', 'ă'),
        'A' => array('Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ă'),
        'e' => array('ế', 'ề', 'ể', 'ễ', 'ệ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê'),
        'E' => array('Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê'),
        'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị'),
        'I' => array('Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
        'o' => array('ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ơ'),
        'O' => array('Ố', 'Ồ', 'Ổ', 'Ô', 'Ộ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ơ'),
        'u' => array('ứ', 'ừ', 'ử', 'ữ', 'ự', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư'),
        'U' => array('Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư'),
        'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
        'Y' => array('Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
        'd' => array('đ'),
        'D' => array('Đ'),
    );
    foreach ($chars as $key => $arr)
        foreach ($arr as $val)
            $string = str_replace($val, $key, $string);
    if ($link) {
        $string = str_replace('-', '', $string);
        $string = str_replace('  ', ' ', $string);
        $string = str_replace(' ', '-', $string);
    }
    $string = @eregi_replace('[^a-zA-Z0-9_-]', '', $string);
    if ($lower)
        $string = strtolower($string);
    return $string;
}

function curl($url, $post = "", $cookie = "", $header = "", $socks5 = "", $auth = "", $head = 1) {
    $curl = ($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($post != "") {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    if (is_array($header))
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    if ($auth != "")
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
    if ($socks5 != "") {
        curl_setopt($ch, CURLOPT_PROXY, $socks5);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    }
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    if ($head)
        curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function getString($string, $start, $end) {
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0)
        return "";
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function clearString($string) {
    $string = str_replace('\'', "'", $string);
    $string = str_replace("\'", "'", $string);
    $string = str_replace('\"', '"', $string);
    $string = str_replace('\r\n', "", $string);
    $string = str_replace('\n', "", $string);
    $string = html_entity_decode($string);
    return $string;
}

function clearStringPost($string) {
    $string = str_replace('\'', "", $string);
    $string = str_replace("\'", "", $string);
    $string = str_replace('\"', '', $string);
    $string = str_replace('\r\n', "", $string);
    $string = str_replace('\n', "", $string);
    $string = str_replace("'", "", $string);
    return $string;
}

function cutOf($string, $len, $type = false) {
    if (strlen($string) > $len) {
        if ($type == false) {
            $t1 = substr($string, 0, $len);
            $t2 = substr($string, $len, strlen($string));
            $t2 = str_replace(strstr($t2, " "), "...", $t2);
            return $t1 . $t2;
        } else {
            $t1 = substr($string, 0, $len);
            return $t1 . "...";
        }
    } else
        return $string;
}

function getPostURL($post) {
    if ($post['slugcat'] == 'world-cup-2014') {
        return WorldCup . '/' . $post['slugcat'] . '/' . $post['slug'];
    } else {
        return URL . '/' . $post['slugcat'] . '/' . $post['slug'];
    }
}

function getVideoURL($video) {
    return URL . '/video/' . $video['slug'];
}

function getVideoCatURL($cat, $prepair = null) {
    return URL . '/video/' . $cat['slug'];
}

function getAuthorURL($post) {
    if ($post['ugroupid'] == 5) {
        $url = URL . "/tac-gia/" . $post['uslug'];
    } else {
        $url = URL . "/chuyen-gia/" . $post['uslug'];
    }
    return $url;
}

function getCatURL($cat, $prepair = null) {

    if ($cat['slug'] == 'world-cup-2014' || (isset($cat['slugcat']) == true && $cat['slugcat'] == "world-cup-2014")) {
        return WorldCup; // . '/' . (isset($cat['slugcat'])?$cat['slugcat']:$cat['slug']);
    } else if (isset($cat['root']) == true || isset($cat['slugcat']) == true) {
        $pre_link = (isset($cat['root']) ? ($cat['root']) : "");
        $pre_cat = (isset($cat['slugcat']) ? $cat['slugcat'] : $cat['slug']);
        if ($pre_link) {
            return URL . '/' . $pre_link . "/" . $pre_cat;
        } else {
            return URL . '/' . $pre_cat;
        }
    } else {
        if ($prepair)
            return URL . '/' . $prepair . '/' . $cat['slug'];
        else
            return URL . '/' . $cat['slug'];
    }
}

function getSummary($long, $short) {
    if (trim($short) != '') {
        return clearString($short);
    } else {
        return clearString(cutOf($long, 100));
    }
}

function getTitle($long, $short) {
    if (trim($short) != '') {
        return str_replace("/", '"', clearString($short));
    } else {
        return str_replace("/", '"', $long);
    }
}

function showSection($categories, $prepair = null) {
    ?>
    <!-- Section Box -->
    <section class="boxStyle worldF">
        <header><h2><a href="<?php echo getCatURL($categories, $prepair); ?>"><?php echo $categories['name']; ?></a></h2></header>
        <div class="listVideo">
            <ul>
                <?php
                $z = 0;
                for ($j = 0; $j < 2; $j++) {
                    echo '<li>';
                    for ($k = 0; $k < 3; $k++) {
                        if (isset($categories['posts'][$z])) {
                            if ($categories['posts'][$z]['thumb'])
                                $thumb = $categories['posts'][$z]['thumb'];
                            else
                                $thumb = CDN . '/images/pic/thumb.jpg';
                            if ($z == 0)
                                $thumb = showThumb($thumb, '418x290');
                            else
                                $thumb = showThumb($thumb, '205x140');
                            ?>
                            <a href="<?php echo getPostURL($categories['posts'][$z]); ?>"<?php if ($z == 0) echo ' class="hotN"'; ?>>
                                <img src="<?php echo $thumb; ?>" alt="<?php echo clearString($categories['posts'][$z]['title']); ?>">
                                <h4><?php
                                    if ($z == 0)
                                        $limit = 100;
                                    else
                                        $limit = 40;
                                    echo clearString(cutOf($categories['posts'][$z]['title'], $limit));
                                    ?></h4>
                                <?php
                                if ($categories['posts'][$z]['type'] == 'new')
                                    echo '<i class="icon icoNews"></i>';
                                if ($categories['posts'][$z]['type'] == 'video')
                                    echo '<i class="icon icoVideo"></i>';
                                if ($categories['posts'][$z]['type'] == 'live')
                                    echo '<div class="live">Live</div>';
                                ?>
                            </a>
                            <?php
                            $z++;
                        }
                    }
                    echo '</li>';
                }
                ?>
                <li></li>
            </ul>
        </div>
        <aside><a href="<?php echo getCatURL($categories, $prepair); ?>" class="bntAll">Xem Tất cả</a></aside>
    </section>
    <!-- Section Box -->
    <?php
}

function uploadFTP($data) {
    $CI = get_instance();
    $CI->load->library('ftp');
    //113.164.14.105 | vtvthethao.img.upload | 14EM6eC35mw1P8l
    //113.164.14.105 | vtvthethao.img.upload | 14EM6eC35mw1P8l

    $config['hostname'] = '98.158.158.40';
    $config['username'] = 'onasia.img.dev';
    $config['password'] = 'PAaIUsTDuN600Ab';

    //$config['hostname'] = '113.164.14.105';
//		$config['username'] = 'img.dev.upload';
//		$config['password'] = 'vthM6REf3b87anG';
    $config['port'] = 21;
    $config['passive'] = FALSE;
    $config['debug'] = TRUE;
    $CI->ftp->connect($config);
    $dir = date("/Y/m/d", time());
    $dirs = explode("/", $dir);
    $temp = "/";
    for ($i = 1; $i <= 3; $i++) {
        $list = $CI->ftp->list_files($temp);
        //print_r($list);
        $temp .= $dirs[$i] . '/';
        if (!in_array($dirs[$i], $list))
            $CI->ftp->mkdir($temp, '0777');
    }
    $path = $dir . '/' . md5(rand(10000, 99999) . time()) . $data['file_ext'];
    $CI->ftp->upload($data['full_path'], $path);
    $CI->ftp->close();
    unlink($data['full_path']);
    return $path;
}

function showThumb($thumb, $size = 'wxh') {
    if (trim($thumb) == "")
        return URL . '/static/images/pic/no_image.jpg';
    else if (strpos($thumb, "http://") === false)
        return 'http://img.dev.vtvguide.vn:8080/' . $size . $thumb;
    else
        return $thumb;
}

function replaceImage($content, $size = '', $show = false) {
    if ($show == false) {
        $content = str_replace('http://img.dev.vtvguide.vn:8080/' . $size, 'IMG_SERVER_REPLACE', $content);
    } else {
        $content = str_replace('IMG_SERVER_REPLACE', 'http://img.dev.vtvguide.vn:8080/' . $size, $content);
    }
    return $content;
}

function shortCut() {
    $CI = get_instance();
    $CI->load->model('shortcut');
    return $CI->shortcut->get(array());
}

function protect_link($link) {
    if ($link) {
        $secretKey = 'RAv611j64LB09A2'; //Token Key gui den Server
        $expire = time() + 3600; //Expire Time, thoi gian het han cua Link la 180s, co the Setup tuy bien
        $validKey = base64_encode(md5($secretKey . "/" . $expire . "/" . ipClient(), true)); //Format: SecretKey/ExpireTime/IPAdrress
        $validKey = strtr($validKey, '+/', '-_');
        $validKey = str_replace('=', '', $validKey);
        $link = $link . '?e=' . $expire . '&st=' . $validKey;
    }
    return $link;
}

function buildplayer($data, $width = 960, $height = 540) {
    $replacement = "";
    if (isset($data['link'])) {
        $link = protect_link($data['link']);
        $images = "";
        //= isset($data['thumb'])?showThumb($data['thumb'],'wxh'):'http://dev.worldcup.vtvthethao.vn/static/player/world-cup-2014.jpg';
        $images = CDN . '/player/Thethao-Bongda.jpg';
        $replacement = '<div class="player" ><div id="player' . $data['id'] . '">Video is loading...</div></div><script type="text/javascript">jwplayer("player' . $data['id'] . '").setup({playlist: [{image:"' . $images . '",title: "' . (isset($data['name']) ? $data['name'] : "") . '",file: "' . $link . '", tracks: [{file: "' . (isset($data['sub']) ? $data['sub'] : "") . '",label: "Tiếng Việt", kind: "captions","default": true}]}], width: ' . $width . ', height: ' . $height . '});</script>';
    }
    return $replacement;
}

function bbcode($string) {
    $tags = 'video';
    preg_match_all('`\[(' . $tags . ')=?(.*?)\](.+?)\[/\1\]`', $string, $matches);
    $ci = &get_instance();
    $ci->load->database();
    foreach ($matches[0] as $key => $match) {
        list($tag, $param, $innertext) = array($matches[1][$key], $matches[2][$key], $matches[3][$key]);
        switch ($tag) {
            case 'video':
                $sql = "select * from video where id = " . $innertext;
                $query = $ci->db->query($sql);
                $dataVideo = $query->row_array();
                $replacement = buildplayer($dataVideo, 600, 343);
                break;
        }
        $string = str_replace($match, $replacement, $string);
    }
    return $string;
}

function ipClient() {

    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function getPlus1($url) {
    $html = file_get_contents("https://plusone.google.com/_/+1/fastbutton?url=" . urlencode($url));
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($html);
    libxml_clear_errors();
    $counter = $doc->getElementById('aggregateCount');
    return $counter->nodeValue;
}

function getTweets($url) {
    $json = file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=" . $url);
    $ajsn = json_decode($json, true);
    $cont = $ajsn['count'];
    return $cont;
}

function getFacebooks($url) {
    $xml = file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&urls=" . urlencode($url));
    $xml = simplexml_load_string($xml);
    //$shares = $xml->link_stat->share_count;
    $likes = $xml->link_stat->like_count;
    //$comments = $xml->link_stat->comment_count;
    return $likes; // + $shares + $comments;
}

function setVCookie($name, $value = "", $permanent = true) {
    $expire = ($permanent) ? (time() + 30 * 24 * 60 * 60) : 0;
    $url = URL;
    if ($url[strlen($url) - 1] != '/')
        $url .= '/';
    $secure = (($_SERVER['HTTPS'] == 'on' OR $_SERVER['HTTPS'] == '1') ? true : false);
    $p = parse_url($url);
    $path = !empty($p['path']) ? $p['path'] : '/';
    $domain = $p['host'];
    if (substr_count($domain, '.') > 1) {
        while (substr_count($domain, '.') > 1) {
            $pos = strpos($domain, '.');
            $domain = substr($domain, $pos + 1);
        }
        $domain = "." . $domain;
    } else if (substr_count($domain, '.') == 1) {
        $domain = "." . $domain;
    } else {
        $domain = "";
    }
    @setcookie($name, $value, $expire, $path, $domain, $secure);
}

function logs($text) {
    #$CI=  get_instance();
    /* @var $model logs_model */
    $model = get_instance()->load->model("logs/logs_model");
    //print_r($_SESSION);exit;
    $model->store_data(
            array('name' => get_instance()->session->userdata('admin_name') . ": " . $text,
                'user_id' => get_instance()->session->userdata('admin_id'),
                'ip' => $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['REMOTE_ADDR'] . "({$_SERVER['HTTP_X_FORWARDED_FOR']})" : $_SERVER['REMOTE_ADDR'],
                'browser' => $_SERVER['HTTP_USER_AGENT'],
    ));
}

function check_permision($permision_name) {
    return get_instance()->session->check($permision_name);
}
function seo_img($obj , $type = false) { 
    $name = htmlspecialchars($obj->name, ENT_QUOTES);
    return "alt='$name'";
}

function seo_a($obj , $type = false) { 
    $name = htmlspecialchars($obj->name, ENT_QUOTES);
    return " title='$name' ";
}
