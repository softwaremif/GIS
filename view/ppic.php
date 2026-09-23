<html>

<head>
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
            top: 68px;
            /* Blue */
            background: #359DD9;
            /* W - Drop Shadow */
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

        .sticky+.contenta {
            padding-top: 102px;
        }

        .datagrid-cell {
            /* font-family: 'Arial'; */
            font-style: normal;
            font-weight: 400;
            font-size: 13px;
            line-height: 18px;
            white-space: normal;
        }

        .datagrid-row {
            height: auto !important;
            white-space: normal !important;
        }
        .datagrid-view1{
            display:none;
        }
        .datagrid-header{
            border-right:1px dotted transparent;
            /* border-bottom:1px dotted transparent;     */
            background: #fff;        }
    </style>

    <script type="text/javascript">
        var url;

        $(function(){
        // var dg= $('#dg');
        // dg.datagrid();
        // dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
        
        $('#dg').datagrid({
        onClickRow: function(index,row){
        var expander = $(this).datagrid('getExpander', index);
        if (expander.hasClass('datagrid-row-expand')){
            $(this).datagrid('expandRow',index);                       
        } else {
            $(this).datagrid('collapseRow',index);
            // $('#dg').datagrid('reload');
        }
        }
        });

        $('#filterCut').combobox({
          valueField: 'value',
          textField: 'text',
          data: [
              { value: 'all',   text: 'All Time' },
              { value: 'today', text: 'Hari ini' },
              { value: '1w',    text: 'Minggu depan' },
              { value: '2w',    text: '2 Minggu depan' },
              { value: '1m',    text: 'Bulan ini' },
              { value: '1mn',   text: 'Bulan depan' },
              { value: '3m',    text: '3 Bulan depan' },
              { value: '6m',    text: '6 Bulan depan' },
              { value: 'year',  text: 'Tahun ini' }
          
          ],
          onChange: function() {
              // updateFilterBadges();
              Search();
          }
        });
        });

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

        function Search(){
            $('#dg').datagrid('load',{
                cari1: $('#cari1').val(),
                cari2: $('#cari2').val(),
                // cari3: $('#cari3').val(),
                cari7: $('#cari7').val(),
                // cari8: $('#cari8').val(),
                cari9: $('#cari9').val(),
                filterCut: $('#filterCut').combobox('getValue')
                // cari4: $('#cari4b').val(),
                // cari5: $('#cari5b').val()
            });
            var a=$('#cari1').val();
            $.ajax({
                type: "POST",
                url: "view/get_pono.php",
                data:"pono="+a,
                success: function(data){
                    // alert(data);
                    if(data>0 && a!=''){
                        var dg = $('#dg');
                        var count = dg.datagrid('getRows').length;
                        for(var i=0; i<count; i++){
                        dg.datagrid('expandRow',i);
                        dg.datagrid('getExpander',i).hide();
                        }
                    }else{
                        var dg = $('#dg');
                        var count = dg.datagrid('getRows').length;
                        for(var i=0; i<count; i++){
                        dg.datagrid('collapseRow',i);
                        dg.datagrid('getExpander',i).hide();
                        }
                        // alert("test");
                    }
                }
            });
        }

        // function Search() {

        //     var params = {
        //         cari1: $('#cari1').val(),
        //         cari2: $('#cari2').val(),
        //         cari7: $('#cari7').val(),
        //         cari9: $('#cari9').val(),
        //         filterCut: $('#filterCut').combobox('getValue')
        //     };

        //     // load parent datagrid
        //     $('#dg').datagrid('load', params);

        //     var a = $('#cari1').val();

        //     $.ajax({
        //         type: "POST",
        //         url: "view/get_pono.php",
        //         data: {
        //             pono: a
        //         },

        //         success: function (data) {

        //             var dg = $('#dg');

        //             setTimeout(function () {

        //                 var rows = dg.datagrid('getRows');

        //                 for (var i = 0; i < rows.length; i++) {

        //                     if (data > 0 && a != '') {

        //                         dg.datagrid('expandRow', i);
        //                         dg.datagrid('getExpander', i).hide();

        //                         // ambil detail grid
        //                         // var ddv = dg.datagrid('getRowDetail', i).find('table.ddv');

        //                         // reload detail grid dengan filter
        //                         // ddv.datagrid('load', {
        //                         //     cari1: $('#cari1').val(),
        //                         //     cari2: $('#cari2').val(),
        //                         //     cari7: $('#cari7').val(),
        //                         //     cari9: $('#cari9').val(),
        //                         //     filterCut: $('#filterCut').combobox('getValue')
        //                         // });

        //                     } else {

        //                         dg.datagrid('collapseRow', i);
        //                         dg.datagrid('getExpander', i).hide();

        //                     }
        //                 }

        //             }, 300);

        //         }
        //     });
        // }

        // function Search(){

        //     var params = {
        //         cari1: $('#cari1').val(),
        //         cari2: $('#cari2').val(),
        //         cari7: $('#cari7').val(),
        //         cari9: $('#cari9').val(),
        //         filterCut: $('#filterCut').combobox('getValue')
        //     };

        //     $('#dg').datagrid('load', params);

        // }

        // function Search2() {
        //     $('#dg').datagrid('load', {
        //         cari4: $('#cari4').val()
        //     });
        //     $('#newest').show();
        //     $('#oldest').hide();
        // }

        // function Search3() {
        //     $('#dg').datagrid('load', {
        //         cari5: $('#cari5').val()
        //     });
        //     $('#newest').hide();
        //     $('#oldest').show();
        // }

        // function Search4() {
        //     $('#kolom1').datagrid('load', {
        //         cari6: $('#cari6').val()
        //     });
        // }

        // function Search5() {
        //     $('#prodes').datagrid('load', {
        //         carispl: $('#carispl').val()
        //     });
        //     $('#byr').datagrid('load', {
        //         carispl: $('#carispl').val()
        //     });
        //     $('#season').datagrid('load', {
        //         carispl: $('#carispl').val()
        //     });
        // }

        function Search2a() {
            $('#dg').datagrid('load', {
                cari1: $('#cari1').val(),
                cari2: $('#cari2').val(),
                // cari3: $('#cari3').val(),
                cari7: $('#cari7').val(),
                cari8: $('#cari8').val(),
                // cari9: $('#cari9').val(),
                filterCut: $('#filterCut').combobox('getValue'),
                cari4: $('#cari4b').val()
            });
            $('#newest').show();
            $('#oldest').hide();
        }

        function Search2b() {
            $('#dg').datagrid('load', {
                cari1: $('#cari1').val(),
                cari2: $('#cari2').val(),
                // cari3: $('#cari3').val(),
                cari7: $('#cari7').val(),
                cari8: $('#cari8').val(),
                // cari9: $('#cari9').val(),
                filterCut: $('#filterCut').combobox('getValue'),
                cari5: $('#cari5b').val()
            });
            $('#newest').hide();
            $('#oldest').show();
        }

        $(function() {
            Search();
            $.ajax({
                type: "POST",
                url: "view/get_last.php",
                success: function(data) {
                    document.getElementById('last2').innerHTML = data;
                },
            });
        });

        function formatku2(value, rows) {
            if (value == 1 || value == 0) {
                return "";
            } else {
                return value;
            }
        }
        
        function dtlcut(rkbpk,popk){
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
            return '<div onclick="dtlcut('+rows.rkbpk+','+rows.popk+')">'+value+'</div>';
        }

        function stylerku(value, rows) {
            if (value == 1 || value == 0) {
                return 'height:0px;padding:0px;margin-left:0px;border-bottom:1px dotted transparent';
            } else {
                return 'height:35px;padding:10px;margin-left:0px;';
            }
        }

$(function(){
$('#dg').datagrid({
view: detailview,
detailFormatter:function(index,row){
return '<div style="padding:2px;position:relative;"><table class="ddv" style="width:100%;"></table></div>';
},
onExpandRow: function(index,row){
var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
// ddv.datagrid('load',{
// cari1:$('#cari1').val()
// });
ddv.datagrid({
//view:groupview,
// view: detailview,
//groupField:'kelnm2',
url:'view/get_detdflpb.php?ord='+row.ordpk+'&pono='+row.pono,
fitColumns:false,
rownumbers:false,
// loadMsg:'',
autoRowHeight: true,
height:'auto',
idField:'rkbpk',
border:true,
singleSelect:false,
columns:[[
{field:'kelnm3',title:'Type',width:60},
{field:'pono',title:'PO',width:80},
{field:'item',title:'Item',width:125},
{field:'spec',title:'Description',width:138},
{field:'supnm',title:'Supplier',width:125},
{field:'colname',title:'Color',width:100},
{field:'pocons2',title:'Quantity',width:90},
{field:'qtydtg',title:'Arrival qty',width:100},
{field:'bal',title:'Balance',formatter:formatter1,width:90},
{field:'etd',title:'Supplier ETD',width:90},
{field:'eta',title:'ETA',width:90},
{field:'eih',title:'EIH',width:90},
]],

onResize:function(){
// $('#dg').datagrid('fixDetailRowHeight',index);
},

onLoadSuccess:function(){
// setTimeout(function(){
// $('#dg').datagrid('fixDetailRowHeight',index);
// },0);
},

onSelect: function() {
getSelected(index);
},

});
$('#dg').datagrid('fixDetailRowHeight',index);
//$('#dg').datagrid('getPanel').css('height','auto');
},
// onLoadSuccess: function(){
// var dg = $('#dg');
// var count = dg.datagrid('getRows').length;
// for(var i=0; i<count; i++){
//   dg.datagrid('expandRow',i);
//   dg.datagrid('getExpander',i).hide();
// }
// }
});
});

// $(function(){

//     $('#dg').datagrid({

//         view: detailview,

//         detailFormatter:function(index,row){
//             return '<div style="padding:2px"><table class="ddv" style="width:100%"></table></div>';
//         },

//         onExpandRow: function(index,row){

//             var ddv = $(this)
//                 .datagrid('getRowDetail',index)
//                 .find('table.ddv');

//             ddv.datagrid({

//                 url:'view/get_detdflpb.php',

//                 queryParams:{
//                     ord: row.ordpk,
//                     // pono: row.pono,
//                     cari1: $('#cari1').val(),
//                     cari2: $('#cari2').val(),
//                     cari7: $('#cari7').val(),
//                     cari9: $('#cari9').val(),
//                     filterCut: $('#filterCut').combobox('getValue')
//                 },

//                 fitColumns:false,
//                 rownumbers:false,
//                 autoRowHeight:true,
//                 height:'auto',
//                 border:true,

//                 columns:[[
//                     {field:'kelnm3',title:'Type',width:60},
//                     {field:'pono',title:'PO',width:80},
//                     {field:'item',title:'Item',width:125},
//                     {field:'spec',title:'Description',width:138},
//                     {field:'supnm',title:'Supplier',width:125},
//                     {field:'colname',title:'Color',width:100},
//                     {field:'pocons2',title:'Quantity',width:90},
//                     {field:'qtydtg',title:'Arrival qty',width:100},
//                     {field:'bal',title:'Balance',formatter:formatter1,width:90},
//                     {field:'etd',title:'Supplier ETD',width:90},
//                     {field:'eta',title:'ETA',width:90},
//                     {field:'eih',title:'EIH',width:90},
//                 ]],

//                 onLoadSuccess:function(){
//                     $('#dg').datagrid('fixDetailRowHeight',index);
//                 }

//             });

//             $('#dg').datagrid('fixDetailRowHeight',index);
//         }

//     });

// });


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
    if(row.vassalnm!=''){
        return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);" onclick="dtlimport('+row.popk+','+row.importpk+')">'+value+'</span>'
    }else{
        return 'N/A';
    }    
}

