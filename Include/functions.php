<?php
function isTickAndBox($mail){
    $TB = "tickandbox.com";
    if(str_contains($mail,$TB)){
        return true;
    }
    else{
    return 0;
    }
}
?>