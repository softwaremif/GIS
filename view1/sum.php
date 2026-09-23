<script type="text/javascript">
var url;

function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari3: $('#cari3').val()
});
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
</script>
<?php if($_SESSION['gusernm']=="admin"){ ?>
<div id="frame-utama-cari" style="width:440px;top:200px;">
<?php } else { ?>
<div id="frame-utama-cari" style="width:440px;top:235px;">
<?php } ?>
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" width="18px" height="18px">
<input id="cari3" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
</div>
</div>
<select class="easyui-combobox" id="cari1"
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
<option value="<?php //echo $bln1; ?>"><?php //echo $bln[$bln2]; ?></option>
<?php
for($bulan=1; $bulan<=12; $bulan++){
?>
<option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
<?php } ?>
</select>
<select class="easyui-combobox" id="cari2"
data-options="editable: false,panelHeight:'auto',onChange:Search" style="width:100px;" >
<?php
for ($i=date('Y'); $i>=date('Y')-5 ; $i-=1){
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>
<input style="left:445px;" type="button" name="submit" value="Print" class="button-submit-add" plain="true" onclick="cetak();">
</div>
<?php if($_SESSION['gusernm']=="admin"){ ?>
<div id="tabel1" onclick="" ondblclick="" style="top:250px;">
<?php } else { ?>
<div id="tabel1" onclick="" ondblclick="" style="top:280px;">
<?php } ?>
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:500px;" align="center"
url="view/get_sum.php" toolbar="#tb" striped="true"
pageSize="100" pageList="[100,200,300,500]" pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post"
data-options="multiSort:true,remoteSort:false">
<thead>
<tr>
<th field="no" width="50" sortable="false" >No.</th>
<th field="nokp" width="100" sortable="true" >OP</th>
<th field="buyer" width="150" sortable="true">Buyer</th>
<th field="funame" width="100" sortable="true">MD</th>
<th field="tglship" width="130" sortable="true">Shipment Date</th>
<th field="qty" width="100" sortable="true" align="right">Order Qty</th>
<th field="kurs" width="100" sortable="true" align="right">Rate</th>
<th field="fob" width=150" title="test" sortable="true" align="right">FOB Price <a href="javascript:void(0)" style="text-decoration:none; color:#359DD9;">(!)</a></th>
<th field="hrg" width=150" sortable="true" align="right">Total Sales</th>
<th field="cost" width="150" sortable="true" align="right">Material Cost</th>
<th field="pfob" width="115" sortable="true">% of FOB</th>
</tr>
</thead>
</table>
</div>