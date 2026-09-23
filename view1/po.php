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
/*refresh*/
/*function refresh(){  
	$('#dg').datagrid('reload');
}*/
	
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
<?php
$tot1= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join sup on sup.suppk=rpo.suppk
left outer join cur on  cur.curpk=rpo.curpk
WHERE rpo.stspk='1'"));

$tot2="";

$tot3="";
?>
<!-- Detail -->
<div id="judul">PO requests</div>
<!--tab-->
<div id="frame-menu-detail" style="width:50%;height:auto;">
<div class="easyui-tabs" id="tt">
<!--breakdwownqty-->
<div title="<div id=tot1 onclick=tot1();>New requests (<?php echo $tot1; ?>)</div>" href="view/new.php">
</div>
<!--allmaterial-->
<div title="<div id=tot2 onclick=tot2();>Awaiting PI (<?php echo $tot2; ?>)</div>" href="view/waiting.php">
</div>
<!--workedon-->
<div title="<div id=tot3 onclick=tot3();>Purchased (<?php echo $tot3; ?>)</div>" href="view/purchased.php">
</div>
<!--end-->
</div>
</div>
</body>
</html>