$(function(){
      $('#cari8').combobox({
        onSelect: function(rec){
        // alert(rec.deppk);
        var cari3 = $('#cari3').val();
        var cari8 = $('#cari8').val();
        // alert(cari8);
        var url = 'view/get_data.php?dt=byr&fupk='+rec.fupk+'&bln='+cari3+'&thn='+cari8;
        $('#cari2').combobox('reload', url);
        }
      });
    });

$(function(){
    $('#cari9').combobox({
	icons:[{
		iconCls:'icon-clear',
		handler:function(e){
			$(e.data.target).combobox('clear');
            document.getElementById("combochek1").checked = true;
            document.getElementById("combochek2").checked = true;
            document.getElementById("combochek3").checked = true;
		}
	}]
})
});

//combobox dengan chekbox
$(function() {
$('#cari9').combobox({
  formatter:function(row){
    var opts = $(this).combobox('options');
            return '<input type="checkbox" id="combochek'+ row[opts.valueField]+'" name="ck1" class="combobox-checkbox" checked>' + row[opts.textField];
  },
  onLoadSuccess:function(){
    var opts = $(this).combobox('options');
    var target = this;
    var values = $(target).combobox('getValues');
    $.map(values, function(value){
      var el = opts.finder.getEl(target, value);
      el.find('input.combobox-checkbox')._propAttr('unchecked', true);
    });
  },
  onSelect:function(row){
    console.log(row);
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('unchecked', true);
  },
  onUnselect:function(row){
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('unchecked', false);
  }
});
});
</script>
</head>

