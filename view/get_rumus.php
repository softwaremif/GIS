<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$formula1  = $_GET['formula1'];
$bdownqty = $_GET['bdownqty'];
$estcons  = $_GET['estcons'];
$negocons = $_GET['negocons'];
$f1b = $_POST['f1b'];
$f2b = $_GET['f2b'];

$f1c = substr($f1b,0,1);
$f1d = substr($f1b,1,9);

$f2c = substr($f2b,0,1);
$f2d = substr($f2b,1,9);

$netto=$bdownqty*$estcons;
$budgetNetto = $bdownqty * $negocons;

if($f1c=="-"){
$netto2=$netto-$f1d;
$budgetNetto2 = $budgetNetto - $f1d;
} else if($f1c=="*"){
$netto2=$netto*$f1d;
$budgetNetto2 = $budgetNetto * $f1d;
} else if($f1c=="/"){
$netto2=$netto/$f1d;
$budgetNetto2 = $f1d != 0 ? $budgetNetto / $f1d : 0;
} else {
$netto2=$netto+$f1d;
$budgetNetto2 = $budgetNetto + (float) $f1d;
}

if($f2c=="-"){
$netto3=$netto2-$f2d;
$budgetNetto3 = $budgetNetto2 - $f2d;
} else if($f2c=="*"){
$netto3=$netto2*$f2d;
$budgetNetto3 = $budgetNetto2 * $f2d;
} else if($f2c=="/"){
$netto3=$netto2/$f2d;
$budgetNetto3 = $f2d != 0 ? $budgetNetto2 / $f2d : 0;
} else {
$netto3=$netto2+$f2d;
$budgetNetto3 = $budgetNetto2 + (float) $f2d;
}


if($netto3>0){
$tnetto=$netto3;
} else if($netto2>0){
$tnetto=$netto2;
} else {
$tnetto=$netto;    
}

if ($budgetNetto3 > 0) {
    $tbudgetNetto = $budgetNetto3;
} elseif ($budgetNetto2 > 0) {
    $tbudgetNetto = $budgetNetto2;
} else {
    $tbudgetNetto = $budgetNetto;
}

$formulaValue = $tnetto - $netto;
$formulaValueNego = $tbudgetNetto - $budgetNetto;

// echo $tnetto;
$response = [
    'tnetto' => $tnetto,
    'netto' => $netto,
    'tbudgetNetto' => $tbudgetNetto,
    'formulaValue' => $formulaValue,
    'formulaValueNego' => $formulaValueNego
];

header('Content-Type: application/json');
echo json_encode($response);
exit;
?>