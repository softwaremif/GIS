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
            font-family: 'Arial';
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
            background: #fff;       
         }
#hor-minimalist-a
{
	font-family:"Arial";
	font-size: 11px;
	background: #ffffff;
	border-collapse: collapse;
	text-align: left;
	width:auto;
	height:auto;
    color: #AFAFAF;
    border-color: #AFAFAF;
}
#hor-minimalist-a th
{
    background-color: #fafafa;
	font-size: 13px;
	font-weight: bolder;
	padding: 5px 5px;
	text-align: center;
/*	border-bottom: 2px solid #6678b1;*/
}
#hor-minimalist-a td
{
	padding: 9px 8px 0px 8px;
/*	border-bottom: 2px solid #6678b1;*/
}
#hor-minimalist-a tbody tr:hover td
{
	font-weight: normal;
}
    </style>

    <script type="text/javascript">
        var url;
        
        $(function(){
        var dg= $('#dg');
        dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
        });

        function Search() {
            $('#dg').datagrid('load', {
                cari1: $('#cari1').val(),
                cari2: $('#cari2').val(),
                cari3: $('#cari3').val(),
                cari7: $('#cari7').val(),
                cari8: $('#cari8').val()
            });
        }

        function Search2() {
            $('#dg').datagrid('load', {
                cari4: $('#cari4').val()
            });
            $('#newest').show();
            $('#oldest').hide();
        }

        function Search3() {
            $('#dg').datagrid('load', {
                cari5: $('#cari5').val()
            });
            $('#newest').hide();
            $('#oldest').show();
        }

        function Search4() {
            $('#kolom1').datagrid('load', {
                cari6: $('#cari6').val()
            });
        }

        function Search5() {
            $('#prodes').datagrid('load', {
                carispl: $('#carispl').val()
            });
            $('#byr').datagrid('load', {
                carispl: $('#carispl').val()
            });
            $('#season').datagrid('load', {
                carispl: $('#carispl').val()
            });
        }

        function Search2a() {
            $('#dg').datagrid('load', {
                cari4: $('#cari4b').val()
            });
            $('#newest').show();
            $('#oldest').hide();
        }

        function Search2b() {
            $('#dg').datagrid('load', {
                cari5: $('#cari5b').val()
            });
            $('#newest').hide();
            $('#oldest').show();
        }

        $(function() {
            $.ajax({
                type: "POST",
                url: "view/get_last.php",
                success: function(data) {
                    document.getElementById('last').innerHTML = data;
                },
            });
        });

function formatku(value,rows){
     return value+
    '<br><div style="width:101.2%;"><table style="margin-left:-15px;" border="1" id="hor-minimalist-a">'+
    '<thead>'+
    '<tr style="height:30px;background-color:#F1F1F1;">'+
    '<th width="60">Type</th>'+
    '<th width="110">PO</th>'+
    '<th width="145">Item</th>'+
    '<th width="235">Description</th>'+
    '<th width="150">Supplier</th>'+
    '<th width="100">Color</th>'+
    '<th width="100">Quantity</th>'+
    '<th width="100">Arrival qty</th>'+
    '<th width="100">Balance</th>'+
    '<th width="110">Delivery ETD</th>'+
    '</tr>'+
    '</thead>'+
    '</table></div>';
}
</script>
</head>

<body>
    <div class="contenta">
        <div id="frame-utama-cari" style="top:180px; width:510px; ">

            <div id="container-cari">
                <div id="frame-cari">
                    <img src="css/images/Shape.png" width="18px" height="18px">
                    <input id="cari1" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
                </div>
            </div>
            

            <select class="easyui-combobox" id="cari3" data-options="editable:false,prompt:'Month',limitToList:'true',onChange:Search" style="width:150px;">
                <?php
                $bln = array(
                    1 => "January", "February", "March", "April", "May",
                    "June", "July", "August", "September", "October",
                    "November", "Desember"
                );
                $bln1 = date('m');
                if ($bln1 <= 9) {
                    $bln2 = substr($bln1, 1, 1);
                }
                ?>
                <option value="<?php echo $bln1; ?>"><?php echo $bln[$bln2]; ?></option>
                <?php
                for ($bulan = 1; $bulan <= 12; $bulan++) {
                ?>
                    <option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
                <?php } ?>
            </select>

            <input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox" data-options="valueField:'byrpk',textField:'byrnm',url:'view/get_data.php?dt=byr',prompt:'Buyer',onChange:Search,limitToList:'true'">

<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">
</a>
        </div>

        <div id="frame-filter" style="top:185px;">
            <div id="frame-filter-fields">

            </div>

