<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$formula1  = $_GET['formula1'];
//$formula2  = $_POST['formula2'];
$bdownqty = $_GET['bdownqty'];
$estcons  = $_GET['estcons'];
//$f1a = $_GET['f1a'];
//$f2a = $_POST['f2a'];
$f1b = $_POST['f1b'];
$f2b = $_GET['f2b'];

/*$f2b = explode(" ",$formula2);
$f0=$f2b[0];
$f1=$f2b[1];
$f2=$f2b[2];
$f3=string($f2b[3]);*/
$f1c = substr($f1b,0,1);
$f1d = substr($f1b,1,9);

$f2c = substr($f2b,0,1);
$f2d = substr($f2b,1,9);

$netto=$bdownqty*$estcons;

if($f1c=="-"){
$netto2=$netto-$f1d;
} else if($f1c=="*"){
$netto2=$netto*$f1d;
} else if($f1c=="/"){
$netto2=$netto/$f1d;
} else {
$netto2=$netto+$f1d;
}

if($f2c=="-"){
$netto3=$netto2-$f2d;
} else if($f2c=="*"){
$netto3=$netto2*$f2d;
} else if($f2c=="/"){
$netto3=$netto2/$f2d;
} else {
$netto3=$netto2+$f2d;
}

/*if($f0=="/"){
$netto2=$netto/$f1;
} else if($f0=="*"){
$netto2=$netto*$f1;
} else if($f0=="-"){
$netto2=$netto-$f1;
} else {
$netto2=$netto+$f1;
}

if($netto2>0)
if($f2=="/"){
$netto3=$netto2/$f3;
} else if($f2=="*"){
$netto3=$netto2*$f3;
} else if($f2=="-"){
$netto3=$netto2-$f3;
} else {
$netto3=$netto2+$f3;
}
}*/ 

if($netto3>0){
$tnetto=$netto3;
} else if($netto2>0){
$tnetto=$netto2;
} else {
$tnetto=$netto;    
}

//echo $netto2;
echo $tnetto;
?>