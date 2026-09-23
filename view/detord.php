<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/gray/easyui.css">
<!-- <link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/default/easyui.css"> -->
<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/icon.css">
<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/color.css">
<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/demo.css">
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.min.js"></script>
<!--<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.easyui.min.js"></script>
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.edatagrid.js"></script>
<script type="text/javascript">
var url;

/*open dialog*/
function create(){
	$('#dialog-formb').dialog('open').dialog('setTitle','Add Material');
	$('#formb').form('clear');
}

/*save*/
function saveb(){
		var string = $("#formb").serialize();
	 $('#formb').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=mat",
		data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
		success	: function(data){
			$.messager.show({
					title:'',
					msg:data, 
					timeout:5000,
					showType:'slide',
					icon:'info',
					width:300,
					height:55,
					style:{
					left:0,
     right:'',
     bottom:''
     }
					});
			$('#dialog-formb').dialog('close');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg2').datagrid('reload');
		}
	 });
}

/*delete*/
function delmat(){  
	var row = $('#dg2').datagrid('getSelected');  
	if (row){  
		$.messager.confirm('Confirm','Are you sure you want to delete this material?',
		function(r){ 
			if (r){  
				$.ajax({
					type	: "POST",
					url	: "action/delete.php?x=mat",
					data	: 'id='+row.rkbpk,
					success	: function(data){
						$.messager.show({
							title:'',
							msg:data, 
							timeout:5000,
							showType:'slide',
							icon:'info',
							width:252,
							height:55,
							style:{
							left:0,
	      right:'',
							bottom:''
							}
						});
						$('#dg2').datagrid('reload');
					}
				});  
			}  
		});  
	}  else {
		$.messager.alert('Warning','No order data selected','warning');
	}
}

/*edit*/
function update(){
	var row = $('#dg2').datagrid('getSelected');
	if(row){
		$('#dialog-formb').dialog('open').dialog('setTitle','');
		$('#formb').form('load',row);
	} else {
		$.messager.alert('Warning','No order data selected','warning');
	}
}

/*print*/
function print(){
var row = $('#dg2').datagrid('getSelected');
var data = JSON.stringify($('#dg2').datagrid('getData').total);
var tabmat = "All material ("+data2+")";
	if(row){
		document.write(tabmat);  
		/*url = "pdf/pdf_qty2.php?ord="+row.ordpk;
  window.open(url);*/
		/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	} /*else {
		$.messager.alert('Warning','No order breakdown data selected','warning');
	}*/
}

function print2(){
	var row = $('#dg2').datagrid('getSelected');
	if(row){
		cari6 = $('#cari6b').val();
		url = "pdf/pdf_mat.php?ord="+row.ordpk+"&cari="+cari6;
  window.open(url);
		/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	} else {
		$.messager.alert('Warning','No material data selected','warning');
	}
}

/*refresh*/
function refresh(){  
	$('#dg').datagrid('reload');
}

/*search*/
function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val()
});
}

function Searchb(){
$('#dg2').datagrid('load',{
cari1: $('#cari1b').val(),
cari2: $('#cari2b').val(),
cari3: $('#cari3b').val(),
cari6: $('#cari6b').val()
});
 }
	
function Search2b(){
$('#dg2').datagrid('load',{
cari4: $('#cari4b').val()
});
 }

function Search3b(){
$('#dg2').datagrid('load',{
cari5: $('#cari5b').val()
});
}
	
//DROPDOWN
function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('')) {
var dropdowns = document.getElementsByClassName("dropdwn-content");
var i;
for (i = 0; i < dropdowns.length; i++) {
  var openDropdown = dropdowns[i];
  if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
  }
}
  }
}
</script>
<script type="text/javascript">
/*tab*/
/*$(function(){
var tabs = $('#tt','#tt2').tabs().tabs('tabs');
for(var i=0; i<tabs.THREAD length; i++){
tabs[i].panel('options').tab.unbind().bind('mouseenter',{index:i},function(e){
$('#tt','#tt2').tabs('select', e.data.index);
});
}
});*/
$(function(){
var tabs = $('#tt').tabs().tabs('tabs');
$('#tt').tabs({
	onSelect: function(title,index){
		$('#tt').tabs('getTab',index).panel('refresh');
	}
});
});

/*edatagrid*/
$(function(){
    $('#dg').edatagrid({
								//saveUrl: 'action/simpan.php?x=qty',
        updateUrl:'action/simpan.php?x=qty',
								destroyUrl: 'action/delete.php?x=qty'
    });
});

