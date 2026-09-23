form tambah
<div id="dialog-forma" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,closable:false,resizable:false,modal:true"
	style="width:95%;height:100%;padding:5px 5px;display:none;top:0;border-radius:8px;">
	<?php //$ord=$_GET['ord']; 
	?>
	<!--<div id="center" region="center" border="false">-->
	<form id="forma" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="bdownpk" id="bdownpk1">
		<input type="hidden" name="kolom" id="kolom1">
		<!--<input type="hidden" name="tspec" id="tspec" >-->
		<div class="modal-dialog" style="width:99%; height:98%; overflow-y:true;overflow-x:hidden;">
			<div class="modal-content">
				<div
					style="padding:5px;margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Add Material
				</div>
				<div
					style="margin-top:-25px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:1090px;"
						onclick="$('#dialog-forma').dialog('close'); $('#forma').form('reset'); 
						sup1b();$('#div_input_usage').hide();"> X</a>
				</div>
				<!-- <div class="fitem">
					<label>Group</label></br>
					<input name="kelnm" id="kelnm1" class="easyui-combobox" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						data-options="prompt:'Choose group...',panelHeight:'auto',editable:false, 
						data: [
						{value:'CUTTING',text:'CUTTING'},
						{value:'SEWING',text:'SEWING'},
						{value:'FINISHING/PACKING',text:'FINISHING/PACKING'}
						], onChange:klnm_value">
				</div> -->

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Category</label></br>
					<input name="mtype" id="mtype" required="true"
					style="width: 235px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
					class="easyui-combobox"
					data-options="onChange:klnm_value,valueField:'mtypepk',textField:'typenm',url:'view/get_data.php?dt=mtype',prompt:'Category',limitToList:'true'">
				</div>

				<div class="fitem item_dan_usage">
					<!-- <div id="item_input">
						<label>Item</label></br>
						<input onkeyup="multi1();" name="item" id="item1" class="easyui-validatebox" required="true"
							style="width: 244px; height:34px;" placeholder="Input item name...">
					</div> -->

				<div class="item_input" style="padding:5px;">
					<label style="padding-bottom:10px;">Item Name</label></br>
					<input onkeyup="multi1();" type="text" name="item" id="item1" class="easyui-validatebox" required="true" 
					autocomplete="off" style="width: 300px; height:34px;" placeholder="Input item name...">
					<div id="suggestions-container1" class="suggestions-container"></div>
				</div>

					<div id="div_input_usage" style="display:none;padding:5px;">
						<label style="padding-bottom:10px;">Usage</label><br>
						<select class="easyui-combobox" name="nilai_usage" id="nilai_usage"
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
						<!-- <input type="text" id="input_hidden_usage" name="input_hidden_usage"> -->
					</div>
				</div>

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Garment Colorway</label></br>
					<textarea name="itemadd" id="itemadd" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Supplier</label><br>
					<span id="suppk1a">
						<input name="suppk" id="suppk1aa" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'">
					</span>
					<span id="suppk1b" style="display:none;">
						<input id="suppk1bb" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'"
							disabled>
					</span>
					<!--<input type="hidden" name="suppk1" id="suppk1" size="5">-->
					<input type="checkbox" name="external1" id="external1" value="1949" onclick="sup1();">
					<input type="hidden" name="ext1" id="ext1" size="5">
					<label>External sourcing</label>
				</div>
				<div class="fitem" style="padding:5px;">
				<label style="width:auto;">Specification 
				<a href="javascript:void(0)" onclick="lookup_mb();" style="color:#359DD9; text-decoration:none;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search for material</a>
				<!-- </label> -->
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- <label> -->
				<a href="http://192.168.0.11/RKB/data/admin?hal=sisa" target="_blank" style="color:#359DD9; text-decoration:none;">
				Check Stock</a>
				</label>
				</div>
				<div class="fitem">
					<input type="radio" name="tspec" id="tspec" value="1" onclick="$('#hidden1').hide(); multi1();"
						checked>
					<label>Single Column</label>
					<input type="radio" name="tspec" id="tspec" value="2" onclick="$('#hidden1').show(); multi1();">
					<label>Multi Column</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<textarea name="spec" id="spec2b" required="true" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div id="hidden1" style="display:none;">
					<div class="fitem" style="padding:5px;">
						<input name="hspec1" id="hspec1b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec2" id="hspec2b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec3" id="hspec3b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec4" id="hspec4b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec5" id="hspec5b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec6" id="hspec6b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec7" id="hspec7b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec8" id="hspec8b" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
					</div>
					<div class="fitem" style="padding:5px;">
						<input name="spec1" id="spec1a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec2" id="spec2a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec3" id="spec3a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec4" id="spec4a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec5" id="spec5a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec6" id="spec6a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec7" id="spec7a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
						<input name="spec8" id="spec8a" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="value...">
					</div>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Placement</label></br>
					<textarea name="specadd" id="specadd" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label>Color Name</label>
					<label>Color Code</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<input name="colname" id="colname1" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input color...">&nbsp;
					<input name="colcode" id="colcode1" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input code...">
					<a href="javascript:void(0)" onclick="lookup_col();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Size</label></br>
					<input name="sizegar" id="sizegar1" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input size...">
					<a href="javascript:void(0)" onclick="lookup_bdown();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label style="width:auto;">
					<!-- Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
					<!-- </label>
					<label style="font-size: 15px;"> -->
					Budgeting price &nbsp;&nbsp;
					<!-- </label>
					<label style="font-size: 15px;"> -->
					Currency
					</label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<!--<input name="unit" id="unit" class="easyui-validatebox" style="width: 150px; height:34px;" placeholder="Input Unit...">&nbsp;-->
					<!-- <input name="unit" id="unit"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true"> -->
					<input required name="price2" id="price2" class="easyui-validatebox"
						style="width: 103px; height:34px;" placeholder="0">
					<input name="curpk" id="curpk"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'USD',panelHeight:'auto'">
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Bdown Qty.</label></br>
					<input name="bdownqty" id="bdownqty1a" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="canbdown(); myFunction2b();" onchange="canbdown(); myFunction2b();">
					<a href="javascript:void(0)" onclick="lookup_bdown();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
					<input type="hidden" name="canbd" id="canbd" size="5">
				</div>
				<div style="padding-left:5px;">
					<label style="margin-left: 24px;font-size: 15px;padding-bottom:5px;">Allowance %</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Allowman</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Costing Cons.</label>&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Purcashing Cons.</label>&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Variance Cons.</label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="allowcons" id="allowcons1" class="easyui-validatebox"
						style="width: 150px; height:34px;" placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">&nbsp;
					<input name="allowman" id="allowman1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">&nbsp;
					<input name="negocons" id="negocons1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">&nbsp;
					<input name="estcons" id="estcons1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">
					<input name="varcons" id="varcons1" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label style="padding-bottom:0px;">Netto</label>&emsp;
					<label style="padding-bottom:0px;">Formula </label>
					<label></label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="totcons" id="totcons1" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input id="formula1b" value="estcons * bdownqty" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" readonly>
					<!--<select class="easyui-combobox" name="f1a" id="f1a"
						data-options="editable:false, panelHeight:'auto'" style="width:50px;">
						<option value=""></option>
						<option value="1"> + </option>
						<option value="2"> - </option>
						<option value="3"> * </option>
						<option value="4"> / </option>
						</select>-->
					<input name="f1" id="f1b" placeholder=" / 100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2b();" onchange="myFunction2b();">
					<!--<select class="easyui-combobox" name="f2a" id="f2a"
						data-options="editable:false, panelHeight:'auto'" style="width:50px;">
						<option value=""></option>
						<option value="+"> + </option>
						<option value="-"> - </option>
						<option value="*"> * </option>
						<option value="/"> / </option>
						</select>-->
					<input name="f2" id="f2b" placeholder=" + 100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2b();" onchange="myFunction2b();">
				</div>
				<!--<div class="fitem">
					<label>Netto</label></br>
					<input name="totcons" id="totcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					</div>-->
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">PPS</label></br>
					<input name="qrs" id="qrs1" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2b();" onchange="myFunction2b();">
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;width:auto;">
					Total PO 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Unit
					</label></br>
					<input name="pocons1" id="pocons1" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="pocons2b" id="pocons2b" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="unit" id="unit"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="editable:false,valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true">
				</div>
				<a style="text-decoration:none; left:750px; margin-top:-32px;" href="javascript:void(0)"
					class="button-cancel"
					onclick="$('#dialog-forma').dialog('close'); $('#forma').form('reset'); sup1b(); $('#div_input_usage').hide();">Cancel</a>
				<!-- <a style="text-decoration:none;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>-->
				<?php if ($tot > 0) { ?>
					<a style="text-decoration:none; left:825px; margin-top:-30px;" href="javascript:void(0)" value="Save"
						class="button-submit" onclick="save1(); sup1b(); $('#div_input_usage').hide();">Save</a>
				<?php } else { ?>
					<a style="text-decoration:none; left:825px; margin-top:-30px;" href="javascript:void(0)" value="Save"
						class="button-submit" onclick="savee1(); sup2b(); $('#div_input_usage').hide();">Save</a>
				<?php } ?>
				<!--<a style="text-decoration:none; left:700px; bottom: 75px;"" href="javascript:void(0)" class="button-request-po" onclick="save2b();">Save & Request PO</a>-->
			</div>
		</div>
	</form>
</div>