<?php
function authenticate() {
    header('WWW-Authenticate: Basic realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You must enter a valid login ID and password to access this resource\n";
    exit;
} 
if (@$_GET['htvdebug']) {
    require_authencation();
} 
function dev_authencation(){ 
    return;
}
function require_authencation(){
    $pw=md5("htvdebug@2015");
    $user="dev";
    if(@$_SERVER['PHP_AUTH_USER']!=$user||$pw!=md5($_SERVER['PHP_AUTH_PW'])){
        authenticate();
    }
}