<div id="frame-filter-newest">
<div class="dropdwn">	
<input onclick="myFunction()" type="image" class="imgsort" style="left:0px;" src="css/images/sort.jpg" alt="Submit button" class="dropbtn">
<div id="myDropdown" class="dropdwn-content" style="">
<input type="hidden" id="cari4b" value="1" name="cari4">
<div class="new-entry" style="font-size:14px;"><a href="javascript:void(0)" plain="true" onclick="Search2a();">Lasted cutting date</a></div>
<input type="hidden" id="cari5b" value="1" name="cari5">
<div class="old-entry" style="font-size:14px;"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Earliest cutting date</a></div>
</div>
</div>
<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
<div id="newest" class="newest" style="left:15px;" onclick="myFunction()">Lasted cutting date</div>
<div id="oldest" class="newest" onclick="myFunction()" style="display:none; left:15px;">Earliest cutting date</div>
</a>
</div>
        </div>

        <div id="tabel1" onclick="" ondblclick="" style="top:220px;height:auto;">
        <table id="dg" class="easyui-datagrid" singleSelect="true" style="width:100%;height:auto;" align="center"
url="view/get_lpb2.php" idField="rkbpk"
data-options="
AutoRowHeight:true,
pagination:false,
collapsible:true,
rownumbers:false,
fitColumns:false,
view:groupview,
border:true,
groupField:'orderno',
groupFormatter:formatku,
groupStyler:function(value,rows){
return 'padding:10px;height:68px;';
}">    
                <thead>
                    <tr>
                    <th field="kelnm3" width="60">Type</th>
                    <th field="pono" width="110">PO</th>
                    <th field="item" width="145">Item</th>
                    <th field="spec" width="235">Description</th>
                    <th field="supnm" width="150">Supplier</th>
                    <th field="colname" width="100">Color</th>
                    <th field="pocons2" width="100">Quantity</th>
                    <th field="qtydtg" width="100">Arrival qty</th>
                    <th field="bal" width="100">Balance</th>
                    <th field="etd" width="110">Delivery ETD</th>
                    </tr>
                </thead>
            </table>
        </div>
    <!-- </div> -->

    <div id="dialog-formcut" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true" style="width:1085px;height:425px;padding:5px 5px;display:none;top:100px;">
        <form id="formcut" method="post">
            <input type="hidden" name="ordpkcut" id="ordpkcut" value="">
            <div class="modal-content">
                <div id="close" style="margin-top:0px; margin-left:1025px;">
                    <a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;" onclick="$('#dialog-formcut').dialog('close'); $('#formcut').form('reset');">X</a>
                </div>
                <div style="margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">Material arrival records</div>
                <div id="opcut" style="margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;"></div>
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

    <div id="dialog-formsew" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true" style="width:1085px;height:425px;padding:5px 5px;display:none;top:100px;">
        <form id="formsew" method="post">
            <input type="hidden" name="ordpksew" id="ordpksew" value="">
            <div class="modal-content">
                <div id="close" style="margin-top:0px; margin-left:1025px;">
                    <a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;" onclick="$('#dialog-formsew').dialog('close'); $('#formsew').form('reset');">X</a>
                </div>
                <div style="margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">Material arrival records</div>
                <div id="opsew" style="margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;"></div>
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

    <div id="dialog-formfin" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,closable:false,resizable:false,modal:true" style="width:1085px;height:425px;padding:5px 5px;display:none;top:100px;">
        <form id="formfin" method="post">
            <input type="hidden" name="ordpkfin" id="ordpkfin" value="">
            <div class="modal-content">
                <div id="close" style="margin-top:0px; margin-left:1025px;">
                    <a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;" onclick="$('#dialog-formfin').dialog('close'); $('#formfin').form('reset');">X</a>
                </div>
                <div style="margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">Material arrival records</div>
                <div id="opfin" style="margin-left:15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;"></div>
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

<div id="dialog-forminfo" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:false,modal:true,closable:false"
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
<div style="margin-top:-25px;margin-left: 15px;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">Arrival date record</div><br>
<div id="tbinf"style="margin-left:15px;" onclick="routeship()">
<input type="hidden" id="buatkondisi" value="0">

<table id="dginf" class="easyui-datagrid" title="" style="width:320px;height:190px;" align="center"
url="view/get_info.php" toolbar="#tb2" striped="false" border="true"
pageSize="100" pageList="[100,200,300,500]" pagination="false" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" data-options="multiSort:false">
<thead>
<tr>
<th field="vassalnm" width="100">Shipment</th>
<th field="tgldtg" width="99">Date</th>
<th field="qtydtg" width="120">Amount</th>
<th field="popk" width="120" hidden="true">Popk</th>
<th field="importpk" width="120" hidden="true">importpk</th>

</tr>
</thead>
</table>
</div>
<span style="margin-left: 15px;font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;" id="qtyinfo"></span>
</div>
</form>
</div>

    <script type="text/javascript">
        window.onscroll = function() {
            myFunctiona();
        };
        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunctiona() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>
</body>

</html>