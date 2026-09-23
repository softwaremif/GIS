<?php
session_start();
/*include "email/pay.php";*/
//include "action/sinkron4b.php";
$x=$_GET['x'];
$po=$_GET['po'];
$cari2=mysqli_query($koneksi,"SELECT po.surcharge, po.surcharge2, po.note, po.piamount, po.piform, po.pono, sup.supnm,
poli.polinm,cur.curid, cur.cursign, pourg.pourgnm, pourg.pourgpk, po.piform, po.ket, po.etd, po.brg, po.potop,po.tgldel,
po.postatpk,po.tglpo,po.pidate,podt.hspec1,podt.hspec2,podt.hspec3,podt.hspec4,podt.hspec5,podt.hspec6,podt.hspec7,
podt.hspec8,podt.spec1,podt.spec2,podt.spec3,podt.spec4,podt.spec5,podt.spec6,podt.spec7,podt.spec8,podt.tspec,
sum(podt.pocons*podt.price) as amount, ord.season, po.buy, byr.byrnm, ord.stage, po.paydate, sup.suppk, po.invoiceno
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
$supnm=preg_replace('/[^a-zA-Z""#()_%+-;–$&>â€]/', ' ', $dt2['supnm']); 
}
$supnm2=substr(TRIM($dt2['supnm']),0,5);  
$polinm=$dt2['polinm'];
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

$updt2=mysqli_query($koneksi,"update po set buy='$season' where popk='$po'");
$buy=$dt2['buy'];

$update4=mysqli_query($koneksi,"update po set ck='1' where ck='0' and popk='$po'");

$updt=mysqli_query($koneksi,"update po set piamount='$dt2[amount]' where popk='$po'");
if($dt2['piamount']>0){
$piamount=$dt2['piamount'];
} else {
$piamount=$dt2['amount'];
}

if($curpk==3){ $cursign="&#8364;"; }
else { $cursign=$dt2['cursign']; }

if($piamount=="0.00000"){ $pi="---";}
else {
if($curid=="IDR"){
$pi=$cursign." ".number_format($piamount,0,".",",");
} else {
$pi=$cursign." ".number_format($piamount,3,".",",");    
}
}

if($surcharge1=="0.00"){ $surcharge1="---";}
else {
if($curid=="IDR"){
$surcharge1=number_format($surcharge1,0,".",",");
} else {
$surcharge1=number_format($surcharge1,3,".",",");    
}
}

if($surcharge2=="0.00"){ $surcharge2="---";}
else {
if($curid=="IDR"){
$surcharge2=number_format($surcharge2,0,".",",");
} else {
$surcharge2=number_format($surcharge2,3,".",",");    
}
}

$cari3=mysqli_query($koneksi,"SELECT count(*) as tdelsts FROM podt WHERE popk='$po' and delsts='1'");
$dt3=mysqli_fetch_array($cari3);
if($dt3['tdelsts']>0){
  $styledel="width:200px;font-family: Arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: #EF3B42;margin-left:320px;margin-top:-17px;";
} else{
  $styledel="display:none;";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');*/
//$('#dg').datagrid('reload');
$('#dg').edatagrid('addRow2');
editrowa();
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
	}
});   
}

