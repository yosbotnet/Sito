<?php
define("KEY","TESTINGKEY");
function contains($table,$array){
    foreach($array as $a){
        if($a==$table){
            return true;
        }
    }
    return false;
}
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
  }
  
function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}
function encode($ut,$ll){
    $header=base64url_encode('{
        "alg": "HS256",
        "typ": "JWT"
      }');
    $content=base64url_encode(json_encode(array("Utente"=>$ut,"LastLogin"=>$ll)));
    $digitalSignature=base64url_encode(hash_hmac("sha256","$header.$content",KEY,true));
    return "$header.$content.$digitalSignature";
}
function verify($token){
    $hcs=explode('.',$token);
    $header=$hcs[0];
    $content=$hcs[1];
    $sign=$hcs[2];
    $fakeSig=base64url_encode(hash_hmac("sha256","$header.$content",KEY,true));
    if($fakeSig==$sign){
        return true;
    }else{
        return false;
    }
}
function content($token){
    $hcs=explode('.',$token);
    $content=$hcs[1];
    return json_decode(base64url_decode($content));
}
?>