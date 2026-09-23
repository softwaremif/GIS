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
top: 68px;
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

function menu(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#myHeader').show();
		count_row();
	} else {
	$('#myHeader').hide();
	$('#dg').datagrid('clearSelections');
	}
}

function menu2(){
  $('#myHeader').hide();
  $('#dg').datagrid('clearSelections');
}

function count_row(){
$('#myHeader').show();
var count = $('#dg').datagrid('getChecked').length;
if (count){
document.getElementById("count").innerHTML = count +" items selected";
} else {
document.getElementById("count").innerHTML = 0 +" items selected";
}
}

/*function add(){
   var rowa = $('#dg').datagrid('getSelected');
    if(rowa){
      	$('#dialog-forma').dialog('open').dialog('setTitle','');
       $('#forma').form('load',rowa);
    } else {
       $.messager.alert('Warning','No order data selected','warning');
    }
    var count2 = $('#dg').datagrid('getChecked').length;
    if (count2) {
        document.getElementById("count2").innerHTML = count2 +" order selected";
    }
}*/

function newuser(){
    $('#dialog-formb').dialog('open').dialog('setTitle','');
    /*var aa = document.getElementById("fupk").value;
    document.getElementById("fupk2").value=aa;
    $('#md2').data('combobox').refresh();*/
}

function edituser(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#dialog-formb').dialog('open').dialog('setTitle','');
		$('#formb').form('load',row);
	} else {
		$.messager.alert('Warning','No order data selected','warning');
	}
}

/*function edit2(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#dialog-forma').dialog('open').dialog('setTitle','');
		$('#forma').form('load',row);
	} else {
		$.messager.alert('Warning','No order data selected','warning');
	}
  var count2b = $('#dg').datagrid('getChecked').length;
    if (count2b) {
        document.getElementById("count2").innerHTML = count2b +" order selected";
    }
}*/

function save(){
		var string = $("#forma").serialize();
	 $('#forma').form('submit',{
  type	: "POST",
		url	 : "action/simpan.php?x=assign2",
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
			$('#dialog-forma').dialog('close');
			$('#forma').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
  $('#dg').datagrid('clearSelections');
  $('#dg').datagrid('clearChecked');
		}
	 });
}

function savenew(){
var lowerCaseLetters = /[a-z]/g;
var upperCaseLetters = /[A-Z]/g;
var numbers = /[0-9]/g;
var myInput = document.getElementById("pswd2");
if (!lowerCaseLetters || !upperCaseLetters || !numbers || myInput.value.length < 8 ){
$('#error1a').show();
}else{
  $('#error1a').hide();
		var string = $("#formb").serialize();
	 $('#formb').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=addusr",
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
			$('#dialog-formb').dialog('close');
			$('#formb').form('reset');
   //$('#forma').form('reload');
   window.location.href="?hal=list";
		}
	 });
}
}

function validasi(){
    var ids = [];
    var rows = $('#dg').datagrid('getSelections');
    for(var i=0; i<rows.length; i++){
    ids.push(rows[i].userpk); 
    }
    var implode = ids.join("");
    if (implode=="") {
        $('#ass').show();
        $('#close').show();
        $('#change').hide();
        //$('#edithandle').hide();
        //$('#newhandle').show();
        $('#count').css('margin-right','850px');
        //$('#frame-utama-cari').css('width','572px');
    } else if (implode>0 && ids.length==1) {
        $('#ass').hide();
        $('#close').show();
        $('#change').show();
        //$('#edithandle').show();
        //$('#newhandle').hide();
        $('#count').css('margin-right','800px');
        //$('#frame-utama-cari').css('width','520px');
    } else if (implode>0) {
        $('#ass').hide();
        $('#close').show();
        $('#change').hide();
        //$('#edithandle').hide();
        //$('#newhandle').show();
        $('#count').css('margin-right','975px');
        //$('#frame-utama-cari').css('width','572px');
    } else {
        $('#ass').show();
        $('#close').show();
        $('#change').hide();
        //$('#edithandle').hide();
        //$('#newhandle').show();
        $('#count').css('margin-right','850px');
        //$('#frame-utama-cari').css('width','572px');
    }
}


function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
}

function Search2a(){
$('#dg').datagrid('load',{
cari4: $('#cari4b').val()
});
	$('#newest').show();
		$('#oldest').hide();
 }

function Search2b(){
$('#dg').datagrid('load',{
cari5: $('#cari5b').val()
});
		$('#newest').hide();
		$('#oldest').show();
}

/*cetak*/
function cetak(){
cari1 = $('#cari1').val();
cari2 = $('#cari2').val();
cari3 = $('#cari3').val();
url = "pdf/pdf_sum?fu=<?php echo $_SESSION['funm']; ?>&cari1="+cari1+"&cari2="+cari2+"&cari3="+cari3;
window.open(url);    
}