<body>
    
    <div class="contenta">
<?php if($_SESSION['mat']==2){ ?>
    <div id="frame-utama-cari" style="width:885px;">
<?php } else { ?>
    <div id="frame-utama-cari" style="width:680px;">
<?php } ?>
<div id="container-cari">
    <div id="frame-cari">
        <img src="css/images/Shape.png" width="18px" height="18px">
        <input id="cari1" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
    </div>
</div>
<input id="filterCut" class="easyui-combobox" style="height:28px;" data-options="prompt:'Cutting date', editable:false">

<!-- <select class="easyui-combobox" id="cari3" data-options="editable:false,prompt:'Month',limitToList:'true',onChange:Search" style="width:150px;"> -->
    <?php
    // $bln = array(
    //     1 => "January", "February", "March", "April", "May",
    //     "June", "July", "August", "September", "October",
    //     "November", "Desember"
    // );
    // $bln1 = date('m');
    // if ($bln1 <= 9) {
    //     $bln2 = substr($bln1, 1, 1);
    // }
    ?>
    <!-- <option value="<?php //echo $bln1; ?>"><?php //echo $bln[$bln2]; ?></option> -->
    <!-- <option value="All">All</option> -->
    <?php
    // for ($bulan = 1; $bulan <= 12; $bulan++) {
    ?>
        <!-- <option value="<?php //echo $bulan; ?>"><?php //echo $bln[$bulan]; ?></option> -->
    <?php //} ?>
