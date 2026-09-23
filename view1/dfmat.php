<style type="text/css">
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

$(function(){
$.ajax({
type:"POST",
url:"view/get_copy.php",
data:"ord=<?php echo $ord ?>",
success:function(data){
document.getElementById('copy').value=data;
var copy = document.getElementById('copy').value;
if(copy==1){
menu();
}
},
});

$.ajax({
type: "POST",
url: "view/get_pomat.php?x=bqty&ord=<?php echo $_GET['ord']; ?>",
success: function(data) {
document.getElementById('bqty').innerHTML = data;
},
});

over1();
over2();
sumpo();
sumreq();
cost1();
cost2();
});

function over1(){
$.ajax({
type: "POST",
url: "view/get_over2.php?x=over1&ord=<?php echo $_GET['ord']; ?>",
success: function(data) {
if(data>0){
$('#container-cari3b').show();
} else {
$('#container-cari3b').hide(); 
}
document.getElementById('overqty').innerHTML = data;
},
});
}

function over2(){
$.ajax({
type: "POST",
url: "view/get_over2.php?x=over2&ord=<?php echo $_GET['ord']; ?>",
success: function(data) {
if(data>0){
$('#container-cari3b').show();
} else {
$('#container-cari3b').hide(); 
}
document.getElementById('overprice').innerHTML = data;
},
});
}

function sumpo(){
$.ajax({
type: "POST",
url: "view/get_pomat.php?x=sumpo&ord=<?php echo $_GET['ord']; ?>",
success: function(data) {
// if(data>0){
$('#sumpo').show();
// } else {
// $('#sumpo').hide(); 
// }
document.getElementById('sumpo').innerHTML = data;
},
});
}

function sumreq(){
$.ajax({
type: "POST",
url: "view/get_pomat.php?x=sumreq&ord=<?php echo $_GET['ord']; ?>",
success: function(data) {
// if(data>0){
$('#sumreq').show();
// } else {
// $('#sumreq').hide(); 
// }
document.getElementById('sumreq').innerHTML = data;
},
});
}

function cost1(){
$.ajax({
type: "POST",
url: "view/get_pomat.php?x=cost1&ord=<?php echo $_GET['ord']; ?>",
success: function(data) {
document.getElementById('cost1').innerHTML = data;
},
});
}

function cost2(){
$.ajax({
type: "POST",
url: "view/get_pomat.php?x=cost2&ord=<?php echo $_GET['ord']; ?>",
success: function(data) {
document.getElementById('cost2').innerHTML = data;
},
});
}

/*menu*/
function menu(){
 var cc = [];
 var rows = $('#dg2').datagrid('getSelections');
 for(var i=0; i<rows.length; i++){
	var pono = rows[i]['pono'];
	if ($.inArray(pono, cc) == -1){	// not found
		cc.push(pono);
	}
 }
	var row = $('#dg2').datagrid('getSelected');
 var tchek = $('#dg2').datagrid('getChecked').length;
	if(row){
  if(row.status2==4){
   if(tchek>1){
    if(cc.length > 1){
       $('#count').show();
       $('#mprint').show();
       $('#mview').hide();
       $('#mviewpi').hide();
       count_row();
       $('#count').css('margin-right','74.5%');
      } else {
       $('#count').show();
       $('#mprint').show();
       $('#mview').show();
       $('#mviewpi').show();
       count_row();
       $('#count').css('margin-right','57%');
      }
   } else {
    $('#count').show();
    $('#medit').show();
    $('#mprint').show();
    $('#mview').show();
    $('#mviewpi').show();
    count_row();
    $('#count').css('margin-right','52%');
    }
  } else if(row.status2<4){
   if(tchek>1){
     if(cc.length > 1){
       $('#count').show();
       $('#mprint').show();
       $('#mview').hide();
       $('#mviewpi').hide();
       count_row();
       $('#count').css('margin-right','74.5%');
      } else {
       $('#count').show();
       $('#mprint').show();
       $('#mview').hide();
       $('#mviewpi').hide();
       count_row();
       $('#count').css('margin-right','74.5%'); 
     }
   } else {
    $('#count').show();
    $('#medit').show();
    $('#mprint').show();
    $('#mview').hide();
    $('#mviewpi').hide();
    count_row();
    $('#count').css('margin-right','67%');
   }
  } else if(row.status2>4){
    if (tchek>1){
    if (cc.length > 1){
       $('#count').show();
       $('#mprint').show();
       $('#mview').hide();
       $('#mviewpi').hide();
       count_row();
       $('#count').css('margin-right','74.5%');
      } else {
       $('#count').show();
       $('#mprint').show();
       $('#mview').show();
       $('#mviewpi').show();
       count_row();
       $('#count').css('margin-right','57%');
      }
   } else {
    $('#count').show();
    $('#medit').show();
    $('#mprint').show();
    $('#mview').show();
    $('#mviewpi').show();
    count_row();
    $('#count').css('margin-right','52%');
   }
  } 
	$('#myHeader').show();
	} else {
	$('#myHeader').hide();
	$('#dg2').datagrid('clearSelections');
	}
}

function menu2(){
var cp = document.getElementById('copy').value;
if(cp==1){
$('#myHeader').show();
menu();
} else {
$('#myHeader').hide();
}
}

