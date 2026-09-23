<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
$po=$_GET['po'];

if($_GET['x']=="over1"){
$rs = mysqli_query($koneksi,"SELECT podt.unit, podt.pocons, podt.qrs, rkb.pocons as rpocons, rkb.qrs as rqrs
FROM podt
left outer join po on po.popk=podt.popk
left outer join rkb on podt.rkbpk=rkb.rkbpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=podt.curpk
WHERE podt.popk='$po' and podt.stspk>='1' and podt.delsts<>'1'
GROUP BY podt.rkbpk");
while($data=mysqli_fetch_array($rs)){
$qrs=$data['qrs'];
$rqrs=$data['rqrs'];
if($data['unit']=="KG" || $data['unit']=="DZN" || $data['unit']=="RIM" || $data['unit']=="GROSS"){
$pocons1=$data['pocons']-$qrs;  
$rpocons1=$data['rpocons']-$rqrs;   
} else {
$pocons1=ceil($data['pocons']-$qrs);
$rpocons1=ceil($data['rpocons']-$rqrs);
}
    
if($pocons1>$rpocons1){ $cek=1; }
else { $cek=0; }
$totcek=$totcek+$cek;
}

echo $totcek;
}
if($_GET['x']=="over2"){
    $rs = mysqli_query($koneksi,"SELECT podt.unit, podt.pocons, podt.qrs, podt.price, podt.curpk,
    rkb.pocons as rpocons, rkb.qrs as rqrs, rkb.price as rprice, rkb.curpk as rcurpk
    FROM podt
    left outer join po on po.popk=podt.popk
    left outer join rkb on podt.rkbpk=rkb.rkbpk
    left outer join ord on ord.ordpk=podt.ordpk
    left outer join sup on sup.suppk=po.suppk
    left outer join cur on  cur.curpk=podt.curpk
    WHERE podt.popk='$po' and podt.stspk>='1' and podt.delsts<>'1'
    GROUP BY podt.rkbpk");
    while($data=mysqli_fetch_array($rs)){
        $sqlk=mysqli_query($koneksi,"select * from kurs order by kurspk desc limit 1");
        $dtk=mysqli_fetch_array($sqlk);
        
        if($data['price']>0){
        if($data['rcurpk']==2){ 
        if($data['curpk']==1){
        $pprice=$data['price'];
        $rprice=$data['rprice']*$dtk['rupiah'];
        $pprice2=number_format($pprice,2,".","");
        $rprice2=number_format($rprice,2,".","");
        } else {
        $pprice=$data['price'];
        $rprice=$data['rprice'];   
        $pprice2=number_format($pprice,5,".","");
        $rprice2=number_format($rprice,5,".",""); 
        }
        } else {
        $pprice=$data['price'];
        $rprice=$data['rprice'];
        $pprice2=number_format($pprice,2,".","");
        $rprice2=number_format($rprice,2,".","");
        }
        
        if($pprice2>$rprice2){ $cek=1; }
        else { $cek=0; }
        }
        $totcek=$totcek+$cek;
        }
    
    echo $totcek;
}
if($_GET['x']=="budget"){
    $sqlk=mysqli_query($koneksi,"select * from kurs order by kurspk desc limit 1");
    $dtk=mysqli_fetch_array($sqlk);

    $dtb=mysqli_fetch_array(mysqli_query($koneksi,"select sum(price) as price, curpk from rkb where popk='$po'"));
    $dtc=mysqli_num_rows(mysqli_query($koneksi,"select * price from rkb where popk='$po'"));
    $pricert=$dtb['price']/$dtc;

    $dt2b=mysqli_fetch_array(mysqli_query($koneksi,"select sum(price) as price, curpk from podt where popk='$po'"));
    $dt2c=mysqli_num_rows(mysqli_query($koneksi,"select * price from podt where popk='$po' and delsts='0'"));
    $pricert2=$dt2b['price']/$dt2c;

    if($dtb['curpk']==2){ 
    if($dt2b['curpk']==1){
    $pprice1=$pricert2;
    $rprice1=$pricert*$dtk['rupiah'];
    $pprice2b=number_format($pprice,2,".","");
    $rprice2b=number_format($rprice,2,".","");
    } else {
    $pprice1=$pricert2;
    $rprice1=$pricert; 
    $pprice2b=number_format($pprice,5,".","");
    $rprice2b=number_format($rprice,5,".","");   
    }
    } else {
    $pprice1=$pricert2;
    $rprice1=$pricert;
    $pprice2b=number_format($pprice,2,".","");
    $rprice2b=number_format($rprice,2,".","");
    }
    
    if($pprice2>$rprice2){ $cek=1; }
    else { $cek=0; }

echo $cek;
}
?>