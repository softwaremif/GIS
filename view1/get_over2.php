<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
$ord=$_GET['ord'];

if($_GET['x']=="over1"){
$rs = mysqli_query($koneksi,"SELECT podt.unit, podt.pocons, podt.qrs, rkb.pocons as rpocons, rkb.qrs as rqrs
FROM podt
left outer join po on po.popk=podt.popk
left outer join rkb on podt.rkbpk=rkb.rkbpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=podt.curpk
WHERE podt.ordpk='$ord' and podt.stspk>='1'
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
    WHERE podt.ordpk='$ord' and podt.stspk>='1'
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
?>