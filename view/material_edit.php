<style>
/* Sembunyikan scrollbar untuk Chrome, Safari dan Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Sembunyikan scrollbar untuk IE, Edge dan Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
<div id="dialog-formb" class="easyui-dialog" closed="true" data-options="header:'#custom-header1',border:true, title:'Edit Material', closable:true,resizable:false,modal:true, buttons:'#footer-buttons', fit:true"
     style="width:90%;height:100%;padding:0;display:none;top:0;border-radius:8px;overflow:hidden;">
    
    <form id="formb" method="post" style="height:100%; width:100%;">
        <input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>">
				<input type="hidden" name="rkbpk" id="rkbpk">
				<input type="hidden" name="bdownpk" id="bdownpk">
				<input type="hidden" name="kolom" id="kolom">
				<input type="hidden" name="nour" id="nour">
				<input type="hidden" name="fup" id="fup">
				<input type="hidden" name="popk" id="popk">
                <input type="hidden" id="val_totqty_raw" value="<?php echo $pure_qty; ?>">

        <div style="display: flex; height: 100%; width: 100%; overflow: hidden; background: #fff;">
            
            <div style="max-height: 90vh; overflow-y: auto; padding: 40px;">
                
                <div id="custom-header1" style="padding:2px; background:#f4f4f4; border-bottom:1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
    
                    <div style="display: flex; flex-direction: column;">
                        <span style="font-size:20px; font-weight:800; color:#333; line-height: 1.2;">Edit Material</span>
                        
                        <small style="color: #666; margin-top: 4px;">
                            Order: <b id="h-ordno"></b> <span id="h-mif" style="font-size:11px; color:#888;"></span> | 
                            Buyer: <b id="h-byrnm"></b> | 
                            Qty: <b id="h-totqty_display"><?php echo $display_qty; ?></b>
                        </small>
                    </div>
                    
                    <a href="javascript:void(0)" 
                    onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset');sup2b(); 
						$('#div_input_usage2').hide();$('#modal_detail_edit_summary').dialog('close');$('#div_input_cw').hide();$('#div_input_gsm').hide();" 
                    style="text-decoration: none; color: #999; font-size: 24px; font-weight: bold; padding: 0 10px;">
                    &times;
                    </a>
                </div>
                <!-- <div style="font-size: 14px; color: #666; margin-bottom: 40px;"></div> -->

                <div style="margin-bottom: 25px;">
                    <div style="font-size: 20px; font-weight: 700; letter-spacing: 1px; margin-bottom: 10px;">
                        Basic Information
                    </div>

						<div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px;">
                            <div style="display: flex; flex-direction: column;">
                                <label style="margin-bottom: 8px;font-size:16px;">Item Category</label>
                                <input name="mtype" id="mtype_edit" required="true" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" class="easyui-combobox" data-options="onChange:klnm_value_edit,valueField:'mtypepk',textField:'typenm',url:'view/get_data.php?dt=mtype',prompt:'Category',limitToList:'true'">
                            </div>
                        </div>

                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size:16px;">Supplier</label>
                                <span id="suppk2a">
                                <input name="suppk" id="suppk2aa" required="true"
                                    style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;"
                                    class="easyui-combobox"
                                    data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'">
                            </span>
                            <span id="suppk2b" style="display:none;">
                                <input id="suppk2bb" required="true"
                                    style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;"
                                    class="easyui-combobox"
                                    data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'"
                                    disabled>
                                <!--<input type="hidden" name="suppk1" id="suppk2" value="1949" size="5">-->
                            </span>
                        </div>

                        <div class="fitem" style="display: flex; align-items: center; margin-top: 22px;">
                            <input type="checkbox" style="transform: scale(1.2); cursor:pointer;" name="external2" id="external2" value="1949" onclick="sup2();">
                            <!--<input type="checkbox" name="external2b" id="external2b" value="1949" onclick="sup2();" checked>-->
                            <input type="hidden" name="ext2" id="ext2" size="5">
                            <input type="hidden" name="ext2b" id="ext2b" size="5">
                            <label for="external1" style="cursor: pointer; font-size: 14px;">External sourcing</label>
                        </div>
                    </div>

					<div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px;" class="item_dan_usage">
                        <div class="item_input" style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size:16px;">Item Name</label>
                            <input onkeyup="multi();" type="text" name="item" id="item" class="easyui-validatebox" required="true"  
                            autocomplete="off" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="Input item name...">
                            <div id="suggestions-container" class="suggestions-container"></div>
                        </div>
                        <div id="div_input_usage2" style="display: flex; flex-direction: column;">
                            <!-- <div class="fitem"> -->
                                <label style="margin-bottom: 8px;font-size:16px;">Usage</label>
                                <select style="width: 200px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" class="easyui-combobox" name="nilai_usage2" id="nilai_usage2"
                                    data-options="editable:true, prompt:'Jenis Usage', limitToList:'true'">
                                    <option value=""></option>
                                    <?php
                                    $jenis_usage = array("Shell", "Lining", "Pocketing", "Interlining", "Filler", "Piping");
                                    $jumlah_usage = 10;

                                    foreach ($jenis_usage as $item) {
                                        for ($i = 1; $i <= $jumlah_usage; $i++) {
                                            echo "<option value='$item$i'>$item$i</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            <!-- </div> -->
                            <!-- <input type="text" id="input_hidden_usage" name="input_hidden_usage"> -->
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size:16px;">Garment colorway</label>
                           <!-- <input name="itemadd" id="itemadd" required="true" style="width: 235px; height:34px;" class="easyui-combobox" data-options="onChange: klnm_value, valueField: 'valCol', textField: 'textCol', url: 'view/get_data.php?dt=colorBdown&ord=<?php echo $_GET['ord']; ?>', prompt: 'Choose garment colorway', limitToList: true, panelHeight:'auto',"> -->
                            <input name="itemadd[]" id="itemadd1"
                            style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" 
                            class="easyui-combobox" 
                            data-options="
                                onChange: klnm_value, 
                                valueField: 'valCol', 
                                textField: 'textCol', 
                                url: 'view/get_data.php?dt=colorBdown&ord=<?php echo $_GET['ord']; ?>', 
                                prompt: 'Choose garment colorway', 
                                limitToList: true, 
                                multiple: true,
                                panelHeight: 300,
                                formatter: function(row){
                                    var opts = $(this).combobox('options');
                                    return '<input type=\'checkbox\' class=\'combobox-checkbox\'> ' + row[opts.textField];
                                },
                                onSelect: function(row){
                                    var opts = $(this).combobox('options');
                                    var el = opts.finder.getEl(this, row[opts.valueField]);
                                    el.find('input.combobox-checkbox').prop('checked', true);
                                },
                                onUnselect: function(row){
                                    var opts = $(this).combobox('options');
                                    var el = opts.finder.getEl(this, row[opts.valueField]);
                                    el.find('input.combobox-checkbox').prop('checked', false);
                                }
                            ">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <div style="font-size: 20px; font-weight: 700; letter-spacing: 1px; margin-bottom: 20px;">
                        Item Specifications
                    </div>

                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <label style="font-weight: 700; color: #333;font-size: 16px;">Item specification</label>
                                
                                <label style="display: flex; align-items: center; cursor: pointer; font-size: 14px;">
                                    <input type="checkbox" name="tspec" id="ts_multi_check1" value="2" 
                                        onclick="if(this.checked) { $('#hidden1a').show(); multi1(); } else { $('#hidden1a').hide(); } " 
                                        style="transform: scale(1.2); cursor:pointer;"> 
                                    Add more detail breakdown
                                </label>
                            </div>

                            <div style="height: 20px; width: 1px; background: #ddd;"></div>

                            <div style="display: flex; align-items: center; gap: 15px;">
                                <a href="javascript:void(0)" onclick="lookup_mb();" style="color: #359DD9; text-decoration: none; font-size: 14px;">
                                    Search Material
                                </a>
                                <a href="http://192.168.0.11/RKB/data/admin?hal=sisa" target="_blank" style="color: #359DD9; text-decoration: none; font-size: 14px;">
                                    Check Stock
                                </a>
                            </div>
                        </div>
                    </div>

                    <div style="max-width: 800px;">
                        <div style="margin-bottom: 10px;">
                            <textarea name="spec" id="spec2" class="easyui-validatebox" required="true" placeholder="Enter full specification details here..." style="width: 100%; min-height: 80px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"></textarea>
                        </div>

                        <div id="hidden1a" style="display:none;margin-bottom: 10px;">
                            <div style="display: grid; grid-template-columns: repeat(8, 1fr); gap: 10px; margin-bottom: 10px;">
                                <?php for($i=1; $i<=8; $i++): ?>
                                    <input name="hspec<?=$i?>" id="hspec<?=$i?>b" placeholder="Header <?=$i?>" class="easyui-validatebox"
                                        style="width: 100%; height: 32px; padding: 4px;">
                                <?php endfor; ?>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: repeat(8, 1fr); gap: 10px;">
                                <?php for($i=1; $i<=8; $i++): ?>
                                    <input name="spec<?=$i?>" id="spec<?=$i?>a" placeholder="Value <?=$i?>" class="easyui-validatebox"
                                        style="width: 100%; height: 32px; padding: 4px;">
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Color Name</label>
                            <input name="colname" id="colname" class="easyui-validatebox" required="true" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="Input color...">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Color Code</label>
                            <input name="colcode" id="colcode" class="easyui-validatebox" required="true" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="Input code...">
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <div style="height: 20px;"></div> 
                            <a href="javascript:void(0)" onclick="lookup_col();" style="color: #359DD9; text-decoration: none; font-size: 14px; font-weight: 600;">
                            Lookup color
                            </a>
                        </div>
                    </div>
                    <!-- <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Item size</label>
					        <input name="sizegar" id="sizegar" class="easyui-validatebox" required="true" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="Input size...">
                        </div>
                        <div class="fitem" style="display: flex; align-items: center; margin-top: 22px;">
                            <div style="height: 20px;"></div> 
                            <input type="checkbox" id="notApplicable1" value="1949" style="transform: scale(1.2); cursor:pointer; margin-right: 8px;" onclick="toggleSizeA();">
                            <label for="notApplicable1" style="cursor: pointer; font-size: 14px;">Not applicable</label>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <div style="height: 20px;"></div> 
                            <a href="javascript:void(0)" onclick="lookup_bdown();" style="color: #359DD9; text-decoration: none; font-size: 14px; font-weight: 600;">Lookup</a>
                        </div>
                    </div> -->

                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <div style="display: flex; justify-content: start; align-items: center; margin-bottom: 8px;">
                                <label style="font-size: 16px; margin: 0; padding-right:15px;">Item size</label>

                                <a href="javascript:void(0)" 
                                onclick="lookup_bdown();" 
                                style="color: #359DD9; text-decoration: none; font-size: 14px; font-weight: 600;">
                                Lookup
                                </a>
                            </div>
					        <input name="sizegar" id="sizegar" class="easyui-validatebox" required="true" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="Input size...">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <div id="div_input_cw">
                                <div style="display: flex; justify-content: start; align-items: center; margin-bottom: 8px;">
                                    <label style="font-size: 16px;">Cuttable width</label>
                                </div>
                                <input name="cw" id="cw" class="easyui-validatebox" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" type="number" placeholder="Input cuttable width...">
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <div id="div_input_gsm">
                                <div style="display: flex; justify-content: start; align-items: center; margin-bottom: 8px;">
                                    <label style="font-size: 16px;">Gramasi</label>
                                </div>
                                <input name="gsm" id="gsm" class="easyui-validatebox" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" type="number" placeholder="Input gramasi...">
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Placement</label>
                            <input name="specadd" id="specadd" class="easyui-validatebox" placeholder="Example: Front Body" style="width: 300px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <div style="font-size: 20px; font-weight: 700; letter-spacing: 1px; margin-bottom: 20px;">
                        Costing & Quantity
                    </div>

                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Costing consumption (per garment)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Target konsumsi bahan per pcs berdasarkan perhitungan awal (Costing).">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </label>
                            <input name="negocons" id="negocons" type="number" class="easyui-validatebox" style="width: 350px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Consumption unit
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Satuan pengukuran yang digunakan untuk bahan baku (contoh: YARD, METER, atau KG).">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </label>
                            <input required name="unit" id="unit1" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" class="easyui-combobox" data-options="editable:false,valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true, onSelect: updateUnitText1, onChange: updateUnitText1">
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 0px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Purchasing consumption (per garment)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Konsumsi bahan murni per pcs sesuai hasil marker atau pola produksi yang dipesan ke supplier.">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </label>
                            <input name="estcons" id="estcons" type="number" class="easyui-validatebox" style="width: 350px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
                            <div id="cons_warning1" style="color: #e74c3c; margin-top: 4px; font-size: 12px; min-height: 18px;"></div>
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Additional merchandising allowance %
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Persentase cadangan bahan tambahan untuk mengantisipasi cacat kain (reject) atau susut (shrinkage) selama produksi.">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </label>
                            <input name="allowcons" id="allowcons" type="number" class="easyui-validatebox" style="width: 350px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
                            <div style="color: #e74c3c; margin-top: 4px; font-size: 12px; min-height: 18px;"></div>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Breakdown quantity
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Jumlah pesanan bersih (net order) yang akan diproduksi, tidak termasuk sampel atau tambahan manual.">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </label>
					        <input name="bdownqty" id="bdownqty" type="number" class="easyui-validatebox" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="0" onkeyup="canbdown2(); myFunction2a();" onchange="canbdown2(); myFunction2a();">
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <div style="height: 20px;"></div> 
                            <a href="javascript:void(0)" onclick="lookup_bdown();" style="color: #359DD9; text-decoration: none; font-size: 14px; font-weight: 600;">Lookup breakdown</a>
					        <input type="hidden" name="canbd" id="canbd2" size="5">
                        </div>
                    </div>
                    <div style="margin-top: 1px;" id="bdownqty_warning"></div>
                    
                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Netto</label>
                            <input name="totcons_edit" id="totcons_edit" class="easyui-validatebox" style="width: 180px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px; background-color:#F1F1F1;" placeholder="0" readonly>
                        </div>
                        <!-- <div style="display: flex; flex-direction: column;"> -->
                            <!-- <label style="margin-bottom: 8px;font-size: 16px;">Formula</label> -->
                            <input type="hidden" id="formula1" value="estcons * bdownqty" class="easyui-validatebox" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px; background-color:#F1F1F1;" readonly>
                        <!-- </div> -->
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Formula 1</label>
                            <input name="f1" id="f1" placeholder=" / 100000000 " class="easyui-validatebox" style="width: 180px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" onkeyup="myFunction2a();" onchange="myFunction2a();">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Formula 2</label>
                            <input name="f2" id="f2" placeholder=" + 100000000 " class="easyui-validatebox"
						style="width: 180px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" onkeyup="myFunction2a();" onchange="myFunction2a();">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Final Netto</label>
                            <input name="totcons" id="totcons" class="easyui-validatebox" style="width: 180px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px; background-color:#F1F1F1;" placeholder="0" readonly>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Manual addition
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Penambahan jumlah bahan secara manual (dalam satuan Yard/Meter) di luar persentase allowance standar.">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </label>
                            <input name="allowman" id="allowman" type="number" class="easyui-validatebox" style="width: 350px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                           <label style="margin-bottom: 8px;font-size: 16px;">Qty tambahan untuk PPS
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Kebutuhan bahan khusus untuk pembuatan sampel Pre-Production (PPS) yang dibebankan ke dalam PO ini.">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                           </label>
                            <input name="qrs" id="qrs" type="number" class="easyui-validatebox" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <!-- <label style="margin-bottom: 8px;font-size: 16px;">Consumption variance</label> -->
                            <input type="hidden" name="varcons" id="varcons" class="easyui-validatebox" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px; background-color:#F1F1F1;" placeholder="0" readonly>
                        </div>
                    </div>
                    <!-- <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Qty tambahan untuk PPS</label>
                            <input name="qrs" id="qrs" type="number" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
                        </div>
                    </div> -->
                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Price per unit
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle easyui-tooltip" viewBox="0 0 16 16" data-options="position:'top'" title="Harga satuan bahan baku sesuai kesepakatan dengan supplier (dalam USD atau mata uang yang berlaku).">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </label>
                            <input required name="price2" id="price2a" type="number" class="easyui-validatebox" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <label style="margin-bottom: 8px;font-size: 16px;">Currency</label>
                            <input name="curpk" id="curpk1" style="width: 250px; height:40px; font-weight: 400; font-size: 14px; line-height: 18px;" class="easyui-combobox" data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'USD',panelHeight:'auto', onSelect: updateCurrencyText1">
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: flex-start; max-width: 800px; margin-bottom: 10px; gap: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <!-- <label style="margin-bottom: 8px;font-size: 16px;">Total PO</label> -->
                            <input type="hidden" name="pocons1" id="pocons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <div style="height: 20px;"></div> 
                            <input type="hidden" name="pocons2b" id="pocons2" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div id="poSummaryWrapper1" style="width: 760px; height: 100%; background: #ffffff; border-left: 1px solid #eef0f2; padding-top: 5px; padding: 15px; display: flex; flex-direction: column; font-family: 'Inter', sans-serif; color: #1a1a1a;"> -->
            <div id="poSummaryWrapper1" class="no-scrollbar" style="width: 760px; height: 100%; background: #ffffff; border-left: 1px solid #eef0f2; padding-top: 5px; padding: 15px; display: flex; flex-direction: column; font-family: 'Inter', sans-serif; color: #1a1a1a;overflow-y: auto;">
                <div>
                    <div style="font-size: 20px; font-weight: 700; margin-bottom: 15px;">PO Summary</div>
                    <span class="po-instruction">Tolong lengkapi informasi yang wajib diisi untuk menampilkan PO summary.</span>
                </div>
                <div class="po-content-data" style="display:none;">
                    <div style="flex-grow: 1; overflow-y: auto;">
                        <div style="margin-bottom: 15px;">
                            
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Final Netto</span>
                                <span style="font-size: 16px;">
                                    <span class="label_bqty_po"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Allowance qty <span id="allowance_qty"></span></span>
                                <span style="font-size: 16px;">
                                    <span class="label_allowance_qty"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Manual addition qty</span>
                                <span style="font-size: 16px;">
                                    <span class="label_manual_qty"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Qty tambahan untuk PPS</span>
                                <span style="font-size: 16px;">
                                    <span class="label_pps_qty"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Total PO qty</span>
                                <span style="font-size: 16px;">
                                    <span class="label_total_po"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 700;">
                                <span style="font-size: 16px;">Final PO qty</span>
                                <span style="font-size: 16px;">
                                    <span class="label_final_po"></span>
                                    <span class="label_unit">-</span>
                                    <span style="font-size: 16px;">(rounded)</span>
                                </span>
                            </div>
                        </div>

                        <div style="margin-bottom: 5px;">
                            <div style="font-size: 18px; font-weight: 700;">Cost breakdown</div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Unit price</span>
                                <span style="font-size: 16px;">
                                    <span class="label_unit_price"></span>
                                    <span class="text_currency"></span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Final PO qty</span>
                                <span style="font-size: 16px;">
                                    <span class="label_final_po"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-top: 5px; font-size: 14px; font-weight: 700;">
                                <span style="font-size: 16px;">Total item cost</span>
                                <span style="font-size: 16px;">
                                    <span class="label_total_cost"></span>
                                    <span class="text_currency"></span>
                                </span>
                            </div>
                        </div>

                        <hr style="border: 0; border-top: 1px solid #eee; margin-top: 0px; margin-bottom: 2px 0;">
                        <div style="margin-bottom: 15px;">
                            <div style="font-size: 18px; font-weight: 700; margin-bottom: 10px; color: #606266;">Cost & Consumption insights</div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <div style="color: #909399; font-size: 16px; font-weight: 700; margin-bottom: 5px;">Consumption additions</div>
                                <a href="javascript:void(0)" onclick="openModalEditDetail()"style="font-size: 12px; color: #359DD9; font-weight: 600; text-decoration:none;">View detail</a>
                            </div>
                            <!-- <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="font-size: 16px;">Consumption additions</span>
                                <span id="varcons_text1"></span>
                            </div> -->
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Allowance</span>
                                <span style="font-size: 16px;">
                                    <span class="text_allowads_edit"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">PPS</span>
                                <span style="font-size: 16px;">
                                    <span class="text_cons_pps_edit"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Others</span>
                                <span style="font-size: 16px;">
                                    <span class="text_cons_other_edit"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <hr style="border: 0; border-top: 1px solid #eee; margin-top: 0px; margin-bottom: 0px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 16px;">
                                <span style="font-weight: 700;">Total consumption addition</span>
                                <span style="font-size: 16px;">
                                    <span style="font-weight: bold;" class="text_totalconsumption_edit"></span>
                                    <span style="font-weight: bold;" class="label_unit">-</span>
                                    <span class="text_persent_totalconsumption_edit"></span>
                                </span>
                            </div>

                            <div style="color: #909399; font-size: 16px; font-weight: 700; margin-bottom: 5px; margin-top: 10px; ">Cost impact</div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Total consumption addition</span>
                                <span style="font-size: 16px;">
                                    <span class="text_totalconsumption_edit"></span>
                                    <span class="label_unit">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Unit Price</span>
                                <span style="font-size: 16px;">
                                    <span class="label_unit_price"></span>
                                    <span class="text_currency">-</span>
                                </span>
                            </div>
                            <hr style="border: 0; border-top: 1px solid #eee; margin-top: 0px; margin-bottom: 0px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 16px;">
                                <span style="font-weight: 700;">Additional cost for order</span>
                                <span style="font-size: 16px;">
                                    <span style="font-weight: bold;" class="text_total_costorder_edit"></span>
                                    <span style="font-weight: bold;" class="text_currency">-</span>
                                    <span class="text_persent_costorder_edit"></span>
                                </span>
                            </div>

                            <div style="color: #909399; font-size: 16px; font-weight: 700; margin-bottom: 5px; margin-top: 10px; ">Costing budget</div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Item costing budget</span>
                                <span style="font-size: 16px;">
                                    <span class="text_totalbudget_edit"></span>
                                    <span class="text_currency">-</span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Total item cost</span>
                                <span style="font-size: 16px;">
                                    <span class="text_total_cost_edit"></span>
                                    <span class="text_currency">-</span>
                                </span>
                            </div>
                            <hr style="border: 0; border-top: 1px solid #eee; margin-top: 0px; margin-bottom: 0px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 2px; font-size: 16px;">
                                <span style="font-weight: 700;">Balance</span>
                                <span style="font-size: 16px;">
                                    <span class="balanceWrapperSummaryEdit">
                                        <span style="font-weight: bold;" class="text_totalbalance_edit"></span>
                                        <span style="font-weight: bold;" class="text_currency"></span>
                                    </span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0px; font-size: 14px;">
                                <div id="budget_warning_edit"></div>
                            </div>
                            
                            <!-- <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span id="budget_warning_edit"></span>
                            </div> -->
                            <!-- <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span style="font-size: 16px;">Consumption allowance/pcs</span>
                                <span>
                                    <span class="label_allowance_qty"></span>
                                    <span>
                                        <span class="label_unit"></span>/pcs
                                    </span>
                                    <span id="allowcons_text1">(0% allowance)</span>
                                </span>
                            </div> -->
                            <!-- <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="font-weight: 700;">Final Consumption / pcs</span>
                                <span class="text_finalcons"></span>
                            </div> -->

                            <!-- <div style="color: #909399; font-size: 13px; font-weight: 600; margin-top: 20px; margin-bottom: 10px; text-transform: uppercase;">Cost impact</div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span>Additional variances/garment</span>
                                <span>
                                    <span class="text_additional_variance1"></span>
                                    <span class="text_currency"></span>
                                </span>
                            </div> -->
                            <!-- <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span>Allowance cost/unit</span>
                                <span>
                                    <span class="text_allow_cost_pc1"></span>
                                    <span class="text_currency"></span>
                                </span>
                            </div> -->
                            <!-- <div style="display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 14px;">
                                <span>Final item cost/garment</span>
                                <span>
                                    <span class="text_final_itemcost1"></span>
                                    <span class="text_currency"></span>
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="font-weight: 700;">Total order cost</span>
                                <span id="totalOrderWrapper1">
                                    <span class="text_order_cost1"></span>
                                    <span class="text_currency"></span>
                                </span>
                            </div> -->
                        </div>
                    </div>

                    <div style="margin-top: 0px; display: flex; flex-direction: column; gap: 5px;">
                        <button type="button" id="btnSaveMaterial1" onclick="save2(); sup2b(); $('#div_input_usage2').hide();$('#div_input_cw').hide();$('#div_input_gsm').hide();" 
                                style="width: 100%; background: #1a1a1b; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer;">
                           Update material
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="footer-buttons" style="padding:5px; text-align:right;">
        <div style="height: 20px;"></div> 
        <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save1()">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dialog-forma').dialog('close')">Close</a> -->
    </div>
</div>