<!-- </select> -->

<!-- <select class="easyui-combobox" id="cari8"
data-options="editable:false, panelHeight:'auto',onChange:Search" style="width:85px;" >
<?php
// for ($i=date('Y'); $i>=date('Y')-2 ; $i-=1){
?>
<option value="<?php //echo $i; ?>"><?php //echo $i; ?></option>
<?php //} ?>
</select> -->

<input style="width:140px; height:28px;" id="cari7" name="cari7" class="easyui-combobox"
data-options="valueField:'fupk',textField:'funm',url:'view/get_data.php?dt=fu',prompt:'MD',onChange:Search,limitToList:'true'">

<input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox" 
data-options="valueField:'byrpk',textField:'byrnm',onChange:Search,limitToList:'true',prompt:'Buyer'">
<?php //if($_SESSION['mat']==2){ ?>
<input  id="cari9" name="cari9" style="width:200px; height:28px;" class="easyui-combobox" data-options="
multiple:true,onChange:Search,prompt:'Type',
		valueField: 'label',
		textField: 'value',
		data: [{
			label: '1',
			value: 'Cutting'
		},
        {
			label: '2',
			value: 'Sewing'
		},{
			label: '3',
			value: 'Finishing'
		}]">
<?php //} ?>
<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">
</a>
</div>

<div id="frame-filter" style="">
<div id="frame-filter-fields">
</div>

<div id="frame-filter-newest">
<div class="dropdwn">	
<input onclick="myFunction()" type="image" class="imgsort" style="left:0px;" src="css/images/sort.jpg" alt="Submit button" class="dropbtn">
<div id="myDropdown" class="dropdwn-content" style="">
<input type="hidden" id="cari4b" value="1" name="cari4">
<div class="new-entry" style="font-size:14px;width:200px;"><a href="javascript:void(0)" plain="true" onclick="Search2a();">Latest cutting date</a></div>
<input type="hidden" id="cari5b" value="1" name="cari5">
<div class="old-entry" style="font-size:14px;width:200px;"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Earliest cutting date</a></div>
</div>
</div>
<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
<div id="newest" class="newest" style="left:15px;" onclick="myFunction()">Latest cutting date</div>
<div id="oldest" class="newest" onclick="myFunction()" style="display:none; left:15px;">Earliest cutting date</div>
</a>
</div>
</div>

        <div id="tabel1" onclick="" ondblclick="" style="height:auto;">
        <table id="dg" class="" singleSelect="true" style="width:100%;height:500px;" align="center"
