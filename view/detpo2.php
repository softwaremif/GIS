<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/gray/easyui2.css">
<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery.edatagrid.js"></script>
<script type="text/javascript" src="media/jquery-easyui-1.9.15/datagrid-cellediting.js"></script>
<script type="text/javascript">
var url;

/*edatagrid*/
$(function(){
    $('#dg').edatagrid({
	//saveUrl: 'action/simpan.php?x=qty',
    updateUrl:'action/simpan.php?x=updtpo2',
	//destroyUrl: 'action/delete.php?x=qty',
    onSuccess: function(index,row){
	$.messager.show({
	title:'',
	msg:row.msg, 
	timeout:3000,
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
    $('#dg').datagrid('reload');
    window.location.href="?hal=detpo&po=<?php echo $po; ?>";
	}
});
});

/*updtpo*/
function updt(){
var string = $("#formb").serialize();
$('#formb').form('submit',{
    type	: "POST",
    url	    : "action/simpan.php?x=updtpo1",
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
     bottom:''
     }
	});
/*$('#dialog-formb').dialog('close');
$('#dialog-progress').dialog('open').dialog('setTitle','');
$('#dg2').datagrid('reload');*/
window.location.href="?hal=detpo&po=<?php echo $po; ?>";
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
					url	: "action/simpan.php?x=updatepi&piqty="+piqty2+"&piprice="+piprice2,
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
       bottom:''
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
  url	    : "action/simpan.php?x=piform",
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
   bottom:''
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

function cancel(){
  /*$('#form').form('clear');*/
  $('#dialog-form').dialog('close');
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
                singleSelect:true,
                toolbar:[{text:'Edit', handler: function(){
                    edit_mode = true;
                    editRow(0);
                  }
                },{text:'Cancel', handler: function(){
                    edit_mode = false;
                    tbl.datagrid('endEdit',editingIndex);
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

	$(function(){
			$('#dg').datagrid({
        clickToEdit: true,
		    dblclickToEdit: false,
				columns:[[
          {field:'no',title:'No',width:55,sortable:false},
          {field:'spec',title:'Specification',width:300,sortable:true},
          {field:'colname',title:'Color',width:168,sortable:true},
          {field:'rkbpk',title:'Units',width:75,sortable:true},
          {field:'qty',title:'Qty',width:75,sortable:true},
          {field:'price',title:'Price',width:75,sortable:true},
          {field:'total',title:'Total',width:110,sortable:true},
          {field:'piqty2',title:'PI Qty',width:100,sortable:true,editor: 'text',},
          {field:'piprice2',title:'PI Price',width:100,sortable:true,editor: 'text'},
          {field:'total2',title:'PI Total',width:100,sortable:true},
					{field:'action',title:'Action',width:115,align:'center',
					   formatter:function(value,row,index){
                    if (row.editing){
                        var s = '<a href="javascript:void(0)" onclick="saverow(this)">Save</a> ';
                        var c = '<a href="javascript:void(0)" onclick="cancelrow(this)">Cancel</a>';
                        return s+c;
                    } else {
                        var e = '<a href="javascript:void(0)" id="link" onclick="editrow(this)">Edit</a> ';       
                        return e;
                    }
                }
					}
				]],
        onBeforeEdit:function(index,row){
            row.editing = true;
            $(this).datagrid('refreshRow', index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }
    });
});
		function updateActions(index){
			$('#dg').datagrid('updateRow',{
				index: index,
				row:{}
			});
		}
		function getRowIndex(target){
			var tr = $(target).closest('tr.datagrid-row');
			return parseInt(tr.attr('datagrid-row-index'));
		}
		function editrow(target){
			$('#dg').datagrid('beginEdit', getRowIndex(target));
		}
		function deleterow(target){
			$.messager.confirm('Confirm','Are you sure?',function(r){
				if (r){
					$('#dg').datagrid('deleteRow', getRowIndex(target));
				}
			});
		}
		function saverow(target){
			$('#dg').datagrid('saveRow', getRowIndex(target));
		}
		function cancelrow(target){
			$('#dg').datagrid('cancelEdit', getRowIndex(target));
		}
		function insert(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				var index = $('#dg').datagrid('getRowIndex', row);
			} else {
				index = 0;
			}
			$('#dg').datagrid('insertRow', {
				index: index,
				row:{
					status:'P'
				}
			});
			$('#dg').datagrid('selectRow',index);
			$('#dg').datagrid('beginEdit',index);
		}
    
    function link2() {
        document.getElementById("link");
    
    }
</script>
<?php
$x=$_GET['x'];
$cari2=mysqli_query($koneksi,"SELECT po.piamount, po.piform, po.pono, rkb.item, sup.supnm, poli.polinm, cur.curid, cur.cursign,
pourg.pourgnm, po.piform
FROM po
left outer join poli on poli.polipk=po.polipk
left outer join pourg on pourg.pourgpk=po.pourgpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and po.popk='$po' group by po.popk");
$dt2=mysqli_fetch_array($cari2);
if($dt2['piamount']=="0.00000"){ $pi="-";}
else {
if($dt2['curid']=="IDR"){
$pi=$dt2['cursign']." ".number_format($dt2['piamount'],0,".",",");
} else {
$pi=$dt2['cursign']." ".number_format($dt2['piamount'],3,".",",");    
}
}
$pourgnm=$dt2['pourgnm'];
?>
<div id="frame-utama-judul">
<div class="frame-arrow">
<?php if($dt2['piform']<>""){ ?>
<a href="?hal=pur2"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
<?php } else { ?>
<a href="?hal=wait"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
<?php } ?>
</div>
<div class="frame-judul">
<div class="font-judul-atas">PO <?php echo $dt2['pono']; ?></div>
</div>
<div class="frame-judul-samping" style="margin-left:-60px;">
<div class="frame-utama-md" style="width:200px;">
<?php if($x==1) {?>
<a href="http://192.168.0.22/GISL2/admin.php?hal=detpo&po=<?php echo $po; ?>" style="text-decoration:none; color:#359DD9;"> Cancel </a> 
&nbsp; &nbsp; &nbsp; &nbsp; <a href="#" onclick="updtpi();" style="text-decoration:none; color:#359DD9;"> Save </a>
<?php } else { ?>
 <a href="javascript:void(0)" onclick="link2();" style="text-decoration:none; color:#359DD9;"> Edit </a>
&nbsp; &nbsp; <a href="http://192.168.0.11/RKB/data/admin.php?hal=sum&cari1=<?php echo $dt2['pono']; ?>" target="_blank" style="text-decoration:none; color:#359DD9;"> Check warehouse</a>
<?php } ?>
</div>
<a href="pdf/pdf_po.php?po=<?php echo $dt2['pono']; ?>" target="_blank">
<input style="margin-top:-5px;  margin-left:250px;" type="button" name="submit" value="Print PO" class="button-submit-add">
</a>
</div>
</div>
<div id="frame-utama-judul" style="top:160px;">
<table>
<tr>
<td style="font-size:14px; width:150px;">Item</td>
<td style="font-size:14px; width:100px;">PI amount</td>
<td style="font-size:14px;  width:250px;">Supplier</td>
<td style="font-size:14px;  width:60px;">PO type</td>
<td style="font-size:14px;  width:100px;">Priority</td>
<td style="font-size:14px;  width:60px;">Currency</td>
<td style="font-size:14px;  width:100px;">PI form</td>
</tr>
<tr>
<td style="font-size:14px; font-weight:bold;"><?php echo $dt2['item']; ?></td>
<td style="font-size:14px; font-weight:bold;"><?php echo $pi; ?></td>
<td style="font-size:14px; font-weight:bold;"><?php echo $dt2['supnm']; ?></td>
<td style="font-size:14px; font-weight:bold;"><?php echo $dt2['polinm']; ?></td>
<td style="font-size:14px; font-weight:bold;">
<?php if ($x==1) { ?>  
<form id="formb" method="post">
<input type="hidden" name="popk1" id="popk1" value="<?php echo $po; ?>" size="8">
<input style="width:120px; height:28px;" id="pourg" name="pourg" class="easyui-combobox"
data-options="valueField:'pourgpk',textField:'pourgnm',url:'view/get_data.php?dt=pourg',prompt:'<?php echo $pourgnm; ?>',onChange:updt,panelHeight:'auto',limitToList:'true'">
</form><?php } else {
echo $pourgnm; 
} ?>
</td>
<td style="font-size:14px; font-weight:bold;"><?php echo $dt2['curid']; ?></td>
<td style="font-size:14px;">
<?php if($dt2['piform']<>""){ ?>
<a href="upload/<?php echo $dt2['piform']; ?>" target="_blank" style="text-decoration:none; color:#359DD9;">View</a>
&nbsp; <a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Change</a>
<?php } else { ?>
<a href="javascript:void(0)" plain="true" style="text-decoration:none; color:#359DD9;" onclick="piform();">Upload</a>
<?php } ?>
</td>
</tr>
</table>
</div>
<div id="menu" onclick="$('#menu').fadeOut();"  style="display:none;">
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('saveRow');" style="color: #FFFFFF; text-decoration: none;"> Save </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="$('#dg').edatagrid('cancelRow');" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')" style="color: #FFFFFF; text-decoration: none;">Delete </a></div>-->
</div>

<div id="tabel" style="top:225px;">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_detpo.php?po=<?php echo $po; ?>" idField="rkbpk" toolbar="#tb" striped="true"
pagination="true" singleSelected="true" rownumbers="false" collapsible="true" fitColumns="false" method="post">
</table>

<div id="dialog-form" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="resizable:true,modal:true,closable:false"
style="width:425px;height:300px;padding:5px 5px;display:none;top:15px">
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


