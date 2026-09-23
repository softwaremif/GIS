<?php session_start(); ?>
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
/*refresh*/
/*function refresh(){  
	$('#dg').datagrid('reload');
}*/
	
//DROPDOWN
function myFunction(){
document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event){
  if (!event.target.matches('')){
var dropdowns = document.getElementsByClassName("dropdwn-content");
var i;
for (i = 0; i < dropdowns.length; i++){
  var openDropdown = dropdowns[i];
  if (openDropdown.classList.contains('show')){
openDropdown.classList.remove('show');
  }
}
  }
}

/*tab*/
/*$(function(){
var tabs = $('#tt','#tt2').tabs().tabs('tabs');
for(var i=0; i<tabs.THREAD length; i++){
tabs[i].panel('options').tab.unbind().bind('mouseenter',{index:i},
function(e){
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
$ord=$_GET['ord'];
$cari=mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno,
ord.artno, ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord'");
$dt=mysqli_fetch_array($cari);

$tot1= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.stspk is null and rkb.sts<=3"));

$tot3= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.stspk>=1 and rkb.sts>3"));
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
<div id="frame-menu-detail" style="width:50%;height:auto;">
<div class="easyui-tabs" id="tt">
<!--breakdwownqty-->
<div title="Order breakdown" href="view/qty.php?ord=<?php echo $ord; ?>">
</div>
<!--allmaterial-->
<div title="<div id=count1 onclick=tot1();>All materials (<?php echo $tot1; ?>)</div>" href="view/material.php?ord=<?php echo $ord; ?>">
</div>
<!--workedon-->
<div title="<div id=count2 onclick=tot2();>Worked on (<?php echo $tot1; ?>)</div>" href="view/material1.php?ord=<?php echo $ord; ?>">
</div>
<!--purchasing-->
<div title="<div id=count3 onclick=tot3();>Purchasing (<?php echo $tot3; ?>)</div>" href="view/purchasing.php?ord=<?php echo $ord; ?>">
</div>
<!--end-->
</div>
</div>
</div>
</div>
</body>
</html>