url="view/get_dflpb.php?p=1" idField="ordpk"
data-options="fitColumns:true">      
                <thead>
                    <tr>
                    <th field="orderno" width="300"></th>
                    </tr>
                </thead>
            </table>
            <br>
        </div>
    <!-- </div> -->

    <div id="dialog-formcut" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true" 
    style="width:1085px;height:425px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
        <form id="formcut" method="post">
            <input type="hidden" name="ordpkcut" id="ordpkcut" value="">
            <div class="modal-content">
                <div id="close" style="margin-top:0px; margin-left:1025px;">
                    <a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;" onclick="$('#dialog-formcut').dialog('close'); $('#formcut').form('reset');">X</a>
                </div>
                <div style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">Material arrival records</div>
                <div id="opcut" style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;"></div>
                <div id="tabelcut" style="margin-top:15px;margin-left: 10px;">
                    <table id="dgcut" class="easyui-datagrid" title="" style="width:1000px;height:300px;" align="center" url="view/get_dtcut.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="false" method="post" data-options="multiSort:true,remoteSort:false">
                        <thead>
                            <tr>
                                <th field="pono" width="85">PO</th>
                                <th field="item" width="140">Item</th>
                                <th field="spec" width="150">Description</th>
                                <th field="supnm" width="110">Supplier</th>
                                <th field="colname" width="80">Color</th>
                                <th field="price" width="85">Price</th>
                                <th field="pocons" width="80">Quantity</th>
                                <th field="qtydtg" width="85">Arrival qty</th>
                                <th field="balance" width="80">Balance</th>
                                <th field="etd" width="105">Delivery ETD</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <div id="dialog-formsew" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true" 
    style="width:1085px;height:425px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
        <form id="formsew" method="post">
            <input type="hidden" name="ordpksew" id="ordpksew" value="">
            <div class="modal-content">
                <div id="close" style="margin-top:0px; margin-left:1025px;">
                    <a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;" onclick="$('#dialog-formsew').dialog('close'); $('#formsew').form('reset');">X</a>
                </div>
                <div style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">Material arrival records</div>
                <div id="opsew" style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;"></div>
                <div id="tabelsew" style="margin-top:15px;margin-left: 10px;">
                    <table id="dgsew" class="easyui-datagrid" title="" style="width:1000px;height:300px;" align="center" url="view/get_dtsew.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="false" method="post" data-options="multiSort:true,remoteSort:false">
                        <thead>
                            <tr>
                                <th field="pono" width="85">PO</th>
                                <th field="item" width="140">Item</th>
                                <th field="spec" width="150">Description</th>
                                <th field="supnm" width="110">Supplier</th>
                                <th field="colname" width="80">Color</th>
                                <th field="price" width="85">Price</th>
                                <th field="pocons" width="80">Quantity</th>
                                <th field="qtydtg" width="85">Arrival qty</th>
                                <th field="balance" width="80">Balance</th>
                                <th field="etd" width="105">Delivery ETD</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <div id="dialog-formfin" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true" 
    style="width:1085px;height:425px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
        <form id="formfin" method="post">
            <input type="hidden" name="ordpkfin" id="ordpkfin" value="">
            <div class="modal-content">
                <div id="close" style="margin-top:0px; margin-left:1025px;">
                    <a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;" onclick="$('#dialog-formfin').dialog('close'); $('#formfin').form('reset');">X</a>
                </div>
                <div style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">Material arrival records</div>
                <div id="opfin" style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;"></div>
                <div id="tabelfin" style="margin-top:15px;margin-left: 10px;">
                    <table id="dgfin" class="easyui-datagrid" title="" style="width:1000px;height:300px;" align="center" url="view/get_dtfin.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="false" method="post" data-options="multiSort:true,remoteSort:false">
                        <thead>
                            <tr>
                                <th field="pono" width="85">PO</th>
                                <th field="item" width="140">Item</th>
                                <th field="spec" width="150">Description</th>
                                <th field="supnm" width="110">Supplier</th>
                                <th field="colname" width="80">Color</th>
                                <th field="price" width="85">Price</th>
                                <th field="pocons" width="80">Quantity</th>
                                <th field="qtydtg" width="85">Arrival qty</th>
                                <th field="balance" width="80">Balance</th>
                                <th field="etd" width="105">Delivery ETD</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </form>
    </div>

<div id="dialog-forminfo" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:377px;height:310px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
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
<input type="hidden" id="buatkondisi" value="0">
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
<div id="dialog-enroute2" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:1017px;height:550px;padding:5px 5px;display:none;top:100px;border-radius:8px;">
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
        // window.onscroll = function() {
        //     myFunctiona();
        // };
        // var header = document.getElementById("myHeader");
        // var sticky = header.offsetTop;

        // function myFunctiona() {
        //     if (window.pageYOffset > sticky) {
        //         header.classList.add("sticky");
        //     } else {
        //         header.classList.remove("sticky");
        //     }
        // }
    </script>
</body>

</html>