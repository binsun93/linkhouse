<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author Administrator
 */
class Display {
    //put your code here
    function __construct(){
        $this->CI=  get_instance();
    }
    var $cssfile=array();
    var $jsfile=array();
    var $cssblock=array();
    var $jsblock=array();
    function imgUrl(){
        return $this->CI->config->item('static_path')."themes/front/images";
    }
    function addCss($filename,$position=0,$priority=0){
        $this->cssfile[$position][$priority][$filename]=$filename;
    }
    function addJs($filename,$position=0,$priority=0){
        $this->jsfile[$position][$priority][$filename]=$filename;
    }
    function buildCss($position=0){
        $version=$this->CI->config->item('static_version');
        $return ="";
        ksort($this->cssfile[$position]);
        if ($this->CI->config->item('minify')&&!$_GET['dev']) {
            $f=array();
            foreach ($this->cssfile[$position] as $priority) {
                foreach ($priority as $key => $file) {
                $f[]="themes/front/css/$file";
                }
            }
            if (!$f)
                return "";
            $return =  implode(",", $f);
             if($version) $return.="?".$version;
            return "<link rel='stylesheet' href='{$this->CI->config->item('static_path')}static/$return' type='text/css' media='screen' />";
        }
        if(count($this->cssfile)){
           //$CI=  get_instance();
           
            foreach ($this->cssfile[$position] as $priority) {
                foreach ($priority as $key => $file) {
                    if($version) $file.="?".$version;
                 $return.="<link rel='stylesheet' href='{$this->CI->config->item('static_path')}themes/front/css/$file' type='text/css' media='screen' />";
                }
            }
        }
        
        return $return;
    }
    function buildJs($position = 0) {
        $version=$this->CI->config->item('static_version');
        $return = "";
        ksort($this->jsfile[$position]);
        if ($this->CI->config->item('minify')&&!$_GET['dev']) {
            $f=array();
            foreach ($this->jsfile[$position] as $priority) {
                foreach ($priority as $key => $file) {
                $f[]="themes/front/js/$file";
                }
            }
            if (!$f)
                return "";
            $return =  implode(",", $f);
             if($version) $return.="?".$version;
            return "<script type='text/javascript' src='{$this->CI->config->item('static_path')}static/$return'></script>";
        }
        if (count($this->cssfile)) {
            //$CI=  get_instance();
            foreach ($this->jsfile[$position] as $priority) {
                foreach ($priority as $key => $file) {
                    if($version) $file.="?".$version;
                    $return.="<script type='text/javascript' src='{$this->CI->config->item('static_path')}themes/front/js/$file'></script>";
                }
            }
        }
        return $return;
    }

    function addBlockJs($key,$jscontent){
        $this->cssblock[$key]=$jscontent;
    }
    function addBlockCss($key,$csscontent){
        $this->jsblock[$key]=$csscontent;
    }
    
}