$(function(){
//var hd = $('#dg').datagrid('getPanel').find('div.datagrid-header td');
//hd.css('border','none');
var td = $('#dg').datagrid('getPanel').find('div.datagrid-body td');
td.css('border','none');
var cells = $('#dg').datagrid('getPanel').find('div.datagrid-header td[field="fob"]');
cells.tooltip({
     position:'top',
     content: function() {
                var tp = "<span style='color: rgba(0, 0, 0, 0.6);font-size: 12px;line-height: 16px;'>The FOB price is an average of the total</br> sales divided by order quantity.</br> Some styles have various colors or types that</br> may have slightly different prices per unit.</span>";
                return tp;
     }  
 });
});

/*assignment*/
function assign(){
var ids = [];
var rows = $('#dg').datagrid('getChecked');
var row = $('#dg').datagrid('getSelected');
var count2 = $('#dg').datagrid('getChecked').length;
	if(rows){
	//alert(i);
	//document.getElementById("rkb2").value = ids;
	for(var i=0; i<rows.length; i++){
	ids.push(rows[i].ordpk);
	}
	$.each(ids, function (index, value){
	$.post('action/simpan.php?x=assign',{id:value},function(result){
if (result.success){
	/*$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:430,
	height:55,
	style:{
	left:0,
	right:'',
	bottom:''
	}
	});*/
	$('#dg').datagrid('reload');
	$('#dialog-forma').dialog('open').dialog('setTitle','');
 $('#forma').form('load',row);
    if (count2) {
        document.getElementById("count2").innerHTML = count2 +" order selected";
    }
 } else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:430,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
	/*$('#dialog-formc').dialog('close');*/
 }
	},'json')
	});
 } else {
	$.messager.alert('Warning','No order data selected','warning');
	}
}

function canassign(){
		var string = $("#forma").serialize();
	 $('#forma').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=canassign",
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
			$('#dialog-forma').dialog('close');
   $('#forma').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
		}
	 });
}
</script>
<div class="contenta">
<div id="frame-utama-cari" style="width:470px;margin-top:80px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" width="18px" height="18px">
<input id="cari1" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
</div>
</div>
<input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox"
data-options="valueField:'userpk',textField:'login',url:'view/get_data.php?dt=md',prompt:'Handle',onChange:Search,panelHeight:'auto',limitToList:'true'">
</input>
<input style="width:140px; height:28px;"  id="cari3" class="easyui-combobox"
data-options="valueField:'season',textField:'season',url:'view/get_data.php?dt=season',prompt:'Season',onChange:Search,limitToList:'true'">
<!--<a href="javascript:void(0);" style="text-decoration:none;" onclick="newuser();">
<div id="newhandle" style="margin-left:0px;margin-top:0px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: #359DD9;">&nbsp; Add Handle</div></a>
<a href="javascript:void(0);" style="text-decoration:none;" onclick="edituser();">
<div id="edithandle" style="font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: #359DD9;display:none;">&nbsp; Edit</div></a>
-->
</div>

<div id="frame-filter" style="margin-left:50px;top:235px;width:60px;">
<div id="frame-filter-newest">
<div class="dropdwn">	
<input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button" class="dropbtn">
<div id="myDropdown" class="dropdwn-content">
<input type="hidden" id="cari4b" value="1" name="cari4">
<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Search2a();">Newest entry</a></div>
<input type="hidden" id="cari5b" value="1" name="cari5">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Oldest entry</a></div>
</div>
</div>
<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
<div id="newest" class="newest" onclick="myFunction();">Newest</div>
<div id="oldest" class="newest" onclick="myFunction();" style="display:none;">Oldest</div>
</a>
</div>
</div>

<div id="tabel1" onclick="menu(); validasi();" ondblclick="" style="top:280px;">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:360px;" align="center"
url="view/get_list.php" toolbar="#tb" striped="true" idField="ordpk"
pageSize="100" pageList="[100,200,300,500]" pagination="true" rownumbers="false"  multiple="true" collapsible="true" fitColumns="false" method="post"
data-options="onCheckAll:function(){menu();},onUncheckAll:function(){$('#myHeader').hide();},ctrlSelect:true,checkOnSelect:true,multiSort:true,remoteSort:false">
<thead>
<tr>
<th data-options="field:'ck',checkbox:true"></th>
<th field="artno" width="150" sortable="true" >Style</th>
<th field="byrnm" width="150" sortable="true">Buyer</th>
<th field="season" width="150" sortable="true">Season</th>
<th field="ordno" width="200" sortable="true">Order no</th>
<th field="prodes" width="400" sortable="true">Product Description</th>
<th field="handle" width="195" sortable="true">Handle</th>
</tr>
</thead>
</table>
</div>
</div>

