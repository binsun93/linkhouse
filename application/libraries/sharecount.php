<?php defined('BASEPATH') OR exit('No direct script access allowed');

class sharecount {
function get_tweets($url) {
 
    $json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
    $json = json_decode($json_string, true);
 
    return intval( $json['count'] );
}
 
//function get_likes($url) {
// 
//    $json_string = file_get_contents('http://graph.facebook.com/?ids=' . $url);
//    $json = json_decode($json_string, true);
//    echo "<pre>";
//    print_r($json);
//    echo "</pre>";
//    exit;
//
//
//
//    return intval( $json[$url]['likes'] );
//}
public  function get_likes( $url = '' ){
 //$pageURL = 'http://nextopics.com';

 $url = ($url == '' ) ? $pageURL : $url; // setting a value in $url variable

 $params = 'select comment_count, share_count, like_count from link_stat where url = "'.$url.'"';
 $component = urlencode( $params );
 $url = 'http://graph.facebook.com/fql?q='.$component;
 $fbLIkeAndSahre = json_decode( $this->file_get_contents_curl( $url ) ); 
 $getFbStatus = $fbLIkeAndSahre->data['0'];
 return $getFbStatus->like_count;
}
 
function get_plusones($url) {
 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    $curl_results = curl_exec ($curl);
    curl_close ($curl);
 
    $json = json_decode($curl_results, true);
    return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
}


    function get_tweets1($url) { 
        $json_string = $this->file_get_contents_curl('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
        $json = json_decode($json_string, true);
        return isset($json['count'])?intval($json['count']):0;
    }
    
    function get_fb($url) {
        $json_string = $this->file_get_contents_curl('http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls='.$url);
        $json = json_decode($json_string, true);
        return isset($json[0]['total_count'])?intval($json[0]['total_count']):0;
    }
    function get_plusones1($url)  {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $curl_results = curl_exec ($curl);
        curl_close ($curl);
        $json = json_decode($curl_results, true);
        return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
        }
    function get_stumble($url) {
        $json_string = $this->file_get_contents_curl('http://www.stumbleupon.com/services/1.01/badge.getinfo?url='.$url);
        $json = json_decode($json_string, true);
        return isset($json['result']['views'])?intval($json['result']['views']):0;
    }
    function get_delicious($url) {
        $json_string = $this->file_get_contents_curl('http://feeds.delicious.com/v2/json/urlinfo/data?url='.$url);
        $json = json_decode($json_string, true);
        return isset($json[0]['total_posts'])?intval($json[0]['total_posts']):0;
    }
    function get_pinterest($url) {
        $return_data = $this->file_get_contents_curl('http://api.pinterest.com/v1/urls/count.json?url='.$url);
        $json_string = preg_replace('/^receiveCount((.*))$/', "\1", $return_data);
        $json = json_decode($json_string, true);
        return isset($json['count'])?intval($json['count']):0;
    }
    private function file_get_contents_curl($url){
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $cont = curl_exec($ch);
        if(curl_error($ch))
        {
        die(curl_error($ch));
        }
        return $cont;
    }
}

?>