/*edit*/
function edit2(){
	var row = $('#dg2').datagrid('getSelected');
	if(row){
  $('#dialog-formb').dialog('open').dialog('setTitle','');
		$('#formb').form('load',row);
  		if(row.tspec==2){
			$('#hidden').show();
		} else {
			$('#hidden').hide();
		}
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

function viewpi(){
var rows = $('#dg2').datagrid('getSelected');
	if(rows){
//  if(rows.status=="Purchased"){
 if(rows.piform !== null && rows.piform !== ""){
 url = "upload/"+rows.piform;
 window.open(url);
 } else {
 $.messager.alert('Warning','No PI files','warning');
 }
// } else {
//     $.messager.alert('Warning','PO status not purchased','warning');
//  }
    } else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

function viewpo(){
var rows = $('#dg2').datagrid('getSelected');
	if(rows){
if(rows.pono){
 url = url = "pdf/pdf_po?cek=1&po="+rows.pono;
 window.open(url);
} else {
    $.messager.alert('Warning','No PO number','warning');
 }
    } else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

/*search*/
function Search2(){
$('#dg2').datagrid('load',{
cari1: $('#cari1b').val(),
cari2: $('#cari2b').val(),
cari3: $('#cari3b').val(),
cari6: $('#cari6b').val(),
type0: $('#filtera0').val(),
type1: $('#filtera1').val(),
type2: $('#filtera2').val(),
spec0: $('#filterb0').val(),
spec1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
});
}

function Search2a(){
$('#dg2').datagrid('load',{
cari1: $('#cari1b').val(),
cari2: $('#cari2b').val(),
cari3: $('#cari3b').val(),
cari6: $('#cari6b').val(),
cari4: $('#cari4b').val(),
type0: $('#filtera0').val(),
type1: $('#filtera1').val(),
type2: $('#filtera2').val(),
spec0: $('#filterb0').val(),
spec1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
});
	$('#newest').show();
	$('#oldest').hide();
	$('#itemaz').hide();
 }

function Search2b(){
$('#dg2').datagrid('load',{
cari1: $('#cari1b').val(),
cari2: $('#cari2b').val(),
cari3: $('#cari3b').val(),
cari6: $('#cari6b').val(),
cari5: $('#cari5b').val(),
type0: $('#filtera0').val(),
type1: $('#filtera1').val(),
type2: $('#filtera2').val(),
spec0: $('#filterb0').val(),
spec1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
});
		$('#newest').hide();
		$('#oldest').show();
		$('#itemaz').hide();
}

function Searchaz(){
$('#dg2').datagrid('load',{
cari1: $('#cari1b').val(),
cari2: $('#cari2b').val(),
cari3: $('#cari3b').val(),
cari6: $('#cari6b').val(),
cariaz: $('#cariaz').val(),
type0: $('#filtera0').val(),
type1: $('#filtera1').val(),
type2: $('#filtera2').val(),
spec0: $('#filterb0').val(),
spec1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
});
		$('#newest').hide();
		$('#oldest').hide();
		$('#itemaz').show();
}

function Search4a(){
$('#dg4e').datagrid('load',{
cari7: $('#cari7').val()
});
}

function Search4b(){
$('#dg4f').datagrid('load',{
cari8: $('#cari8').val()
});
}

function Search4(){
    $('#kolom1').datagrid('load',{
    cari6: $('#cari6').val()
    });
}

function Searchc(){
  $('#dg2b').datagrid('load',{
    cari11: $('#cari11').val()
    });
}

function Searchc2(){
  $('#dg2b2').datagrid('load',{
    cari12: $('#cari12a').val()
    });
}

/*print*/
function print(){
var row = $('#dg2').datagrid('getSelected');
var data = JSON.stringify($('#dg2').datagrid('getData').total);
//document.getElementById("rkb2").value = ids;
var tabmat = "All material ("+data+")";
	if(row){
		document.write(tabmat);  
		/*url = "pdf/pdf_qty2.php?ord="+row.ordpk;
  window.open(url);*/
		/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

function print2(){       
 var ids = [];     
	var row = $('#dg2').datagrid('getSelected');
 var rows = $('#dg2').datagrid('getSelections');
	if(row){
		//cari6 = $('#cari6b').val();
   for(var i=0; i<rows.length; i++){
        ids.push(rows[i].rkbpk);
      }
		url = "pdf/pdf_mat?ord="+row.ordpk+"&rkb="+ids;
  window.open(url);
		/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}
		
function myformatter2(date){
var y = date.getFullYear();
var m = date.getMonth()+1;
var d = date.getDate();
return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}

function myparser2(s){
if (!s) return new Date();
var ss = (s.split('-'));
var y = parseInt(ss[0],10);
var m = parseInt(ss[1],10);
var d = parseInt(ss[2],10);
if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
return new Date(y,m-1,d);
} else {
return new Date();
}
}

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

function count_row(){
$('#myHeader').show();
var count = $('#dg2').datagrid('getChecked').length;
if (count) {
if(count >1){
$('#medit').hide();
$('#count').css('margin-right','825px');
} else {
$('#medit').show();
$('#count').css('margin-right','750px');
}
document.getElementById("count").innerHTML = count +" items selected";
} else {
document.getElementById("count").innerHTML = 0 +" items selected";
}
}
	
//DROPDOWN
function toggle(source) {
   checkboxes = document.getElementsByName('ck');
  for(var i=0, n=14;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

function cheka1(){ 
			var c1 = document.getElementById("chek1");
				if (c1.checked) {
        $('#dg2').datagrid('showColumn', 'item');
			}else {
			$('#dg2').datagrid('hideColumn', 'item');
			}
				}
    
    function cheka1b(){ 
			var c1b = document.getElementById("chek1b");
				if (c1b.checked) {
        $('#dg2').datagrid('showColumn', 'itemadd');
			}else {
			$('#dg2').datagrid('hideColumn', 'itemadd');
			}
				}
				
			 function cheka2(){ 
			var c2 = document.getElementById("chek2");
				if (c2.checked) {
        $('#dg2').datagrid('showColumn', 'supnm');
			}else {
			$('#dg2').datagrid('hideColumn', 'supnm');
			}
				}
				
				function cheka3(){ 
			var c3 = document.getElementById("chek3");
				if (c3.checked) {
        $('#dg2').datagrid('showColumn', 'status');
			}else {
			$('#dg2').datagrid('hideColumn', 'status');
			}
				}
    
    function cheka3b(){ 
			var c3b = document.getElementById("chek3b");
				if (c3b.checked) {
        $('#dg2').datagrid('showColumn', 'pono');
			}else {
			$('#dg2').datagrid('hideColumn', 'pono');
			}
				}
				
				function cheka4(){ 
			var c4 = document.getElementById("chek4");
				if (c4.checked) {
        $('#dg2').datagrid('showColumn', 'spec');
			}else {
			$('#dg2').datagrid('hideColumn', 'spec');
			}
				}
    
    function cheka4b(){ 
			var c4b = document.getElementById("chek4b");
				if (c4b.checked) {
        $('#dg2').datagrid('showColumn', 'specadd');
			}else {
			$('#dg2').datagrid('hideColumn', 'specadd');
			}
				}
				
				function cheka5(){ 
			var c5 = document.getElementById("chek5");
				if (c5.checked) {
        $('#dg2').datagrid('showColumn', 'qty');
			}else {
			$('#dg2').datagrid('hideColumn', 'qty');
			}
				}
    
    			function cheka5b(){ 
			var c5b = document.getElementById("chek5b");
				if (c5b.checked) {
        $('#dg2').datagrid('showColumn', 'pocons2');
			}else {
			$('#dg2').datagrid('hideColumn', 'pocons2');
			}
				}
				
				function cheka6(){ 
			var c6 = document.getElementById("chek6");
				if (c6.checked) {
        $('#dg2').datagrid('showColumn', 'unit');
			}else {
			$('#dg2').datagrid('hideColumn', 'unit');
			}
				}
				
				function cheka7(){ 
			var c7 = document.getElementById("chek7");
				if (c7.checked) {
        $('#dg2').datagrid('showColumn', 'colname');
			}else {
			$('#dg2').datagrid('hideColumn', 'colname');
			}
				}
    
    function cheka7b(){ 
			var c7b = document.getElementById("chek7b");
				if (c7b.checked) {
        $('#dg2').datagrid('showColumn', 'colcode');
			}else {
			$('#dg2').datagrid('hideColumn', 'colcode');
			}
				}
				
				function cheka8(){ 
			var c8 = document.getElementById("chek8");
				if (c8.checked) {
        $('#dg2').datagrid('showColumn', 'price');
			}else {
			$('#dg2').datagrid('hideColumn', 'price');
			}
				}
				
				function cheka9(){ 
			var c9 = document.getElementById("chek9");
				if (c9.checked) {
        $('#dg2').datagrid('showColumn', 'negocons');
			}else {
			$('#dg2').datagrid('hideColumn', 'negocons');
			}
				}
				
				function cheka10(){ 
			var c10 = document.getElementById("chek10");
				if (c10.checked) {
        $('#dg2').datagrid('showColumn', 'estcons');
			}else {
			$('#dg2').datagrid('hideColumn', 'estcons');
			}
				}
				
			 function cheka11(){ 
			var c11 = document.getElementById("chek11");
				if (c11.checked) {
        $('#dg2').datagrid('showColumn', 'varcons');
			}else {
			$('#dg2').datagrid('hideColumn', 'varcons');
			}
				}
				
				function cheka12(){ 
			var c12 = document.getElementById("chek12");
				if (c12.checked) {
        $('#dg2').datagrid('showColumn', 'totcons');
			}else {
			$('#dg2').datagrid('hideColumn', 'totcons');
			}
				}
				
				function cheka13(){ 
			var c13 = document.getElementById("chek13");
				if (c13.checked) {
        $('#dg2').datagrid('showColumn', 'allowcons');
			}else {
			$('#dg2').datagrid('hideColumn', 'allowcons');
			}
				}
				
				function cheka14(){ 
			var c14 = document.getElementById("chek14");
				if (c14.checked) {
        $('#dg2').datagrid('showColumn', 'sizegar');
			}else {
			$('#dg2').datagrid('hideColumn', 'sizegar');
			}
				}
			
/*filter*/
function Search5(){
    $('#spec').datagrid('load',{
    carispl: $('#carispl').val()
    });
				 $('#type').datagrid('load',{
    carispl: $('#carispl').val()
    });
					$('#color').datagrid('load',{
    carispl: $('#carispl').val()
    });
}

$(function(){
    $('#type').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","60px");
				    var ckk=$('#type').datagrid('getRows')[index].kelnm;
				    document.getElementById("filtera"+index).value = ckk;
								document.getElementById("idxa"+index).value = index;
								document.getElementById("talla"+index).value = 1;
								$('#filtera'+index).show();
								$('#crossa'+index).show();
								$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
				tall();
				var counta= JSON.stringify($('#dg2').datagrid('getData').total);
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
								$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
				document.getElementById("talla"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg2').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncektype2(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxa"+c).value;
$('#type').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filtera"+c).value ="";
document.getElementById("talla"+c).value = 0;
$('#filtera'+c).hide();
$('#crossa'+c).hide();
$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
document.getElementById("idxa"+c).value="";
}
}

$(function(){
    $('#spec').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","60px");
				    var ckk=$('#spec').datagrid('getRows')[index].spec;
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
								$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
				var counta= JSON.stringify($('#dg2').datagrid('getData').total);
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
								$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
				document.getElementById("tallb"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg2').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekspec2(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxb"+c).value;
$('#spec').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterb"+c).value ="";
document.getElementById("tallb"+c).value = 0;
$('#filterb'+c).hide();
$('#crossb'+c).hide();
$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
document.getElementById("idxb"+c).value="";
}
}

$(function(){
    $('#color').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","60px");
				    var ckk=$('#color').datagrid('getRows')[index].colname;
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
								$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
				var counta= JSON.stringify($('#dg2').datagrid('getData').total);
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
								$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
				document.getElementById("tallc"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg2').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekcolor2(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxc"+c).value;
$('#color').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterc"+c).value ="";
document.getElementById("tallc"+c).value = 0;
$('#filterc'+c).hide();
$('#crossc'+c).hide();
$('#dg2').datagrid('load',{
				type0: $('#filtera0').val(),
				type1: $('#filtera1').val(),
    			type2: $('#filtera2').val(),
				spec0: $('#filterb0').val(),
				spec1: $('#filterb1').val(),
				col0: $('#filterc0').val(),
				col1: $('#filterc1').val(),
				cari1: $('#cari1b').val(),
				cari2: $('#cari2b').val(),
				cari3: $('#cari3b').val(),
				cari6: $('#cari6b').val()
				});
document.getElementById("idxc"+c).value="";
}
}

function totrec() {
var tcount= JSON.stringify($('#dg2').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = tcount+" result";
}

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
$('#type').datagrid('clearSelections');
$('#spec').datagrid('clearSelections');
$('#color').datagrid('clearSelections');
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

$('#dg2').datagrid('load',{
type0: $('#filtera0').val(),
type1: $('#filtera1').val(),
type2: $('#filtera2').val(),
spec0: $('#filterb0').val(),
spec1: $('#filterb1').val(),
col0: $('#filterc0').val(),
col1: $('#filterc1').val(),
cari1: $('#cari1b').val(),
cari2: $('#cari2b').val(),
cari3: $('#cari3b').val(),
cari6: $('#cari6b').val()
});
}
}

/*disheader*/
function testku() {
var dg = $('#spec');
var dg2= $('#type');
var dg3= $('#color');
dg.datagrid();
dg2.datagrid();
dg3.datagrid();
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg3.datagrid('getPanel').find('div.datagrid-header').css('display','none');
$('#spec').datagrid('getPanel').addClass('lines-no');
$('#type').datagrid('getPanel').addClass('lines-no');
$('#color').datagrid('getPanel').addClass('lines-no');
$('#spec').datagrid('getPanel').addClass('lines-no2');
$('#type').datagrid('getPanel').addClass('lines-no2');
$('#color').datagrid('getPanel').addClass('lines-no2');
$('#spec').datagrid('getPanel').addClass('col');
$('#type').datagrid('getPanel').addClass('col');
$('#color').datagrid('getPanel').addClass('col');
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

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("cari6");
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

function tnew() {
var tcount= JSON.stringify($('#dg2').datagrid('getData').total);
document.getElementById("tmat").innerHTML = "("+tcount+")";
$('#tmat').show();
$('#tmat1').hide();
}

$(function(){
// $('#dg2').datagrid({
//   onClickCell: function(index,field,value){
//    var row = $(this).datagrid('getRows')[index];
//     if (field == 'status'){
//      if(row.pono!=null && row.status2==6){
//      document.getElementById('ponoi').value=row.pono;
//      document.getElementById('rkbpki').value=row.rkbpk;
//      $('#dialog-forminfo').dialog('open').dialog('setTitle','');
//      $('#dginf').datagrid('load',{
//      pono: $('#ponoi').val(),
//      rkbpk: $('#rkbpki').val()
//      });
//      $.ajax({
//      type:"POST",
//      url:"view/get_infob.php?pono="+row.pono,
//      data:"rkbpk="+row.rkbpk,
//      success:function(data){
//      document.getElementById('qtyinfo').innerHTML=data;
//      },
//      });
//      }
//     }
//   }
// });
});

function info(popk,rkbpk){
            // alert(rkbpk);
            document.getElementById('ponoi').value=popk;
            document.getElementById('rkbpki').value=rkbpk;
            $('#dialog-forminfo').dialog('open').dialog('setTitle','');
			$('#dginf').datagrid('load', 'view/get_infolpb.php?popk='+popk+'&rkbpk='+rkbpk);
            // $('#dginf').datagrid('load',{
            // popk: $('#ponoi').val(),
            // rkbpk: $('#rkbpki').val()
            // });
            $.ajax({
            type:"POST",
            url:"view/get_infolpbb.php?popk="+popk,
            data:"rkbpk="+rkbpk,
            success:function(data){
            document.getElementById('qtyinfo').innerHTML=data;
            },
            });
}
function formatter1(value, rows) {
	if(value=="1"){
		return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:#FFFFFF;background-color: rgba(25, 183, 21, 1);cursor:pointer" onclick="info('+rows.popk+','+rows.rkbpk+');">'+rows.stsb+'</span>';
	}else if(value=="2"){
		return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:#FFFFFF;background-color: rgba(25, 183, 21, 1);cursor:pointer" onclick="info('+rows.popk+','+rows.rkbpk+');">'+rows.stsb+'</span>';
	}else if(value=="3"){
		return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;cursor:pointer" onclick="info('+rows.popk+','+rows.rkbpk+');">'+rows.stsb+'</span>';
	}else if(value=="4"){
		return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#EF3B42;cursor:pointer" onclick="info('+rows.popk+','+rows.rkbpk+');">'+rows.stsb+'</span>';
	}
	else{
		return value;
	}
}

function dtlimport(popkship,importpk){
    //  alert(importpk);
    $('#dialog-enroute2').dialog('open').dialog('setTitle','');
    $('#dg2c').datagrid('load', {
          importpkb: importpk
    });
    $.ajax({
	type:"POST",
	url:"view/get_data.php?x=vasnm2",
	data:"popk="+popkship,
	success:function(data){
	let text = data;
	const arr = text.split(",");
	// alert(data);
	document.getElementById('typenm2').value=arr[0];
	document.getElementById('vassalnm2').value=arr[1];
	document.getElementById('bill2').value=arr[2];
	document.getElementById('arrival2').value=arr[3];
	document.getElementById('port2').value=arr[4];

	document.getElementById('gw2').value=arr[5];
	document.getElementById('dp2').value=arr[6];
	document.getElementById('dl2').value=arr[7];
	document.getElementById('dt2').value=arr[8];
	document.getElementById('amount2').value=arr[9];

	document.getElementById('etd222').value=arr[10];
	document.getElementById('eta222').value=arr[11];
	document.getElementById('eih222').value=arr[12];

	document.getElementById('importpkb2').value=arr[13];
	// document.getElementById('supnm').value=arr[14];
	},
	});
}

function formatter2(value, row){
	if(row.vassalnm=="N/A"){
		return value;
	}else{
		return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);cursor:pointer;" onclick="dtlimport('+row.popk+','+row.importpk+')">'+value+'</span>'   

	}	
}
</script>
<?php 
$sql=mysqli_query($koneksi,"SELECT SUM(tot) AS tot FROM bdown WHERE ordpk='$ord' AND jenis LIKE '%DETAIL%' GROUP BY ordpk");
$dtsql=mysqli_fetch_array($sql);
$totqty=$dtsql['tot'];

$sqlcur=mysqli_query($koneksi,"select * from cur where curpk='2'");
$dtcur=mysqli_fetch_array($sqlcur);

$sqlc=mysqli_query($koneksi,"select * from costing where ordpk='$ord'");
$dtc=mysqli_fetch_array($sqlc);

$sqlk=mysqli_query($koneksi,"select * from kurs order by kurspk desc limit 1");
$dtk=mysqli_fetch_array($sqlk);

/*totrkb*/
$crr=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='1' and spec<>'' group by ordpk");
$dtr=mysqli_fetch_array($crr);
$totrp=$dtr['totrkb']/$dtk['rupiah'];

$cre=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='3' and spec<>'' group by ordpk");
$dte=mysqli_fetch_array($cre);
$toteu=$dte['totrkb']/$dtk['euro'];

$crp=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='6' and spec<>'' group by ordpk");
$dtp=mysqli_fetch_array($crp);
$totp=$dtp['totrkb']/$dtk['pounds'];

$crd=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from rkb where ordpk='$ord' and curpk='2' and spec<>'' group by ordpk");
$dtd=mysqli_fetch_array($crd);
$totd=$dtd['totrkb'];

$totrkb1=$totrp+$toteu+$totp+$totd;
$totrkb=$dtcur['cursign'].number_format($totrkb1,2,".",",");
$totrkbb=number_format($totrkb1,2,".",",");
if($totqty>0){
$perrkb1=$totrkb1/$totqty;
$perrkb=$dtcur['cursign'].number_format($perrkb1,2,".",",");
} else {
$perrkb="N/A";	
}

/*totpo*/
$crr2=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='1' group by ordpk");
$dtr2=mysqli_fetch_array($crr2);
$totrp2=$dtr2['totrkb']/$dtk['rupiah'];

$cre2=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='3' group by ordpk");
$dte2=mysqli_fetch_array($cre2);
$toteu2=$dte2['totrkb']/$dtk['euro'];

$crp2=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='6' group by ordpk");
$dtp2=mysqli_fetch_array($crp2);
$totp2=$dtp2['totrkb']/$dtk['pounds'];

$crd2=mysqli_query($koneksi,"select sum(pocons*price) as totrkb from podt where ordpk='$ord' and curpk='2' group by ordpk");
$dtd2=mysqli_fetch_array($crd2);
$totd2=$dtd2['totrkb'];

$totpo1=$totrp2+$toteu2+$totp2+$totd2;
$totpo=$dtcur['cursign'].number_format($totpo1,2,".",",");
$totpoo=number_format($totpo1,2,".",",");
if($totqty>0){
$perpo1=$totpo1/$totqty;
$perpo=$dtcur['cursign'].number_format($perpo1,2,".",",");
} else {
$perpo="N/A";	
}
?>
<input type="hidden" name="copy" id="copy">
<input type="hidden" name="test1" id="test1">
<input type="hidden" name="test2" id="test2">
<input type="hidden" name="total" id="total"  value="0" size="5">
<input type="hidden" name="ord" id="ord" value="<?php echo $ord; ?>" size="8">
<input type="hidden" name="sfu" id="sfu" value="<?php echo $_SESSION['funm']; ?>" size="8">

<!--<div id="menu" onclick="$('#menu').hide(); $('#dg2').datagrid('clearSelections');"  style="display:none;">
<div id="count" style="margin-right:700px;color:#ffffff;"></div>
<div class="detail" style="width:50px;" id="medit"><a href="javascript:void(0)" plain="true" onclick="edit2();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="select();" style="color: #FFFFFF; text-decoration: none;"> Select </a></div>-->
<!--<div class="detail"><a href="javascript:void(0)" plain="true" onclick="request2();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="print2();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="copy2();" style="color: #FFFFFF; text-decoration: none;"> Copy </a></div>
<div class="delete" style="width:80px;"><a href="javascript:void(0)" plain="true" onclick="copyto();" style="color: #FFFFFF; text-decoration: none;"> Copy To </a></div>-->
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="delmat2();" style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
</div>-->

<?php
$tot = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb WHERE ordpk='$ord' GROUP BY ordpk"));
if($tot>0){
?>

<div class="contenta">
<div id="container-cari" style="background:#FFFFFF; width:1220px; top:160px; left:20px;">
<div style="text-align:left;width:100%;height:92px;overflow-y:hidden;overflow-x:scroll; width:auto;z-index: 0; border-radius: 8px;box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<div style="text-align:left;padding:5px;background-color:#FFFFFF; height:70px; width:15%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Summary</span><br>
<span id="sumreq" style="display:none;color:#000000; font-size:14px; line-height:18px;"></span>
<span style="color:#000000; font-size:14px; line-height:18px;">requested for PO</span><br>
<span id="sumpo" style="display:none;color:#00000061; font-size:14px; line-height:18px;"></span>
<span style="color:#00000061; font-size:14px; line-height:18px;">PO issued</span>
</div>
<div style="text-align:left;padding:5px;background-color:#FFFFFF; margin-top:-70px;margin-left:15.5%; height:70px; width:30%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Material Per garment </span>
<table style="width:100%">
<tr>
<td style="width:20%;color:#000000; font-size:14px; line-height:18px">Costing</td>
<td style="width:25%;color:#000000; font-size:14px; line-height:18px">RKB cost</td>
<td style="width:55%;color:#000000; font-size:14px; line-height:18px">PO cost</td>
</tr>
<tr>
<td style="width:20%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<!-- <span id="cost1"></span> -->
<?php
if($dtc['costpk']>0){
// $cost1=$dtc['CM']+$dtc['materials']+$dtc['others'];
$cost1=$dtc['materials'];
$cost=$dtcur['cursign'].number_format($cost1,2,".",",");
} else {
$cost="<span style='color:#00000061;font-weight:400;'>N/A</span>";  
}
echo $cost;
?>
</td>
<td style="width:25%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($perrkb1>0){ ?>
<?php echo $perrkb; ?>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
</td>
<td style="width:55%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($perpo1>0){ ?>
<?php echo $perpo; ?>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
<?php if($perrkb1>0){
$profit1a=$perrkb1-$perpo1;
if($totrkbb<>$totpoo){ 
if($profit1a<0){ 
$profit1b=$profit1a*(-1);
$profitp1a=($profit1b/$perrkb1)*100;
$profitp1=number_format($profitp1a,2,".",","); 
$profit1="-".number_format($profit1b,2,".",",");  
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo $profit1."(".$profitp1."%)"; ?>" class="easyui-tooltip">
<span style='color:#EF3B42; font-size:12px;'> 
<?php //echo truncate($profit1,10); ?>
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
<?php } 
} else { 
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
} ?>
</td>
</tr>
</table>
</div>
<div style="text-align:left;padding:5px;background-color:#FFFFFF; margin-top:-70px;margin-left:46%; height:70px; width:40%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Bulk material</span>
<span id="bqty" style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;"></span>
<table style="width:100%">
<tr>
<td style="width:20%;color:#000000; font-size:14px; line-height:18px">Costing</td>
<td style="width:25%;color:#000000; font-size:14px; line-height:18px">RKB cost</td>
<td style="width:55%;color:#000000; font-size:14px; line-height:18px">PO cost</td>
</tr>
<tr>
<td style="width:20%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<!-- <span id="cost2"></span> -->
<?php
if($dtc['costpk']>0){
$cost1=$dtc['materials']*$totqty;
$cost2=$dtcur['cursign'].number_format($cost1,0,".",",");
$totcost="<a href='javascript:void(0)' style='text-decoration:none; color:#000000;cursor:default;' title='$cost2' class='easyui-tooltip'>"
.truncate($cost2,10).
// .$cost2.
"</a>";
} else {
$totcost="<span style='color:#00000061;font-weight:400;'>N/A</span>";  
}
echo $totcost;
?>
</td>
<td style="width:25%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($totrkb1>0){ ?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $totrkb; ?>" class="easyui-tooltip">
<?php 
//echo truncate($totrkb,10); 
echo $totrkb; 
?>
</a>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
</td>
<td style="width:55%;color:#000000; font-weight:700; font-size:14px; line-height:18px">
<?php if($totpo1>0){ ?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" title="<?php echo $totpo; ?>" class="easyui-tooltip">
<?php 
//echo truncate($totpo,10); 
echo $totpo; 
?>
</a>
<?php } else { ?>
<span style="color:#00000061;font-weight:400;">N/A</span>
<?php } ?>
<?php
if($totrkb1>0){
$profit2a=$totrkb1-$totpo1;
if($totrkbb<>$totpoo){
if($profit2a<0){ 
$cekover=1;
$profit2b=$profit2a*(-1);
$profitp2a=($profit2b/$totrkb1)*100;
$profitp2=number_format($profitp2a,2,".",","); 
$profit2="-".number_format($profit2b,2,".",",");  
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo $profit2."(".$profitp2."%)"; ?>" class="easyui-tooltip">
<span style='color:#EF3B42; font-size:12px;'> 
<?php 
//echo truncate($profit2,10); 
echo $profit2; 
?>(<?php echo $profitp2; ?>%)
</span> 
</a>
<?php //} else if($profit2a>0){ 
} else if($profit2a>0){ 
$profitp2a=($profit2a/$totrkb1)*100;
$profitp2=number_format($profitp2a,2,".",",");
$profit2=number_format($profit2a,2,".",","); 
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo "+".$profit2."(".$profitp2."%) profit"; ?>" class="easyui-tooltip">
<span style='color:#19B715; font-size:12px;'>+
<?php 
// echo truncate($profit2,5); 
echo $profit2; 
?>(<?php echo $profitp2; ?>%) profit
</span> 
</a>
<?php } 
} else { 
$profitp2a=($profit2a/$totrkb1)*100;
$profitp2=number_format($profitp2a,2,".",",");
$profit2=number_format($profit2a,2,".",","); 
?>
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor:default;" 
title="<?php echo "+".$profit2."(".$profitp2."%) profit"; ?>" class="easyui-tooltip">
<span style='color:#00000061; font-size:12px;'>+
<?php 
// echo truncate($profit2,5);
echo $profit2; 
?>(<?php echo $profitp2; ?>%) profit
</span> 
</a>
<?php } 
} else { 
if($totpo1>$totrkb1){
$cekover=1;
}
} 
?>
</td>
</tr>
</table>
</div>
<?php //if($cekover==1){ ?>
<div id="container-cari3b" style="display:none;text-align:left;padding:5px;background-color:#FFFFFF; margin-top:-70px;margin-left:86.5%; height:70px; width:23%; border-radius: 8px; box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);">
<span style="color:#00000061; font-weight:700; font-size:12px; line-height:16px;">Attention !</span><br>
<span id="overprice" style="color:#EF3B42; font-size:12px; line-height:16px;"></span>
<span style="color:#EF3B42; font-size:12px; line-height:16px;">materials</span>
<span style="color:#000000; font-size:12px; line-height:18px;">are over price in purchase</span><br>
<span id="overqty" style="color:#FF6B00; font-size:12px; line-height:16px;"></span>
<span style="color:#FF6B00; font-size:12px; line-height:16px;">materials</span>
<span style="color:#000000; font-size:12px; line-height:18px;">are over qty in purchase</span>
<!-- <span style="color:#000000; font-size:14px; line-height:18px;">Materials row is highlighted in</span>
<span style="color:#FF6B00; font-size:14px; line-height:18px;">orange</span> -->
</div>
<?php //} ?>
</div>
</div>
<!--<div id="frame-utama-cari" style="width:820px; top:175px;">-->
<div id="frame-utama-cari" style="width:530px; top:257px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
<input id="cari1b" placeholder="Search..." class="input" onkeyup="Search2(); over1();
over2(); sumpo(); cost1(); cost2();">
</div>
</div>
<input style="width:140px; height:28px;" id="cari2b" class="easyui-combobox"
data-options="prompt:'Status',onChange:Search2,limitToList:'true',
data: [
{value:'0',text:'All'},
{value:'1',text:'In progress'},
{value:'2',text:'Ready for PO'},
{value:'3',text:'Need revision'},
{value:'41',text:'Req PO'},
{value:'42',text:'PO in process'},
{value:'44',text:'Req Revised'},
{value:'45',text:'Ready Revised'},
{value:'46',text:'Req Cancel'},
{value:'47',text:'Cancel PO'},
{value:'5',text:'In Revision PO'},
{value:'6',text:'Purchased'},
]">
<input style="width:200px; height:28px;"  id="cari3b" class="easyui-combobox"
data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=supplier2&ord=<?php echo $ord; ?>',prompt:'Supplier',onChange:Search2,limitToList:'true'">
</a>
</div>
<div id="frame-filter" style="top:267px;">
<div id="frame-filter-fields">    
<div class="fields"><a href="javascript:void(0)" style="text-decoration:none; color: #AFAFAF;" onclick="myFunction1c(); testku2();">Fields</a></div>
<div class="all"><a href="javascript:void(0)" style="text-decoration:none; color: #000000;" onclick="myFunction1c(); testku2();">All</a></div>
<div id="panah2">
<div class="dropdown">
  <input onclick="myFunction1c(); testku2();" type="image" src="css/images/Polygon.png" class="dropbtn1" style="filter:brightness(0%);" alt="Submit button" width="10px" height="10px">
  <div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:540px;">
			<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="cari6" placeholder="Search..." class="input" onkeyup="filterFunction();">
				</div>
				</div>
			<div style="margin-top:50px;margin-left:-5px;display: inline-block; text-align: left;">
					<a href="Javascript:void(0);" style="padding: 5px 16px;"><div><b>Select All</b></div><div class="ck2" style="margin-left: 150px;margin-top: -19px;">
						<input type="checkbox" name="all" value="all" id="chek0" onclick="toggle(this); cheka1(); cheka1b(); cheka2(); cheka3(); cheka3b(); cheka4(); cheka4b(); cheka5(); cheka5b(); cheka6(); cheka7(); cheka7b();  cheka8(); cheka9(); cheka10(); cheka11(); cheka12(); cheka13(); cheka14();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Item</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="ck"  id="chek1" onclick="cheka1();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Garment Colorway</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="ck"  id="chek1b" onclick="cheka1b();" checked></div></a>
      <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Supplier</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek2" onclick="cheka2();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Status</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek3" onclick="cheka3();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>PO no.</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek3b" onclick="cheka3b();" checked></div></a>
      <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Specification</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek4" onclick="cheka4();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Placement</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek4b" onclick="cheka4b();" checked></div></a>
      <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Size</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek14" onclick="cheka14();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Qty</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek5" onclick="cheka5();" checked></div></a>
      <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Total PO</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek5b" onclick="cheka5b();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Unit</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="ck" id="chek6" onclick="cheka6();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Color</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek7" onclick="cheka7();" checked></div></a>
      <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Col Code</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek7b" onclick="cheka7b();" checked></div></a>	
	     <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Price</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek8" onclick="cheka8();" checked></div></a>			
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Cost.Cons</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek9" onclick="cheka9();"></div></a>
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Pur.Cons</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek10" onclick="cheka10();"></div></a>
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Var.Cons</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek11" onclick="cheka11();"></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Netto</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek12" onclick="cheka12();"></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Allowance</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck" id="chek13" onclick="cheka13();"></div></a>
	</div>
  </div>
</div>
</div>
</div>
<div id="frame-filter-newest">
<div class="dropdwn">	
<input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button" class="dropbtn">
<div id="myDropdown" class="dropdwn-content" style="height:120px;">
<input type="hidden" id="cari4b" value="1" name="cari4b">
<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Search2a();">Newest entry</a></div>
<input type="hidden" id="cari5b" value="1" name="cari5b">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Oldest entry</a></div>
<input type="hidden" id="cariaz" value="1" name="cariaz">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Searchaz();">Item Name (A-Z)</a></div>
</div>
</div>
<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
<div id="newest" class="newest" onclick="myFunction()">Newest</div>
<div id="oldest" class="newest" onclick="myFunction()" style="display:none;">Oldest</div>
<div id="itemaz" class="newest" onclick="myFunction()" style="display:none;">Item</div>
</a>
</div>
<div id="frame-filter2">
<div id="dropdown2">
<input onclick="myFunction1d(); testku();" type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px" alt="Submit button">
<div class="filter"><a href="javascript:void(0);" style="text-decoration:none; color: #000000;" onclick="myFunction1d(); testku();">Filter</a></div>
<div id="myDropdown3" class=dropdown2-content style="width:220px;height:395px">
				<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
				</div>
				</div>
				<div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">
						Type
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
						<i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i>
						</div>
						</div>
				<div id="tabel" class="tabela" onmousemove="totrec();" style="width:200px;height:auto;border:0px solid;margin-top:-120px;margin-left:-20px;">
			 <table id="type" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
				url="view/get_data2.php?dt=mat1b&ord=<?php echo $ord; ?>" toolbar="#tb" idField="rkbpk" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="kelnm" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>
				
					<div id="byr1a" class="prodesa" style="margin-top:85px;margin-left:15px;">
						<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
					Specification
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
						<i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i></div>
						</div>
								<div id="tabel" class="tabelb" onmousemove="totrec();" style="width:200px;height:auto;margin-top:15px;margin-left:-20px;">
			 <table id="spec" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
				url="view/get_data2.php?dt=mat2b&ord=<?php echo $ord; ?>" toolbar="#tb" idField="rkbpk" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
					data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="spec" width="160" sortable="false"></th>
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
			 <table id="color" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
				url="view/get_data2.php?dt=mat3b&ord=<?php echo $ord; ?>" toolbar="#tb" idField="rkbpk" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
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
<div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%; margin-top:90px;">
<div id="fltr1" style="margin-top:-25px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr2" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr3" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;display:none;" onclick="reset();">
<a href="javascript:void(0)" style="text-decoration:none; color: #359DD9;">Reset All</a></div>
<div style="margin-left:150px;margin-top:-20px;">
<?php for($i=0; $i<=2; $i++){ ?>
<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross" onclick="uncektype2(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
<?php } ?>
<!--B-->
<?php for($j=0; $j<=1; $j++){ ?>
<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross" onclick="uncekspec2(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
<?php } ?>
<!--C-->
<?php for($k=0; $k<=1; $k++){ ?>
<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross" onclick="uncekcolor2(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="tallc<?php echo $k; ?>" value="0" size="5">
<?php } ?>
</div>
</div>
<div id="tabel1" onclick="menu();" ondblclick="edit2(); $('#myHeader').hide();" onmousemove="" style="top:297px;">
<table id="dg2" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_dfmat.php?ord=<?php echo $ord; ?>" idField="rkbpk" toolbar="#tb2" striped="true" pageSize="100" pageList="[100,200,300,500]"
pagination="false" rownumbers="false"  multiple="true" collapsible="true" fitColumns="false"
data-options="onCheckAll:function(){menu();},onUncheckAll:function(){menu2();},ctrlSelect:true,checkOnSelect:true,multiSort:true,
rowStyler:function(index,row){
	if (row.copy==3){
        return 'color:#000000;background-color:#D6D6D6;';
      	} else {
        if(row.cekover==1){
		if(row.cekover2==1){
		return 'color:#000000;background-color:#FFCCCB;';
		} else {
        return 'color:#000000;background-color:#FFE4B5;';
		}
        } else if(row.cekover2==1){ 
        return 'color:#000000;background-color:#FFCCCB;';
        } else {
        return 'color:#000000;background-color:#ffffff;';  
        }
      }
    }">
<thead>
<tr>
<th data-options="field:'ck',checkbox:true"></th>
<th align="center" data-options="field:'kelnm2',title:'Type',width:60,sortable:true,styler:function(index,row){}">Type</th>
<th data-options="field:'item',title:'Item',width:125,sortable:true,styler:function(index,row){}"></th>
<th field="itemadd" width="148" sortable="true">Garment Colorway</th>
<th field="supnm" width="137" sortable="true">Supplier</th>
<th field="status" width="100" formatter="formatter1" sortable="true">Status</th>
<th field="ponoblue" width="90" sortable="true">PO no.</th>
<th field="spec" width="150" sortable="true">Specification</th>
<th field="specadd" width="150" sortable="true">Placement</th>
<th field="sizegar" width="100" sortable="true">Size</th>
<th field="qty" width="100" sortable="true">Qty</th>
<th field="pocons2" width="100" sortable="true">Total PO</th>
<th field="unit" width="100" sortable="true">Units</th>
<th field="colname" width="100" sortable="true">Color</th>
<th field="colcode" width="100" sortable="true">Col Code</th>
<th field="price" width="100" sortable="true">Price</th>
<th field="negocons" width="100" sortable="true" hidden="true">Cost.Cons</th>
<th field="estcons" width="100" sortable="true" hidden="true">Pur.Cons</th>
<th field="varcons" width="100" sortable="true" hidden="true">Var.Cons</th>
<th field="totcons" width="100" sortable="true" hidden="true">Netto</th>
<th field="allowcons" width="100" sortable="true" hidden="true">Allowance</th>
</tr>
</thead>
</table>
<br>
</div>
</div>

<div class="header" id="myHeader" onclick="" style="display:none;">
<div id="count" style="display:none;"></div>
<div class="detail" id="medit" style="width:50px;display:none;"><a href="javascript:void(0)" plain="true" onclick="edit2();" style="color: #FFFFFF; text-decoration: none;"> View </a></div>
<div class="delete" id="mprint"><a href="javascript:void(0)" plain="true" onclick="print2();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="delete" id="mview" style="width:60px;display:none;"><a href="javascript:void(0)" plain="true" onclick="viewpo();" style="color: #FFFFFF; text-decoration: none;"> View PO </a></div>
<div class="delete" id="mviewpi" style="width:100px;display:none;"><a href="javascript:void(0)" plain="true" onclick="viewpi();" style="color: #FFFFFF; text-decoration: none;"> View PI Form </a></div>
<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="$('#myHeader').hide(); $('#dg2').datagrid('clearSelections'); $('#dg2').datagrid('clearChecked');" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<!--form edit-->
<div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true"
style="width:1200px;height:675px;padding:5px 5px;display:none;top:15px;">
<?php //$ord=$_GET['ord']; ?>
<!--<div id="center" region="center" border="false">-->
<form id="formb" method="post">
<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>">
<input type="hidden" name="rkbpk" id="rkbpk">
<input type="hidden" name="bdownpk" id="bdownpk">
<input type="hidden" name="kolom" id="kolom">
<input type="hidden" name="nour" id="nour">
<!--<input type="hidden" name="tspec" id="tspec" >-->
<div class="modal-dialog" style="width:98%; height:96%; overflow-y:scroll;overflow-x:hidden;">
<div class="modal-content">
<div style="margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
View Material
</div>
<div style="margin-top:-25px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
<a href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:1100px;"
onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset'); sup1b();"> X</a>
</div>
<div class="fitem">
<label>Group</label></br>
<input name="kelnm" id="kelnm" class="easyui-validatebox" style="width:162px; height:34px;" placeholder="Group" readonly>
</div>
<div class="fitem">
<label>Item</label></br>
<input onkeyup="" name="item" id="item" class="easyui-validatebox" style="width: 244px; height:34px;" placeholder="Input item name..." readonly>
</div>
<div class="fitem">
<label>Garment Colorway</label></br>
<textarea name="itemadd" id="itemadd" class="easyui-validatebox" style="width:1125px; height: 55px;" readonly></textarea>
</div>
<div class="fitem">
<label>Supplier</label><br>
<input name="supnm" id="suppk" class="easyui-validatebox" style="width:162px; height:34px;" placeholder="Supplier" readonly>
</div>
<div class="fitem">
<input type="radio" name="tspec" id="tspec" value="1" onclick="$('#hidden').hide(); multi();" checked>
<label>Single Column</label>
<input type="radio" name="tspec" id="tspec" value="2" onclick="$('#hidden').show(); multi();">
<label>Multi Column</label>
</div>
<div class="fitem">
<textarea name="spec" id="spec2" class="easyui-validatebox" style="width:1125px; height: 55px;" readonly></textarea>
</div>
<div id="hidden"  style="display: none;">
<div class="fitem">
<input name="hspec1" id="hspec1" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
<input name="hspec2" id="hspec2" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
<input name="hspec3" id="hspec3" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
<input name="hspec4" id="hspec4" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
<input name="hspec5" id="hspec5" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
<input name="hspec6" id="hspec6" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
<input name="hspec7" id="hspec7" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
<input name="hspec8" id="hspec8" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header..." readonly>
</div>
<div class="fitem">
<input name="spec1" id="spec1a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
<input name="spec2" id="spec2a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
<input name="spec3" id="spec3a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
<input name="spec4" id="spec4a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
<input name="spec5" id="spec5a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
<input name="spec6" id="spec6a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
<input name="spec7" id="spec7a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
<input name="spec8" id="spec8a" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value..." readonly>
</div>
</div>
<div class="fitem">
<label>Placement</label></br>
<textarea name="specadd" id="specadd" class="easyui-validatebox" style="width:1125px; height: 55px;" readonly></textarea>
</div>
<div class="fitem">
<label>Color Name</label>&emsp;
<label>Color Code</label>
</div>
<div class="fitem">
<input name="colname" id="colname" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input color..." readonly>&nbsp;
<input name="colcode" id="colcode" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input code..." readonly>
</div>
<div class="fitem">
<label>Size</label></br>
<input name="sizegar" id="sizegar" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input size..." readonly>
</div>
<div class="">
<label style="margin-left: 24px;font-size: 15px;">Unit</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
<label style="font-size: 15px;">Unit price actual</label>&nbsp;&nbsp;
<label style="font-size: 15px;">Currency</label>
</div>
<div class="fitem">
<input name="unit" id="unit" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input Unit..." readonly>&nbsp;
<input name="price2" id="price2" class="easyui-validatebox" style="width: 103px; height:34px;" placeholder="0" readonly>&nbsp;
<input name="curpk" id="curpk" class="easyui-validatebox" style="width: 88px; height:34px;" placeholder="USD" readonly>
</div>
<div class="fitem">
<label>Bdown Qty.</label></br>
<input name="bdownqty" id="bdownqty" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="" readonly>
</div>
<div>
<label style="margin-left: 24px;font-size: 15px;">Allowance%</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<label style="font-size: 15px;">Allowman</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<label style="font-size: 15px;">Costing Cons.</label>&emsp;&emsp;&emsp;&emsp;
<label style="font-size: 15px;">Purcashing Cons.</label>&emsp;&emsp;
<label style="font-size: 15px;">Variance Cons.</label>
</div>
<div class="fitem">
<input name="allowcons" id="allowcons" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="" readonly>&nbsp;
<input name="allowman" id="allowman" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="" readonly>&nbsp;
<input name="negocons" id="negocons" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="" readonly>&nbsp;
<input name="estcons" id="estcons" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="" readonly>
<input name="varcons" id="varcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
</div>
<div class="fitem">
<label>Netto</label>&emsp;
<label>Formula </label>
<label></label>
</div>
<div class="fitem">
<input name="totcons" id="totcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
<input id="formula1" value="estcons * bdownqty" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" readonly>
<!--<select class="easyui-combobox" name="f1a" id="f1a"
data-options="editable:false, panelHeight:'auto'" style="width:50px;">
<option value=""></option>
<option value="1"> + </option>
<option value="2"> - </option>
<option value="3"> * </option>
<option value="4"> / </option>
</select>-->
<input name="f1" id="f1" placeholder=" /100000000 " class="easyui-validatebox" style="width:100px; height:34px;" onkeyup="" readonly>
<!--<select class="easyui-combobox" name="f2a" id="f2a"
data-options="editable:false, panelHeight:'auto'" style="width:50px;">
<option value=""></option>
<option value="+"> + </option>
<option value="-"> - </option>
<option value="*"> * </option>
<option value="/"> / </option>
</select>-->
<input name="f2" id="f2" placeholder=" +100000000 " class="easyui-validatebox" style="width:100px; height:34px;" onkeyup="" readonly>
</div>
<!--<div class="fitem">
<label>Netto</label></br>
<input name="totcons" id="totcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
</div>-->
<div class="fitem">
<label>QRS</label></br>
<input name="qrs" id="qrs" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="" readonly>
</div>
<div class="fitem">
<label>Total PO</label></br>
<input name="pocons1" id="pocons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
<input name="pocons2b" id="pocons2" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
</div>
</div>
</div>
</form>
</div>

<div id="dialog-forminfo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:false,modal:true,closable:false"
style="width:377px;height:310px;padding:5px 5px;display:none;top:200px;">
<form id="forminfo" method="post">
<div class="modal-content">
<div id="close" style="margin-top:0px; margin-left:325px;">
<a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
onclick="$('#dialog-forminfo').dialog('close'); $('#forminfo').form('reset');"> X</a>
</div>
<input type="hidden" id="ponoi" name="ponoi">
<input type="hidden" id="rkbpki" name="rkbpki">
<input type="hidden" id="rkbpki2" name="rkbpki2">
<input type="hidden" id="popkship" name="popkship">
<input type="hidden" id="importshipa" name="importshipa">
<!-- <input type="hidden" id="popki" name="popki">
<input type="hidden" id="podtpki" name="podtpki"> -->
<div style="margin-top:-25px;margin-left: 15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Arrival date record</div><br>
<div id="tbinf"style="margin-left:15px;" onclick="routeship()">
<table id="dginf" class="easyui-datagrid" title="" style="width:320px;height:190px;" align="center" toolbar="#tb2" striped="false" border="true"
pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" data-options="multiSort:false">
<thead>
<tr>
<th field="vassalnm" width="100" formatter="formatter2">Shipment</th>
<th field="tgldtg" width="99">Date</th>
<th field="qtydtg" width="120">Amount</th>
<th field="popk" width="120" hidden="true">Popk</th>
<th field="importpk" width="120" hidden="true">importpk</th>
</tr>
</thead>
</table>
</div>
<span style="margin-left: 15px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;" id="qtyinfo"></span>
</div>
</form>
</div>

<!--Shipment detail -->
<div id="dialog-enroute2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:false,modal:true,closable:false"
style="width:1017px;height:550px;padding:5px 5px;display:none;top:100px;">
<div id="close" style="margin-top:5px; margin-left:960px;">
<a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
onclick="$('#dialog-enroute2').dialog('close');"> X</a>
</div>
<div id="shipdetail2" style="margin-top:-15px;">
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
                <td align="left"><input type="text" name="typenm2" id="typenm2" style="border:none;" readonly></td>
                <td align="left"><input type="text" name="vassalnm2" id="vassalnm2" style="width: 200px;border:none;" readonly></td>
                <td align="left"><input type="text" name="bill2" id="bill2" style="width: 200px;border:none;" readonly></td>
                <td align="left"><input type="text" name="arrival2" id="arrival2" style="border:none;" readonly></td>
                <td align="left"><input type="text" name="port2" id="port2" style="border:none;" readonly></td>
              </tr>
            </table>
			<br>
            <div class="ItemDetails" style="margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">Item details</div>
			<table border="0" style="margin-left:15px;">
              <tr>
                <th width="150" align="left">
                  <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">Gross weight</div>
                </th>
                <th width="250" align="left">
                  <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">Dimension of boxes</div>
                </th>
                <th width="250" align="left">
                  <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">Total Package</div>
                </th>
              </tr>
              <tr>
                <td align="left"><input type="text" name="gw2" id="gw2" style="border:none;" readonly></td>
                <td align="left">(P)<input type="text" name="dp2" id="dp2" style="width: 35px;border:none;" readonly>x (L)<input type="text" name="dl2" id="dl2" style="width: 35px;border:none;" readonly>x (T)<input type="text" name="dt2" id="dt2" style="width: 35px;border:none;" readonly>cm</td>
                <td align="left"><input type="text" name="amount2" id="amount2" style="border:none;" readonly></td>
              </tr>
            </table>
            <br>
            <div class="ItemDetails2" style="margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">Shipment dates</div>
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
                <td align="left"><input type="text" name="etd222" id="etd222" class="easyui-validatebox" style="border:none;" data-options="formatter:myformatter,parser:myparser" readonly></td>
                <td align="left"><input type="text" name="eta222" id="eta222" class="easyui-validatebox" style="border:none;" data-options="formatter:myformatter,parser:myparser" readonly></td>
                <td align="left"><input type="text" name="eih222" id="eih222" class="easyui-validatebox" style="border:none;" data-options="formatter:myformatter,parser:myparser" readonly></td>
              </tr>
            </table>
            <br>
			  <div id="tabel2c" onclick="" onmousemove="" style="margin-top:10px;margin-left:15px;">
				<div class="ItemDetails" style="color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">Shipment Log</div>
				<table id="dg2c" class="easyui-datagrid" title="" style="width:79%;" align="center" url="view/get_log_shipment.php" border="none" striped="false" idField="importdtpk" data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
					<thead>
						<tr>
							<th field="datelog" width="200" style="border:none;">Date</th>
							<th field="logchange" width="568">Changes</th>
						</tr>
					</thead>
				</table>
			</div>
</div>            
</div>

<script type="text/javascript">
window.onscroll = function() {myFunctiona();myFunctionb();};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunctiona(){
  if (window.pageYOffset > sticky){
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

// var header2 = document.getElementById("dialog-forminfo");
// var sticky2 = header2.offsetTop;
// function myFunctionb(){
//   if (window.pageYOffset > sticky2){
//     header2.classList.add("sticky");
//   } else {
//     header2.classList.remove("sticky");
//   }
// }
</script>
<?php } else {?>
  <!-- <div class="contenta" style="text-align:left;">
  <div id="frame-utama-cari" style="width:720px;text-align:left;margin-left:-31%;">

<div style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;margin-top:10%;">No data available. Please check in again later.</div>
</div>
</div> -->
<div id="frame-utama-cari" style="width:auto;text-align:left;top:180px;">
<span style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;">No data available. Please check in again later.</span>
</div>
</div>
<?php } ?>