<div class="header" id="myHeader" onclick="$('#myHeader').hide();"  style="display:none">
<div id="count" style="color:#ffffff;"></div>
<div class="detail" id="change" style="width:150px;"><a href="javascript:void(0)" plain="true" onclick="assign();" style="color: #FFFFFF; text-decoration: none;"> Change Assigment </a></div>
<div class="detail" id="ass"><a href="javascript:void(0)" plain="true" onclick="assign();" style="color: #FFFFFF; text-decoration: none;"> Assign Order </a></div>
<div class="detail" id="close"><a href="javascript:void(0)" plain="true" onclick="menu2();$('#dg').datagrid('clearSelections');" style="color: #FFFFFF; text-decoration: none;"> Close Menu </a></div>
</div>

<!-- Assignment -->
<div id="dialog-forma" class="easyui-dialog" closed="true" buttons="#dialog-buttons" closed="true" data-options="border:false,title:false,closable:false,resizable:false,modal:true"
style="width:390px;height:235px;top:100px;padding:5px 5px;display:none;border-radius:8px;">
<!-- <div class="modal-dialog" style="width:365px; height:210px;"> -->
<form id="forma" method="post">
<input type="hidden" name="ordpk" id="ordpk">
<input type="hidden" name="fupk2" id="fupk2" value="<?php echo $_SESSION['fu']; ?>">
<div id="count2" style="margin-top:16px;margin-left:16px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;"></div>
<div style="margin-top:-30px;margin-left:345px;">
<a href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:18px;"
onclick="canassign();"> X</a>
</div>
<div style="margin-top:17px;margin-left:16px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
Please choose a merchandiser to handle these orders
</div>
<div style="margin-top:16px;margin-left:16px;">
<input style="width:165px; height:34px;" id="md2" name="md2" class="easyui-combobox"
data-options="valueField:'userpk',textField:'login',url:'view/get_data.php?dt=md',prompt:'Choose handle',panelHeight:'auto',limitToList:'true'">
<!--<a href="javascript:void(0);" style="text-decoration:none;" onclick="newuser();">
<div id="newhandle" style="margin-left:175px;margin-top:-25px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: #359DD9;">&nbsp; Add Handle</div></a>
<a href="javascript:void(0);" style="text-decoration:none;" onclick="">
<div id="edithandle" style="font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: #359DD9;display:none;">&nbsp; Edit</div></a>-->
</div>
<a style="text-decoration:none; left:205px; top: 170px;"" href="javascript:void(0)" class="button-request-po" onclick="save();">Save</a>
</form>
<!-- </div> -->
</div>

<!-- Add new user -->
<div id="dialog-formb" class="easyui-dialog" closed="true" buttons="#dialog-buttons" closed="true" data-options="title:false,closable:false,resizable:false,modal:true"
style="width:390px;height:395px;top:100px;padding:5px 5px;display:none;">
<div class="modal-dialog" style="width:365px; height:370px;">
<form id="formb" method="post">
<input type="hidden" name="fupk2" id="fupk2" value="<?php echo $_SESSION['fu']; ?>">
<input type="hidden" name="userpk" id="userpk2">
<input type="hidden" name="domain" id="domain" value="@ptmorich.com">
<div style="margin-top:10px;margin-left:345px;">
<a href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:18px;"
onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset');"> X</a>
</div>
<div style="margin-top:0px;margin-left:25px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
New account for merchandiser
</div>
<div style="margin-top:16px;margin-left:25px;">
<span style="font-style: normal;font-weight: 700;font-size: 14px;line-height: 20px;">Username</span><br>
<input type="text" name="login" id="usr" class="easyui-validatebox" required="true" style="width: 244px;height: 34px;">
</div>
<div style="margin-top:16px;margin-left:25px;">
<span style="font-style: normal;font-weight: 700;font-size: 14px;line-height: 20px;">Email</span><br>
<input type="text" name="username2" id="email2" class="easyui-validatebox" required="true" style="width: 175px;height: 34px;"> @ptmorich.com
</div>
<div style="margin-top:16px;margin-left:25px;">
<span style="font-style: normal;font-weight: 700;font-size: 14px;line-height: 20px;">Password</span><br>
<input type="text" name="password" id="pswd2" class="easyui-validatebox" onkeyup="$('#error1a').hide();" required="true" style="width: 244px;height: 34px;">
<div id="error1a" style="text-align:justify; margin-left:0px;  font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none">
<li>Password must be at least 8 characters and contain upper case, lowercase, numbers, and special characters.</li>
</div>
</div>
<a style="text-decoration:none; left:205px; top: 330px;" href="javascript:void(0)" class="button-request-po" onclick="savenew();">Save</a>
</form>
</div>
</div>
<script type="text/javascript">
window.onscroll = function(){ myFunctiona(); };
var header = document.getElementById("myHeader");
//var header2 = document.getElementById("dialog-forma");
var sticky = header.offsetTop;
function myFunctiona(){
  if (window.pageYOffset > sticky){
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
/*function myFunctionb() {
  if (window.pageYOffset > sticky) {
    header2.classList.add("sticky");
  } else {
    header2.classList.remove("sticky");
  }
}*/
</script>