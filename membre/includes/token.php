<?php
function token_random_string($len = 20) {
    $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for($i = 0; $i < $len; $i++) {
        $token .= $str[rand(0, strlen($str) - 1)];
    }
    return $token;
    
}
$token = token_random_string(25);
?>