function updt8(){
var string = $("#formj").serialize();
$('#formj').form('submit',{
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
//window.location.href="?hal=detpo&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
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
	var row = $('#dg').datagrid('getSelected');
		$('#dialog-form').dialog('open').dialog('setTitle','');
		$('#form').form('load',row);
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
//window.location.href="?hal=detpo&po=<?php echo $po; ?>";
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
    var dg = $('#dg');
    $('#container-cari').css('margin-top','60px');
    $('#tabel1').css('margin-top','60px');
    $('#tabel').css('margin-top','10px');
    $('#tab2').css('width','80%');
    $('#tab2').css('margin-top','-10px');
    $('#tab3').css('margin-top','-20px');
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

function back(){
window.location.href="?hal=proses&x=1";
}

function cansave(){
window.location.href="?hal=detpomd&x=<?php echo $_GET['x']; ?>&po=<?php echo $po; ?>";
}

function formatku2(val,row){
  //if (row.tpodt>0) {
  //return '<div style="margin-left:-10px;"><img src="css/images/notif2.png" width="3px" height="30px">'+
  //        '<div style="margin-top:-25px;margin-left:5px;"><center>'+val+'</center></div>';
  //} else {
  //  return val;
  //}
    if (row.tpodtb>0) {
  return '<div style="margin-left:-10px;"><img src="css/images/notif2.png" width="3px" height="30px">'+
          '<div style="margin-top:-25px;margin-left:5px;"><center>'+val+'</center></div>';
  } else {
    return val;
  }
}

$(function(){
$('#dg').datagrid({
    rowStyler:function(index,row){
        if (row.delsts>0){
            return 'color:#EF3B42';
        }
    }
});
});

function tpodtb(){
  var row=$('#dg').datagrid('getSelected');
  if (row){
    if(row.tpodtb==1){
        $.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=tpodtb&podtpk="+row.podtpk,
					success	: function(){
          $('#dg').datagrid('reload');
          }
				});
    }
  }
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
</script>
<input type="hidden" id="x" name="x" value="<?php echo $_GET['x']; ?>">
<input type="hidden" id="tdelsts" name="tdelsts" value="<?php echo $dt3['tdelsts']; ?>">
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
<?php
if($postatpk==1){ $sts="Awaiting PI"; }
else if($postatpk==2){ $sts="In Revision"; }
else if($postatpk==3){ $sts="Cancel PO"; }
else if($postatpk==4){ $sts="Purchased"; }
else { $sts="Awaiting PI"; }

if($postatpk==4){
?>
&nbsp; <input type="text" name="on" id="on" value="PI received" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#19B715;" readonly>
<?php } else { ?>
&nbsp; <input type="text" name="on" id="on" value="<?php echo $sts; ?>" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>
<?php } ?>
&nbsp; <input type="text" name="pourg" id="pourg" value="<?php echo $pourgnm; ?>" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#BDBDBD;" readonly>
<!--<div id="ccb" style="margin-left:5px; margin-top:20px;">
<form id="formb" method="post">
<input type="hidden" name="popk1" id="popk1" value="<?php //echo $po; ?>" size="8">
<input style="width:120px; height:28px;" id="pourg" name="pourg" class="easyui-combobox"
data-options="valueField:'pourgpk',textField:'pourgnm',url:'view/get_data.php?dt=pourg',prompt:'<?php //echo $pourgnm; ?>',panelHeight:'auto',limitToList:'true'">
</form>
</div>!-->
</div>
<span style="font-style:normal;font-weight:400;font-size:14px;line-height:18px;"><?php echo $polinm; ?></span>
<div id="ccbj" style="display:none;font-family:'Arial';font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
<form id="formj" method="post">
<?php
//if($postatpk<4){
?>
<input style="width:140px; height:28px;" id="sts" name="sts" class="easyui-combobox"
data-options="prompt:'<?php echo $sts; ?>',limitToList:'true',panelHeight:'auto',
data: [
{value:'1',text:'Awaiting PI'},
{value:'2',text:'In Revision'},
{value:'3',text:'Cancel PO'}
]">
<?php //} else {
//echo $sts." - ";  
//} ?>
<input type="hidden" name="popk1j" id="popk1j" value="<?php echo $po; ?>" size="8">
<input name="tglpo" id="tglpo" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($tglpo=='' || $tglpo=='0000-00-00'){} else{echo tgl2($tglpo);}?>">
</form>
</div>  
<div id="ccb2j" style="font-family:'Arial';font-style:normal;font-weight:400;font-size:14px;line-height:18px;">
<?php
//if($postatpk==4){
?>
<!--<input type="text" name="postat" id="postat" value="PI received" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:700;font-size:14px;color:#FFFFFF;background-color:#19B715;" readonly>-->
<?php //} else { ?>
<!--<input type="text" name="postat" id="postat" value="Awaiting PI" size="10" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:700;font-size:14px;color:#FFFFFF;background-color:#0B89D2;" readonly>-->
<?php //} ?> 
<?php
//echo $sts." - ";
if($tglpo=='' || $tglpo=='0000-00-00'){ echo "-"; }
else { echo tgl($tglpo); }
?>
</div>

<!--<div style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
<?php //echo $sts." - ".$tglpo; ?>
</div>-->
</div>
<div class="frame-judul-samping" style="margin-left:85%;">
<div class="frame-utama-md" style="width:100%;">
<!--<a href="http://192.168.0.22/GISL2/admin.php?hal=detpo&po=<?php //echo $po; ?>" style="text-decoration:none; color:#359DD9;display:none;"> Cancel </a> 
&nbsp; &nbsp; &nbsp; &nbsp; <a href="#" onclick="updtpi();" style="text-decoration:none; color:#359DD9;"> Save </a>-->
<?php //if($postatpk<>3){ ?>
<a href="javascript:void(0);" id="printpo" onclick="print();" plain="true" style="padding:8px; text-decoration:none; color:#359DD9;">
<!--<input style="margin-top:-5px; margin-left:50%;" id="printpo" type="button" name="submit" value="Print PO" class="button-submit-add">!-->
View PDF</a>
<!--<a href="javascript:void(0);" id="edita" plain="true" onclick="$('#dg').edatagrid('addRow2'); editrowa();" style="padding:8px; text-decoration:none; color:#359DD9;">
Edit PO information</a>-->
<a href="http://192.168.0.11/RKB/data/admin?hal=sum&cari1=<?php echo $pono; ?>"  id="ckwrh" target="_blank" style="padding:8px;text-decoration:none; color:#359DD9;">
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
<?php if($postatpk==4){
if($supnm2=="STOCK"){
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
<td  colspan="9" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Summary</td>
</tr>
<tr>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:250px;">Buyer / Season / Stage</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Supplier</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:100px;">Currency</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:100px;">Req.delivery</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:100px;">ETD</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:120px;">PI received date</td>
<?php
//if($postatpk==4){
//if($piform<>""){
?>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:100px;">Invoice no.</td>
<?php //}
//} ?>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:120px;">PI amount</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; width:150px;"><div id="piform">PI form</div></td>
</tr>
<tr>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbi" style="display:none;">
<form id="formi" method="post">
<input type="hidden" name="popk1i" id="popk1i" value="<?php echo $po; ?>" size="8">
<textarea class="easyui-validatebox" id="brgg" name="brgg" style="width:175px; height:45px; border-color:#d3d3d3;">
<?php echo TRIM($brg); ?></textarea>
</form>
</div>
<div id="ccb2i" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $buyer; ?> / <?php echo $buy; ?> / <?php echo $stage; ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($buyer),7); ?> / <?php echo truncate(TRIM($buy),7); ?> / <?php echo truncate(TRIM($stage),7); ?>
</a>
</div>  
<!--<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php //echo TRIM($dt2['brg']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt2['brg']),15); ?>
</a>-->
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbe" style="display:none;">
<form id="forme" method="post">
<input type="hidden" name="popk1e" id="popk1e" value="<?php echo $po; ?>" size="8">
<input style="width:150px; height:28px;" id="suppe" name="suppe" class="easyui-combobox"
data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=suppe',prompt:'<?php echo $supnm2; ?>',limitToList:true,panelHeight:'300'">
</form>
</div>
<div id="ccb2e" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($supnm); ?>" class="easyui-tooltip">
<?php if($suppk==1949) { ?>
<font style="color:rgba(0, 0, 0, 0.38)">
<?php echo truncate(TRIM($supnm),15); ?>
</font>
<?php } else { ?>
<?php echo truncate(TRIM($supnm),15); ?>
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
<td>
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
<td>
<div id="et" style="width:80%;display:none">
<form id="formc" method="post">
<input type="hidden" name="popk2" id="popk2" value="<?php echo $po; ?>" size="8">
<!--<input type="hidden" name="etda" id="etda" value="<?php echo tgl2($etd); ?>" size="8">-->
<!--<div id="etdtol" position="top" style="width:160px;padding:0px;">-->
<!--<input class="easyui-textbox" id="etda" name="etda" style="width:125px;height:30px;border:1px solid #c0c0c0;"
value="<?php //if($etd=='' || $etd=='0000-00-00'){} else{echo tgl2($etd);}?>" data-options="prompt:'DD/MM/YYYY'"/>-->
<input name="etda" id="etda" class="easyui-datebox" style="width:125px;" data-options="formatter:myformatter,parser:myparser"
value="<?php if($etd=="" || $etd=='0000-00-00'){} else{echo tgl2($etd);}?>">
</form>
</div>
<!--<label style="width:auto;font-family: 'Arial'; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
<div id="et2">
<?php if($etd=="" || $etd=='0000-00-00'){
  echo "---";
} else {
  echo tgl($etd);
} ?>
</div>
</td>
<td>
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
<!--<label style="width:auto;font-family: 'Arial'; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
<div id="pi2">
<?php if($pidate=="" || $pidate=='0000-00-00'){
  echo "---";
} else {
  echo tgl($pidate);
} ?>
</div>
</td>
<td>
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
echo truncate(TRIM($invoiceno),15);
} else {
echo "---";
}
?>
</a>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $pi; ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($pi),15); ?>
</a>
</td>
<td style="font-size:14px;">
<div id="pif">
<?php
//if($postatpk==4){
if($piform<>""){ ?>
<a href="upload/<?php echo $piform; ?>" target="_blank" style="text-decoration:none; color:#359DD9;">Download</a><br>
<!--&nbsp; <a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Change</a><br>-->
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($piform); ?>" class="easyui-tooltip">
<font style="color:rgba(0, 0, 0, 0.38)"><?php echo truncate(TRIM($piform),15); ?>
</a>
<?php } else { ?>
<!--<a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Upload</a>-->
<?php }
//} ?>
</div>
</td>
</tr>
</table>
<table id="tab2" style="width:90%; float: left;">
<tr>
<td  colspan="6" style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px; color: rgba(0, 0, 0, 0.6);">Additional details</td>
</tr>
<tr>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Bank surcharge</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:200px;">Other surcharge</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Notes</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Payment terms</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:150px;">Payment due date</td>
<td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;  width:250px;">Remarks</td>
</tr>
<tr>
<td>
<div id="ccbg2" style="display:none;">
<form id="formg2" method="post">
<input type="hidden" name="popkg2" id="popkg2" value="<?php echo $po; ?>" size="8">
<input  placeholder="Enter amount..." class="easyui-validatebox" id="surcharge1" name="surcharge1"
value="<?php if($dt2['surcharge']=="0.00"){ } else { echo TRIM($dt2['surcharge']); } ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
<div id="ccb2g2" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($surcharge1); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($surcharge1),15); ?>
</a>
</div>  
</td>
<td>
<div id="ccbg2b" style="display:none;">
<form id="formg2b" method="post">
<input type="hidden" name="popkg2b" id="popkg2b" value="<?php echo $po; ?>" size="8">
<input  placeholder="Enter amount..." class="easyui-validatebox" id="surcharge2" name="surcharge2"
value="<?php if($dt2['surcharge2']=="0.00"){ } else { echo TRIM($dt2['surcharge2']); } ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
 -
</form>
</div>
<div id="ccb2g2b" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($surcharge2); ?>" class="easyui-tooltip">
<?php echo truncate(TRIM($surcharge2),15); ?>
</a>
</div>
</td>
<td>
<div id="ccbg2c" style="display:none;">
<form id="formg2c" method="post">
<input type="hidden" name="popkg2c" id="popkg2c" value="<?php echo $po; ?>" size="8">
<input  placeholder="Notes..." class="easyui-validatebox" id="note" name="note" value="<?php echo TRIM($note); ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
<div id="ccb2g2c" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($note); ?>" class="easyui-tooltip">
<?php
if($note<>"") { $note=$note; }
else { $note="---"; }
?>
<?php echo truncate(TRIM($note),15); ?>
</a>
</div>
</td>
<td style="font-size:14px; font-weight:bold;">
<div id="ccbg" style="display:none;">
<form id="formg" method="post">
<input type="hidden" name="popk1g" id="popk1g" value="<?php echo $po; ?>" size="8">
<input  placeholder="Terms" class="easyui-validatebox" id="payterm" name="payterm" value="<?php echo TRIM($potop); ?>" style="width:150px; height:28px; border-color:#d3d3d3;" >
</form>
</div>
<div id="ccb2g" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo TRIM($potop); ?>" class="easyui-tooltip">
<?php
if($potop<>"") { $potop=$potop; }
else { $potop="---"; }
?>
<?php echo truncate(TRIM($potop),15); ?>
</a>
</div>
</td>
<td>
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
<!--<label style="width:auto;font-family: 'Arial'; font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px;">Date format must be in YYYY-MM-DD</label>-->
<div id="ccbgp2">
<?php if($paydate=="" || $paydate=='0000-00-00'){
  echo "---";
} else {
  echo tgl($paydate);
} ?>
</div>
</td>
<td>  
<div id="ccbi2" style="display:none;">
<form id="formi2" method="post">
<input type="hidden" name="popki2" id="popki2" value="<?php echo $po; ?>" size="8">
<textarea class="easyui-validatebox" id="rmk" name="rmk" style="width:175px; height:45px; border-color:#d3d3d3;" placeholder="Notes...">
<?php echo TRIM($ket); ?></textarea>
</form>
</div>
<div id="ccbi2b" style="margin-top:0px;">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $ket; ?>" class="easyui-tooltip">
<?php
if($ket<>"") { $ket=$ket; }
else { $ket="---"; }
?>
<?php echo truncate(TRIM($ket),30); ?>
</a>
</div>
</td>
</tr>
</table>
<!--</div>-->
<!--<div id="menu" onclick="$('#menu').fadeOut();"  style="display:none;">
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('saveRow');" style="color: #FFFFFF; text-decoration: none;"> Save </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('cancelRow');" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')" style="color: #FFFFFF; text-decoration: none;">Delete </a></div>-->
<!--</div>-->
<!--<div id="tabel1" style="top:400px;">-->
<table id="tab3" style="width:70%; float: left;">
<tr>
<td style="font-style:normal;font-weight:700;font-size: 16px;line-height: 20px; color: rgba(0, 0, 0, 0.6);">Purchasing details</td>
</tr>
</table>
</div>
<div id="container-cari" style="top:340px;width:250px;left:30px;">
<div id="frame-cari" style="width:218px;">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
<input id="caria" placeholder="Search..." class="input" onkeyup="Search();" style="width:185px;">
</div>
<img src="css/images/close.png" id="close" plain="true" onclick="tutup();" width="15px" height="15px" style="margin-left:225px;display:none;">
<img src="css/images/reload1.png" width="20px" height="20px"  onclick="$('#dg').datagrid('reload');" id="reload" style="margin-left:250px;margin-top:5px;">
<div id="delsts" style="<?php echo $styledel; ?>"><?php echo $dt3['tdelsts']; ?>&nbsp;item delete from PO</div>
</div>
<div id="tabel1" style="top:380px;">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_detpomd.php?po=<?php echo $po; ?>" idField="rkbpk" toolbar="#tb" striped="true"
pagination="false" singleSelected="true" rownumbers="false" collapsible="true" method="post"
data-options="" multiSort="true">
<thead>
<tr>
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
<th field="pocons" width="90" sortable="true" editor="text">Total PO</th>
<th field="qrs" width="90" sortable="true" editor="text">PPS</th>
<th field="price" width="90" sortable="true" editor="text">Price</th>
<th field="total" width="90" sortable="true">Total</th>
<!--<th field="piqty" width="90" sortable="true">PI qty</th>-->
<!--<th data-options="field:'piunit'">Units</th>-->
<!--<th field="piprice2" width="90" sortable="true">PI price</th>-->
<!--<th field="total2" width="95" sortable="true">PI Total</th>-->
<!--<th field="prodes" width="125" sortable="true">Product Description</th>-->
</tr>
</thead>
</table>


<div id="dialog-form" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:true,modal:true,closable:false"
style="width:425px;height:275px;padding:5px 5px;display:none;top:15px">
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

<div id="dialog-formb" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:true,modal:true,closable:false"
style="width:425px;height:200px;padding:5px 5px;display:none;top:15px">
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