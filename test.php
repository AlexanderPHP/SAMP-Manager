<?php
function test($arg){
var_dump($arg);
}

test(function(){return 'test';});
?>