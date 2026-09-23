<?php
//include "action/sinkron3.php";
/*include "email/po.php";
include "email/rev2.php";*/
//include "email/pay.php";
?>
<style>
.header {
display: flex;
flex-direction: row;
justify-content: flex-end;
align-items: flex-start;
padding: 16px;
gap: 24px;
position: absolute;
width: 100%;
height: 48px;
left: 0px;
top: 58px;
background: #359DD9;
box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
}
.contenta {
  padding: 16px;
}
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}
.sticky + .contenta {
  padding-top: 102px;
}
</style>
<script type="text/javascript">
var url;

/*menu*/
function menu(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#myHeader').show();
	} else {
	$('#myHeader').hide();
	//$('#dg').datagrid('clearSelections');
	}
}

/*search*/
function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
srcsts();
 srcsupp();
 srccolor();
}

function Searcha(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari3: $('#cari3').val(),
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
	$('#newest').show();
$('#oldest').hide();
$('#recently').hide();
 }

function Searchb(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari4: $('#cari4').val(),
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
$('#newest').hide();
$('#oldest').show();
$('#recently').hide();
}

function Searchc(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari4b: $('#cari4b').val(),
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
$('#newest').hide();
$('#oldest').hide();
$('#recently').show();
}

function Search4(){
    $('#kolom1').datagrid('load',{
    cari6: $('#cari6').val()
    });
}


function revised(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
  if(row.postatpk==4){
   $.messager.alert('Warning','PO data status purchased','warning');
  } else {
		$('#dialog-form').dialog('open').dialog('setTitle','');
		$('#form').form('load',row);
	}
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

function saverev(){  
var string = $("#form").serialize();
	 $('#form').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=revised",
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
			$('#dialog-form').dialog('close');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
   $('#dg').datagrid('clearSelections');
			$('#dg').datagrid('reload');
		}
	 });
}

function canrev(){
$('#dialog-form').dialog('close');
$('#dg').datagrid('clearSelections');
}