function myformatter(date){
var y = date.getFullYear();
var m = date.getMonth()+1;
var d = date.getDate();
return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function myparser(s){
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

/*var editIndex = undefined;
function endEditing(){
    if (editIndex == undefined){return true}
    if ($('#dg').datagrid('validateRow', editIndex)){
$('#dg').datagrid('endEdit', editIndex);
editIndex = undefined;
return true;
    } else {
return false;
    }
}
function onClickCell(index, field){
    if (editIndex != index){
if (endEditing()){
    $('#dg').datagrid('selectRow', index)
    .datagrid('beginEdit', index);
    var ed = $('#dg').datagrid('getEditor', {index:index,field:field});
    if (ed){
($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
    }
    editIndex = index;
} else {
    setTimeout(function(){
$('#dg').datagrid('selectRow', editIndex);
    },0);
}
    }
}

function onEndEdit(index, row){
var ed = $(this).datagrid('getEditor', {
index: index,
field: 'bdownpk'
    });
    row.productname = $(ed.target).combobox('getText');
}
function append(){
    if (endEditing()){
$('#dg').datagrid('appendRow',{status:'P'});
editIndex = $('#dg').datagrid('getRows').length-1;
$('#dg').datagrid('selectRow', editIndex)
.datagrid('beginEdit', editIndex);
    }
}
function removeit(){
    if (editIndex == undefined){return}
    $('#dg').datagrid('cancelEdit', editIndex)
    .datagrid('deleteRow', editIndex);
    editIndex = undefined;
}
/*function acceptit(){
if (endEditing()){
$('#dg').datagrid('acceptChanges');
    }
}
function reject(){
    $('#dg').datagrid('rejectChanges');
    editIndex = undefined;
}
function getChanges(){
    var rows = $('#dg').datagrid('getChanges');
    alert(rows.length+' rows are changed!');
}*/
</script>
</head>
<body>
<!-- Detail -->
<?php
$cari=mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno,
ord.artno, ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$_GET[ord]'");
$dt=mysqli_fetch_array($cari);
?>
<div id="frame-utama-judul">
<div class="frame-arrow">
<input type="image" src="css/images/Vector2.png" class="panah-samping" onclick="window.history.back();">  
</div>
<div class="frame-judul">
<div class="font-judul-atas">Order <?php echo $dt['ordno']; ?></div>
<div class="font-judul-bawah"><?php echo $dt['byrnm']; ?>, Season <?php echo $dt['season']; ?></div>
</div>
<div class="frame-judul-samping">
<div class="frame-utama-md">
<font class="md">MD</font>
<font class="nm-md"><?php echo $dt['funm']; ?></font>
</div>
<div class="frame-utama-article">
<font class="article">Article</font>
<font class="article-number"><?php echo $dt['artno']; ?></font>
</div>
<div class="frame-utama-Product">
<font class="product">Product</font>
<font class="dt-product"><?php echo $dt['prodes']; ?></font>
</div>
</div>
</div>
<!--tab-->
<div id="frame-menu-detail" style="width:50%;height:auto">
<div class="easyui-tabs" id="tt">
<!--breakdwownqty-->
<div title="Order breakdown">
<div id="menu5" onclick="$('#menu5').fadeOut(700);"  style="display:none; left:-830px; top:-40px;">
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')" style="color: #FFFFFF; text-decoration: none;"> Save </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')" style="color: #FFFFFF; text-decoration: none;">Delete </a></div>-->
</div>
<div id="frame-utama-cari" style="left:-780px; top:72px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
<input id="cari1" placeholder="Search PO no." class="input" plain="true" onkeyup="Search();">
</div>
</div>
<a href="pdf/pdf_qty2.php?ord=<?php echo $_GET['ord']; ?>" target="_blank">
<input style="width:119px;" type="button" name="submit" value="Print breakdown" class="button-submit-add" plain="true">
</a>
</div>
<div id="tabel" ondblclick="$('#menu5').fadeIn(700);" style="left:-780px; top:117px;">
TEST
<script type="text/javascript">
var data2 = JSON.stringify($('#dg2').datagrid('getData').total);
var tabmat2 = "All material";
var test2 = "BISA";
document.open();
document.write(tabmat2);
document.close();
</script>
<?php echo json_encode($tabmat2); ?>
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_detord.php?ord=<?php echo $_GET['ord']; ?>" idField="bdownpk" toolbar="#tb" striped="true" showFooter="false"
pagination="false" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false">
<thead>
<tr>
<th field="country" width="98" sortable="true" rowspan="2" editor="{type:'validatebox',options:{required:true}}">Place</th>
<th field="pono" width="98" sortable="true" rowspan="2" editor="{type:'validatebox',options:{required:true}}">PO no.</th>
<th field="opno" width="91" sortable="true" rowspan="2" editor="{type:'validatebox',options:{required:true}}">OP no.</th>
<th field="style" width="100" sortable="true" rowspan="2" editor="{type:'validatebox',options:{required:true}}">Style</th>
<th field="color" width="91" sortable="true" rowspan="2" editor="{type:'validatebox',options:{required:true}}">Color</th>
<th field="gac" width="90" sortable="true" rowspan="2" editor="{type:'datebox',options:{formatter:myformatter,parser:myparser}}">GAC</th>
<th colspan="15"><b>Quantity / Size</b></th>
<th align="right" field="tot" width="60" sortable="true" rowspan="2">Total</th>
</tr>
<tr>
<th field="s1"  width="43" sortable="true" editor="numberbox"></th>
<th field="s2"  width="43" sortable="true" editor="numberbox"></th>
<th field="s3"  width="43" sortable="true" editor="numberbox"></th>
<th field="s4"  width="43" sortable="true" editor="numberbox"></th>
<th field="s5"  width="43" sortable="true" editor="numberbox"></th>
<th field="s6"  width="43" sortable="true" editor="numberbox"></th>
<th field="s7"  width="43" sortable="true" editor="numberbox"></th>
<th field="s8"  width="43" sortable="true" editor="numberbox"></th>
<th field="s9"  width="43" sortable="true" editor="numberbox"></th>
<th field="s10"  width="43" sortable="true" editor="numberbox"></th>
<th field="s11"  width="43" sortable="true" editor="numberbox"></th>
<th field="s12"  width="43" sortable="true" editor="numberbox"></th>
<th field="s13"  width="43" sortable="true" editor="numberbox"></th>
<th field="s14"  width="43" sortable="true" editor="numberbox"></th>
<th field="s15"  width="43" sortable="true" editor="numberbox"></th>
</tr>
</thead>
</table>
</div>
</div>

<!--allmaterial-->
<div title="All materials (0)">
<div id="menu" onclick="$('#menu').fadeOut(700);"  style="display:none; left:-830px; top:-40px;">
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="request();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="print();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="copy();" style="color: #FFFFFF; text-decoration: none;"> Copy </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="delmat();" style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
</div>

<div id="frame-utama-cari" style="left:-780px; top:72px; width:775px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
<input id="cari1b" placeholder="Search Item" class="input" onkeyup="Searchb();">
</div>
</div>
<input type="button" name="submit" value="&#10010; Material" class="button-submit-add" onclick="create();">
<input style="width:140px; height:28px;" id="cari2b" class="easyui-combobox"
data-options="prompt:'Status',onChange:Searchb,panelHeight:'auto',
data: [
{value:'1',text:'In Progress'},
{value:'2',text:'Ready for PO'},
{value:'3',text:'PO in process'},
{value:'4',text:'Need revision'},
{value:'5',text:'Purchased'}
]">
<input style="width:200px; height:28px;"  id="cari3b" class="easyui-combobox"
data-options="valueField:'supnm',textField:'supnm',url:'view/get_data.php?dt=supplier',prompt:'Supplier',onChange:Searchb,limitToList:'true'">
<input style="width:140px; height:28px;" id="cari6b" class="easyui-combobox"
data-options="prompt:'Type',onChange:Searchb,panelHeight:'auto',
data: [
{value:'ALL',text:'ALL'},
{value:'CUTTING',text:'CUTTING'},
{value:'SEWING',text:'SEWING'},
{value:'FINISHING',text:'FINISHING'}
]">
</div>
<div id="frame-filter" style="left:225px; top:80px;">
<div id="frame-filter-fields">    
<div class="fields">Fields</div>
<div class="all">All</div>
<input type="image" class="panah2" src="css/images/Polygon.png" style="filter:brightness(0%);" alt="Submit button">
</div>
<div id="frame-filter-newest">
<div id="dropdwn">	
<input type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button" onclick="myFunction()" class="dropbtn">
<div id="myDropdown" class="dropdwn-content">
<input type="hidden" id="cari4b" value="1" name="cari4">
<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Newest entry</a></div>
<input type="hidden" id="cari5b" value="1" name="cari5">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Search3b();">Oldest entry</a></div>
</div>
</div>
<div class="newest">Newest</div>
</div>
<div id="frame-filter2">
<input type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px" alt="Submit button">
<div class="filter">Filter</div>
</div>
</div>

<div id="tabel" ondblclick="$('#menu').fadeIn(700);" style="left:-780px; top:117px;">
<table id="dg2" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_material.php?ord=<?php echo $_GET['ord']; ?>" toolbar="#tb2" striped="true"
pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post">
<thead>
<tr>
<th field="no" width="55" sortable="false">No</th>
<th field="item" width="120" sortable="true">Item</th>
<th field="supnm" width="200" sortable="true">Supplier</th>
<th field="sts" width="120" sortable="true">Status</th>
<th field="spec" width="328" sortable="true">Specification</th>
<th field="qty" width=100" sortable="true">Qty</th>
<th field="unit" width="110" sortable="true">Units</th>
<th field="colname" width="120" sortable="true">Color</th>
<th field="price" width="120" sortable="true">Price</th>
</tr>
</thead>
</table>
</div>

<div id="dialog-formb" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="resizable:true,modal:true"
style="width:899px;height:1000px;padding:5px 5px;display:none;top:15px">
<form id="formb" method="post">
	<input type="hidden" name="ordpk" >
 <input type="hidden" name="rkbpk" >
   <div class="fitem">
			<label>Group</label></br>
			<select name="group" class="easyui-validatebox" style="width: 162px; height:34px;">
   <option></option>
			</select>
		</div>
   <div class="fitem">
			<label >Item</label></br>
			<input name="item" class="easyui-validatebox" style="width: 244px; height:34px;" placeholder="Input item name...">
		</div>
<div class="fitem">
			<label>Supplier</label></br>
			<select name="supplier" class="easyui-validatebox" style="width: 162px; height:34px;">
			<option value=""></option>
			</select>
		</div></br>
 <label style="margin-left: 24px;">Specification <a href="#">Search for material</a></label>
<div class="fitem">
 <input type="radio" name="radio" id="single-kolom" onclick="$('#hidden').fadeOut(500)">
 <label>Single Column</label>
 <input type="radio" name="radio" id="multi-kolom" onclick="$('#hidden').fadeIn(500)">
 <label>Multi Column</label>
</div>
<div class="fitem">
 <input name="ket" class="easyui-textbox" multiline="true" style="width:848px; height: 95px;">
</div>
<div id="hidden"  style="display: none;">
<div class="fitem">
			<input name="header1" id="header1" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
   <input name="header2" id="header2"class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
   <input name="header3" id="header3"class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
   <input name="header4" id="header4"class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
   <input name="header5" id="header5"class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
   <input name="header6" id="header6"class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="header...">
		</div>
<div class="fitem">
			<input name="value1" id="value1" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
   <input name="value2" id="value2" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
   <input name="value3" id="value3" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
   <input name="value4" id="value4" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
   <input name="value5" id="value5" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
   <input name="value6" id="value6" class="easyui-validatebox" style="width: 138px; height:34px;" placeholder="value...">
		</div></br>
  </div>
<div class="fitem">
			<label>Color Name</label>&emsp;&emsp;&emsp;&emsp;
   <label>Color Code</label>
</div>
<div class="fitem">
			<input name="colname" id="colname" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input color...">&nbsp;
			<input name="colcode" id="colcode" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input code..."> <a href="#">Lookup</a>
			</div>
<div class="fitem">
			<label>Size</label></br>
			<input name="size" id="size" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input size..."> <a href="#">Lookup</a>
			</div>
<div class="">
			<label style="margin-left: 24px;font-size: 15px;">Unit</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
   <label style="font-size: 15px;">Unit price actual</label>&nbsp;&nbsp;
   <label style="font-size: 15px;">Currency</label>
			</div>
<div class="fitem">
 <input name="unit" id="unit" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input Unit...">&nbsp;
 <input name="unitprice" id="unitprice" class="easyui-validatebox" style="width: 103px; height:34px;" placeholder="0">&nbsp;
 <select name="currency" id="currency" class="easyui-validatebox" style="width: 88px; height:34px;">
			<option value=""></option>
			</select>
</div>
<div class="fitem">
			<label>Bdown Qty.</label></br>
			<input name="bdown" id="bdown" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0"> <a href="#">Lookup</a>
			</div>
<div>
			<label style="margin-left: 24px;font-size: 15px;">Allowance%</label>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
   <label style="font-size: 15px;">Coasting cons.</label>&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
   <label style="font-size: 15px;">Purcashing Cons.</label>
</div>
<div class="fitem">
 <input name="allowance" id="allowance" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0">&nbsp;
 <input name="coasting" id="coasting" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0">&nbsp;
 <input name="purchas" id="purchas" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0">
</div>
<div class="fitem">
			<label>Netto</label></br>
			<input name="netto" id="netto" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" disabled>
			</div>
<div class="fitem">
			<label>QRS</label></br>
			<input name="qrs" id="qrs" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" disabled>
			</div>
<div class="fitem">
			<label>Total PO</label></br>
			<input name="total" id="total" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" disabled>
</div>
<a style="text-decoration:none; left:475px; bottom: 77px;" href="javascript:void(0)" class="button-cancel" onclick="jQuery('#dialog-formb').dialog('close');">Cancel</a>
 <!-- <a style="text-decoration:none;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>-->
								<a style="text-decoration:none; left:550px; bottom: 75px;" href="javascript:void(0)" value="Save" class="button-submit">Save</a>
 <a style="text-decoration:none;" href="javascript:void(0)" class="button-request-po">Save & Request PO</a>      
</form>
</div>

</div>
<!--workedon-->
<div title="Worked on (0)">
<div style="margin-top:1%; width:40%;height:auto">
<div class="easyui-tabs" id="tt2">
<!--inprogress-->
<div title="In progress (0)">

<div id="menu2" onclick="$('#menu2').fadeOut(700);"  style="display:none; left:-830px; top:-40px;">
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="editc();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="print();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="delmat();" style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
</div>

<div id="tabel" ondblclick="$('#menu2').fadeIn(700);" style="left:-780px; top:100px;">
<table id="dg3a" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_material.php?ord=<?php echo $_GET['ord']; ?>&cek=1" toolbar="#tb2" striped="true"
pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post">
<thead>
<tr>
<th field="no" width="55" sortable="false">No</th>
<th field="item" width="120" sortable="true">Item</th>
<th field="supnm" width="200" sortable="true">Supplier</th>
<th field="sts" width="120" sortable="true">Status</th>
<th field="spec" width="328" sortable="true">Specification</th>
<th field="qty" width=100" sortable="true">Qty</th>
<th field="unit" width="110" sortable="true">Units</th>
<th field="colname" width="120" sortable="true">Color</th>
<th field="price" width="120" sortable="true">Price</th>
</tr>
</thead>
</table>
</div>
</div>
<!--readyforpo-->
<div title="Ready for PO (0)">
<div id="menu3" onclick="$('#menu3').fadeOut(700);"  style="display:none; left:-830px; top:-40px;">
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="request();" style="color: #FFFFFF; text-decoration: none;"> Request PO </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="print();" style="color: #FFFFFF; text-decoration: none;"> Print </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="delmat();" style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
</div>

<div id="tabel" ondblclick="$('#menu3').fadeIn(700);" style="left:-780px; top:100px;">
<table id="dg3b" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_material.php?ord=<?php echo $_GET['ord']; ?>&cek=2" toolbar="#tb2" striped="true"
pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post">
<thead>
<tr>
<th field="no" width="55" sortable="false">No</th>
<th field="item" width="120" sortable="true">Item</th>
<th field="supnm" width="200" sortable="true">Supplier</th>
<th field="sts" width="120" sortable="true">Status</th>
<th field="spec" width="328" sortable="true">Specification</th>
<th field="qty" width=100" sortable="true">Qty</th>
<th field="unit" width="110" sortable="true">Units</th>
<th field="colname" width="120" sortable="true">Color</th>
<th field="price" width="120" sortable="true">Price</th>
</tr>
</thead>
</table>
</div>
</div>
</div>
</div>
</div>
<!--purchasing-->
<div title="Purchasing (0)">
<div id="menu4" onclick="$('#menu4').fadeOut(700);"  style="display:none; left:-830px; top:-40px;">
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="printpi();" style="color: #FFFFFF; text-decoration: none;"> View PI form </a></div>
</div>

<div id="tabel" ondblclick="$('#menu4').fadeIn(700);" style="left:-780px; top:117px;">
<table id="dg4" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_po.php?ord=<?php echo $_GET['ord']; ?>" toolbar="#tb2" striped="true"
pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post">
<thead>
<tr>
<th field="no" width="40" sortable="false">No</th>
<th field="item" width="100" sortable="true">Item</th>
<th field="supnm" width="150" sortable="true">Supplier</th>
<th field="colname" width="100" sortable="true">Color</th>
<th field="sts" width="100" sortable="true">Status</th>
<th field="pono" width="80" sortable="true">PO no.</th>
<th field="price" width="90" sortable="true">Price</th>
<th field="qty" width=80" sortable="true">Qty</th>
<th field="unit" width="80" sortable="true">Units</th>
<th field="piqty" width="80" sortable="true">PI Qty</th>
<th field="piprice" width="90" sortable="true">PI Price</th>
<th field="pitot" width="90" sortable="true">PI Total</th>
<th field="spec" width="192" sortable="true">Specification</th>
</tr>
</thead>
</table>
</div>
</div>
<!--end-->
</div>
</div>
</body>
</html>