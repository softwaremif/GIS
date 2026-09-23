<?php
session_start();
/*include "email/pay.php";*/
//include "action/sinkron4b.php";
$x = $_GET['x'];
$po = $_GET['po'];
$cari2 = mysqli_query($koneksi, "SELECT po.surcharge, po.surcharge2, po.note, po.piamount, po.piform, po.pono, sup.supnm,
poli.polinm,poli.polipk,cur.curid, cur.cursign, pourg.pourgnm, pourg.pourgpk, po.piform, po.ket, po.etd, po.brg, po.potop, po.tgldel, po.eihl,
po.postatpk,po.tglpo,po.pidate,podt.hspec1,podt.hspec2,podt.hspec3,podt.hspec4,podt.hspec5,podt.hspec6,podt.hspec7,
podt.hspec8,podt.spec1,podt.spec2,podt.spec3,podt.spec4,podt.spec5,podt.spec6,podt.spec7,podt.spec8,podt.tspec, podt.unit2,
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
$dt2 = mysqli_fetch_array($cari2);

// $cari2b=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' group by popk");
// $dt2b=mysqli_fetch_array($cari2b);

$sqlk=mysqli_query($koneksi,"select * from kurs order by kurspk desc limit 1");
$dtk=mysqli_fetch_array($sqlk);

/*totrkb*/
$crr=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='1' and popk>'0' group by popk");
$dtr=mysqli_fetch_array($crr);
// $totrp=$dtr['totrkb']/$dtk['rupiah'];
$totrp=$dtr['totrkb'];

// $cre=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='3' and popk>'0' group by popk");
// $dte=mysqli_fetch_array($cre);
// $toteu=$dte['totrkb']/$dtk['euro'];

// $crp=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='6' and popk>'0' group by popk");
// $dtp=mysqli_fetch_array($crp);
// $totp=$dtp['totrkb']/$dtk['pounds'];

$crd=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where popk='$po' and curpk='2' and popk>'0' group by popk");
$dtd=mysqli_fetch_array($crd);
$totd=$dtd['totrkb']*$dtk['rupiah'];

// $totrkb1=$totrp+$toteu+$totp+$totd;
$totrkb3=$totrp+$totd;
// $totrkb=$dtcur['cursign'].number_format($totrkb1,0,".",",");
// if($totqty>0){
// $perrkb1=$totrkb1/$totqty;
// $perrkb=$dtcur['cursign'].number_format($perrkb1,2,".",",");
// } else {
// $perrkb="N/A";	
// }

$tglpo = $dt2['tglpo'];
$pono = $dt2['pono'];
$postatpk = $dt2['postatpk'];
$pourgnm = $dt2['pourgnm'];
$ket = $dt2['ket'];
$etd = $dt2['etd'];
$deldt = $dt2['tgldel'];
$pourgpk = $dt2['pourgpk'];
$tspec = $dt2['tspec'];
$hspec1 = TRIM($dt2['hspec1']);
$hspec2 = TRIM($dt2['hspec2']);
$hspec3 = TRIM($dt2['hspec3']);
$hspec4 = TRIM($dt2['hspec4']);
$hspec5 = TRIM($dt2['hspec5']);
$hspec6 = TRIM($dt2['hspec6']);
$hspec7 = TRIM($dt2['hspec7']);
$hspec8 = TRIM($dt2['hspec8']);
$pidate = $dt2['pidate'];
$piform = $dt2['piform'];
$suppk = $dt2['suppk'];
if ($suppk == "1949") {
  $supnm = "Unassigned";
} else {
  $supnm = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰"]/', ' ', $dt2['supnm']);
}
$supnm2 = substr(TRIM($dt2['supnm']), 0, 5);
$polipk=$dt2['polipk'];
$polinm = $dt2['polinm'];
$potop = $dt2['potop'];
$curid = $dt2['curid'];
$curpk = $dt2['curpk'];
//$cursign=$dt2['cursign'];
$brg = $dt2['brg'];
$surcharge1 = $dt2['surcharge'];
$surcharge2 = $dt2['surcharge2'];
$note = $dt2['note'];
$season = $dt2['season'];
$stage = $dt2['stage'];
$buyer = $dt2['byrnm'];
$paydate = $dt2['paydate'];
$invoiceno = $dt2['invoiceno'];
$freightterm = $dt2['freightterm'];
$eihl=$dt2['eihl'];
$etdvl=$dt2['etdvl'];
$etal=$dt2['etdal'];
$unit2=$dt2['unit2'];

$updt2 = mysqli_query($koneksi, "update po set buy='$season' where popk='$po'");
$buy = $dt2['buy'];

$update4 = mysqli_query($koneksi, "update po set ck='1' where ck='0' and popk='$po'");

$updt = mysqli_query($koneksi, "update po set piamount='$dt2[amount]' where popk='$po'");
// if ($dt2['piamount'] > 0) {
//   $piamount = $dt2['piamount'];
// } else {
  $piamount = $dt2['amount'];
// }

if($curpk==3){ $cursign="&#8364;"; }
else { $cursign=$dt2['cursign']; }

$totpii=$piamount+$surcharge1+$surcharge2;

if($piamount=="0.00000"){ $pi="---"; $totrkb="---"; }
else {
  if($curid=="IDR"){
  $pi=$cursign."".number_format($piamount,0,".",",");
  $totpii=$cursign."".number_format($totpii,0,".",",");
  // $totrkb=$cursign."".number_format($dt2b['totrkb'],0,".",",");
  $totrkb=$cursign."".number_format($totrkb3,0,".",",");
  $totpi2=number_format($piamount,0,".",",");
  // $totrkb2=number_format($dt2b['totrkb'],0,".",",");
  $totrkb2=number_format($totrkb3,0,".",",");
  } else {
  $pi=$cursign."".number_format($piamount,2,".",","); 
  $totpii=$cursign."".number_format($totpii,2,".",",");    
  // $totrkb=$cursign."".number_format($dt2b['totrkb'],2,".",","); 
  $totrkb=$cursign."".number_format($totrkb3,2,".",","); 
  $totpi2=number_format($piamount,2,".",",");
  // $totrkb2=number_format($dt2b['totrkb'],2,".",",");
  $totrkb2=number_format($totrkb3,2,".",",");
  }
  $totpi1=$piamount;
  // $totrkb1=$dt2b['totrkb'];
  }

if ($surcharge1 == "0.00") {
  $surcharge1 = "---";
} else {
  if ($curid == "IDR") {
    $surcharge1 = $cursign."".number_format($surcharge1, 0, ".", ",");
  } else {
    $surcharge1 = $cursign."".number_format($surcharge1, 2, ".", ",");
  }
}

if ($surcharge2 == "0.00") {
  $surcharge2 = "---";
} else {
  if ($curid == "IDR") {
    $surcharge2 = $cursign."".number_format($surcharge2, 0, ".", ",");
  } else {
    $surcharge2 = $cursign."".number_format($surcharge2, 2, ".", ",");
  }
}

$cari3 = mysqli_query($koneksi, "SELECT count(*) as tdelsts FROM podt WHERE popk='$po' and delsts='1'");
$dt3 = mysqli_fetch_array($cari3);
if ($dt3['tdelsts'] > 0) {
  $styledel = "margin-bottom:5px;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #EF3B42;margin-left:0px;margin-top:0px;";
} else {
  $styledel = "display:none;";
}

$crimm = mysqli_query($koneksi, "select * from importdt
left outer join import on import.importpk=importdt.importpk
where importdt.popk='$po' and import.arrivalpk>0
group by import.importpk");
$tott = mysqli_num_rows($crimm);

$crim = mysqli_query($koneksi, "select * from importdt
left outer join import on import.importpk=importdt.importpk
left outer join vassal on vassal.vassalpk=import.vassalpk
left outer join arrival on arrival.arrivalpk=import.arrivalpk
left outer join port on port.portpk=import.portpk
where importdt.popk='$po' and import.arrivalpk>0 order by import.EIH desc limit 1");
$dtim = mysqli_fetch_array($crim);
$tot = mysqli_num_rows($crim);
// $importpk = $dtim['importpk'];
// $stsimpk = $dtim['stsimpk'];
// $vassaltype = $dtim['typenm'];
// $vassalname = $dtim['vassalnm'];
// $airwaybill = $dtim['AWB'];
// $arrival = $dtim['city'];
// $port_name = $dtim['portnm'];
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
$perrkb1=$totrkb3/$bqty;
$perpi1=$totpi1/$bqty;

if($piamount=="0.00000"){ $perpi="---"; $perrkb="---"; 
} else {
if ($curid == "IDR") {
$perrkb = $cursign."".number_format($perrkb1, 0, ".", ",");
$perpi = $cursign."".number_format($perpi1, 0, ".", ",");
} else {
$perrkb = $cursign."".number_format($perrkb1, 2, ".", ",");
$perpi = $cursign."".number_format($perpi1, 2, ".", ",");
}
}

$tpo=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM importdt WHERE popk='$po' GROUP BY importpk"));
?>
<!--<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/gray/easyui2.css">
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.edatagrid.js"></script>
<script type="text/javascript" src="media/jquery-easyui-1.9.15/datagrid-cellediting.js"></script>-->
<script type="text/javascript">
  var url;

  //simpan datebox
  $(function() {
    $('#etd').datebox({
      onSelect: function(date) {
        //var e = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
        var e = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
        $('#etda').textbox('setValue', e);
        $('#etda').textbox('textbox').focus();
      }
    });
  });

  function updt2() {
    var string = $("#formc").serialize();
    $('#formc').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1b",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt2p() {
    var string = $("#formp").serialize();
    $('#formp').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1p",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt2iv() {
    var string = $("#formiv").serialize();
    $('#formiv').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1iv",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  /*updtpo*/
  function updt() {
    var ket = $('#rmk').val();
    var string = $("#formb").serialize();
    $('#formb').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
        $.messager.show({
          title: '',
          msg: data,
          timeout: 3000,
          showType: 'slide',
          icon: 'info',
          width: 252,
          height: 55,
          style: {
            left: 0,
            right: '',
            top: '',
            bottom: -document.body.scrollTop - document.documentElement.scrollTop
          }
        });
        /*$('#dialog-formb').dialog('close');
        $('#dialog-progress').dialog('open').dialog('setTitle','');*/
        //$('#dg').datagrid('reload');
        $('#dg').edatagrid('addRow2');
        editrowa();
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt3() {
    var string = $("#formf").serialize();
    $('#formf').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1f&po=<?php echo $po; ?>",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt4() {
    var cc = $('#suppe').combobox('getText');
    var string = $("#forme").serialize();
    $('#forme').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1e&po=<?php echo $po; ?>&sup=" + cc,
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt5() {
    var string = $("#formg").serialize();
    $('#formg').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1g",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt5b() {
    var string = $("#formg2").serialize();
    $('#formg2').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpog2",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt5c() {
    var string = $("#formg2b").serialize();
    $('#formg2b').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpog2b",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt5d() {
    var string = $("#formg2c").serialize();
    $('#formg2c').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpog2c",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt6() {
    var string = $("#formh").serialize();
    $('#formh').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1h",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt7() {
    var string = $("#formi").serialize();
    $('#formi').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1i",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt7b() {
    var string = $("#formi2").serialize();
    $('#formi2').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpoi2",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt8() {
    var string = $("#formj").serialize();
    $('#formj').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1j",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updt9() {
    var string = $("#formk").serialize();
    $('#formk').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=updtpo1k",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
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
        //window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
      }
    });
  }

  function updtpi() {
    var row2 = $('#dg').datagrid('getSelected');
    var piqty2 = $('#piqty2').val();
    var piprice2 = $('#piprice2').val();
    if (row2) {
      /* window.location.href="admin.php?x=updatepi&piqty="+piqty2+"&piprice="+piprice2;
      alert(piqty2);*/
      $.ajax({
        type: "POST",
        url: "action/simpan.php?x=updatepi&piqty=" + piqty2 + "&piprice=" + piprice2,
        data: 'rkbpk2=' + row2.rkbpk,
        success: function(data) {
          $.messager.show({
            title: '',
            msg: data,
            timeout: 3000,
            showType: 'slide',
            icon: 'info',
            width: 252,
            height: 55,
            style: {
              left: 0,
              right: '',
              top: '',
              bottom: -document.body.scrollTop - document.documentElement.scrollTop
            }
          });
          $('#dg').datagrid('clearSelections');
          $('#dg').datagrid('reload');
        }
      });
    } else {
      $.messager.alert('Warning', 'No material  data selected', 'warning');
    }
  }

  function piform() {
    var row = $('#dg').datagrid('getSelected');
    $('#dialog-form').dialog('open').dialog('setTitle', '');
    $('#form').form('load', row);
    //$('#form').form('clear');
  }

  function save() {
    var string = $("#form").serialize();
    $('#form').form('submit', {
      type: "POST",
      url: "action/simpan.php?x=piform",
      data: string,
      onSubmit: function() {
        return $(this).form('validate');
      },
      success: function(data) {
        $.messager.show({
          title: '',
          msg: data,
          timeout: 3000,
          showType: 'slide',
          icon: 'info',
          width: 300,
          height: 55,
          style: {
            left: 0,
            right: '',
            top: '',
            bottom: -document.body.scrollTop - document.documentElement.scrollTop
          }
        });
        /*$('#form').form('clear');*/
        $('#dialog-form').dialog('close');
        /*$('#dialog-progress').dialog('open').dialog('setTitle','');
        $('#dg2').datagrid('reload');*/
        //window.location.href="?hal=detpo&po=<?php echo $po; ?>";
      }
    });
  }

  function Search() {
    $('#dg').datagrid('load', {
      caria: $('#caria').val()
    });
    $('#close').show();
    $('#close').css('margin-top', '7px');
    $('#reload').css('margin-top', '-20px');
  }

  function tutup() {
    document.getElementById('caria').value = "";
    Search();
    $('#close').hide();
    $('#reload').css('margin-top', '5px');
  }

  function cancel() {
    $('#dialog-form').dialog('close');
    $('#form').form('reset');

    $('#dialog-formb').dialog('close');
    $('#formb').form('reset');
  }

  var myCheckEditor = {
    type: 'checkbox',
    options: {
      on: 1,
      off: 0
    },
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

  function myformatter(date) {
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

  function myparser(s) {
    if (!s) return new Date();
    //var ss = (s.split('-'));
    var ss = (s.split('/'));
    var y = parseInt(ss[0], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[2], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
      //return new Date(y,m-1,d);
      return new Date(d, m - 1, y);
    } else {
      return new Date();
      //return new Date(date).format("dd/mm/yy");
    }
  }

  function selectrow() {
    var rows = $('#dg').datagrid('getRows');
    if (rows) {
      $('#dg').datagrid('selectRow', 0);
    }
  }

  function changePosition() {
    $('#etdtol').tooltip({
      position: right
    });
  }

  //$(function(){
  // $('#dg').datagrid('getPanel').css('height','auto');
  //});

  function editrowa() {
    var dg = $('#dg');
    $('#container-cari').css('margin-top', '60px');
    $('#tabel1').css('margin-top', '60px');
    $('#tabel').css('margin-top', '10px');
    $('#tab2').css('width', '80%');
    $('#tab2').css('margin-top', '-10px');
    $('#tab3').css('margin-top', '-20px');
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
    td4.css('border-right', '1px solid #b2b2b2');
    td4.css('border-top', '1px solid #b2b2b2');
    td4.css('border-left', '1px solid #b2b2b2');
    td4.css('border-bottom', '1px solid #b2b2b2');
    td4.css('border-radius', '5px');
    td4.css('background-color', '#ffffff');
    td5.css('border-right', '1px solid #b2b2b2');
    td5.css('border-top', '1px solid #b2b2b2');
    td5.css('border-left', '1px solid #b2b2b2');
    td5.css('border-bottom', '1px solid #b2b2b2');
    td5.css('border-radius', '5px');
    td5.css('background-color', '#ffffff');
    td5b.css('border-right', '1px solid #b2b2b2');
    td5b.css('border-top', '1px solid #b2b2b2');
    td5b.css('border-left', '1px solid #b2b2b2');
    td5b.css('border-bottom', '1px solid #b2b2b2');
    td5b.css('border-radius', '5px');
    td5b.css('background-color', '#ffffff');
    td6.css('border-right', '1px solid #b2b2b2');
    td6.css('border-top', '1px solid #b2b2b2');
    td6.css('border-left', '1px solid #b2b2b2');
    td6.css('border-bottom', '1px solid #b2b2b2');
    td6.css('border-radius', '5px');
    td6.css('background-color', '#ffffff');
    td7.css('border-right', '1px solid #b2b2b2');
    td7.css('border-top', '1px solid #b2b2b2');
    td7.css('border-left', '1px solid #b2b2b2');
    td7.css('border-bottom', '1px solid #b2b2b2');
    td7.css('border-radius', '5px');
    td7.css('background-color', '#ffffff');
    td8.css('border-right', '1px solid #b2b2b2');
    td8.css('border-top', '1px solid #b2b2b2');
    td8.css('border-left', '1px solid #b2b2b2');
    td8.css('border-bottom', '1px solid #b2b2b2');
    td8.css('border-radius', '5px');
    td8.css('background-color', '#ffffff');
    td9.css('border-right', '1px solid #b2b2b2');
    td9.css('border-top', '1px solid #b2b2b2');
    td9.css('border-left', '1px solid #b2b2b2');
    td9.css('border-bottom', '1px solid #b2b2b2');
    td9.css('border-radius', '5px');
    td9.css('background-color', '#ffffff');
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
    $('#ccbi').show();
    $('#ccbj').show();
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
    $('#ccb2j').hide();
    $('#ccbgp').show();
    $('#ccbgp2').hide();
    $('#ccbiv').show();
    $('#ccbiv2').hide();
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
    selectrow();
    changePosition();
    //$('#etd').datebox('textbox').mask('9999-99-99',{placeholder:'yyyy-mm-dd'});
  }

  function editrowb() {
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

  function print() {
    $('#dialog-formb').dialog('open').dialog('setTitle', '');
  }

  function printpo() {
    var cek = $('input:checked').attr("value");
    if (cek == 1) {
      url = "pdf/pdf_po?po=<?php echo $pono; ?>&cek=" + cek;
      window.open(url);
    } else {
      url = "pdf/pdf_po2?po=<?php echo $pono; ?>&cek=" + cek;
      window.open(url);
    }
  }

  function back() {
    window.location.href = "?hal=proses&x=1";
  }

  function backm() {
    window.location.href = "?hal=mat&ord=<?php echo $_GET['ord']; ?>";
  }

  function backp() {
    window.location.href = "?hal=pur&ord=<?php echo $_GET['ord']; ?>";
  }

  function backdm() {
    window.location.href = "?hal=dfmat&ord=<?php echo $_GET['ord']; ?>";
  }

  function formatku2(val, row) {
    //if (row.tpodt>0) {
    //return '<div style="margin-left:-10px;"><img src="css/images/notif2.png" width="3px" height="30px">'+
    //        '<div style="margin-top:-25px;margin-left:5px;"><center>'+val+'</center></div>';
    //} else {
    //  return val;
    //}
    if (row.tpodtb > 0) {
      return '<div style="margin-left:-10px;"><img src="css/images/notif2.png" width="3px" height="30px">' +
        '<div style="margin-top:-25px;margin-left:5px;"><center>' + val + '</center></div>';
    } else {
      return val;
    }
  }

  $(function() {
    $('#dg').datagrid({
      rowStyler: function(index, row) {
        if (row.delsts > 0) {
          return 'color:#EF3B42';
        }
      }
    });
  });

  function tpodtb() {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
      if (row.tpodtb == 1) {
        $.ajax({
          type: "POST",
          url: "action/simpan.php?x=tpodtb&podtpk=" + row.podtpk,
          success: function() {
            $('#dg').datagrid('reload');
          }
        });
      }
    }
  }

  $(function() {
    var tdelsts = $('#tdelsts').val();
    if (tdelsts > 0) {
      $('#container-cari').css('margin-top', '20px');
      $('#tabel1').css('margin-top', '20px');
    } else {
      $('#container-cari').css('margin-top', '20px');
      $('#tabel1').css('margin-top', '20px');
    }
  });

function formLog_detpomd(id){
$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=vtype&id="+id,
success: function(data) {
document.getElementById('vtype3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=vname&id="+id,
success: function(data) {
document.getElementById('vname3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=awb&id="+id,
success: function(data) {
document.getElementById('awb3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=arrival&id="+id,
success: function(data) {
document.getElementById('arrival3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=port&id="+id,
success: function(data) {
document.getElementById('port3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=etdv&id="+id,
success: function(data) {
document.getElementById('etdv3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=etdv&id="+id,
success: function(data) {
document.getElementById('etdv3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=eta&id="+id,
success: function(data) {
document.getElementById('eta3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=eih&id="+id,
success: function(data) {
document.getElementById('eih3b').innerHTML = data;
},
});

$.ajax({
type: "POST",
url: "view/get_shipdet.php?x=totpo&id="+id,
success: function(data) {
document.getElementById('totpo').innerHTML = data;
},
});
// alert(id);
// var eih3 = $('#eih3').val();
// alert(eih3);
document.getElementById('importpkb').value = id;
// document.getElementById('eih3b').innerHTML = eih3;
$('#dialog-form-log').dialog('open').dialog('setTitle', '');
$('#dg2c').datagrid('load', {
    // importpkb: $('#importpkb').val()
    importpkb: id
});

var dg = $('#dg2c');
dg.datagrid();
dg.datagrid('getPanel').addClass('lines-no2');
dg.datagrid('getPanel').addClass('col');
$('#dg2c').datagrid('getPanel').addClass('lines-no3');
$('#dg2c').datagrid('getPanel').css('border', 'none');
}

function formatku2b(val, row) {
return val;
}

function viewdtl() {
var a = document.getElementById('dtb').value;
//  alert(a);
if (a == 0) {
    $('#cancel1').show();
    $('#edit1').show();
    $('#cancela').hide();
    $('#savea').hide();
    $('#tabel2b').hide();
    $('#tabel2c').show();
    document.getElementById('dtb').value = 1;
    $('#shw').show();
    $('#hdn').hide();
    $('#shipdetail').show();
    $('#shipdetail').css('margin-top', '15px');
    $('#shipdetail2').hide();
    $('#dg2b').datagrid('load', {
        importpkb: $('#importpkb').val()
    });
    $('#dg2c').datagrid('load', {
        importpkb: $('#importpkb').val()
    });
} else {
    $('#tabel2b').show();
    document.getElementById('dtb').value = 0;
    $('#shw').hide();
    $('#hdn').show();
    $('#shipdetail').css('margin-top', '300px');
    $('#dg2b').datagrid('load', {
        importpkb: $('#importpkb').val()
    });
}
}
</script>
<input type="hidden" id="x" name="x" value="<?php echo $_GET['x']; ?>">
<input type="hidden" id="tdelsts" name="tdelsts" value="<?php echo $dt3['tdelsts']; ?>">
<div id="frame-utama-judul">
  <div class="frame-arrow">
  <?php if($_GET['mat']=="1"){ ?>
    <a href="javascript:void(0);" onclick="backm();"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
    <?php } else if($_GET['dfmat']=="1"){ ?>
    <a href="javascript:void(0);" onclick="backdm();"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
    <?php } else if($_GET['pur']=="1"){ ?>
    <a href="javascript:void(0);" onclick="backp();"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
    <?php } else { ?>
    <a href="javascript:void(0);" onclick="back();"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
    <?php } 
    ?>
  </div>
  <div class="frame-judul">
    <div class="font-judul-atas" style="width:120%;">
      PO <?php echo $pono; ?>
      <?php
      if($tpo>0){
        echo '&nbsp;<input type="text" name="on" id="on" value="'.$tpo.' Shipments" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#0B89D2;" readonly>';
      }else{
      if($postatpk==1){ $sts="Awaiting PI"; }
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
        }
        } ?>
      &nbsp; <input type="text" name="pourg" id="pourg" value="<?php echo $pourgnm; ?>" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>
      <!--<div id="ccb" style="margin-left:5px; margin-top:20px;">
<form id="formb" method="post">
<input type="hidden" name="popk1" id="popk1" value="<?php //echo $po; 
                                                    ?>" size="8">
<input style="width:120px; height:28px;" id="pourg" name="pourg" class="easyui-combobox"
data-options="valueField:'pourgpk',textField:'pourgnm',url:'view/get_data.php?dt=pourg',prompt:'<?php //echo $pourgnm; 
                                                                                                ?>',panelHeight:'auto',limitToList:'true'">
</form>
</div>!-->
    </div>
    <span style="font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
    <?php //echo $polinm; ?>
    Buyer: <?php echo $buyer; ?>, <?php echo $season; ?>
  </span>
    <div id="ccbj" style="display:none;font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
      <form id="formj" method="post">
        <?php
        //if($postatpk<4){
        ?>
        <input style="width:140px; height:28px;" id="sts" name="sts" class="easyui-combobox" data-options="prompt:'<?php echo $sts; ?>',limitToList:'true',panelHeight:'auto',
data: [
{value:'1',text:'Awaiting PI'},
{value:'2',text:'In Revision'},
{value:'3',text:'Cancel PO'}
]">
        <?php //} else {
        //echo $sts." - ";  
        //} 
        ?>
        <input type="hidden" name="popk1j" id="popk1j" value="<?php echo $po; ?>" size="8">
        <input name="tglpo" id="tglpo" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser" value="<?php if ($tglpo == '' || $tglpo == '0000-00-00') {
                                                                                                                                                } else {
                                                                                                                                                  echo tgl2($tglpo);
                                                                                                                                                } ?>">
      </form>
    </div>
    <div id="ccb2j" style="font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
      <?php
      //if($postatpk==4){
      ?>
      <!--<input type="text" name="postat" id="postat" value="PI received" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:700;font-size:14px;color:#FFFFFF;background-color:#19B715;" readonly>-->
      <?php //} else { 
      ?>
      <!--<input type="text" name="postat" id="postat" value="Awaiting PI" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:700;font-size:14px;color:#FFFFFF;background-color:#0B89D2;" readonly>-->
      <?php //} 
      ?>
      <?php
      //echo $sts." - ";
      if ($tglpo == '' || $tglpo == '0000-00-00') {
        echo "-";
      } else {
        echo tgl($tglpo);
      }
      ?>
    </div>

    <!--<div style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
<?php //echo $sts." - ".$tglpo; 
?>
</div>-->
  </div>
  <div class="frame-judul-samping" style="margin-left:75%;">
    <div class="frame-utama-md" style="width:100%;">
      <!--<a href="http://192.168.0.22/GISL2/admin.php?hal=detpo&po=<?php //echo $po; 
                                                                    ?>" style="text-decoration:none; color:#359DD9;display:none;"> Cancel </a> 
&nbsp; &nbsp; &nbsp; &nbsp; <a href="#" onclick="updtpi();" style="text-decoration:none; color:#359DD9;"> Save </a>-->
      <?php //if($postatpk<>3){ 
      ?>
      <a href="javascript:void(0);" id="printpo" onclick="print();" plain="true" style="padding:8px; text-decoration:none; color:#359DD9;">
        <!--<input style="margin-top:-5px; margin-left:50%;" id="printpo" type="button" name="submit" value="Print PO" class="button-submit-add">!-->
        View PDF</a>
      <!--<a href="javascript:void(0);" id="edita" plain="true" onclick="$('#dg').edatagrid('addRow2'); editrowa();" style="padding:8px; text-decoration:none; color:#359DD9;">
Edit PO information</a>-->
      <a href="http://192.168.0.11/RKB/data/admin?hal=sum&cari1=<?php echo $pono; ?>" id="ckwrh" target="_blank" style="padding:8px;text-decoration:none; color:#359DD9;">
        Status Material</a>
    </div>
  </div>
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
  <div class="frame-judul-samping" style="margin-left:30%;">
    <div class="frame-utama-md" style="width:100%;">
      <a href="javascript:void(0);" id="cancela" plain="true" onclick="$('#dg').edatagrid('cancelRow');editrowb(); cansave();" style="text-decoration:none; color:#BDBDBD; display:none;"> Cancel </a>&nbsp; &nbsp;
      <a href="javascript:void(0);" id="savea" plain="true" onclick="$('#dg').edatagrid('saveRow');editrowb();updt();updt2();updt2p();updt2iv();updt3();updt4();updt5();updt5b();updt5c();updt5d();updt6();updt7();updt7b();updt8();updt9();" style="text-decoration:none; color:#359DD9;display:none;"> Save </a>&nbsp; &nbsp;
      <?php if ($postatpk == 4) {
        if ($supnm2 == "STOCK") {
      ?>
          <a href="javascript:void(0);" id="deletea" plain="true" onclick="$('#dg').edatagrid('destroyRow');" style="text-decoration:none; color:#359DD9;display:none;"> Delete </a>
        <?php }
      } else {
        ?>
        <a href="javascript:void(0);" id="deletea" plain="true" onclick="$('#dg').edatagrid('destroyRow');" style="text-decoration:none; color:#359DD9;display:none;"> Delete </a>
      <?php } ?>
    </div>
  </div>

</div>
</div>
<!--<div id="frame-utama-judul2" style="top:185px;">-->
<div id="tabel" style="top:170px;">
  <table style="width:100%; float: left">
    <tr>
<td colspan="8" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Summary</td>
<td colspan="3" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Shipment</td>
    </tr>
    <tr>
      <!-- <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:250px;">Buyer / Season / Stage</td> -->
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Supplier</td>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:80px;">Currency</td>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:120px;">PI received date</td>
      <?php
      //if($postatpk==4){
      //if($piform<>""){
      ?>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:120px;">Invoice no.</td>
      <?php //}
      //} 
      ?>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:160px;">PI amount</td>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:150px;">
        <div id="piform">PI form</div>
      </td>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:120px;">Requested Deliv.</td>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:100px;">Supplier ETD</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:120px;">ETD from port</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:80px;">ETA</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:80px;">EIH</td>
    </tr>
    
    <tr>
      <!-- <td style="font-size:14px; font-weight:bold;">
<div id="ccbi" style="display:none;">
<form id="formi" method="post">
<input type="hidden" name="popk1i" id="popk1i" value="<?php //echo $po; 
                                                      ?>" size="8">
<textarea class="easyui-validatebox" id="brgg" name="brgg" style="width:175px; height:45px; border-color:#d3d3d3;">
<?php //echo TRIM($brg); 
?></textarea>
</form>
</div>
<div id="ccb2i" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php //echo $buyer; 
                                                                                                ?> / <?php //echo $buy; 
                                                                                                                          ?> / <?php //echo $stage; 
                                                                                                                                                  ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($buyer),7); 
?> / <?php //echo truncate(TRIM($buy),7); 
                                            ?> / <?php //echo truncate(TRIM($stage),7); 
                                                                                      ?>
</a>
</div>   -->
      <!--<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php //echo TRIM($dt2['brg']); 
                                                                                                          ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt2['brg']),15); 
?>
</a>-->
      <!-- </td> -->
      <td style="font-size:14px; font-weight:bold;">
        <div id="ccbe" style="display:none;">
          <form id="forme" method="post">
            <input type="hidden" name="popk1e" id="popk1e" value="<?php echo $po; ?>" size="8">
            <input style="width:150px; height:28px;" id="suppe" name="suppe" class="easyui-combobox" data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=suppe',prompt:'<?php echo $supnm2; ?>',limitToList:true,panelHeight:'300'">
          </form>
        </div>
        <div id="ccb2e" style="margin-top:0px;">
          <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($supnm); ?>" class="easyui-tooltip">
            <?php if ($suppk == 1949) { ?>
              <font style="color:rgba(0, 0, 0, 0.38)">
                <?php echo truncate(TRIM($supnm), 13); ?>
              </font>
            <?php } else { ?>
              <?php echo truncate(TRIM($supnm), 13); ?>
            <?php } ?>
          </a>
          <input type="hidden" id="ccb2be" value="<?php echo $suppk; ?>" style="border:none;" readonly />
        </div>
        <!--<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt2['supnm']); 
                                                                                              ?>" class="easyui-tooltip">
<?php // echo truncate(TRIM($dt2['supnm']),20); 
?>
</a>-->
      </td>
      <td style="font-size:14px; font-weight:bold;">
        <div id="ccbf" style="display:none;">
          <form id="formf" method="post">
            <input type="hidden" name="popk1f" id="popk1f" value="<?php echo $po; ?>" size="8">
            <input style="width:100px; height:28px;" id="curf" name="curf" class="easyui-combobox" data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'<?php echo $curid; ?>',limitToList:true">
          </form>
        </div>
        <div id="ccb2f" style="margin-top:0px;">
          <?php
          if ($curid <> '') {
            echo $curid;
          } else {
            echo "---";
          }
          ?>
          <input type="hidden" id="ccb2bf" value="<?php echo $curpk; ?>" style="border:none;" readonly />
        </div>
      </td>
      <td style="font-size:14px; font-weight:bold;">
        <div id="pi" style="width:80%;display:none">
          <form id="formk" method="post">
            <input type="hidden" name="popk1k" id="popk1k" value="<?php echo $po; ?>" size="8">
            <!--<input type="hidden" name="etda" id="etda" value="<?php //echo tgl2($pidate); 
                                                                  ?>" size="8">-->
            <!--<div id="piol" position="top" style="width:160px;padding:0px;">-->
            <!--<input class="easyui-textbox" id="etda" name="etda" style="width:125px;height:30px;border:1px solid #c0c0c0;"
value="<?php //if($etd=='' || $etd=='0000-00-00'){} else{echo tgl2($etd);}
        ?>" data-options="prompt:'DD/MM/YYYY'"/>-->
            <input name="pia" id="pia" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser" value="<?php if ($pidate == "" || $pidate == '0000-00-00') {
                                                                                                                                                } else {
                                                                                                                                                  echo tgl2($pidate);
                                                                                                                                                } ?>">
          </form>
        </div>
        <!--<label style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
        <div id="pi2">
          <?php if ($pidate == "" || $pidate == '0000-00-00') {
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
            <input placeholder="Enter invoice no ..." class="easyui-validatebox" id="invoiceno" name="invoiceno" value="<?php echo TRIM($dt2['invoiceno']); ?>" style="width:150px; height:28px; border-color:#d3d3d3;">
          </form>
        </div>
        <div id="ccbiv2" style="margin-top:0px;">
          <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($invoiceno); ?>" class="easyui-tooltip">
            <?php
            if ($invoiceno) {
              echo truncate(TRIM($invoiceno), 13);
            } else {
              echo "---";
            }
            ?>
          </a>
        </div>
      </td>
      <td style="font-size:14px; font-weight:bold;">
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
          if ($piform <> "") { ?>
            <a href="upload/<?php echo $piform; ?>" target="_blank" style="text-decoration:none; color:#359DD9;">Download</a><br>
            <!--&nbsp; <a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Change</a><br>-->
            <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($piform); ?>" class="easyui-tooltip">
              <font style="color:rgba(0, 0, 0, 0.38)"><?php echo truncate(TRIM($piform), 13); ?></font>
            </a>
          <?php } else { ?>
            <!--<a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Upload</a>-->
          <?php }
          //} 
          ?>
        </div>
      </td>
      <td style="font-size:14px; font-weight:bold;">
        <div id="ccbh" style="width:80%;display:none">
          <form id="formh" method="post">
            <input type="hidden" name="popk1h" id="popk1h" value="<?php echo $po; ?>" size="8">
            <input name="deldt" id="deldt" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser" value="<?php if ($deldt == "" || $deldt == '0000-00-00') {
                                                                                                                                                    } else {
                                                                                                                                                      echo tgl2($deldt);
                                                                                                                                                    } ?>">          </form>
        </div>
        <div id="ccb2h">
          <?php if ($deldt == "" || $deldt == '0000-00-00') {
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
            <!--<input type="hidden" name="etda" id="etda" value="<?php echo tgl2($etd); ?>" size="8">-->
            <!--<div id="etdtol" position="top" style="width:160px;padding:0px;">-->
            <!--<input class="easyui-textbox" id="etda" name="etda" style="width:125px;height:30px;border:1px solid #c0c0c0;"
value="<?php //if($etd=='' || $etd=='0000-00-00'){} else{echo tgl2($etd);}
        ?>" data-options="prompt:'DD/MM/YYYY'"/>-->
            <input name="etda" id="etda" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser" value="<?php if ($etd == "" || $etd == '0000-00-00') {
                                                                                                                                                  } else {
                                                                                                                                                    echo tgl2($etd);
                                                                                                                                                  } ?>">
          </form>
        </div>
        <!--<label style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
        <div id="et2">
          <?php if ($etd == "" || $etd == '0000-00-00') {
            echo "---";
          } else {
            echo tgl($etd);
          } ?>
        </div>
      </td>
      <td style="font-size:14px; font-weight:bold;">
          <?php if ($etdv2 == "" || $etdv2 == '0000-00-00') {
            echo "---";
          } else {
            echo tgl($etdv2);
          } ?>
      </td>
      <td style="font-size:14px; font-weight:bold;">
          <?php if ($eta2 == "" || $eta2 == '0000-00-00') {
            echo "---";
          } else {
            echo tgl($eta2);
          } ?>
      </td>
      <td style="font-size:14px; font-weight:bold;">
          <?php if ($eih2 == "" || $eih2 == '0000-00-00') {
            echo "---";
          } else {
            echo tgl($eih2);
          } ?>
      </td>
    </tr>
  </table>
  <table id="tab2" style="width:100%; float: left;">
    <tr>
      <td colspan="6" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px; color: rgba(0, 0, 0, 0.6);">Additional details</td>
    </tr>
    <tr>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Bank surcharge</td>
      <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Other surcharge</td>
      <!-- <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:10px;"></td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Notes</td> -->
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
            <input placeholder="Enter amount..." class="easyui-validatebox" id="surcharge1" name="surcharge1" value="<?php if ($dt2['surcharge'] == "0.00") {
                                                                                                                      } else {
                                                                                                                        echo TRIM($dt2['surcharge']);
                                                                                                                      } ?>" style="width:150px; height:28px; border-color:#d3d3d3;">
          </form>
        </div>
        <div id="ccb2g2" style="margin-top:0px;">
          <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($surcharge1); ?>" class="easyui-tooltip">
            <?php echo truncate(TRIM($surcharge1), 15); ?>
          </a>
        </div>
      </td>
      <td style="font-size:14px; font-weight:bold;">
        <div id="ccbg2b" style="display:none;">
          <form id="formg2b" method="post">
            <input type="hidden" name="popkg2b" id="popkg2b" value="<?php echo $po; ?>" size="8">
            <input placeholder="Enter amount..." class="easyui-validatebox" id="surcharge2" name="surcharge2" value="<?php if ($dt2['surcharge2'] == "0.00") {
                                                                                                                      } else {
                                                                                                                        echo TRIM($dt2['surcharge2']);
                                                                                                                      } ?>" style="width:150px; height:28px; border-color:#d3d3d3;">
          </form>
        </div>
        <div id="ccb2g2b" style="margin-top:0px;">
          <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($surcharge2); ?>" class="easyui-tooltip">
            <?php echo truncate(TRIM($surcharge2), 15); ?>
          </a>
        </div>
        <div id="ccb2g2c" style="margin-top:0px;font-weight:normal;">
          <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($note); ?>" class="easyui-tooltip">
            <?php
            if ($note <> "") {
              $note = $note;
            } else {
              $note = "---";
            }
            ?>
            <?php echo truncate(TRIM($note), 13); ?>
          </a>
        </div>
      </td>
      <!-- <td style="font-size:14px;">-</td> -->
      <!-- <td style="font-size:14px; font-weight:bold;">
<div id="ccbg2c" style="display:none;">
<form id="formg2c" method="post">
<input type="hidden" name="popkg2c" id="popkg2c" value="<?php echo $po; ?>" size="8">
<input  placeholder="Notes..." class="easyui-validatebox" id="note" name="note" value="<?php echo TRIM($note); ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
</td> -->
      <td style="font-size:14px; font-weight:bold;">
        <div id="ccbg" style="display:none;">
          <form id="formg" method="post">
            <input type="hidden" name="popk1g" id="popk1g" value="<?php echo $po; ?>" size="8">
            <input placeholder="Terms" class="easyui-validatebox" id="payterm" name="payterm" value="<?php echo TRIM($potop); ?>" style="width:150px; height:28px; border-color:#d3d3d3;">
          </form>
        </div>
        <div id="ccb2g" style="margin-top:0px;">
          <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($potop); ?>" class="easyui-tooltip">
            <?php
            if ($potop <> "") {
              $potop = $potop;
            } else {
              $potop = "---";
            }
            ?>
            <?php echo truncate(TRIM($potop), 13); ?>
          </a>
        </div>
      </td>
      <td style="font-size:14px; font-weight:bold;">
        <div id="ccbgp" style="width:80%;display:none">
          <form id="formp" method="post">
            <input type="hidden" name="popk1p" id="popk1p" value="<?php echo $po; ?>" size="8">
            <!--<input type="hidden" name="etda" id="etda" value="<?php //echo tgl2($pidate); 
                                                                  ?>" size="8">-->
            <!--<div id="piol" position="top" style="width:160px;padding:0px;">-->
            <!--<input class="easyui-textbox" id="etda" name="etda" style="width:125px;height:30px;border:1px solid #c0c0c0;"
value="<?php //if($etd=='' || $etd=='0000-00-00'){} else{echo tgl2($etd);}
        ?>" data-options="prompt:'DD/MM/YYYY'"/>-->
            <input name="pyd" id="pyd" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser" value="<?php if ($paydate == "" || $paydate == '0000-00-00') {
                                                                                                                                                } else {
                                                                                                                                                  echo tgl2($paydate);
                                                                                                                                                } ?>">
          </form>
        </div>
        <!--<label style="width:auto; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
        <div id="ccbgp2">
          <?php if ($paydate == "" || $paydate == '0000-00-00') {
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
            <input style="width:100px; height:28px;" id="ft" name="ft" class="easyui-combobox" data-options="valueField:'freightnm',textField:'freightnm',url:'view/get_data.php?dt=freight',prompt:'<?php echo $freightterm; ?>',panelHeight:'auto'">
          </form>
        </div>
        
        <div id="ccb2ft" style="margin-top:0px;">
          <?php
          if ($freightterm <> '') {
            echo $freightterm;
          } else {
            echo "---";
          }
          ?>
        </div>
      </td>
      <td style="font-size:14px; font-weight:bold;">
        <div id="ccbi2" style="display:none;">
          <form id="formi2" method="post">
            <input type="hidden" name="popki2" id="popki2" value="<?php echo $po; ?>" size="8">
            <textarea class="easyui-validatebox" id="rmk" name="rmk" style="width:175px; height:45px; border-color:#d3d3d3;" placeholder="Remarks...">
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
  <!-- </div> -->
  <!--<div id="menu" onclick="$('#menu').fadeOut();"  style="display:none;">
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('saveRow');" style="color: #FFFFFF; text-decoration: none;"> Save </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('cancelRow');" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')" style="color: #FFFFFF; text-decoration: none;">Delete </a></div>-->
  <!--</div>-->
  <!--<div id="tabel1" style="top:400px;">-->

<div style="float: left; margin-top:10px; width:100%; height:auto;">
<a href="?hal=detpopur&po=<?php echo $po; ?>&dfmat=<?php echo $_GET['dfmat']; ?>&mat=<?php echo $_GET['mat']; ?>&ord=<?php echo $_GET['ord']; ?>" class="link2" style="<?php if ($_GET['hal'] == "detpopur") { echo $style; }?>"> 
Material details </a>
<a href="?hal=shipdet_detpopur&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>&dfmat=<?php echo $_GET['dfmat']; ?>&mat=<?php echo $_GET['mat']; ?>&ord=<?php echo $_GET['ord']; ?>" class="link2" style="<?php if ($_GET['hal'] == "shipdet_detpopur") { echo $style; } ?>">
Shipment details</a>
<br><br>
</div>
          <!-- </div> -->
          <?php if($tot>0){ ?>
      <table id="dg_mat_detshipment" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
      url="view/get_matdetshipment2.php?po=<?php echo $po; ?>" border="true"
      idField="importdtpk" toolbar="#tb" striped="true" pagination="false" singleSelected="true" rownumbers="false" 
      collapsible="true" method="post" data-options="" multiSort="true" fitColumns="true" nowrap="false">
       <thead>
         <tr>
         <!-- <th field="item" width="150">Item</th> -->
           <th field="spec" width="350" sortable="true">Specification</th>
           <!-- <th field="supnm" width="217">Supplier</th> -->
           <th field="colname" width="125" sortable="true">Color</th>
           <th field="unit" width="75" sortable="true">Units</th>
           <th field="pocons1a" width="125">Qty</th>
           <?php for($i=1; $i<=$tpo; $i++){ 
               if($i == 1) {
                 $ship = '1st Shipment';
             } elseif($i == 2) {
                 $ship = '2nd Shipment';
             } elseif($i == 3) {
                 $ship = '3rd Shipment';
             } else {
                 $ship = $i . 'th Shipment';
             }
           ?>
           <th field="pocons<?php echo $i; ?>" width="125"><?php echo $ship; ?></th>
           <?php } ?>
           <th field="balance2b" width="125">Balance</th>
         </tr>
       </thead>
     </table><br>
         <!-- </div> -->
     <span style="font-size: 16px;font-style: normal;font-weight: 700;line-height: 20px;color:#00000099;">Vassal Details</span>
     <?php
      $k=0;
      $qship=mysqli_query($koneksi,"select import.importpk from importdt
      left outer join import on import.importpk=importdt.importpk
      where importdt.popk='$po'
      group by import.importpk
      order by import.importpk ASC, import.EIH desc");  
      while($dship=mysqli_fetch_array($qship)){
        $k++;
        if($k == 1) {
          $ship2 = '1st Shipment';
      } elseif($k == 2) {
          $ship2 = '2nd Shipment';
      } elseif($k == 3) {
          $ship2 = '3rd Shipment';
      } else {
          $ship2 = $k.'th Shipment';
      }
        $crim2 = mysqli_query($koneksi, "select * from importdt
        left outer join import on import.importpk=importdt.importpk
        left outer join vassal on vassal.vassalpk=import.vassalpk
        left outer join arrival on arrival.arrivalpk=import.arrivalpk
        left outer join port on port.portpk=import.portpk
        where import.importpk='$dship[importpk]' and import.arrivalpk>0");
        $dtim2 = mysqli_fetch_array($crim2);
        $importpk = $dtim2['importpk'];
        $stsimpk = $dtim2['stsimpk'];
        $vassaltype = $dtim2['typenm'];
        $vassalname = $dtim2['vassalnm'];
        $airwaybill = $dtim2['AWB'];
        $arrival = $dtim2['city'];
        $port_name = $dtim2['portnm'];
        $dateim = $dtim2['datecreate'];
        $etdv3 = $dtim2['ETDV'];
        $eta3 = $dtim2['ETDA'];
        $eih3 = $dtim2['EIH'];
        $tott2--;
      ?>
      <div style="float: left; margin-top:10px; width:100%; height:75px;">
      <table>
      <tr>
        <td colspan="9" style="font-style:normal; font-weight:700; font-size:14px; line-height:18px; color:#359DD9;">
          <?php
          // if ($vassaltype == "") {
          //   echo '<a href="javascript:void(0)" plain="true" onclick="formLog();" style="text-decoration:none; color:#359DD9;">Shipment</a>';
          // } else {
            echo '<a href="javascript:void(0)" plain="true" onclick="formLog_detpomd('.$importpk.');" style="text-decoration:none; color:#359DD9;">'.$ship2.' &nbsp;'. $tott2 .'</a>';
          // }
          ?>
          &nbsp;&nbsp;
          <?php
          if ($stsimpk == 1) {
            echo '<input type="text" name="on" id="on" value="En route" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#333333;" readonly>';
            echo '<span style="color:#00000061;font-weight:normal;"> Departed on &nbsp;';
            if ($etdv3 == "") {
              echo $etdv3 = "-";
            } else {
              echo tgl($etdv3);
            }
            echo '</span>';
          } else if ($stsimpk == 2) {
            echo '<input type="text" name="on" id="on" value="Arrived IDN" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#359DD9;" readonly>';
            echo '<span style="color:#00000061;font-weight:normal;"> Arrived on &nbsp;';
            if ($eta3 == "") {
              echo $eta3 = "-";
            } else {
              echo tgl($eta3);
            }
            echo '</span>';
          } else if ($stsimpk == 3) {
            echo '<input type="text" name="on" id="on" value="In house" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#19B715;" readonly>';
            echo '<span style="color:#00000061;font-weight:normal;"> Arrived on &nbsp;';
            if ($eih3 == "") {
              echo $eih3 = "-";
            } else {
              echo tgl($eih3);
            }
            echo '</span>';
          } else {
            echo '<input type="text" name="on" id="on" value="Schedule" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px; border:0px solid #000000; font-weight:300; font-size:14px; color:#FFFFFF; background-color:#858585;" readonly>';
            echo '<span style="color:#00000061;font-weight:normal;"> Create on &nbsp;';
            if ($dateim == "") {
              echo $dateim = "-";
            } else {
              echo tgl($dateim);
            }
            echo '</span>';
          }
          ?>
          <?php
          // if ($paydate == "" || $paydate == '0000-00-00') {
          // } else {
          //   echo '<span style="color: #00000061; font-size: 12px; line-height: 16px;">Departed on ' . tgl($paydate) . '</span>';
          // }
          ?>
        </td>
      </tr>
      </table>
      <table>
        <thead>
          <tr style="color: #00000061; font-size: 16px; line-height: 16px;">
            <td field="vastype" width="120">Vassal type</td>
            <td field="vasname" width="311">Vassal name</td>
            <td field="airway" width="170" editor="text">AirwayBill number</td>
            <td field="arrival" width="120" editor="text">Arrival City</td>
            <td field="portname" width="120" editor="text">Port Name</td>
            <td field="etd" width="120" editor="text">ETD(Vassal)</td>
            <td field="eta" width="120" editor="text">ETA</td>
            <td field="eih" width="120" editor="text">EIH</td>
          </tr>
          <tr style="font-size: 14px; line-height: 14px;">
            <td field="vastype" width="120">
              <?php
              if ($vassaltype == "") {
                echo $vassaltype = "-";
              } else {
                echo $vassaltype;
              }
              ?>
            </td>
            <td field="vasname" width="311">
              <?php
              if ($vassalname == "") {
                echo $vassalname = "-";
              } else {
                echo $vassalname;
              }
              ?>
            </td>
            <td field="airway" width="170">
              <?php
              if ($airwaybill == "") {
                echo $airwaybill = "-";
              } else {
                echo $airwaybill;
              }
              ?>
            </td>
            <td field="arrival" width="120">
              <?php
              if ($arrival == "") {
                echo $arrival = "-";
              } else {
                echo $arrival;
              }
              ?>
            </td>
            <td field="portname" width="120">
              <?php
              if ($port_name == "") {
                echo $port_name = "-";
              } else {
                echo $port_name;
              }
              ?>
            </td>
            <td field="etd" width="120">
              <?php
              if ($etdv3 == "") {
                echo $etdv3 = "-";
              } else {
                echo tgl($etdv3);
              }
              ?>
            </td>
            <td field="eta" width="120">
              <?php
              if ($eta3 == "") {
                echo $eta3 = "-";
              } else {
                echo tgl($eta3);
              }
              ?>
            </td>
            <td field="eih" width="120">
            <?php
              if ($eih3 == "") {
                echo $eih3 = "-";
              } else {
                echo tgl($eih3);
              }
              ?>
            </td>
          </tr>
        </thead>
      </table>
</div>  
<?php } 
} else { ?>
<div id="frame-utama-cari" style="left:0px;width:auto;text-align:left;top:210px;">
<span style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;">No data available. Please check in again later.</span>
</div>
<?php } ?>
</div>

<div id="tabel1" style="top:455px;">  
<div id="dialog-form-log" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:false,modal:true,closable:false" style="width:1017px;height:500px;padding:5px 5px;display:none;top:50px;overflow-y:hidden;overflow-x:hidden;">
        <div class="modal-dialog" style="width:995px; height:375px;">
            <div style="margin-top:5px; margin-left:98%;">
                <a href="javascript:void(0)" style="text-decoration:none; color:#000; font-size:20px;" onclick="$('#dialog-form-log').dialog('close');">&#10761;</a>
            </div>

            <div class="Supplier" style="color: rgba(0, 0, 0, 0.38); font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
                <input type="hidden" name="importpkb" id="importpkb">
                <input type="hidden" name="dtb" id="dtb" value="1">
                <input type="hidden" name="dtc" id="dtc" value="0">
            </div>

            <div style="margin-left:15px;margin-top:-15px;">
                <div class="CreateShipmentPlan" style="color: black; font-size: 18px;  font-weight: 700; line-height: 24px; word-wrap: break-word">
                    Shipment plan
                </div>

                <div class="OrderDetails" style="margin-top:10px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">
                    Order details
                </div>

                <div class="Supplier" style="color: rgba(0, 0, 0, 0.38); font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
                    Supplier&nbsp;&nbsp;&nbsp; <a style="color: #000000;
                                                  font-size: 14px;
                                                  font-weight: 400;
                                                  line-height: 18px;"><?php echo $supnm; ?></a> 
                </div>

                <div class="Pos" style="color: rgba(0, 0, 0, 0.38); font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
                POs <span id="totpo" name="totpo"></span>
                    <span id="shw" name="shw" style="cursor:pointer;color:#359DD9;" onclick="viewdtl();">View detail</span>
                    <span id="hdn" name="hdn" style="cursor:pointer;color:#359DD9;display:none;" onclick="viewdtl();">Hide detail</span>
                </div>
            </div>
            <br>

            <div class="modal-dialog" style="width:99%; height:96%; overflow-y:scroll;overflow-x:hidden;">
                <div class="modal-content">

                    <div id="tabel2b" style="width:935px;height:250px;margin-top:5px;margin-left:10px; display: none;">
                        <table id="dg2b" class="easyui-datagrid" title="" style="width:98%;height:auto;" align="center" url="view/get_dtimport.php" border="none" striped="false" idField="importdtpk" data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:false,view:groupview,border:true,autoRowHeight:true,fit: true, 
                               groupField:'pono',groupFormatter:formatku2b,onLoadSuccess:function(){editrow();}, multiSort:true">
                            <thead>
                                <tr>
                                    <th field="item" width="100">Item</th>
                                    <th field="spec" width="195">Description</th>
                                    <th field="supnm" width="150">Supplier</th>
                                    <th field="byrnm" width="125">Color</th>
                                    <th field="price" width="125">Price</th>
                                    <th field="total" width="100">Qty PO</th>
                                    <th data-options="field:'qtys',width:110,editor:'text'">Shipment Qty</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div id="shipdetail" style="">
                        <div class="ShipmentDetails" style="margin-top:15px;margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">Shipment details</div>
                        <table border="0" style="margin-left:15px;">
                            <tr>
                                <th width="150" align="left">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">Vassal type</div>
                                </th>
                                <th width="275" align="left">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">Vassal name</div>
                                </th>
                                <th width="250" align="left">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">AirwayBill Number</div>
                                </th>
                                <th width="200" align="left">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">Arrival city</div>
                                </th>
                                <th width="200" align="left">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">Port name</div>
                                </th>
                            </tr>
                            <tr>
                                <td align="left">
                                <span id="vtype3b"></span>
                                    <?php
                                    // if ($vassaltype == "") {
                                    //     echo $vassaltype = "-";
                                    // } else {
                                    //     echo $vassaltype;
                                    // }
                                    ?>
                                </td>
                                <td align="left">
                                <span id="vname3b"></span>
                                    <?php
                                    // if ($vassalname == "") {
                                    //     echo $vassalname = "-";
                                    // } else {
                                    //     echo $vassalname;
                                    // }
                                    ?>
                                </td>
                                <td align="left">
                                <span id="awb3b"></span>
                                    <?php
                                    // if ($airwaybill == "") {
                                    //     echo $airwaybill = "-";
                                    // } else {
                                    //     echo $airwaybill;
                                    // }
                                    ?>
                                </td>
                                <td align="left">
                                <span id="arrival3b"></span>
                                    <?php
                                    // if ($arrival == "") {
                                    //     echo $arrival = "-";
                                    // } else {
                                    //     echo $arrival;
                                    // }
                                    ?>
                                </td>
                                <td align="left">
                                <span id="port3b"></span>
                                    <?php
                                    // if ($port_name == "") {
                                    //     echo $port_name = "-";
                                    // } else {
                                    //     echo $port_name;
                                    // }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div class="ItemDetails" style="margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">Shipment dates</div>
                        <table border="0" style="margin-left:15px;">
                            <tr>
                                <th align="left" width="150">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">ETD</div>
                                </th>
                                <th align="left" width="150">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">ETA</div>
                                </th>
                                <th align="left" width="150">
                                    <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">EIH (Estimate in house)</div>
                                </th>
                            </tr>
                            <tr>
                                <td align="left">
                                <span id="etdv3b"></span>
                                    <?php
                                    // if ($etdv3 == "") {
                                    //     echo $etdv3 = "-";
                                    // } else {
                                    //     echo tgl($etdv3);
                                    // }
                                    ?>
                                </td>
                                <td align="left">
                                <span id="eta3b"></span>
                                    <?php
                                    // if ($eta3 == "") {
                                    //     echo $eta3 = "-";
                                    // } else {
                                    //     echo tgl($eta3);
                                    // }
                                    ?>
                                </td>
                                <td align="left">
                                <span id="eih3b"></span>
                                    <?php
                                    // if ($eih3 == "") {
                                    //     echo $eih3 = "-";
                                    // } else {
                                    //     echo tgl($eih3);
                                    // }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>

                    <style>
                      .lines-no3 .datagrid-body td {
                          border-right: 2px solid #FFFFFF;
                          border-bottom: 2px solid #FFFFFF;
                      }
                    </style>

                    <div id="tabel2c" onclick="" onmousemove="" style="margin-top:10px;margin-left:15px;">
                        <div class="ItemDetails" style="color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">Shipment Log</div>
                        <table id="dg2c" class="easyui-datagrid" title="" style="width:100%;" align="center" url="view/get_log_shipment.php" border="none" striped="false" idField="importdtpk" data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,fitColumns:false,border:true,autoRowHeight:true">
                            <thead>
                                <tr>
                                    <th field="datelog" width="200" style="border:none;">Date</th>
                                    <th field="logchange" width="570">Changes</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

  <div id="dialog-form" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:true,modal:true,closable:false" style="width:425px;height:275px;padding:5px 5px;display:none;top:15px">
    <form id="form" method="post" enctype="multipart/form-data">
      <input type="hidden" name="popk" id="popk" value="<?php echo $po; ?>" size="8">
      <div class="modal-dialog" style="height:250px;">
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
          <!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
          <a style="text-decoration:none; left: 129px; top: 200px;" href="javascript:void(0)" class="button-cancel" onclick="cancel();">Cancel</a>
          <a style="text-decoration:none; left: 206px; top: 200px;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>
          <!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
        </div>
    </form>
  </div>
</div>

<div id="dialog-formb" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:true,modal:true,closable:false" style="width:425px;height:200px;padding:5px 5px;display:none;top:15px">
  <form id="formb" method="post" enctype="multipart/form-data">
    <input type="hidden" name="popk" id="popk" value="<?php echo $po; ?>" size="8">
    <div class="modal-dialog" style="height:175px;">
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
</div>
</div>