function cancel(){  
	var row2a = $('#dg').datagrid('getSelected');  
	if (row2a){
  if(row2a.postatpk==4){
   $.messager.alert('Warning','PO data status purchased','warning');
  } else {
		$.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=cancel",
					data	: 'popk3='+row2a.popk,
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
	}
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}
/*count*/
/*function count_row() {
	$('#menu').show();
    var count = $('#dg').datagrid('getChecked').length;
    if (count) {
        document.getElementById("countp").innerHTML = count +" items selected";
    } else {
		document.getElementById("countp").innerHTML = 0 +" items selected";
		}
	}*/
    
 /*function tot1() {
	var totmat = JSON.stringify($('#dg').datagrid('getData').total);
	if (totmat) {
	document.getElementById("tot1").innerHTML = "New requests ("+totmat+")";
	}
}*/

/*view*/
function update(){
var rows = $('#dg').datagrid('getSelected');
	if(rows){
  var cari1=document.getElementById('cari1').value;
  var cari2=document.getElementById('cari2').value;
  var cari5=document.getElementById('cari5').value;
   var cari6=document.getElementById('cari6').value;
  /*if(rows.postatpk==3){
   $.messager.alert('Warning','PO data status cancel','warning');
  } else {*/
      //update tpo2
  $.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=tpo2&po="+rows.popk,
					data	: 'popk3='+rows.popk,
					success	: function(data){
      window.location.href="?hal=detpo&x=1&po=" +rows.popk+"&cari1="+cari1+"&cari2="+cari2+"&cari5="+cari5+"&cari6="+cari6;
     }
				});
  /*}*/
 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

// function update2(){
// var rows = $('#dg').datagrid('getSelected');
// 	if(rows){
//     /*if(rows.postatpk==3){
//    $.messager.alert('Warning','PO data status cancel','warning');
//   } else {*/
// 	url = "?hal=detpo&x=1&po=" +rows.popk;
//   window.open(url);
// 	//window.location.href="?hal=qty&ord=" +row.ordpk;
// 	/*}*/
//  } else {
// 		$.messager.alert('Warning','No PO data selected','warning');
// 	}
// }

function update2(){
var rows = $('#dg').datagrid('getSelected');
	if(rows){
		$.ajax({
					type	: "POST",
					url	: "action/simpan.php?x=tpo2&po="+rows.popk,
					data	: 'popk3='+rows.popk,
					success	: function(data){
    //   window.location.href="?hal=detpo&x=1&po=" +rows.popk+"&cari1="+cari1+"&cari2="+cari2+"&cari5="+cari5+"&cari6="+cari6;
		$('#dg').datagrid('reload');
		url = "?hal=detpo&x=1&po=" +rows.popk;
		window.open(url);
     }
	 });

 } else {
		$.messager.alert('Warning','No PO data selected','warning');
	}
}

//DROPDOWN
/*function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}*/
function toggle(source) {
   checkboxes = document.getElementsByName('ck');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

function cheka1(){               
			var c1 = document.getElementById("chek1");
				if (c1.checked) {
        $('#dg').datagrid('showColumn', 'funm');
			}else {
											$('#dg').datagrid('hideColumn', 'funm');
			}
				}
				
			 function cheka2(){               
			var c2 = document.getElementById("chek2");
				if (c2.checked) {
        $('#dg').datagrid('showColumn', 'status');
			}else {
											$('#dg').datagrid('hideColumn', 'status');
			}
				}
				
				function cheka3(){               
			var c3 = document.getElementById("chek3");
				if (c3.checked) {
        $('#dg').datagrid('showColumn', 'pono');
			}else {
											$('#dg').datagrid('hideColumn', 'pono');
			}
				}
				
				function cheka4(){               
			var c4 = document.getElementById("chek4");
				if (c4.checked) {
        $('#dg').datagrid('showColumn', 'tglpo2');
			}else {
											$('#dg').datagrid('hideColumn', 'tglpo2');
			}
				}
				
				function cheka5(){               
			var c5 = document.getElementById("chek5");
				if (c5.checked) {
        $('#dg').datagrid('showColumn', 'brg');
			}else {
											$('#dg').datagrid('hideColumn', 'brg');
			}
				}
				
				function cheka6(){               
			var c6 = document.getElementById("chek6");
				if (c6.checked) {
        $('#dg').datagrid('showColumn', 'supnm');
			}else {
											$('#dg').datagrid('hideColumn', 'supnm');
			}
				}
				
				function cheka7(){               
			var c7 = document.getElementById("chek7");
				if (c7.checked) {
        $('#dg').datagrid('showColumn', 'pocons');
			}else {
											$('#dg').datagrid('hideColumn', 'pocons');
			}
				}
				
				function cheka8(){               
			var c8 = document.getElementById("chek8");
				if (c8.checked) {
        $('#dg').datagrid('showColumn', 'unit');
			}else {
											$('#dg').datagrid('hideColumn', 'unit');
			}
				}
				
				function cheka9(){               
			var c9 = document.getElementById("chek9");
				if (c9.checked) {
        $('#dg').datagrid('showColumn', 'colname');
			}else {
											$('#dg').datagrid('hideColumn', 'colname');
			}
				}
    function cheka10(){               
			var c10 = document.getElementById("chek10");
				if (c10.checked) {
        $('#dg').datagrid('showColumn', 'price');
			}else {
											$('#dg').datagrid('hideColumn', 'price');
			}
				}
    function cheka11(){               
			var c11 = document.getElementById("chek11");
				if (c11.checked) {
        $('#dg').datagrid('showColumn', 'tgljam2');
			}else {
											$('#dg').datagrid('hideColumn', 'tgljam2');
			}
				}
     function cheka12(){               
			var c12 = document.getElementById("chek12");
				if (c12.checked) {
        $('#dg').datagrid('showColumn', 'tgldel2');
			}else {
											$('#dg').datagrid('hideColumn', 'tgldel2');
			}
				}
				 function cheka13(){               
			var c13 = document.getElementById("chek13");
				if (c13.checked) {
        $('#dg').datagrid('showColumn', 'etd2');
			}else {
											$('#dg').datagrid('hideColumn', 'etd2');
			}
				}
    
/*filter*/
function Search5(){
    $('#status').datagrid('load',{
    carispl: $('#carispl').val()
    });
	$('#supp2').datagrid('load',{
    carispl: $('#carispl').val()
    });
	$('#color2').datagrid('load',{
    carispl: $('#carispl').val()
    });
}

$(function(){
    $('#status').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#status').datagrid('getRows')[index].status;
				    document.getElementById("filtera"+index).value = ckk;
								document.getElementById("idxa"+index).value = index;
								document.getElementById("talla"+index).value = 1;
								$('#filtera'+index).show();
								$('#crossa'+index).show();
								$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filtera"+index).value ="";
								$('#filtera'+index).hide();
								$('#crossa'+index).hide();
								$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				document.getElementById("talla"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function unceka(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxa"+c).value;
$('#status').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filtera"+c).value ="";
document.getElementById("talla"+c).value = 0;
$('#filtera'+c).hide();
$('#crossa'+c).hide();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
document.getElementById("idxa"+c).value="";
}
}

$(function(){
    $('#supp2').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#supp2').datagrid('getRows')[index].supnm;
				    document.getElementById("filterb"+index).value = ckk;
								$('#filterb'+index).show();
								$('#filterb'+index).show();
								$('#crossb'+index).show();
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
								document.getElementById("idxb"+index).value = index;
								document.getElementById("tallb"+index).value = 1;
								tall();
								$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filterb"+index).value ="";
								$('#filterb'+index).hide();
								$('#crossb'+index).hide();
								$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				document.getElementById("tallb"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekb(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxb"+c).value;
$('#supnm').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterb"+c).value ="";
document.getElementById("tallb"+c).value = 0;
$('#filterb'+c).hide();
$('#crossb'+c).hide();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
document.getElementById("idxb"+c).value="";
}
}

$(function(){
    $('#color2').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#color2').datagrid('getRows')[index].colname;
				    document.getElementById("filterc"+index).value = ckk;
								$('#filterc'+index).show();
								$('#filterc'+index).show();
								$('#crossc'+index).show();
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
								document.getElementById("idxc"+index).value = index;
								document.getElementById("tallc"+index).value = 1;
								tall();
								$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filterc"+index).value ="";
								$('#filterc'+index).hide();
								$('#crossc'+index).hide();
								$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
				document.getElementById("tallc"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekc(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxc"+c).value;
$('#color2').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterc"+c).value ="";
document.getElementById("tallc"+c).value = 0;
$('#filterc'+c).hide();
$('#crossc'+c).hide();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
				});
document.getElementById("idxc"+c).value="";
}
}

/*
function cekstatus(){
$('#tabel1').css("margin-top","50px");
var ck = $('#status').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#status').datagrid('getRows')[i];
if ($.inArray(row,ck) >= 0){
    document.getElementById("filtera"+i).value = ck[i].status;
				$('#filtera'+i).show();
				$('#crossa'+i).show();
document.getElementById("talla"+i).value = 1;
}
if ($.inArray(row,ck) < 0){
    document.getElementById("filtera"+i).value ="";
				$('#filtera'+i).hide();
				$('#crossa'+i).hide();
document.getElementById("talla"+i).value = 0;
}
}
tall();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
var total = document.getElementById("total").value;
if(total==0){
$('#tabel1').css("margin-top","");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
} else {
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}

function ceksupp(){
$('#tabel1').css("margin-top","50px");
var ck = $('#supp2').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#supp2').datagrid('getRows')[i];
if ($.inArray(row,ck) >= 0){
    document.getElementById("filterb"+i).value = ck[i].supnm;
				$('#filterb'+i).show();
				$('#crossb'+i).show();
document.getElementById("tallb"+i).value = 1;
}
if ($.inArray(row,ck) < 0){
    document.getElementById("filterb"+i).value ="";
				$('#filterb'+i).hide();
				$('#crossb'+i).hide();
document.getElementById("tallb"+i).value = 0;
}
}
tall();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
var total = document.getElementById("total").value;
if(total==0){
$('#tabel1').css("margin-top","");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
} else {
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}

function cekcol(){
$('#tabel1').css("margin-top","50px");
var ck = $('#color2').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#color2').datagrid('getRows')[i];
if ($.inArray(row,ck) >= 0){
    document.getElementById("filterc"+i).value = ck[i].colname;
				$('#filterc'+i).show();
				$('#crossc'+i).show();
document.getElementById("tallc"+i).value = 1;
}
if ($.inArray(row,ck) < 0){
    document.getElementById("filterc"+i).value ="";
				$('#filterc'+i).hide();
				$('#crossc'+i).hide();
document.getElementById("tallc"+i).value = 0;
}
}
tall();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
var total = document.getElementById("total").value;
if(total==0){
$('#tabel1').css("margin-top","");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
} else {
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}
  
function unceka(cross){
var total = document.getElementById("total").value;
if (total==1) {
reset();
} else {
var c = cross;
$('#status').datagrid('unselectRow',c);

document.getElementById("filtera"+c).value ="";
$('#filtera'+c).hide();
$('#crossa'+c).hide();
document.getElementById("talla"+c).value = 0;

tall();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
}
}

function uncekb(cross){
var total = document.getElementById("total").value;
if (total==1) {
reset();
} else {
var c = cross;
$('#supp2').datagrid('unselectRow',c);

document.getElementById("filterb"+c).value ="";
$('#filterb'+c).hide();
$('#crossb'+c).hide();
document.getElementById("tallb"+c).value = 0;

tall();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
}
}

function uncekc(cross){
var total = document.getElementById("total").value;
if (total==1) {
reset();
} else {
var c = cross;
$('#color2').datagrid('unselectRow',c);

document.getElementById("filterc"+c).value ="";
$('#filterc'+c).hide();
$('#crossc'+c).hide();
document.getElementById("tallc"+c).value = 0;

tall();
$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val()
});
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
}
}*/

function totrec() {
var tcount= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = tcount+" result";
}

/*function myFunc(total, num) {
return total - num;
}*/

function tall(){
/*for(var i=0; i<=5; i++){
const ck = [document.getElementById('tall'+i).value];
var tall = ck;
var tall = ck.reduce(myFunc);
alert(ck);
document.getElementById('tall').innerHTML = +ck;
document.getElementById('fltr1').innerHTML = "Search filters("+ck.reduce(myFunc)+")";
}*/
var cka0 = document.getElementById("talla0").value;
var cka1 = document.getElementById("talla1").value;
var cka2 = document.getElementById("talla2").value;
var ckb0 = document.getElementById("tallb0").value;
var ckb1 = document.getElementById("tallb1").value;
var ckc0 = document.getElementById("tallc0").value;
var ckc1 = document.getElementById("tallc1").value;
var tall = parseInt(cka0)+parseInt(cka1)+parseInt(cka2)+parseInt(ckb0)+parseInt(ckb1)+parseInt(ckc0)+parseInt(ckc1);
//alert(tall);
if(tall>=1){
document.getElementById('total').value = tall;
document.getElementById('fltr1').innerHTML = "Search filters("+tall+")";
}
else {
document.getElementById('total').value = tall;
document.getElementById('fltr1').innerHTML = "Search filters(0)";
}
}

function reset(){
//var total = document.getElementById("total").value;
document.getElementById("carispl").value = "";
Search5();
document.getElementById('total').value = 0;
$('#status').datagrid('clearSelections');
$('#supp2').datagrid('clearSelections');
$('#color2').datagrid('clearSelections');
$('#tabel1').css("margin-top","");
$(".dropdown2-content").slideUp("fast");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
for(var i=0; i<=2; i++){
$('#filtera'+i).hide();
$('#crossa'+i).hide();
document.getElementById('filtera'+i).value = '';
document.getElementById('talla'+i).value = 0;

$('#filterb'+i).hide();
$('#crossb'+i).hide();
document.getElementById('filterb'+i).value = '';
document.getElementById('tallb'+i).value = 0;

$('#filterc'+i).hide();
$('#crossc'+i).hide();
document.getElementById('filterc'+i).value = '';
document.getElementById('tallc'+i).value = 0;

$('#dg').datagrid('load',{
sts0: $('#filtera0').val(),
sts1: $('#filtera1').val(),
sts2: $('#filtera2').val(),
supp0: $('#filterb0').val(),
supp1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val()
});
}
}

/*disheader*/
function testku() {
var dg = $('#status');
var dg2= $('#supp2');
var dg3= $('#color2');
dg.datagrid();
dg2.datagrid();
dg3.datagrid();
dg.datagrid();
dg2.datagrid();
dg3.datagrid();
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg3.datagrid('getPanel').find('div.datagrid-header').css('display','none');
$('#status').datagrid('getPanel').addClass('lines-no');
$('#supp2').datagrid('getPanel').addClass('lines-no');
$('#color2').datagrid('getPanel').addClass('lines-no');
$('#status').datagrid('getPanel').addClass('lines-no2');
$('#supp2').datagrid('getPanel').addClass('lines-no2');
$('#color2').datagrid('getPanel').addClass('lines-no2');
$('#status').datagrid('getPanel').addClass('col');
$('#supp2').datagrid('getPanel').addClass('col');
$('#color2').datagrid('getPanel').addClass('col');
}

$.extend($.fn.datagrid.methods, {
    lockColumn: function(jq, field){
        return jq.each(function(){
            var p = $('#kolom1').datagrid('getPanel');    // get the panel
            var cell = p.find('div.datagrid-header td[field=' + field + '] > div.datagrid-cell'); // get the cell
												cell.resizable({disabled:true}); // disable resize
        });
    }
});

function testku2() {
$('#kolom1').datagrid('getPanel').addClass('col');
$('#kolom1').datagrid('getPanel').addClass('lines-no');
$('#kolom1').datagrid('getPanel').addClass('lines-no2');
$('#kolom1').datagrid('lockColumn', 'kolomnm');
$('#kolom1').datagrid('lockColumn', 'ck');
//$('#kolom1').datagrid('getPanel').find('div.datagrid-header input[type=checkbox]').css('outline','2px solid deeppink');
}

function expand() {
const togglePassword2a = document.querySelector("#togglePassword2a");
const togglePassword2b = document.querySelector("#togglePassword2b");
const togglePassword2c = document.querySelector("#togglePassword2c");

     togglePassword2a.addEventListener("click", function () {
					test1 = $('#test1').val();
						test2 = $('#test2').val();
				if (test1=="" && test2=="") {
      $('.tabela').hide();
						document.getElementById('test1').value=1;
						$(".prodesa").css("margin-top","-15px");
						$(".tabelb").css("margin-top","-90px");
						$(".tabelc").css("margin-top","10px");
    } else if (test1==1 && test2==1) {
									$(".tabelb").css("margin-top","-45px");
       $(".tabelc").css("margin-top","55px");
							$('.tabela').show();
								$(".prodesa").css("margin-top","90px");
								document.getElementById('test1').value="";
    }else if (test1=="" && test2==1) {
							$('.tabela').hide();
							$(".prodesa").css("margin-top","-15px");
							$(".tabelb").css("margin-top","-70px");
							document.getElementById('test1').value=1;
							 $(".tabelc").css("margin-top","-50px");
    }else if (test1==1 && test2=="") {
							$('.tabela').show();
							$(".byr").css("margin-top","20px");
							$(".prodesa").css("margin-top","90px");
							$(".seasona").css("margin-top","55px");
							$(".tabelb").css("margin-top","15px");
							document.getElementById('test1').value="";
							 $(".tabelc").css("margin-top","115px");
    }
				else {
					 $('.tabela').show();
						document.getElementById('test1').value="";
						$(".prodesa").css("margin-top","25px");
						$(".tabelb").css("margin-top","-40px");
						$(".tabelc").css("margin-top","55px");
				}
				this.classList.toggle("bi-eye2");
				});
					
					togglePassword2b.addEventListener("click", function () {
						test1 = $('#test1').val();
						test2 = $('#test2').val();
     if (test1=="" && test2=="") {
      $('.tabelb').hide();
						document.getElementById('test2').value=1;
      $(".prodesa").css("margin-top","85px");
						$(".seasona").css("margin-top","-5px");
						$(".tabelc").css("margin-top","45px");
    } else if (test1==1 && test2==1) {
       $(".tabelc").css("margin-top","25px");
							$('.tabelb').show();
								$(".seasona").css("margin-top","65px");
								document.getElementById('test2').value="";
    }else if (test1==1 && test2=="") {
     $(".tabelb").css("margin-top","-85px");
							$('.tabelb').hide();
							$(".seasona").css("margin-top","-10px");
							document.getElementById('test2').value=1;
							 $(".tabelc").css("margin-top","-60px");
    }else if (test1=="" && test2==1) {
     $(".prodesa").css("margin-top","85px");
     $(".tabelb").css("margin-top","10px");
							$('.tabelb').show();
							$(".seasona").css("margin-top","55px");
							document.getElementById('test2').value="";
							 $(".tabelc").css("margin-top","105px");
    }
				else {
					 $('.tabelb').show();
						document.getElementById('test2').value="";
						$(".seasona").css("margin-top","30px");
						$(".tabelc").css("margin-top","55px");
				}
				this.classList.toggle("bi-eye2");
        });
									 togglePassword2c.addEventListener("click", function () {
            $('.tabelc').toggle();
            this.classList.toggle("bi-eye2");
        });
}

function tnew(){
var tcount= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("twait").innerHTML = "("+tcount+")";
$('#twait').show();
$('#twait1').hide();

if(tcount>0){
$("#ntwait").show();
} else {
$("#ntwait").hide(); 
}
}

function filterFunction1() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("cari6a");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown2");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

$(function(){
 Search();
 srcsts();
 srcsupp();
 srccolor();

});

function srcsts(){
	var thn=$('#cari6').val();
	$('#status').datagrid('load', 'view/get_data2.php?dt=wait1&thn='+thn);
  }

  function srcsupp(){
	var thn=$('#cari6').val();
	$('#supp2').datagrid('load', 'view/get_data2.php?dt=wait2&thn='+thn);
  }

  function srccolor(){
	var thn=$('#cari6').val();
	$('#color2').datagrid('load', 'view/get_data2.php?dt=wait3&thn='+thn);
  }

function formatku2(val,row){
  if (row.tpo2>0) {
  return '<div style="margin-left:-10px;"><img src="css/images/notif2.png" width="3px" height="30px">'+
          '<div style="margin-top:-25px;margin-left:-10px;"><center>'+val+'</center></div>';
  } else {
    return val;
  }
}
</script>

<?php
if($_GET['cari2a']>0){?>
 <script type="text/javascript">
$.fn.combobox.defaults.onLoadSuccess = function(items){
	if (items.length){
		var opts = $(this).combobox('options');
		$(this).combobox('select', items[0][opts.valueField]);
	}
};
</script>
<?php } ?>

<input type="hidden" name="test1" id="test1">
<input type="hidden" name="test2" id="test2">
<input type="hidden" name="total" id="total"  value="0" size="5">
<input type="hidden" name="pur" id="pur" value="<?php echo $_SESSION['login']; ?>" size="8">
<?php //$ord=$_GET['ord']; ?>

<div class="contenta">
<div id="frame-utama-cari" style="width:618px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
<input id="cari1" placeholder="Search..." class="input" onkeyup="Search();" value="<?php echo $_GET['cari1a']; ?>">
</div>
</div>
<?php
if($_SESSION['mat']==1) { $fdt="fu1"; }
else { $fdt="fu2"; }
?>
<!--<input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox"
data-options="valueField:'fupk',textField:'funm',url:'view/get_data.php?dt=fu&cari2a=<?php echo $_GET['cari2a']; ?>',prompt:'Handle',onChange:Search,limitToList:'true'">-->
<select class="easyui-combobox" id="cari2"
data-options="editable:false,prompt:'Handle',limitToList:'true',onChange:Search" style="width:140px;" >
<?php
$sqla=mysqli_query($koneksi,"select * FROM fu where aktif='0' and fupk='$_GET[cari2a]' order by funm asc");
$dta=mysqli_fetch_array($sqla)
?>
<option value="<?php echo $dta['fupk']; ?>"><?php echo $dta['funm']; ?></option>
<option value="">ALL HANDLE</option>
<?php
$sql=mysqli_query($koneksi,"select * FROM fu where aktif='0' order by funm asc");
while($dt=mysqli_fetch_array($sql)){
?>
<option value="<?php echo $dt['fupk']; ?>"><?php echo $dt['funm']; ?></option>
<?php } ?>
</select>
<select class="easyui-combobox" id="cari5"
data-options="editable:false,prompt:'Month',limitToList:'true',onChange:Search" style="width:150px;" >
<?php
$bln=array(1=>"January","February","March","April","May",
"June","July","August","September","October",
"November","Desember");
$bln1=date('m');
if($bln1<=9){
$bln2 = substr($bln1,1,1);
}
?>
<option value="<?php echo $_GET['cari5a']; ?>"><?php echo $bln[$_GET['cari5a']]; ?></option>
<option value="">All Month</option>
<?php
for($bulan=1; $bulan<=12; $bulan++){
?>
<option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
<?php } ?>
</select>
<?php $thna=date('Y'); ?>
<select class="easyui-combobox" id="cari6"
data-options="editable:false, panelHeight:'auto',onChange:Search,prompt:'<?php echo $thna; ?>'" style="width:100px;" >
<?php
if($_GET['cari6a']<>$thna){ ?>
<option value="<?php echo $_GET['cari6a']; ?>"><?php echo $_GET['cari6a']; ?></option>
<?php }
for ($i=date('Y'); $i>=date('Y')-2 ; $i-=1){
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>
<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">
</a>
</div>
<div id="frame-filter" style="margin-left:-5%;">
<div id="frame-filter-fields">    
<div class="fields"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();" style="text-decoration:none; color: #AFAFAF;">Fields</a></div>
<div class="all"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();" style="text-decoration:none; color: #000000;">All</a></div>
<div id="panah2">
<div class="dropdown1">
  <input onclick="myFunction1c(); testku2();" type="image" src="css/images/Polygon.png" class="dropbtn1" style="filter:brightness(0%);" alt="Submit button" width="10px" height="10px">
  <!--<button onclick="myFunction()" class="dropbtn"></button>-->
  <div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:500px;">
			<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="cari6a" placeholder="Search..." class="input" onkeyup="filterFunction1();">
				</div>
				</div>
			<div style="margin-top:50px;margin-left:-5px;display: inline-block; text-align: left;">
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div><b>Select All</b></div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="all" value="all" id="chek0" onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka7(); cheka8(); cheka9(); cheka10(); cheka11(); cheka12(); cheka13();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>From</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="ck" id="chek1" onclick="cheka1();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Status</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek2" onclick="cheka2();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>PO No</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek3" onclick="cheka3();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>PO Date</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek4" onclick="cheka4();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Item</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek5" onclick="cheka5();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Supplier</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="ck" id="chek6" onclick="cheka6();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Qty</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek7" onclick="cheka7();" checked></div></a>
	     <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Unit</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek8" onclick="cheka8();" checked></div></a>			
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Color</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek9" onclick="cheka9();" checked></div></a>
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Price</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek10" onclick="cheka10();" checked></div></a>
		    <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Req Date</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek11" onclick="cheka11();" checked></div></a>
	     <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Req Del</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek12" onclick="cheka12();" checked></div></a>			
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>ETD</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek13" onclick="cheka13();" checked></div></a>
			</div>
			<!--<div id="tabel" class="tabeld" style="width:200px;height:300px;border:0px solid;margin-top:-150px;margin-left:-20px;">
			<table id="kolom1" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
				url="view/get_data.php?dt=kolom1" toolbar="#tb" striped="false"
				rownumbers="false"  multiple="true" collapsible="false" fitColumns="false" method="post" data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="kolomnm" width="165" sortable="false" >Select All</th>
			<th field="ck" width="40"><input type="checkbox" name="chekk" onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka7(); cheka8(); cheka9(); cheka10(); cheka11();" id="chekk2" checked></th>
			</tr>
			</thead>
			</table>
			</div>-->
  </div>
</div>
</div>
</div>
<div id="frame-filter-newest">
<div class="dropdwn">	
<input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button" class="dropbtn">
<div id="myDropdown" class="dropdwn-content" style="height:120px;">
<input type="hidden" id="cari3" value="1" name="cari3">
<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Searcha();">Newest entry</a></div>
<input type="hidden" id="cari4" value="1" name="cari4">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Searchb();">Oldest entry</a></div>
<input type="hidden" id="cari4b" value="1" name="cari4b">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Searchc();">Recently modified</a></div>
</div>
</div>
<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
<div id="newest" class="newest" onclick="myFunction();">Newest</div>
<div id="oldest" class="newest" onclick="myFunction();" style="display:none;">Oldest</div>
<div id="recently" class="newest" onclick="myFunction();" style="display:none;">Recently</div>
</a>
</div>
<div id="frame-filter2">
<div id="dropdown2">
<input onclick="myFunction1d(); testku();" type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px" alt="Submit button">
<div class="filter"><a href="javascript:void(0);" style="text-decoration:none; color: #000000;" onclick="myFunction1d(); testku();">Filter</a></div>
<div id="myDropdown3" class=dropdown2-content style="width:220px;height:395px;margin-right:-3px;">
				<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
				</div>
				</div>
					<div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">
						Status
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
						<i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i>
						</div>
						</div>
				<div id="tabel" class="tabela" onmousemove="totrec();" style="width:200px;height:auto;border:0px solid;margin-top:-120px;margin-left:-20px;">
			 <table id="status" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="popk"
				 toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="status" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>
				
   		<div id="byr1a" class="prodesa" style="margin-top:85px;margin-left:15px;">
						<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
					Supplier
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
						<i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i></div>
						</div>     				
								<div id="tabel" class="tabelb" onmousemove="totrec();" style="width:200px;height:auto;margin-top:15px;margin-left:-20px;">
			 <table id="supp2" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="popk"
				 toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="supnm" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>
								
								<div id="byr1a"  class="seasona" style="margin-top:60px;margin-left:15px;">
				<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
				Color
								<div style="text-align:right;margin-top:-15px;margin-right:25px;" id="img3">
											<i class="bi bi-eye-slash-fill" id="togglePassword2c" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i></div>
									</div>
								<div id="tabel" class="tabelc" onmousemove="totrec();" style="width:200px;height:auto;margin-top:115px;margin-left:-20px;">
			 <table id="color2" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="popk"
			 toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="colname" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>

</div>
</div>
</div>
</div>
<div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%;">
<div id="fltr1" style="margin-top:-35px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr2" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr3" style="width:100px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;display:none;" onclick="reset();">
<a href="javascript:void(0)" style="text-decoration:none; color: #359DD9;">Reset All</a></div>
<div style="margin-left:150px;margin-top:-20px;">
<!--<div style="width:20px; height:auto;" id="cross" class="cross" value="<?php //echo $i; ?>" onclick="uncek(<?php //echo $i; ?>);">
&nbsp;&#215;&nbsp;
</div>-->
<!--A-->
<?php for($i=0; $i<=2; $i++){ ?>
<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross" onclick="unceka(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
<?php } ?>
<!--B-->
<?php for($j=0; $j<=1; $j++){ ?>
<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross" onclick="uncekb(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
<?php } ?>
<!--C-->
<?php for($k=0; $k<=1; $k++){ ?>
<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross" onclick="uncekc(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="tallc<?php echo $k; ?>" value="0" size="5">
<?php } ?>
<!--<input type="button" id="filter1" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross1" class="cross" onclick="UnSearchsupp(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter2" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross2" class="cross" onclick="UnSearchcolor(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter3" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross3" class="cross" onclick="UnSearchspec(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>-->

</div>
</div>

<div id="tabel1" onclick="menu();" ondblclick="update(); $('#myHeader').hide();" onmousemove="" style="">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
url="view/get_wait.php" idField="popk" toolbar="#tb" striped="true"
pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="false" method="post"
data-options="multiSort:true,remoteSort:false">
<thead>
<tr>
<!--<th field="no" width="55" sortable="false" formatter="formatku2">No</th>-->
<th field="funm" width="80" sortable="true" formatter="formatku2">From</th>
<th field="byrnm" width="90" sortable="true">Buyer</th>
<th field="status" width="90" sortable="true">Status</th>
<th field="pono" width="90" sortable="true">PO no.</th>
<th field="tglpo2" width="80" sortable="true">PO Date</th>
<th field="brg" width="155" sortable="true">Item</th>
<th field="supnm2" width="135" sortable="true">Supplier</th>
<th field="pocons" width="90" sortable="true">Total PO</th>
<th field="unit" width="80" sortable="true">Units</th>
<th field="colname" width="80" sortable="true">Color</th>
<th field="price" width="100" sortable="true">Total Price</th>
<th field="tgljam2" width="100" sortable="true">Req Date</th>
<th field="tgldel2" width="80" sortable="true">Req Del</th>
<th field="etd2" width="80" sortable="true">ETD</th>
</tr>
</thead>
</table>
<br>
</div>
</div>

<div class="header" id="myHeader" onclick=""  style="display:none;">
<!--<div id="countp" style="left:0px;font-color:#ffffff;"></div>-->
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="edit2();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>-->
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="update();" oncontextmenu="update2();" title="if right click automatically new tab" class="easyui-tooltip" style="color: #FFFFFF; text-decoration: none;"> Update PO </a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="revised();" style="color: #FFFFFF; text-decoration: none;"> Revised PO </a></div>
<!--<div class="detail"><a href="javascript:void(0)" plain="true" onclick="cancel();" style="color: #FFFFFF; text-decoration: none;"> Cancel PO </a></div>-->
<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="$('#myHeader').hide(); $('#dg').datagrid('clearSelections');" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<div id="dialog-form" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,reziable:false,modal:true,closable:false"
style="width:425px;height:310px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
<form id="form" method="post">
	<input type="hidden" name="popk" id="popk" size="8">
 <input type="hidden" name="pur" id="pur" size="8">
    <!-- <div class="modal-dialog"> -->
        <div class="modal-content">
        	<!-- Modal Header -->
            <div class="modal-header">
            <div class="modal-title">Attach a memo?
												</div>
            </div>
            <!-- Modal body -->
            <div class="border-modal" style="border:none;">
            <div style="padding:5px;">
             <textarea placeholder="Beri memo untuk MD" name="memo" id="memo" class="easyui-validatebox" style="width:100%; height:100px;" required></textarea>
													</div>
             </div>
        <!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
        <a style="text-decoration:none; left: 129px; top: 228px;" href="javascript:void(0)" class="button-cancel" onclick="canrev();">Cancel</a>
        <a style="text-decoration:none; left: 206px; top: 228px;" href="javascript:void(0)" class="button-submit" onclick="saverev();">Submit</a>
								<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
        </div>
</form>
</div>
<!-- </div> -->
</div>
<script type="text/javascript">
window.onscroll = function(){ myFunctiona(); };
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunctiona(){
  if (window.pageYOffset > sticky){
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>