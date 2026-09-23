<?php
session_start();
/*include "email/pay.php";*/
//include "action/sinkron4b.php";
$x=$_GET['x'];
$po=$_GET['po'];
$cari2=mysqli_query($koneksi,"SELECT po.surcharge, po.surcharge2, po.note, po.piamount, po.piform, po.pono, sup.supnm,
poli.polinm,poli.polipk,podt.curpk,cur.curid, cur.cursign, pourg.pourgnm, pourg.pourgpk, po.piform, po.ket, po.etd, po.brg, po.mpaypk, po.potop,po.tgldel, po.eihl,
po.postatpk,po.tglpo,po.pidate,podt.hspec1,podt.hspec2,podt.hspec3,podt.hspec4,podt.hspec5,podt.hspec6,podt.hspec7,
podt.hspec8,podt.spec1,podt.spec2,podt.spec3,podt.spec4,podt.spec5,podt.spec6,podt.spec7,podt.spec8,podt.tspec, podt.unit2,podt.unit,
sum(podt.pocons*podt.price) as amount, ord.season, po.buy, byr.byrnm, ord.stage, po.paydate, sup.suppk, po.invoiceno, po.freightterm,
po.etdvl, po.etdal
FROM po
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join byr on byr.byrpk=ord.byrpk
left outer join poli on poli.polipk=po.polipk
left outer join pourg on pourg.pourgpk=po.pourgpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=podt.curpk
WHERE po.popk='$po'
group by po.popk");
$dt2=mysqli_fetch_array($cari2);

$tglpo=$dt2['tglpo'];
$pono=$dt2['pono'];
$postatpk=$dt2['postatpk'];
$pourgnm=$dt2['pourgnm'];
$ket=$dt2['ket'];
$etd=$dt2['etd'];
$deldt=$dt2['tgldel'];
$pourgpk=$dt2['pourgpk'];
$tspec=$dt2['tspec'];
$hspec1=TRIM($dt2['hspec1']);
$hspec2=TRIM($dt2['hspec2']);
$hspec3=TRIM($dt2['hspec3']);
$hspec4=TRIM($dt2['hspec4']);
$hspec5=TRIM($dt2['hspec5']);
$hspec6=TRIM($dt2['hspec6']);
$hspec7=TRIM($dt2['hspec7']);
$hspec8=TRIM($dt2['hspec8']);
$pidate=$dt2['pidate'];
$piform=$dt2['piform'];
$suppk=$dt2['suppk'];
if($suppk=="1949"){ 
$supnm="Unassigned";
} else{
$supnm=preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰"]/', ' ', $dt2['supnm']); 
}
$supnm2=substr(TRIM($dt2['supnm']),0,5); 
$polipk=$dt2['polipk']; 
$polinm=$dt2['polinm'];
$mpaypk=$dt2['mpaypk'];
$potop=$dt2['potop'];
$curid=$dt2['curid'];
$curpk=$dt2['curpk'];
//$cursign=$dt2['cursign'];
$brg=$dt2['brg'];
$surcharge1=$dt2['surcharge'];
$surcharge2=$dt2['surcharge2'];
$note=$dt2['note'];
$season=$dt2['season'];
$stage=$dt2['stage'];
$buyer=$dt2['byrnm'];
$paydate=$dt2['paydate'];
$invoiceno=$dt2['invoiceno'];
$freightterm=$dt2['freightterm'];
$eihl=$dt2['eihl'];
$etdvl=$dt2['etdvl'];
$etal=$dt2['etdal'];
$unit=$dt2['unit'];
$unit2=$dt2['unit2'];

$updt2=mysqli_query($koneksi,"update po set buy='$season' where popk='$po'");
$buy=$dt2['buy'];

$update4=mysqli_query($koneksi,"update po set ck='1' where ck='0' and popk='$po'");

$updt=mysqli_query($koneksi,"update po set piamount='$dt2[amount]' where popk='$po'");
// if($dt2['piamount']>0){
// $piamount=$dt2['piamount'];
// } else {
if($unit=="KG" || $unit=="DZN" || $unit=="RIM" || $unit=="GROSS"){
  $cari2b=mysqli_query($koneksi,"SELECT sum(podt.pocons*podt.price) as amount
  FROM po
  left outer join podt on podt.popk=po.popk
  left outer join ord on ord.ordpk=podt.ordpk
  left outer join byr on byr.byrpk=ord.byrpk
  left outer join poli on poli.polipk=po.polipk
  left outer join pourg on pourg.pourgpk=po.pourgpk
  left outer join sup on sup.suppk=po.suppk
  left outer join cur on  cur.curpk=podt.curpk
  WHERE po.popk='$po' and podt.delsts='0'
  group by po.popk");
  $dt2b=mysqli_fetch_array($cari2b);
} else {
  $cari2b=mysqli_query($koneksi,"SELECT sum(ceil(podt.pocons)*podt.price) as amount
  FROM po
  left outer join podt on podt.popk=po.popk
  left outer join ord on ord.ordpk=podt.ordpk
  left outer join byr on byr.byrpk=ord.byrpk
  left outer join poli on poli.polipk=po.polipk
  left outer join pourg on pourg.pourgpk=po.pourgpk
  left outer join sup on sup.suppk=po.suppk
  left outer join cur on  cur.curpk=podt.curpk
  WHERE po.popk='$po' and podt.delsts='0'
  group by po.popk");
  $dt2b=mysqli_fetch_array($cari2b); 
}
$piamount=$dt2b['amount'];
// }

// $cari2b=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' group by popk");
// $dt2b=mysqli_fetch_array($cari2b);

$sqlk=mysqli_query($koneksi,"select * from kurs order by kurspk desc limit 1");
$dtk=mysqli_fetch_array($sqlk);

/*totrkb*/
if($unit=="KG" || $unit=="DZN" || $unit=="RIM" || $unit=="GROSS"){
$crr=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='1' and popk>'0' group by popk");
$dtr=mysqli_fetch_array($crr);
} else {
$crr=mysqli_query($koneksi,"select sum(ceil(pocons)*price) as totrkb from rkb where popk='$po' and curpk='1' and popk>'0' group by popk");
$dtr=mysqli_fetch_array($crr); 
}
// $totrp=$dtr['totrkb']/$dtk['rupiah'];
$totrp1=$dtr['totrkb'];
$totrp2=$dtr['totrkb']/$dtk['rupiah'];

if($unit=="KG" || $unit=="DZN" || $unit=="RIM" || $unit=="GROSS"){
  $cre=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='3' and popk>'0' group by popk");
  $dte=mysqli_fetch_array($cre);
  } else {
  $cre=mysqli_query($koneksi,"select sum(ceil(pocons)*price) as totrkb from rkb where popk='$po' and curpk='3' and popk>'0' group by popk");
  $dte=mysqli_fetch_array($cre); 
  }
$toteu=$dte['totrkb'];

// $crp=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='6' and popk>'0' group by popk");
// $dtp=mysqli_fetch_array($crp);
// $totp=$dtp['totrkb']/$dtk['pounds'];
if($unit=="KG" || $unit=="DZN" || $unit=="RIM" || $unit=="GROSS"){
$crd=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='2' and popk>'0' group by popk");
$dtd=mysqli_fetch_array($crd);
} else {
$crd=mysqli_query($koneksi,"select sum(ceil(pocons)*price) as totrkb from rkb where popk='$po' and curpk='2' and popk>'0' group by popk");
$dtd=mysqli_fetch_array($crd); 
}
$totd1=$dtd['totrkb'];
$totd2=$dtd['totrkb']*$dtk['rupiah'];

// $totrkb1=$totrp+$toteu+$totp+$totd;
if($dt2['curpk']==1){ $totrkb3=$totrp1+$totd2; }
if($dt2['curpk']==2){ $totrkb3=$totrp2+$totd1; }
if($dt2['curpk']==3){ $totrkb3=$toteu; }
// $totrkb=$dtcur['cursign'].number_format($totrkb1,0,".",",");
// if($totqty>0){
// $perrkb1=$totrkb1/$totqty;
// $perrkb=$dtcur['cursign'].number_format($perrkb1,2,".",",");
// } else {
// $perrkb="N/A";	
// }

if($curpk==3){ $cursign="&#8364;"; }
else { $cursign=$dt2['cursign']; }

$totpii=$piamount+$surcharge1+$surcharge2;

if($totrkb3>0){
  if ($curid == "IDR") {
    $totrkb=$cursign."".number_format($totrkb3,0,".",",");
    $totrkb2=number_format($totrkb3,0,".",",");
    } else {
    $totrkb=$cursign."".number_format($totrkb3,2,".",",");
    $totrkb2=number_format($totrkb3,2,".",",");
    }
  }

if($piamount=="0.00000"){ 
$pi="---"; 
} else {
  if($curid=="IDR"){
  $pi=$cursign."".number_format($piamount,0,".",",");
  $totpii=$cursign."".number_format($totpii,0,".",",");
  $totpi2=number_format($piamount,0,".",",");
  } else {
  $pi=$cursign."".number_format($piamount,2,".",","); 
  $totpii=$cursign."".number_format($totpii,2,".",",");    
  $totpi2=number_format($piamount,2,".",",");
  }
  $totpi1=$piamount;
  }

if($surcharge1=="0.00"){ $surcharge1="---";}
else {
if($curid=="IDR"){
$surcharge1=$cursign."".number_format($surcharge1,0,".",",");
} else {
$surcharge1=$cursign."".number_format($surcharge1,2,".",",");    
}
}

if($surcharge2=="0.00"){ $surcharge2="---";}
else {
if($curid=="IDR"){
$surcharge2=$cursign."".number_format($surcharge2,0,".",",");
} else {
$surcharge2=$cursign."".number_format($surcharge2,2,".",",");    
}
}

$cari3 = mysqli_query($koneksi, "SELECT count(*) as tdelsts FROM podt WHERE popk='$po' and delsts='1'");
$dt3 = mysqli_fetch_array($cari3);
if ($dt3['tdelsts'] > 0) {
  $styledel = "margin-bottom:5px;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #EF3B42;margin-left:0px;margin-top:0px;";
} else {
  $styledel = "display:none;";
}

$crim = mysqli_query($koneksi, "select * from importdt
left outer join import on import.importpk=importdt.importpk
where importdt.popk='$po' and import.arrivalpk>0 order by import.importpk desc limit 1");
$dtim = mysqli_fetch_array($crim);
$tot = mysqli_num_rows($crim);
$stsimpk = $dtim['stsimpk'];
$etdv = $dtim['ETDV'];
$eta = $dtim['ETDA'];
$eih = $dtim['EIH'];

$crdtg = mysqli_query($koneksi4, "select sum(qtydtg) as qty from dtgdt where popk='$po'");
$dtdtg = mysqli_fetch_array($crdtg);
$qtydtg = $dtdtg['qty'];

if($polipk==1){ $eih2=$eihl; } 
else { $eih2=$eih; }

if($polipk==1){ $etdv2=$etdvl; } 
else { $etdv2=$etdv; }

if($polipk==1){ $eta2=$etal; } 
else { $eta2=$eta; }

$crqty = mysqli_query($koneksi, "select * from podt where popk='$po' group by ordpk");
while($dtqty = mysqli_fetch_array($crqty)){
  $crqty2 = mysqli_query($koneksi, "select sum(tot) as qty from bdown 
  where jenis like '%DETAIL%' and ordpk='$dtqty[ordpk]' group by ordpk");
  $dtqty2 = mysqli_fetch_array($crqty2);
  $tbqty=$tbqty+$dtqty2['qty'];
}
$bqty = $tbqty;
if($bqty>0){
$perrkb1=$totrkb3/$bqty;
$perpi1=$totpi1/$bqty;

if($perrkb1>0){
if ($curid == "IDR") {
  $perrkb = $cursign."".number_format($perrkb1, 0, ".", ",");
  } else {
  $perrkb = $cursign."".number_format($perrkb1, 2, ".", ",");
  }
}

if($piamount=="0.00000"){ 
$perpi="---"; 
} else {
if ($curid == "IDR") {
$perpi = $cursign."".number_format($perpi1, 0, ".", ",");
} else {
$perpi = $cursign."".number_format($perpi1, 2, ".", ",");
}
}
}
?>
<!--<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/gray/easyui2.css">
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.edatagrid.js"></script>
<script type="text/javascript" src="media/jquery-easyui-1.9.15/datagrid-cellediting.js"></script>-->
<script type="text/javascript">
var url;

//simpan datebox
$(function(){
$('#etd').datebox({
	onSelect: function(date){
		//var e = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
    var e = date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
    $('#etda').textbox('setValue',e);
    $('#etda').textbox('textbox').focus();
	}
});
});

function updt2(){
    var string = $("#formc").serialize();
    $('#formc').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1b",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});
}

function updteih(){
    var string = $("#formeih").serialize();
    $('#formeih').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpoeih",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});
}

function updt2p(){
    var string = $("#formp").serialize();
    $('#formp').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1p",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});
}

function updt2iv(){
    var string = $("#formiv").serialize();
    $('#formiv').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1iv",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});
}

/*updtpo*/
function updt(){
var ket=$('#rmk').val();
var string = $("#formb").serialize();
$('#formb').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt3(){
var string = $("#formf").serialize();
$('#formf').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1f&po=<?php echo $po; ?>",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updtft(){
var string = $("#formft").serialize();
$('#formft').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpoft&po=<?php echo $po; ?>",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
// window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
$('#dg').edatagrid('addRow2');
editrowa();
	}
});   
}

function updt4(){
var cc=$('#suppe').combobox('getText');
var string = $("#forme").serialize();
$('#forme').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1e&po=<?php echo $po; ?>&sup="+cc,
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt5(){
var string = $("#formg").serialize();
$('#formg').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1g",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt5b(){
var string = $("#formg2").serialize();
$('#formg2').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpog2",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt5c(){
var string = $("#formg2b").serialize();
$('#formg2b').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpog2b",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt5d(){
var string = $("#formg2c").serialize();
$('#formg2c').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpog2c",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt6(){
var string = $("#formh").serialize();
$('#formh').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1h",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt7(){
var string = $("#formi").serialize();
$('#formi').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1i",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt7b(){
var string = $("#formi2").serialize();
$('#formi2').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpoi2",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt8(){
var string = $("#formj2").serialize();
$('#formj2').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1j",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt8b(){
var string = $("#formj2b").serialize();
$('#formj2b').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1j2",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updt9(){
var string = $("#formk").serialize();
$('#formk').form('submit',{
    type	: "POST",
    url	  : "action/simpan.php?x=updtpo1k",
	  data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	/*$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});*/
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php //echo $_GET['x']; ?>&po=<?php //echo $po; ?>";
	}
});   
}

function updtpi(){  
var row2 = $('#dg').datagrid('getSelected');
var piqty2 = $('#piqty2').val();
var piprice2 = $('#piprice2').val();
if (row2){
  /* window.location.href="admin.php?x=updatepi&piqty="+piqty2+"&piprice="+piprice2;
  alert(piqty2);*/
		$.ajax({
					type	: "POST",
					url	  : "action/simpan.php?x=updatepi&piqty="+piqty2+"&piprice="+piprice2,
					data	: 'rkbpk2='+row2.rkbpk,
					success	: function(data){
						$.messager.show({
							title:'',
							msg:data, 
							timeout:3000,
							showType:'slide',
							icon:'info',
							width:252,
							height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
						});
      $('#dg').datagrid('clearSelections');
						$('#dg').datagrid('reload');
					}
				}); 
	}  else {
		$.messager.alert('Warning','No material  data selected','warning');
	}
}

function piform(){
	//var row = $('#dg').datagrid('getSelected');
		$('#dialog-form').dialog('open').dialog('setTitle','');
		//$('#form').form('load',row);
    //$('#form').form('clear');
}

function save(){
var string = $("#form").serialize();
$('#form').form('submit',{
  type	: "POST",
  url	  : "action/simpan.php?x=piform",
	data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
	success	: function(data){
	$.messager.show({
	title:'',
	msg:data, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:300,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
/*$('#form').form('clear');*/
$('#dialog-form').dialog('close');
/*$('#dialog-progress').dialog('open').dialog('setTitle','');
$('#dg2').datagrid('reload');*/
//window.location.href="?hal=detpo&po=<?php //echo $po; ?>";
	}
});   
}

function undo(){
  var a=document.getElementById('popku').value;
   var b=document.getElementById('submitdateu').value;
   var c=document.getElementById('rkbpku').value;
    $.ajax({
					type	: "POST",
					url	  : "action/delete.php?x=undo&postatpk=<?php echo $postatpk; ?>&rkbpk="+c+"&popk="+a+"&submitdate="+b,
				success	: function(){
					$('#dg').datagrid('reload');
          document.getElementById('popku').value='';
          document.getElementById('submitdateu').value='';
          document.getElementById('rkbpku').value='';
          $('#dg').edatagrid('addRow2'); editrowa();
			}
		}); 
}

function Search(){
$('#dg').datagrid('load',{
caria: $('#caria').val()
});
$('#close').show();
$('#close').css('margin-top','7px');
$('#reload').css('margin-top','-20px');
}

function Search2() {
    $('#dg').datagrid('load', {
      unit1: $('#unit1').val()
    });
    $('#search2').css('background-color', '#359DD9');
    $('#search2').css('color', '#FFFFFF');
    $('#search3').css('background-color', '#FFFFFF');
    $('#search3').css('color', '#000000');
  }

  function Search3() {
    $('#dg').datagrid('load', {
      unit2: $('#unit2').val()
    });
    $('#search3').css('background-color', '#359DD9');
    $('#search3').css('color', '#FFFFFF');
    $('#search2').css('background-color', '#FFFFFF');
    $('#search2').css('color', '#000000');
  }

function tutup(){
document.getElementById('caria').value="";
Search();
$('#close').hide();
$('#reload').css('margin-top','5px');
}

function cancel(){
$('#dialog-form').dialog('close');
$('#form').form('reset');

$('#dialog-formb').dialog('close');
$('#formb').form('reset');
}

var myCheckEditor = {
  type:'checkbox',
  options: {on:1,off:0},
}; 

/*$(function(){
            var edit_mode = false;
            var editingIndex;
            var tbl = $('#dg');

            tbl.datagrid({
                onDblClickRow:false,
                singleSelect:true,
                toolbar:[{text:'Edit', handler: function(){
                    edit_mode = true;
                    editRow(0);                    
                  }
                },
                {text:'Save', handler: function(){
                    tbl.datagrid('endEdit',editingIndex);
                  }
                },
                {text:'Cancel', handler: function(){
                    edit_mode = false;
                    tbl.datagrid('cancelEdit',editingIndex);
                  }
                }],
                onSelect:function(index){
                    editRow(parseInt(index));
                }
            });
                function editRow(index){
                if (!edit_mode)
                  return;                       
                if (editingIndex >= 0){
                    tbl.datagrid('endEdit',editingIndex);
                }
                editingIndex = index;
                tbl.datagrid('beginEdit',index);
                var editors = tbl.datagrid('getEditors', index);
                $(editors[0].target).focus();
               
            }
        });*/

function myformatter(date){
/*var y = date.getFullYear("yy");
var m = date.getMonth("M")+1;
var d = date.getDate("dd");
//return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
//return d+'/'+m+'/'+y;*/
var d = new Date(date || Date.now()),
month = '' + (d.getMonth() + 1),
day = '' + d.getDate(),
year = d.getFullYear();
if (month.length < 2) month = '0' + month;
if (day.length < 2) day = '0' + day;
return [day, month, year].join('/');
}
function myparser(s){
if (!s) return new Date();
//var ss = (s.split('-'));
var ss = (s.split('/'));
var y = parseInt(ss[0],10);
var m = parseInt(ss[1],10);
var d = parseInt(ss[2],10);
if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
//return new Date(y,m-1,d);
return new Date(d,m-1,y);
} else {
return new Date();
//return new Date(date).format("dd/mm/yy");
}
}

function selectrow(){
  var rows = $('#dg').datagrid('getRows');
			if (rows){
				$('#dg').datagrid('selectRow',0);
			}  
}

function changePosition(){
  $('#etdtol').tooltip({
    position: right
  });
 }
    
//$(function(){
// $('#dg').datagrid('getPanel').css('height','auto');
//});

		function editrowa(){
    // $('#test').focus();
    var dg = $('#dg');
    $('#container-cari').css('margin-top','65px');
    $('#tabel1').css('margin-top','65px');
    $('#tabel').css('margin-top','10px');
    $('#tab2').css('width','80%');
    $('#tab2').css('margin-top','-10px');
    $('#tab3').css('margin-top','20px');
    //dg.datagrid();
    /*var etdc= document.getElementById('etda').value;
    if (etdc=='' || etdc=='00//0000') {
       $('#etd').datebox('setValue', '');
    }else{
      $('#etd').datebox('setValue', etdc);
    }*/
    //var cmbb = document.getElementById("ccb2b").value;
    //$('#pourg').combobox('select', cmbb);
    var td = dg.datagrid('getPanel').find('div.datagrid-body td[field="piqty"]');
    var td2 = dg.datagrid('getPanel').find('div.datagrid-body td[field="piunit"]');
    var td3 = dg.datagrid('getPanel').find('div.datagrid-body td[field="piprice2"]');
    var td4 = dg.datagrid('getPanel').find('div.datagrid-body td[field="spec"]');
    var td5 = dg.datagrid('getPanel').find('div.datagrid-body td[field="colname"]');
    var td5b = dg.datagrid('getPanel').find('div.datagrid-body td[field="colcode"]');
    var td6 = dg.datagrid('getPanel').find('div.datagrid-body td[field="sizegar"]');
    var td7 = dg.datagrid('getPanel').find('div.datagrid-body td[field="unit"]');
    var td8 = dg.datagrid('getPanel').find('div.datagrid-body td[field="pocons"]');
    var td9 = dg.datagrid('getPanel').find('div.datagrid-body td[field="price"]');
    var td10 = dg.datagrid('getPanel').find('div.datagrid-body td[field="qrs"]');
    var td11 = dg.datagrid('getPanel').find('div.datagrid-body td[field="item"]');
    /*td.css('border-right','1px solid #b2b2b2');
    td.css('border-top','1px solid #b2b2b2');
    td.css('border-left','1px solid #b2b2b2');
    td.css('border-bottom','1px solid #b2b2b2');
    td.css('border-radius','5px');
    td.css('background-color','#ffffff');
    td2.css('border-right','1px solid #b2b2b2');
    td2.css('border-top','1px solid #b2b2b2');
    td2.css('border-left','1px solid #b2b2b2');
    td2.css('border-bottom','1px solid #b2b2b2');
    td2.css('border-radius','5px');
    td2.css('background-color','#ffffff');
    td3.css('border-right','1px solid #b2b2b2');
    td3.css('border-top','1px solid #b2b2b2');
    td3.css('border-left','1px solid #b2b2b2');
    td3.css('border-bottom','1px solid #b2b2b2');
    td3.css('border-radius','5px');
    td3.css('background-color','#ffffff');*/
    td4.css('border-right','1px solid #b2b2b2');
    td4.css('border-top','1px solid #b2b2b2');
    td4.css('border-left','1px solid #b2b2b2');
    td4.css('border-bottom','1px solid #b2b2b2');
    td4.css('border-radius','5px');
    td4.css('background-color','#ffffff');
    td5.css('border-right','1px solid #b2b2b2');
    td5.css('border-top','1px solid #b2b2b2');
    td5.css('border-left','1px solid #b2b2b2');
    td5.css('border-bottom','1px solid #b2b2b2');
    td5.css('border-radius','5px');
    td5.css('background-color','#ffffff');
    td5b.css('border-right','1px solid #b2b2b2');
    td5b.css('border-top','1px solid #b2b2b2');
    td5b.css('border-left','1px solid #b2b2b2');
    td5b.css('border-bottom','1px solid #b2b2b2');
    td5b.css('border-radius','5px');
    td5b.css('background-color','#ffffff');
    td6.css('border-right','1px solid #b2b2b2');
    td6.css('border-top','1px solid #b2b2b2');
    td6.css('border-left','1px solid #b2b2b2');
    td6.css('border-bottom','1px solid #b2b2b2');
    td6.css('border-radius','5px');
    td6.css('background-color','#ffffff');
    td7.css('border-right','1px solid #b2b2b2');
    td7.css('border-top','1px solid #b2b2b2');
    td7.css('border-left','1px solid #b2b2b2');
    td7.css('border-bottom','1px solid #b2b2b2');
    td7.css('border-radius','5px');
    td7.css('background-color','#ffffff');
    td8.css('border-right','1px solid #b2b2b2');
    td8.css('border-top','1px solid #b2b2b2');
    td8.css('border-left','1px solid #b2b2b2');
    td8.css('border-bottom','1px solid #b2b2b2');
    td8.css('border-radius','5px');
    td8.css('background-color','#ffffff');
    td9.css('border-right','1px solid #b2b2b2');
    td9.css('border-top','1px solid #b2b2b2');
    td9.css('border-left','1px solid #b2b2b2');
    td9.css('border-bottom','1px solid #b2b2b2');
    td9.css('border-radius','5px');
    td9.css('background-color','#ffffff');
    td10.css('border-right','1px solid #b2b2b2');
    td10.css('border-top','1px solid #b2b2b2');
    td10.css('border-left','1px solid #b2b2b2');
    td10.css('border-bottom','1px solid #b2b2b2');
    td10.css('border-radius','5px');
    td10.css('background-color','#ffffff');
    td11.css('border-right','1px solid #b2b2b2');
    td11.css('border-top','1px solid #b2b2b2');
    td11.css('border-left','1px solid #b2b2b2');
    td11.css('border-bottom','1px solid #b2b2b2');
    td11.css('border-radius','5px');
    td11.css('background-color','#ffffff');
    $('#edita').hide();
    $('#savea').show();
    $('#cancela').show();
    $('#deletea').show();
    $('#ckwrh').hide();
    $('#ccb').show();
    $('#ccbe').show();
    $('#ccbf').show();
    $('#ccbg').show();
    $('#ccbh').show();
    $('#ccbi').hide();
    $('#ccbj').show();
    $('#ccbj2').show();
    $('#ccb2').hide();
    $('#ccb2e').hide();
    $('#ccb2f').hide();
    $('#ccbg2').show();
    $('#ccbg2b').show();
    $('#ccbg2c').show();
    $('#ccb2g2').hide();
    $('#ccb2g2b').hide();
    $('#ccb2g2c').hide();
    $('#ccb2g').hide();
    $('#ccb2h').hide();
    $('#ccb2i').hide();
    $('#ccbi2').show();
    $('#ccbi2b').hide();
    $('#ccb2j').show();
    $('#ccbgp').show();
    $('#ccbgp2').hide();
    $('#ccbiv').show();
    $('#ccbiv2').hide();
    $('#ccbft').show();
    $('#ccb2ft').hide();
    $('#td1a').show();
    $('#td2a').hide();
    $('#buyer1a').hide();
    $('#buyer2a').hide();
    $('#amount1a').hide();
    $('#amount2a').hide();
    $('#eta1a').hide();
    $('#eta2a').hide();
    $('#eih1a').show();
    $('#eih2a').show();
    $('#eihl1').hide();
    $('#eihl2').show();
    $('#td1').hide();
    $('#td2').show();
    $('#notes1a').show();
    $('#notes2a').show();
    $('#notes1b').show();
    $('#notes2b').show();
    $('#et').show();
    $('#et2').hide();
    $('#pi').show();
    $('#pi2').hide();
    $('#keta').show();
    $('#ketb').hide();
    $('#pif').show();
    $('#cek1').hide();
    $('#cek2').hide();
    $('#printpo').hide();
    $('#piform').show();
    // selectrow();
    // $('#dg').datagrid('reload');
    // changePosition();
    //$('#etd').datebox('textbox').mask('9999-99-99',{placeholder:'yyyy-mm-dd'});
		}
    
    function editrowb(){
		$('#edita').show();
    $('#savea').hide();
    $('#cancela').hide();
    $('#deletea').hide();
    $('#ckwrh').show();
    $('#ccb').hide();
    $('#ccbe').hide();
    $('#ccbf').hide();
    $('#ccbg').hide();
    $('#ccbh').hide();
    $('#ccbi').hide();
    $('#ccbj').hide();
    $('#on').show();
    $('#ccb2').show();
    $('#ccb2e').show();
    $('#ccb2f').show();
    $('#ccb2g2').show();
    $('#ccb2g2b').show();
    $('#ccb2g2c').show();
    $('#ccbg2').hide();
    $('#ccbg2b').hide();
    $('#ccbg2c').hide();
    $('#ccb2h').show();
    $('#ccb2g').show();
    $('#ccb2i').show();
    $('#ccbi2b').show();
    $('#ccbi2').hide();
    $('#ccb2j').show();
    $('#et').hide();
    $('#et2').show();
    $('#pi').hide();
    $('#pi2').show();
    $('#keta').hide();
    $('#ketb').show();
    $('#pif').show();
    $('#piform').show();
    $('#cek1').show();
    $('#cek2').show();
    $('#printpo').show();
		}
    
/*$.fn.combobox.defaults.onLoadSuccess = function(items){
	if (items.length){
		var opts = $(this).combobox('options');
		$(this).combobox('select', items[0][opts.valueField]);
	}
}*/

function adduom() {
        $('#dialog-adduom').dialog('open').dialog('setTitle', '');
    }

    function Cancel_adduom() {
        $('#dialog-adduom').dialog('close');
        $('#form').form('reset');
    }

function print(){
$('#dialog-formb').dialog('open').dialog('setTitle',''); 
}
function printpo(){
var cek=$('input:checked').attr("value");
if(cek==1){
url = "pdf/pdf_po?po=<?php echo $pono; ?>&cek="+cek;
window.open(url);
} else {
url = "pdf/pdf_po2?po=<?php echo $pono; ?>&cek="+cek;
window.open(url); 
}
}

function backa(){
var cari1a= document.getElementById('cari1a').value;
var cari2a= document.getElementById('cari2a').value;
var cari5a= document.getElementById('cari5a').value;
var cari6a= document.getElementById('cari6a').value;
window.location.href="?hal=pur2&cari1a="+cari1a+"&cari2a="+cari2a+"&cari5a="+cari5a+"&cari6a="+cari6a;
}
function backb(){
var cari1a= document.getElementById('cari1a').value;
var cari2a= document.getElementById('cari2a').value;
var cari5a= document.getElementById('cari5a').value;
var cari6a= document.getElementById('cari6a').value;
window.location.href="?hal=wait&cari1a="+cari1a+"&cari2a="+cari2a+"&cari5a="+cari5a+"&cari6a="+cari6a;
}

function back(){
var x=document.getElementById('x').value;
if (x=="") {
    backa();
} else {
  backb();
}
}

function cansave(){
var cari1a= document.getElementById('cari1a').value;
var cari2a= document.getElementById('cari2a').value;
var cari5a= document.getElementById('cari5a').value;
var cari6a= document.getElementById('cari6a').value;
window.location.href="?hal=detpo&po=<?php echo $po; ?>&x=<?php echo $_GET['x']; ?>&cari1="+cari1a+"&cari2="+cari2a+"&cari5="+cari5a+"&cari6="+cari6a;
//undo();
}

function formatku2(val,row){
  if (row.tpodt>0) {
  return '<div style="margin-left:-10px;"><img src="css/images/notif2.png" width="3px" height="30px">'+
          '<div style="margin-top:-25px;margin-left:5px;"><center>'+val+'</center></div>';
  } else {
    return val;
  }
}

// $(function(){
// over();
// });

$(function(){
$.ajax({
type: "POST",
url: "view/get_over.php?x=over1&po=<?php echo $_GET['po']; ?>",
success: function(data) {
if(data>0){
$('#container-cari3b').show();
$('#overqty').show();
$('#mat2').show();
$('#oqty').show();
} else {
$('#container-cari3b').hide(); 
$('#overqty').hide();
$('#mat2').hide();
$('#oqty').hide();
}
document.getElementById('overqty').innerHTML = data;
},
});
});

$(function(){
$.ajax({
type: "POST",
url: "view/get_over.php?x=over2&po=<?php echo $_GET['po']; ?>",
success: function(data) {
if(data>0){
$('#container-cari3b').show();
$('#overprice').show();
$('#mat1').show();
$('#oprice').show();
} else {
$('#container-cari3b').hide(); 
$('#overprice').hide();
$('#mat1').hide();
$('#oprice').hide();
}
document.getElementById('overprice').innerHTML = data;
},
});
});

function actdelsts(){
  var a=document.getElementById('popk3').value;
	$.ajax({
					type	: "POST",
					url	  : "action/delete.php?x=delsts&popk="+a,
          data  : a,
				success	: function(data){
          $.messager.show({
            title:'',
            msg:data, 
            timeout:3000,
           showType:'slide',
           icon:'info',
            width:265,
           height:55,
           	style:{
           left:0,
           right:'',
           top:'',
           bottom:-document.body.scrollTop-document.documentElement.scrollTop
           }
          });
						$('#dg').datagrid('reload');
            $('#delsts').hide();
			}
		}); 
}

function srcdelsts(){
  $('#dg').datagrid('load',{
  delsts: 1
  });
   $('#delsts').hide();
}

function delmat(){
  var row =  $('#dg').datagrid('getSelected');
  if(row){
    document.getElementById('popku').value=row.popk;
    document.getElementById('submitdateu').value=row.submitdate;
    document.getElementById('rkbpku').value=row.rkbpk;
$.messager.confirm('Confirm','Are you sure you want to delete this material?',
function(r){
if (r){
    $.ajax({ 
					type	: "POST",
					url	  : "action/delete.php?x=detpo&rkbpk="+row.rkbpk+"&po=<?php echo $po; ?>",
          data  : row.rkbpk,
				success	: function(data){
          	$.messager.show({
            title:'',
            msg:data, 
            timeout:3000,
           showType:'slide',
           icon:'info',
            width:265,
           height:55,
           	style:{
           left:0,
           right:'',
           top:'',
           bottom:-document.body.scrollTop-document.documentElement.scrollTop
           }
          });
					$('#dg').datagrid('reload');
			}
		});
}
});
  }
}

function wrap(){
      var item = $(this).datagrid('getColumnOption', 'item');
      $('.' + item.cellClass).each(function(){
         var style2 = $(this).attr('style');
        $(this).attr('style',style2+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
       var spec = $(this).datagrid('getColumnOption', 'spec');
      $('.' + spec.cellClass).each(function(){
         var style3 = $(this).attr('style');
        $(this).attr('style',style3+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var sizegar = $(this).datagrid('getColumnOption', 'sizegar');
      $('.' + sizegar.cellClass).each(function(){
         var style4 = $(this).attr('style');
        $(this).attr('style',style4+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var colname = $(this).datagrid('getColumnOption', 'colname');
      $('.' + colname.cellClass).each(function(){
         var style5 = $(this).attr('style');
        $(this).attr('style',style5+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
}

$(function(){
var tdelsts = $('#tdelsts').val();
if(tdelsts>0){
$('#container-cari').css('margin-top','20px');
$('#tabel1').css('margin-top','20px');
} else {
$('#container-cari').css('margin-top','20px');
$('#tabel1').css('margin-top','20px');  
}
});

function AddUnit() {
        var string = $("#formAddUnit").serialize();
        $('#formAddUnit').form('submit', {
            type: "POST",
            url: "action/simpan.php?x=updtunit&po=<?php echo $po; ?>",
            data: string,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (data) {
                window.location.href = "?hal=detpo&po=<?php echo $po; ?>";
            }
        });
    }

</script>

<style>
    /*    input[type=text] {
            border: 1px solid black;
            border-radius: 8px;
            width: 142px;
            height: 24px;
        }*/
    select {
        width: 142px;
        height: 34px;
        padding: 8px 10px;
        border: 1px solid black;
        border-radius: 8px;
        background-color: #fff;
    }
    .unit-div {
        display: none;
    }
</style>

<input type="hidden" id="cari1a" name="cari1a" value="<?php echo $_GET['cari1']; ?>">
<input type="hidden" id="cari2a" name="cari2a" value="<?php echo $_GET['cari2']; ?>">
<input type="hidden" id="cari5a" name="cari5a" value="<?php echo $_GET['cari5']; ?>">
<input type="hidden" id="cari6a" name="cari6a" value="<?php echo $_GET['cari6']; ?>">
<input type="hidden" id="x" name="x" value="<?php echo $_GET['x']; ?>">
<input type="hidden" id="popk3" name="popk3" value="<?php echo $po; ?>">
<input type="hidden" id="tdelsts" name="tdelsts" value="<?php echo $dt3['tdelsts']; ?>">
<input type="hidden" id="popku" name="popku" value="">
<input type="hidden" id="rkbpku" name="rkbpku" value="">
<input type="hidden" id="submitdateu" name="submitdateu" value="">
<div id="frame-utama-judul">
<div class="frame-arrow">
<?php //if($_GET['x']==""){ ?>
<a href="javascript:void(0);" onclick="back();"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
<?php //} else { ?>
<!--<a href="?hal=wait"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>-->
<?php //} ?>
</div>
<div class="frame-judul">
<div class="font-judul-atas" style="width:120%;">
PO <?php echo $pono; ?>
<?php if($postatpk==1){ $sts="Awaiting PI"; }
else if($postatpk==2){ $sts="In Revision"; }
else if($postatpk==3){ $sts="Cancel PO"; }
else if($postatpk==4){ $sts="Purchased"; }
else { $sts="Awaiting PI"; }

if ($postatpk == 4) {
  if($qtydtg>0){
    echo '&nbsp;<input type="text" name="on" id="on" value="In house" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#19B715;" readonly>';
  } else if($tot>0){
    if ($stsimpk == 0) {
      echo '&nbsp;<input type="text" name="on" id="on" value="Schedule" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#858585;" readonly>';
    } else if ($stsimpk == 1) {
      echo '&nbsp;<input type="text" name="on" id="on" value="En route" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#333333;" readonly>';
    } else if ($stsimpk == 2) {
      echo '&nbsp;<input type="text" name="on" id="on" value="Arrived IDN" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#359DD9;" readonly>';
    } else if ($stsimpk == 3) {
      echo '&nbsp;<input type="text" name="on" id="on" value="In house" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#19B715;" readonly>';
    } 
  } else {
  ?>
  &nbsp; <input type="text" name="on" id="on" value="PI received" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#19B715;" readonly>
  <?php } 
  } else { 
  if($qtydtg>0){
  echo '&nbsp;<input type="text" name="on" id="on" value="In house" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#19B715;" readonly>';
  } else {
  ?>
  &nbsp; <input type="text" name="on" id="on" value="<?php echo $sts; ?>" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>
  <?php } 
  } ?>

<?php if($qtydtg>0){ } else { ?>
  &nbsp;
<div id="ccbj" style="display:none;font-style:normal;font-weight:400;font-size:14px;line-height:18px;margin-top:13px;">
<form id="formj2" method="post">
<?php
//if($postatpk<4){
?>
<input style="width:140px; height:28px;" id="sts" name="sts" class="easyui-combobox"
data-options="prompt:'<?php echo $sts; ?>',panelHeight:'auto',
data: [
{value:'1',text:'Awaiting PI'},
{value:'2',text:'In Revision'},
{value:'3',text:'Cancel PO'}
]">
<?php //} else {
//echo $sts." - ";  
//} ?>
<input type="hidden" name="popk1j" id="popk1j" value="<?php echo $po; ?>" size="8">
</form>
</div>  
<?php } ?>
<div id="ccb" style="margin-left:5px; margin-top:20px;">
<form id="formb" method="post">
<input type="hidden" name="popk1" id="popk1" value="<?php echo $po; ?>" size="8">
<input style="width:120px; height:28px;" id="pourg" name="pourg" class="easyui-combobox"
data-options="valueField:'pourgpk',textField:'pourgnm',url:'view/get_data.php?dt=pourg',prompt:'<?php echo $pourgnm; ?>',panelHeight:'auto',limitToList:'true'">
</form>
</div>
</div>
<span style="font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
<?php //echo $polinm; ?>
Buyer: <?php echo $buyer; ?>, <?php echo $season; ?>
</span>
<div id="ccbj2" style="display:none;font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
<form id="formj2b" method="post">
<?php
//if($postatpk<4){
?>
<!--<input style="width:140px; height:28px;" id="sts" name="sts" class="easyui-combobox"
data-options="prompt:'<?php //echo $sts; ?>',limitToList:'true',panelHeight:'auto',
data: [
{value:'1',text:'Awaiting PI'},
{value:'2',text:'In Revision'},
{value:'3',text:'Cancel PO'}
]">-->
<?php //} else {
//echo $sts." - ";  
//} ?>
<input type="hidden" name="popk1j2" id="popk1j2" value="<?php echo $po; ?>" size="8">
<input name="tglpo" id="tglpo" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($tglpo=='' || $tglpo=='0000-00-00'){ } else { echo tgl2($tglpo); } ?>">
</form>
</div>
<div id="ccb2j" style="font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
<?php
//echo $sts." - ";
if($tglpo=='' || $tglpo=='0000-00-00'){ echo "-"; }
else { echo tgl($tglpo); }
?>
</div>

<!--<div style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
<?php //echo $sts." - ".$tglpo; ?>
</div>-->
</div>
<?php //if($_GET['e']==""){ ?>
<div class="frame-judul-samping" style="margin-left:57%;">
<div class="frame-utama-md" style="width:100%;">
<!--<a href="http://192.168.0.22/GISL2/admin.php?hal=detpo&po=<?php //echo $po; ?>" style="text-decoration:none; color:#359DD9;display:none;"> Cancel </a> 
&nbsp; &nbsp; &nbsp; &nbsp; <a href="#" onclick="updtpi();" style="text-decoration:none; color:#359DD9;"> Save </a>-->
<?php //if($postatpk<>3){ ?>
<a href="javascript:void(0);" id="printpo" onclick="print();" plain="true" style="padding:8px; text-decoration:none; color:#359DD9;">
<!--<input style="margin-top:-5px; margin-left:50%;" id="printpo" type="button" name="submit" value="Print PO" class="button-submit-add">!-->
View PDF</a>
<?php //if($postatpk==3){ ?>
<?php //} else { ?>
<a href="?hal=detpoedt&po=<?php echo $po; ?>&e=1&x=<?php echo $_GET['x']; ?>&cari1=<?php echo $_GET['cari1']?>&cari2=<?php echo $_GET['cari2']; ?>&cari5=<?php echo $_GET['cari5']; ?>&cari6=<?php echo $_GET['cari6']; ?>" id="edita" plain="true" onclick="" style="padding:8px; text-decoration:none; color:#359DD9;">
Edit PO</a>
<?php //} ?>
<!-- <a href="javascript:void(0);" id="edita" plain="true" onclick="srcdelsts(); $('#dg').edatagrid('addRow2'); editrowa();" style="padding:8px; text-decoration:none; color:#359DD9;">
Edit PO</a> -->
<a href="http://192.168.0.11/RKB/data/admin?hal=sum&cari1=<?php echo $pono; ?>"  id="ckwrh" target="_blank" style="padding:8px;text-decoration:none; color:#359DD9;">
Status Material</a>
</div>
</div>
<?php ?>
<?php //}
//if($postatpk==4){
//if($supnm2=="STOCK"){
//$style='style="margin-left:50%; text-decoration:none; color:#BDBDBD; display:none;"';
//} else {
//$style='style="margin-left:50%; text-decoration:none; color:#BDBDBD; display:none;"';  
//}
//} else {
//$style='style="margin-left:50%; text-decoration:none; color:#BDBDBD; display:none;"';
//}
?>
<?php //} else { ?>
<div class="frame-judul-samping" style="margin-left:-5%; display:none;">
<div class="frame-utama-md" style="text-align:left;width:300%;" onmouseout ="editrowa();" onmousemove ="editrowa();" onmouseover ="editrowa();">
<a href="javascript:void(0);" id="cancela" plain="true" onclick="$('#dg').edatagrid('cancelRow'); cansave();" style="text-decoration:none; color:#BDBDBD; display:none;"> 
Cancel</a>&nbsp; &nbsp;
<a href="javascript:void(0);" id="savea" plain="true" onclick="$('#dg').edatagrid('saveRow');updt();updteih();updt2();updt2p();updt2iv();updtft();updt3();updt4();updt5();updt5b();updt5c();updt5d();updt6();updt7();updt7b();updt8();updt8b();updt9();" style="text-decoration:none; color:#359DD9; display:none;"> Save </a>&nbsp; &nbsp;
<?php if($postatpk==4){
if($supnm2=="STOCK"){
?>
<a href="javascript:void(0);" id="deletea" plain="true" onclick="delmat();" style="text-decoration:none; color:#359DD9; display:none;"> Delete </a>
<?php }
} else {
if($qtydtg>0){ } else {
?>
<a href="javascript:void(0);" id="deletea" plain="true" onclick="delmat();" style="text-decoration:none; color:#359DD9; display:none;"> Delete </a>
<?php } 
} ?>
</div>
</div>
<?php //} ?>
</div>
</div>
<!--<div id="frame-utama-judul2" style="top:185px;">-->
<div id="tabel" style="top:170px;">
<table style="width:100%; float: left">
<tr>
<!-- <td  id="td1a" colspan="7" style="display:none;font-style:normal;font-weight:700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Summary</td> -->
<td  id="td2a" colspan="8" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Summary</td>
<td  id="td2b" colspan="3" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Shipment</td>
</tr>
<tr>
<!-- <td id="buyer1a" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:250px;">Buyer / Season / Stage</td> -->
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Supplier</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:80px;">Currency</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:120px;">PI received date</td>
<?php
//if($postatpk==4){
//if($piform<>""){
?>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:120px;">Invoice no.</td>
<?php //}
//} ?>
<td id="amount1a" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:160px;">PI amount</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:150px;"><div id="piform">PI form</div></td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:120px;">Requested Deliv.</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:100px;">Supplier ETD</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:120px;">ETD from port</td>
<td id="eta1a" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:80px;">ETA</td>
<td id="eih1a" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:80px;">EIH</td>
</tr>
<!-- <tr>
<td id="buyer2a" style="font-size:14px; font-weight:bold;"> -->
<!-- <div id="ccbi" style="display:none;">
<form id="formi" method="post">
<input type="hidden" name="popk1i" id="popk1i" value="<?php //echo $po; ?>" size="8">
<?php //echo truncate(TRIM($buyer),9); ?> / <input placeholder="Season" class="easyui-validatebox" id="brgg" name="brgg" style="width:150px; height:28px;" value="<?php //echo TRIM($buy); ?>">
</form>
</div> -->
<!-- <div id="ccb2i" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php //echo $buyer; ?> / <?php //echo $buy; ?> / <?php //echo $stage; ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($buyer),7); ?> / <?php //echo truncate(TRIM($buy),7); ?> / <?php //echo truncate(TRIM($stage),7); ?>
</a>
</div>   -->
<!--<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php //echo TRIM($dt2['brg']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt2['brg']),15); ?>
</a>-->
<!-- </td> -->
<td style="font-size:14px; font-weight:bold;">
<div id="ccbe" style="display:none;">
<form id="forme" method="post">
<input type="hidden" name="popk1e" id="popk1e" value="<?php echo $po; ?>" size="8">
<input style="width:150px; height:28px;" id="suppe" name="suppe" class="easyui-combobox"
data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=suppe',prompt:'<?php echo $supnm; ?>',limitToList:true,panelHeight:'300'">
</form>
</div>
<div id="ccb2e" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($supnm); ?>" class="easyui-tooltip">
<?php if($suppk==1949) { ?>
<font style="color:rgba(0, 0, 0, 0.38)">
<?php echo truncate(TRIM($supnm),13); ?>
</font>
<?php } else { ?>
<?php echo truncate(TRIM($supnm),13); ?>
<?php } ?>
</a>
<input type="hidden" id="ccb2be" value="<?php echo $suppk; ?>" style="border:none;" readonly />
</div>
<!--<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt2['supnm']); ?>" class="easyui-tooltip">
<?php// echo truncate(TRIM($dt2['supnm']),20); ?>
</a>-->
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbf" style="display:none;">
<form id="formf" method="post">
<input type="hidden" name="popk1f" id="popk1f" value="<?php echo $po; ?>" size="8">
<input style="width:100px; height:28px;" id="curf" name="curf" class="easyui-combobox"
data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'<?php echo $curid; ?>',limitToList:true">
</form>
</div>
<div id="ccb2f" style="margin-top:0px;">
<?php
if($curid<>''){ echo $curid; }
else { echo "---"; }
?>
<input type="hidden" id="ccb2bf" value="<?php echo $curpk; ?>" style="border:none;" readonly />
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="pi" style="width:80%;display:none">
<form id="formk" method="post">
<input type="hidden" name="popk1k" id="popk1k" value="<?php echo $po; ?>" size="8">
<!--<input type="hidden" name="etda" id="etda" value="<?php //echo tgl2($pidate); ?>" size="8">-->
<!--<div id="piol" position="top" style="width:160px;padding:0px;">-->
<!--<input class="easyui-textbox" id="etda" name="etda" style="width:125px;height:30px;border:1px solid #c0c0c0;"
value="<?php //if($etd=='' || $etd=='0000-00-00'){} else{echo tgl2($etd);}?>" data-options="prompt:'DD/MM/YYYY'"/>-->
<input name="pia" id="pia" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($pidate=="" || $pidate=='0000-00-00'){ } else { echo tgl2($pidate); } ?>">
</form> 
</div>
<!--<label style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
<div id="pi2">
<?php if($pidate=="" || $pidate=='0000-00-00'){
  echo "---";
} else {
  echo tgl($pidate);
} ?>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbiv" style="display:none;">
<form id="formiv" method="post">
<input type="hidden" name="popkiv" id="popkiv" value="<?php echo $po; ?>" size="8">
<input  placeholder="Enter invoice no ..." class="easyui-validatebox" id="invoiceno" name="invoiceno"
value="<?php echo TRIM($dt2['invoiceno']); ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
<div id="ccbiv2" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($invoiceno); ?>" class="easyui-tooltip">
<?php
if($invoiceno){
echo truncate(TRIM($invoiceno),13);
} else {
echo "---";
}
?>
</a>
</div>
</td>
<td id="amount2a" style="font-size:14px; font-weight:bold;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $pi; ?>" class="easyui-tooltip">
PI: <?php echo truncate(TRIM($pi),15); ?>
</a><br>
<a href="javascript:void(0)" style="font-weight:normal;text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($totpii); ?>" class="easyui-tooltip">
<font style="color:rgba(0, 0, 0, 0.38)">Total: <?php echo truncate(TRIM($totpii),15); ?></font>
</a>
</td>
<td style="font-size:14px;">
<div id="pif">
<?php
//if($postatpk==4){
if($piform<>""){ ?>
<a href="upload/<?php echo $piform; ?>" target="_blank" style="text-decoration:none; color:#359DD9;">Download</a>
&nbsp; <a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Replace</a><br>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($piform); ?>" class="easyui-tooltip">
<font style="color:rgba(0, 0, 0, 0.38)"><?php echo truncate(TRIM($piform),13); ?></font>
</a>
<?php } else { 
if($postatpk==3){ }
else {
?>
<a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Upload</a>
<?php }
} ?>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbh" style="width:80%;display:none">
<form id="formh" method="post">
<input type="hidden" name="popk1h" id="popk1h" value="<?php echo $po; ?>" size="8">
<input name="deldt" id="deldt" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($deldt=="" || $deldt=='0000-00-00'){} else{echo tgl2($deldt);}?>">
</form>
</div>  
<div id="ccb2h">
<?php if($deldt=="" || $deldt=='0000-00-00'){
  echo "---";
} else {
  echo tgl($deldt);
} ?>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="et" style="width:80%;display:none">
<form id="formc" method="post">
<input type="hidden" name="popk2" id="popk2" value="<?php echo $po; ?>" size="8">
<!--<input type="hidden" name="etda" id="etda" value="<?php //echo tgl2($etd); ?>" size="8">-->
<!--<div id="etdtol" position="top" style="width:160px;padding:0px;">-->
<!--<input class="easyui-textbox" id="etda" name="etda" style="width:125px;height:30px;border:1px solid #c0c0c0;"
value="<?php //if($etd=='' || $etd=='0000-00-00'){} else{echo tgl2($etd);}?>" data-options="prompt:'DD/MM/YYYY'"/>-->
<input name="etda" id="etda" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($etd=="" || $etd=='0000-00-00'){} else{echo tgl2($etd);}?>">
</form>
</div>
<!--<label style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
<div id="et2">
<?php if($etd=="" || $etd=='0000-00-00'){
  echo "---";
} else {
  echo tgl($etd);
} ?>
</div>
</td>
<td id="etdv2a" style="font-size:14px; font-weight:bold;">
<?php if($etdv2=="" || $etdv2=='0000-00-00'){
  echo "---";
} else {
  echo tgl($etdv2);
} ?>
</td>
<td id="eta2a" style="font-size:14px; font-weight:bold;">
<?php if($eta2=="" || $eta2=='0000-00-00'){
  echo "---";
} else {
  echo tgl($eta2);
} ?>
</td>
<td id="eih2a" style="font-size:14px; font-weight:bold;">
<?php if($polipk==2){ ?>
<?php if($eih2=="" || $eih2=='0000-00-00'){
  echo "---";
} else {
  echo tgl($eih2);
} 
} else { ?>
<div id="eihl1" style="width:80%;">
<?php if($eih2=="" || $eih2=='0000-00-00'){
  echo "---";
} else {
  echo tgl($eih2);
} 
?>
</div>
<div id="eihl2" style="width:80%;display:none">
<form id="formeih" method="post">
<input type="hidden" name="popkeih" id="popkeih" value="<?php echo $po; ?>" size="8">
<input name="eih" id="eih" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($eih2=="" || $eih2=='0000-00-00'){ } else{echo tgl2($eih2);}?>">
</form>
</div>
<?php } ?>
</td>
</tr>
</table>

<table id="tab2" style="width:100%; float: left;">
<tr>
<td  id="td1" colspan="6" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px; color: rgba(0, 0, 0, 0.6);">Additional details</td>
<td  id="td2" colspan="8" style="display:none;font-style:normal;font-weight:700;font-size: 16px;line-height: 20px; color: rgba(0, 0, 0, 0.6);">Additional details</td>
</tr>
<tr>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Bank surcharge</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Other surcharge</td>
<td id="notes1a" style="display:none; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:10px;"></td>
<td id="notes2a" style="display:none; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Notes</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Payment terms</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Payment due date</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Freight terms</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:250px;">Remarks</td>
</tr>
<tr>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbg2" style="display:none;">
<form id="formg2" method="post">
<input type="hidden" name="popkg2" id="popkg2" value="<?php echo $po; ?>" size="8">
<input  placeholder="Enter amount..." class="easyui-validatebox" id="surcharge1" name="surcharge1"
value="<?php if($dt2['surcharge']=="0.00"){ } else { echo TRIM($dt2['surcharge']); } ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
<div id="ccb2g2" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($surcharge1); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($surcharge1),20); ?>
</a>
</div>  
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbg2b" style="display:none;">
<form id="formg2b" method="post">
<input type="hidden" name="popkg2b" id="popkg2b" value="<?php echo $po; ?>" size="8">
<input  placeholder="Enter amount..." class="easyui-validatebox" id="surcharge2" name="surcharge2"
value="<?php if($dt2['surcharge2']=="0.00"){ } else { echo TRIM($dt2['surcharge2']); } ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
<div id="ccb2g2b" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($surcharge2); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($surcharge2),20); ?>
</a>
</div>
<div id="ccb2g2c" style="margin-top:0px;font-weight:normal;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($note); ?>" class="easyui-tooltip">
<?php
if($note<>"") { $note=$note; }
else { $note="---"; }
?>
<?php echo truncate(TRIM($note),13); ?>
</a>
</div>
</td>
<td id="notes1b" style="display:none;font-size:14px;">-</td>
<td id="notes2b" style="display:none;font-size:14px; font-weight:bold;">
<div id="ccbg2c" style="display:none;">
<form id="formg2c" method="post">
<input type="hidden" name="popkg2c" id="popkg2c" value="<?php echo $po; ?>" size="8">
<input  placeholder="Notes..." class="easyui-validatebox" id="note" name="note" value="<?php echo TRIM($note); ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbg" style="display:none;">
<form id="formg" method="post">
<input type="hidden" name="popk1g" id="popk1g" value="<?php echo $po; ?>" size="8">
<!-- <input  placeholder="Terms" class="easyui-validatebox" id="payterm" name="payterm" value="<?php //echo TRIM($potop); ?>" style="width:150px; height:28px; border-color:#d3d3d3;" > -->
<select id="payterm" name="payterm" class="easyui-combobox" style="width:120px; height:28px;"
data-options="editable:false,valueField:'mpaypk',textField:'paynm',url:'view/get_data.php?dt=mpay',prompt:'<?php if($potop<>""){echo TRIM($potop);}else{ echo "Terms"; } ?>',limitToList:true">
<?php if($mpaypk>0){ ?>
<option value="<?php echo $mpaypk; ?>"><?php echo $potop; ?></option>
<?php } ?>
</select>
</form>
</div>
<div id="ccb2g" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($potop); ?>" class="easyui-tooltip">
<?php
if($potop<>"") { $potop=$potop; }
else { $potop="---"; }
?>
<?php echo truncate(TRIM($potop),20); ?>
</a>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbgp" style="width:80%;display:none">
<form id="formp" method="post">
<input type="hidden" name="popk1p" id="popk1p" value="<?php echo $po; ?>" size="8">
<!--<input type="hidden" name="etda" id="etda" value="<?php //echo tgl2($pidate); ?>" size="8">-->
<!--<div id="piol" position="top" style="width:160px;padding:0px;">-->
<!--<input class="easyui-textbox" id="etda" name="etda" style="width:125px;height:30px;border:1px solid #c0c0c0;"
value="<?php //if($etd=='' || $etd=='0000-00-00'){} else{echo tgl2($etd);}?>" data-options="prompt:'DD/MM/YYYY'"/>-->
<input name="pyd" id="pyd" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($paydate=="" || $paydate=='0000-00-00'){ } else { echo tgl2($paydate); } ?>">
</form> 
</div>
<!--<label style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
<div id="ccbgp2">
<?php if($paydate=="" || $paydate=='0000-00-00'){
  echo "---";
} else {
  echo tgl($paydate);
} ?>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbft" style="display:none;">
<form id="formft" method="post">
<input type="hidden" name="popkft" id="popkft" value="<?php echo $po; ?>" size="8">
<input style="width:100px; height:28px;" id="ft" name="ft" class="easyui-combobox"
data-options="valueField:'freightnm',textField:'freightnm',url:'view/get_data.php?dt=freight',prompt:'<?php echo $freightterm; ?>',panelHeight:'auto'">
</form>
</div>
<div id="ccb2ft" style="margin-top:0px;">
<?php
if($freightterm<>''){ echo $freightterm; }
else { echo "---"; }
?>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbi2" style="display:none;">
<form id="formi2" method="post">
<input type="hidden" name="popki2" id="popki2" value="<?php echo $po; ?>" size="8">
<textarea class="easyui-validatebox" id="rmk" name="rmk" style="width:175px; height:45px; border-color:#d3d3d3;" placeholder="Notes...">
<?php echo TRIM($ket); ?></textarea>
</form>
</div>
<div id="ccbi2b" style="margin-top:0px;">
            <?php
            if ($ket <> "") {
              $ket2 = str_replace('"',"",$ket);
            } else {
              $ket2 = "---";
            }
            ?>
          <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($ket2); ?>" class="easyui-tooltip">
            <?php echo truncate(TRIM($ket2), 33); ?>
          </a>
        </div>
</td>
</tr>
</table>
<!--</div>-->
<!--<div id="menu" onclick="$('#menu').fadeOut();"  style="display:none;">
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('saveRow');" style="color: #FFFFFF; text-decoration: none;"> Save </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('cancelRow');" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')" style="color: #FFFFFF; text-decoration: none;">Delete </a></div>-->
<!--</div>-->
<!--<div id="tabel1" style="top:400px;">-->

<div style="float: left; margin-top:10px; width:100%; height:auto;">
<a href="?hal=detpo&po=<?php echo $po; ?>&x=<?php echo $_GET['x']; ?>&cari1=<?php echo $_GET['cari1']?>&cari2=<?php echo $_GET['cari2']; ?>&cari5=<?php echo $_GET['cari5']; ?>&cari6=<?php echo $_GET['cari6']; ?>" class="link2" style="<?php if ($_GET['hal'] == "detpo") { echo $style;} ?>"> 
Material details </a>
<a href="?hal=shipdet_detpo&po=<?php echo $po; ?>&x=<?php echo $_GET['x']; ?>&cari1=<?php echo $_GET['cari1']?>&cari2=<?php echo $_GET['cari2']; ?>&cari5=<?php echo $_GET['cari5']; ?>&cari6=<?php echo $_GET['cari6']; ?>" class="link2" style="<?php if ($_GET['hal'] == "shipdet_detpo") {
echo $style; } ?>">
Shipment details</a>
</div>

<table id="tab3" style="width:70%; float: left; margin-top:15px;">
<tr>
<td style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px; color: rgba(0, 0, 0, 0.6);">Purchasing details</td>
</tr>
</table>
</div>

<div id="container-cari" style="top:395px;width:175px;left:30px;">
  <div id="frame-cari" style="width:143px;">
    <img src="css/images/Shape.png" plain="true" width="18px" height="18px">
    <input id="caria" placeholder="Search..." class="input" onkeyup="Search();" style="width:110px;">
  </div>
  <img src="css/images/close.png" id="close" plain="true" onclick="tutup();" width="15px" height="15px" style="margin-left:150px;display:none;">
  <img src="css/images/reload1.png" width="20px" height="20px" onclick="$('#dg').datagrid('reload');" id="reload" style="margin-left:175px;margin-top:5px;">
  <!-- <div id="delsts" style="<?php //echo $styledel; ?>"><?php //echo $dt3['tdelsts']; ?>&nbsp;item delete from PO</div> -->
<!-- </div> -->
<div style="margin-top:-60px;margin-left:200px;height:90px;overflow-y:hidden;overflow-x:scroll; width:580%;z-index: 0; border-radius: 8px;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<div style="text-align:left;padding:5px;background:#FFFFFF; height:70px; width:35%; border-radius: 8px;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Per garment</span>
<table style="width:100%">
<tr>
<td style="width:30%;color:#000000; font-size:14px; line-height:18px">RKB price</td>
<td style="width:70%;color:#000000; font-size:14px; line-height:18px">Actual price</td>
</tr>
<tr>
<td style="width:30%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($bqty>0){ 
if($perrkb1>0){
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $perrkb; ?>" class="easyui-tooltip">
<?php //echo truncate($perrkb,10); ?>
<?php echo $perrkb; ?>
</a>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php }
} else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
</td>
<td style="width:70%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($bqty>0){ 
if($perpi1>0){
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $perpi; ?>" class="easyui-tooltip">
<?php //echo truncate($perpi,10); ?>
<?php echo $perpi; ?>
</a>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php }
} else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
<?php 
if($bqty>0){
if($perrkb1>0 && $perpi1>0){
$profit1a=$perrkb1-$perpi1;
if($totrkb2<>$totpi2){
if($profit1a<0){ 
$profit1b=$profit1a*(-1);
$profitp1a=($profit1b/$perrkb1)*100;
$profitp1=number_format($profitp1a,2,".",","); 
$profit1="-".number_format($profit1b,2,".",",");  
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo $profit1."(".$profitp1."%)"; ?>" class="easyui-tooltip">
<span style='color:#EF3B42; font-size:12px;'> 
<?php //echo truncate($profit1,5); ?>
<?php echo $profit1; ?>
(<?php echo $profitp1; ?>%)</span> 
</a>
<?php } else if($profit1a>0){ 
$profitp1a=($profit1a/$perrkb1)*100;
$profitp1=number_format($profitp1a,2,".",",");
$profit1=number_format($profit1a,2,".",","); 
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo "+".$profit1."(".$profitp1."%) profit"; ?>" class="easyui-tooltip">
<span style='color:#19B715; font-size:12px;'>+
<?php //echo truncate($profit1,5); ?>
<?php echo $profit1; ?>
(<?php echo $profitp1; ?>%) profit</span> 
</a>
<?php 
} 
} else {
// } else { 
$profitp1a=($profit1a/$perrkb1)*100;
$profitp1=number_format($profitp1a,2,".",",");
$profit1=number_format($profit1a,2,".",","); 
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo "+".$profit1."(".$profitp1."%) profit"; ?>" class="easyui-tooltip">
<span style='color:#00000061; font-size:12px;'>+
<?php //echo truncate($profit1,5); ?>
<?php echo $profit1; ?>
(<?php echo $profitp1; ?>%) profit</span> 
</a>
<?php } 
} 
} ?>
</td>
</tr>
</table>
</div>
<div style="text-align:left;padding:5px;background-color:#FFFFFF; margin-top:-70px;margin-left:35.5%; height:70px; width:40%; border-radius: 8px;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Bulk purchase (<?php echo number_format($bqty,0,".",","); ?>)
</span>
<table style="width:100%">
<tr>
<td style="width:30%;color:#000000; font-size:14px; line-height:18px">RKB price</td>
<td style="width:70%;color:#000000; font-size:14px; line-height:18px">Actual price</td>
</tr>
<tr>
<td style="width:30%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($totrkb3>0){ ?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $totrkb; ?>" class="easyui-tooltip">
<?php //echo truncate($totrkb,11); ?>
<?php echo $totrkb; ?>
</a>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
</td>
<td style="width:70%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($totpi1>0){ ?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $pi; ?>" class="easyui-tooltip">
<?php //echo truncate($pi,11); ?>
<?php echo $pi; ?>
</a>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
<?php
if($totrkb3>0 && $totpi1>0){
$profit2a=$totrkb3-$totpi1;
if($totrkb2<>$totpi2){
if($profit2a<0){ 
$cekover=1;
$profit2b=$profit2a*(-1);
$profitp2a=($profit2b/$totrkb3)*100;
$profitp2=number_format($profitp2a,2,".",","); 
$profit2="-".number_format($profit2b,2,".",",");  
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo $profit2."(".$profitp2."%)"; ?>" class="easyui-tooltip">
<span style='color:#EF3B42; font-size:12px;'> 
<?php //echo truncate($profit2,5); ?>
<?php echo $profit2; ?>
(<?php echo $profitp2; ?>%)</span> 
</a>
<?php } else if($profit2a>0){ 
$profitp2a=($profit2a/$totrkb3)*100;
$profitp2=number_format($profitp2a,2,".",",");
$profit2=number_format($profit2a,2,".",","); 
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo "+".$profit2."(".$profitp2."%) profit"; ?>" class="easyui-tooltip">
<span style='color:#19B715; font-size:12px;'>+
<?php //echo truncate($profit2,5); ?>
<?php echo $profit2; ?>
(<?php echo $profitp2; ?>%) profit</span> 
</a>
<?php 
} 
} else {
// } else { 
$profitp2a=($profit2a/$totrkb3)*100;
$profitp2=number_format($profitp2a,2,".",",");
$profit2=number_format($profit2a,2,".",","); 
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo "+".$profit2."(".$profitp2."%) profit"; ?>" class="easyui-tooltip">
<span style='color:#00000061; font-size:12px;'>+
<?php //echo truncate($profit2,5); ?>
<?php echo $profit2; ?>
(<?php echo $profitp2; ?>%) profit</span> 
</a>
<?php } 
} else { 
if($totpi1>$totrkb3){
$cekover=1;
}
}
?>
</td>
</tr>
</table>
</div>
<?php //if($cekover==1){ ?>
<!-- <input type="text" id="overprice2" size="5">
<input type="text" id="overqty2" size="5"> -->
<div id="container-cari3b" style="display:none;text-align:left;padding:5px;background-color:#FFFFFF;margin-top:-70px;margin-left:76%; height:70px; width:23%; border-radius: 8px;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Attention !</span><br>
<span id="overprice" style="color:#EF3B42; font-size:12px; line-height:16px;"></span>
<span style="color:#EF3B42; font-size:12px; line-height:16px;">materials</span>
<span style="color:#000000; font-size:12px; line-height:16px;">are over price in purchase</span><br>
<span id="overqty" style="color:#FF6B00; font-size:12px; line-height:16px;"></span>
<span style="color:#FF6B00; font-size:12px; line-height:16px;">materials</span>
<span style="color:#000000; font-size:12px; line-height:16px;">are over qty in purchase</span>
<!-- <span style="color:#000000; font-size:12px; line-height:16px;">Materials row is highlighted in</span>
<span style="color:#FF6B00; font-size:12px; line-height:16px;">orange</span> -->
</div>
<?php //} ?>
<!-- <div id="container-cari" style="top:-40px;width:475px;left:600%;text-align:left;padding:5px;background-color:#FFFFFF;">
<p style="text-decoration:none;color:#000000;font-weight:700;font-size:14px;line-height:18px;">
Unit of PO
</p>
<input type="hidden" name="unit1" id="unit1" value="1">
<a href="javascript:void(0);" onclick="Search2();" id="search2" 
style="padding:8px;border-radius:5px;border:1px solid #D6D6D6;background-color:#359DD9;text-decoration:none;color:#ffffff;font-size:14px;line-height:18px;">
Original
</a>
<?php //if($unit2<>""){ ?>
  &nbsp;
<input type="hidden" name="unit2" id="unit2" value="1">
<a href="javascript:void(0);" onclick="Search3();" id="search3" 
style="padding:8px;border-radius:5px;border:1px solid #D6D6D6;background-color:#ffffff;text-decoration:none;color:#000000;font-size:14px;line-height:18px;">
<?php // echo $unit2; ?> 
</a>
</div> -->
<?php //} ?>
</div>
</div>
<?php if($_GET['e']==1){ ?>
<div id="tabel1" style="top:460px;" onmouseout="editrowa();">
<?php } else { ?>
  <div id="tabel1" style="top:460px;">
<?php } ?>
<?php if ($dt3['tdelsts'] > 0) { ?>
<div id="delsts" style="<?php echo $styledel; ?>"><?php echo $dt3['tdelsts']; ?>&nbsp;item remove from PO&nbsp;&nbsp;
<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #359DD9;cursor: pointer;" onclick="actdelsts();">Remove all</span>
</div>
<?php } ?>
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_detpo.php?po=<?php echo $po; ?>" idField="rkbpk" toolbar="#tb" striped="true"
pagination="false" singleSelected="true" rownumbers="false" collapsible="true" method="post"
data-options="
    rowStyler:function(index,row){
      if (row.delsts>0){
        return 'color:#EF3B42;background-color:#ffffff;';
        } else {
        if(row.cek==1){
        if(row.cek2==1){
        return 'color:#000000;background-color:#FFCCCB;';
        } else {
        return 'color:#000000;background-color:#FFE4B5;';
        }
        } else if(row.cek2==1){
        return 'color:#000000;background-color:#FFCCCB;';
        } else {
        return 'color:#000000;background-color:#ffffff;';  
        }
      }
    },remoteSort:false,multiSort:true">
<thead>
<tr>
<!-- <th field="trpocons1" width="50">tot</th>
<th field="trtotal1" width="50">totp</th> -->
<th field="no" width="35" sortable="false" formatter="formatku2">No</th>
<th field="rev" width="85" sortable="false">Subject</th>
<th field="ordno" width="90" sortable="true">Order no</th>
<!--<th field="spec" width="150" sortable="true" editor="text">Specification</th>-->
<th sortable="true" data-options="field:'item',width:170,
editor:{type:'textbox',options:{multiline:true,height:100}}">Item</th>
<th sortable="true" data-options="field:'spec',width:170,
editor:{type:'textbox',options:{multiline:true,height:100}}">Specification</th>
<?php if($tspec==2){ ?>
<?php if($hspec1<>""){ ?><th field="spec1" width="80" sortable="true"><?php echo $hspec1; ?></th>
<?php } if($hspec2<>""){ ?><th field="spec2" width="80" sortable="true"><?php echo $hspec2; ?></th>
<?php } if($hspec3<>""){ ?><th field="spec3" width="80" sortable="true"><?php echo $hspec3; ?></th>
<?php } if($hspec4<>""){ ?><th field="spec4" width="80" sortable="true"><?php echo $hspec4; ?></th>
<?php } if($hspec5<>""){ ?><th field="spec5" width="80" sortable="true"><?php echo $hspec5; ?></th>
<?php } if($hspec6<>""){ ?><th field="spec6" width="80" sortable="true"><?php echo $hspec6; ?></th>
<?php } if($hspec7<>""){ ?><th field="spec7" width="80" sortable="true"><?php echo $hspec7; ?></th>
<?php } if($hspec8<>""){ ?><th field="spec8" width="80" sortable="true"><?php echo $hspec8; ?></th>
<?php }
} ?>
<th field="colname" width="90" sortable="true" editor="text">Color</th>
<th field="colcode" width="90" sortable="true" editor="text">Col code</th>
<th field="sizegar" width="90" sortable="true" editor="text">Size</th>
<th data-options="field:'unit',width:84,
editor:{type:'combobox',options:{valueField:'unita',textField:'unita',limitToList: true, reversed: true,
url:'view/get_data.php?dt=piunit'}}">Units</th>
<th field="rpocons" width="90" sortable="true">RKB Qty</th>
<th field="rqrs" width="90" sortable="true">RKB PPS</th>
<th field="rprice" width="90" sortable="true">RKB price</th>
<th field="rtotal" width="90" sortable="true">RKB Total</th>
<th field="pocons" width="90" sortable="true" editor="text">PO qty</th>
<th field="qrs" width="90" sortable="true" editor="text">PO PPS</th>
<th field="price" width="90" sortable="true" editor="text">PO price</th>
<th field="total" width="90" sortable="true">PI Total</th>
<!--<th field="piqty" width="90" sortable="true">PI qty</th>
<th data-options="field:'piunit'">Units</th>
<th field="piprice2" width="90" sortable="true">PI price</th>
<th field="total2" width="95" sortable="true">PI Total</th>-->
<!--<th field="prodes" width="125" sortable="true">Product Description</th>-->
</tr>
</thead>
</table>
<br>

<div id="dialog-form" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:true,modal:true,closable:false"
style="width:425px;height:325px;padding:5px 5px;display:none;top:35px;border-radius:8px;">
<form id="form" method="post" enctype="multipart/form-data">
<input type="hidden" name="popk" id="popk" value="<?php echo $po; ?>" size="8">
<!-- <div class="modal-dialog" style="height:300px;"> -->
<div class="modal-content">
<!-- Modal Header -->
<div class="modal-header">
<div class="modal-title">Upload File PI Form<br>
PO <?php echo $dt2['pono']; ?>
</div>
</div>
<!-- Modal body -->
<div class="border-modal">
<div style="padding:5px;">
<input name="uploadfile" id="uploadfile" class="easyui-filebox" style="width:100%;" data-options="
buttonText:'Upload file',
buttonAlign:'left',
label:'',
labelPosition: '',
labelWidth:'',
required:'true',
validType:''">
</div>
<!--<div align="center" style="padding:10px;">
<img src="css/images/xls.png" style="width:18px; height:18px;">
<input name="filenm" style="border:none;" readonly>
</div>-->
<div align="center" style="padding:10px;"><?php echo $dt2['piform']; ?></div>
</div>
<div class="font-excel-template" style="width: auto;">
<span style="color:red; font-style: italic;">PI file name cannot contain the (#) symbol</span>
</div>
<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
<a style="text-decoration:none; left: 129px; top: 250px;" href="javascript:void(0)" class="button-cancel" onclick="cancel();">Cancel</a>
<a style="text-decoration:none; left: 206px; top: 250px;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>
<!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
</div>
</form>
<!-- </div> -->
</div>

<div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:true,modal:true,closable:false"
style="width:425px;height:200px;padding:5px 5px;display:none;top:35px;border-radius:8px;">
<form id="formb" method="post" enctype="multipart/form-data">
<input type="hidden" name="popk" id="popk" value="<?php echo $po; ?>" size="8">
<!-- <div class="modal-dialog" style="height:175px;"> -->
<div class="modal-content">
<!-- Modal Header -->
<div class="modal-header">
<div class="modal-title">
Print PO <?php echo $dt2['pono']; ?> <br>
</div>
</div>
<!-- Modal body -->
<div style="padding:5px; margin-top:60px; margin-left:25px;">
<span id="cek1"><input type="radio" name="cek" id="cek" value="1" checked>Sum Color</span>
<span id="cek2"><input type="radio" name="cek" id="cek" value="2">Sum Color & Size</span>
</div>
<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
<a style="text-decoration:none; left: 129px; top: 100px;" href="javascript:void(0)" class="button-cancel" onclick="cancel();">Cancel</a>
<a style="text-decoration:none; width:100px; left: 206px; top: 100px;" href="javascript:void(0)" class="button-submit" onclick="printpo();">Print</a>
<!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
</div>
</form>
<!-- </div> -->
</div>

<div id="dialog-adduom" class="easyui-dialog sticky" closed="true" data-options="border:false,title:false,border:false,closable:true,resizable:false,modal:true"
     style="width:352px; height:400px; padding:5px 5px; display:none; top:25px; border-radius: 5px;border-radius:8px;">

    <div style="margin-right:1px;cursor:pointer;" onclick="jQuery('#dialog-adduom').dialog('close');
            $('#form1').form('reset');" data-dismiss="modal" aria-label="Close">
        <img src="css/images/X.png" style="width:15px;height:15px; margin-left: 95%; margin-top: 2%;">
    </div>  

    <form id="formAddUnit" method="post">
        <input type="hidden" name="popk" id="popk" value="<?php echo $po; ?>">
        <!--<input type="text" name="coba" id="coba" value="dozen">-->
        <div class="modal-content">

            <div style="text-align:left; margin-left:24px; font-style: normal;font-weight: 700;font-size: 18px;">
                Choose an alternate unit
            </div>
            <br>
            <div style="margin-left:24px;">
                RKB Unit :  <b><?php echo $unit1 ?></b>
            </div>
            <br>
            <div style="margin-left:24px;">
                Alternate Unit :  
                <br>
                <select id="satuan" name="unit2" onchange="toggleDivs();
                        updateButtonPosition();">
                    <option  value="Pieces">Pieces</option>
                    <option  value="Dozen">Dozen</option>
                    <option  value="Gross">Gross</option>
                    <option  value="Box">Box (Packaging)</option>
                    <option  value="Yards">Yards</option>
                    <option value="Meters">Meters</option>
                    <option value="Centimeters">Centimeters</option>
                    <option value="Kg">Kg</option>
                    <option value="Lbs">Lbs</option>
                </select>
            </div>

            <div id="dozenDiv" class="unit-div" style="margin-left:24px; margin-top: 3px;">
                <p style="color: #00000061;">1 Dozen = 12 pieces</p>
            </div>
            <br>

            <div id="boxDiv" class="unit-div" style="margin-left:24px;">
                How many <?php echo $unit ?> are there per box?  
                <input type="number" name="perpcs" value="" placeholder="Number of <?php echo $unit ?>..." required style="border:1px solid black; border-radius: 8px; width: 142px; height: 34px;"> /Box
            </div>
            <br>


            <div id="yardDiv" class="unit-div" style="margin-left:24px;">
                Fabric's cuttable width?  
                <br>
                <input type="number" name="yardwidth" value="" placeholder="Number of <?php echo $unit ?>..." required style="border:1px solid black; border-radius: 8px; width: 142px; height: 34px;">

                <br>
                <br>

                Fabric's weight?
                <br>
                <input type="number" name="yardlength" value="" placeholder="Number of <?php echo $unit ?>..." required style="border:1px solid black; border-radius: 8px; width: 142px; height: 34px;">
            </div>

            <div id="kgDiv" class="unit-div" style="margin-left:24px;">
                Fabric's cuttable width?  
                <br>
                <input type="number" name="kgwidth" value="" placeholder="Number of <?php echo $unit ?>..." required style="border:1px solid black; border-radius: 8px; width: 142px; height: 34px;">

                <br>
                <br>

                Fabric's weight?
                <br>
                <input type="number" name="kglength" value="" placeholder="Number of <?php echo $unit ?>..." required style="border:1px solid black; border-radius: 8px; width: 142px; height: 34px;">
            </div>



            <a id="buttonAddUnit" style="text-decoration:none; width:100px; left: 206px; top: 110px;" href="javascript:void(0)" class="button-submit" onclick="AddUnit();">Add unit</a>
        </div>
    </form>
</div>

<script>

    function toggleDivs() {

        var selectedValue = document.getElementById('satuan').value;

        var divsToHide = document.querySelectorAll('.unit-div');
        divsToHide.forEach(function (div) {
            div.style.display = 'none';
        });

        if (selectedValue === 'Dozen') {
            document.getElementById('dozenDiv').style.display = 'block';
        } else if (selectedValue === 'Box') {
            document.getElementById('boxDiv').style.display = 'block';

        } else if (selectedValue === 'Yards') {
            document.getElementById('yardDiv').style.display = 'block';
        } else if (selectedValue === 'Kg') {
            document.getElementById('kgDiv').style.display = 'block';
        }
    }

    function updateButtonPosition() {
        var selectedValue = document.getElementById('satuan').value;
        var button = document.getElementById('buttonAddUnit');

        if (selectedValue === 'Dozen') {
            button.style.left = '206px';
            button.style.top = '110px'; // Ganti nilai margin-top sesuai yang diinginkan
        } else if (selectedValue === 'Kg') {
            button.style.left = '206px';
            button.style.top = '320px'; // Ganti nilai margin-top sesuai yang diinginkan
        } else if (selectedValue === 'Yards') {
            button.style.left = '206px';
            button.style.top = '320px'; // Ganti nilai margin-top sesuai yang diinginkan
        } else if (selectedValue === 'Box') {
            button.style.left = '206px';
            button.style.top = '240px'; // Ganti nilai margin-top sesuai yang diinginkan
        } else {
            button.style.left = '206px';
            button.style.top = '110px';
        }
    }
</script>