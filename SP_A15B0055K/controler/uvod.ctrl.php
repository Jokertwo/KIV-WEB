<?php
include_once 'view/uvod.class.php';

@session_start();

//uvodni strana
$uvod = new uvod(); 

echo $uvod->uvodni();


//zabiti vytvorenych objektu
unset($uvod);