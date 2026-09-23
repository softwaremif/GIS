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


function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val(),
cari4: $('#cari4').val(),
cari5: $('#cari5').val()
});
}
</script>
<div class="contenta">
<div id="frame-utama-cari" style="width:805px;margin-top:10px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" width="18px" height="18px">
<input id="cari1" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
</div>
</div>
<input style="width:150px;" id="cari4" name="cari4" class="easyui-combobox"
data-options="valueField:'login',textField:'login',url:'view/get_data.php?dt=user',prompt:'User',onChange:Search,
limitToList:'true'">
<select class="easyui-combobox" id="cari5"
data-options="editable:false,prompt:'Action',panelHeight:'auto',onChange:Search" style="width:150px;" >
<option></option>
<option value="tambah">Tambah data</option>
<option value="import">Import data</option>
<option value="edit">Edit data</option>
<option value="delete">Delete data</option>
<option value="hapus">Hapus data</option>
<option value="unlock">Unlock data</option>
<option value="request">Cancel request</option>
<option value="remove">Remove item</option>
</select>
<select class="easyui-combobox" id="cari2"
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
<option value="<?php echo $bln1; ?>"><?php echo $bln[$bln2]; ?></option>
<?php
for($bulan=1; $bulan<=12; $bulan++){
?>
<option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
<?php } ?>
</select>
<select class="easyui-combobox" id="cari3"
data-options="editable: false,panelHeight:'auto',onChange:Search" style="width:150px;" >
<?php
for ($i=date('Y'); $i>=date('Y')-5 ; $i-=1){
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>
</div>

<div id="tabel1" onclick="" ondblclick="" style="top:200px;">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:415px;" align="center"
url="view/get_log.php" toolbar="#tb" striped="true" idField="ordpk"
pageSize="100" pageList="[100,200,300,500]" pagination="true" rownumbers="false"  multiple="true" collapsible="true" fitColumns="false" method="post"
data-options="onCheckAll:function(){menu();},onUncheckAll:function(){$('#myHeader').hide();},ctrlSelect:true,checkOnSelect:true,multiSort:true,remoteSort:false">
<thead>
<tr>
<th field="no" width="50" sortable="false" >No.</th>
<th field="logdate" width="100" sortable="true" >Log date</th>
<th field="logtime" width="100" sortable="true" >Log time</th>
<th field="logip" width="120" sortable="true">Log IP</th>
<th field="lognote" width="400" sortable="true">Log note</th>
<th field="user" width="100" sortable="true">Handle</th>
<th field="ordno" width="125" sortable="true">Order no</th>
<th field="item" width="200" sortable="true">Item</th>
<th field="sistem" width="200" sortable="true">Sistem</th>
</tr>
</thead>
</table>
</div>
</div>