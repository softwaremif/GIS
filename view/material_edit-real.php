<!--form edit-->
<div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
	data-options="border:false,title:false,closable:false,resizable:false,modal:true"
	style="width:95%;height:100%;padding:5px 5px;display:none;top:15px;border-radius:8px;">
	<?php //$ord=$_GET['ord']; 
	?>
	<!--<div id="center" region="center" border="false">-->
	<form id="formb" method="post">
		<input type="hidden" name="ordpk" id="ordpk" value="<?php echo $ord; ?>">
		<input type="hidden" name="rkbpk" id="rkbpk">
		<input type="hidden" name="bdownpk" id="bdownpk">
		<input type="hidden" name="kolom" id="kolom">
		<input type="hidden" name="nour" id="nour">
		<input type="hidden" name="fup" id="fup">
		<input type="hidden" name="popk" id="popk">
		<!--<input type="hidden" name="tspec" id="tspec" >-->
		<div class="modal-dialog" style="width:99%; height:98%; overflow-y:scroll;overflow-x:hidden;">
			<div class="modal-content">
				<div id="viewmemo"
					style="padding:5px;margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Edit Material
					<a href="javascript:void(0)" onclick="myFunction2();"
						style="font-size:14px; color:#359DD9; text-decoration:none;">View purchasing memo</a>
				</div>
				<div id="close" style="margin-top:-30px; margin-left:1090px;display:none;">
					<a id="close" href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px;"
						onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset'); sup2b(); 
						$('#div_input_usage2').hide();"> X</a>
				</div>

				<div id="viewmemo2"
					style="padding:5px;margin-top:10px; margin-left:25px;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
					Edit Material
					<a href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:28px; margin-left:980px;"
						onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset'); sup2b(); $('#div_input_usage2').hide();"> X</a>
				</div>
				<!-- <div class="fitem">
					<label>Group</label></br>
					<input name="kelnm" id="kelnm_edit" class="easyui-combobox" required="true"
						style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						data-options="prompt:'Choose group...',panelHeight:'auto',editable:false, 
						data: [
						{value:'CUTTING',text:'CUTTING'},
						{value:'SEWING',text:'SEWING'},
						{value:'FINISHING/PACKING',text:'FINISHING/PACKING'}
						], onChange:klnm_value_edit">
				</div> -->

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Category</label></br>
					<input name="mtype" id="mtype_edit" required="true"
					style="width: 235px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
					class="easyui-combobox"
					data-options="onChange:klnm_value_edit,valueField:'mtypepk',textField:'typenm',url:'view/get_data.php?dt=mtype',prompt:'Category',limitToList:'true'">
				</div>

				<div class="fitem item_dan_usage">
					<!-- <div id="item_input">
						<label>Item</label></br>
						<input onkeyup="multi();" name="item" id="item" class="easyui-validatebox" required="true"
							style="width: 244px; height:34px;" placeholder="Input item name...">
					</div> -->

				<div class="item_input" style="padding:5px;">
					<label style="padding-bottom:10px;">Item Name</label></br>
					<input onkeyup="multi();" type="text" name="item" id="item" class="easyui-validatebox" required="true" 
					autocomplete="off" style="width: 300px; height:34px;" placeholder="Input item name...">
					<div id="suggestions-container" class="suggestions-container"></div>
				</div>

					<div id="div_input_usage2" style="display:none;padding:5px;">
						<label style="padding-bottom:10px;">Usage</label><br>
						<select class="easyui-combobox" name="nilai_usage2" id="nilai_usage2"
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
						<!-- <input type="text" id="input_hidden_usage_edit" name="input_hidden_usage_edit"> -->
					</div>
				</div>

				<!-- memo -->
				<div id="dropdwn">
					<div id="myDropdown2b" class="dropdwn-content2" style="left:155px; top:35px; width:413px;">
						<input name="memonm" id="memonm" class="easyui-validatebox"
							style="font-size:14px; border:none; width:100%; height:auto;" readonly>
						<input name="tgl2" id="tgl2" class="easyui-validatebox"
							style="font-size:14px; color:#AFAFAF; border:none; width:100%; height:auto;" readonly>
					</div>
				</div>

				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Garment Colorway</label></br>
					<textarea name="itemadd" id="itemadd" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Supplier</label><br>
					<span id="suppk2a">
						<input name="suppk" id="suppk2aa" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'">
					</span>
					<span id="suppk2b" style="display:none;">
						<input id="suppk2bb" required="true"
							style="width: 162px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
							class="easyui-combobox"
							data-options="valueField:'suppk',textField:'supnm',url:'view/get_data.php?dt=sup',prompt:'Supplier',limitToList:'true'"
							disabled>
						<!--<input type="hidden" name="suppk1" id="suppk2" value="1949" size="5">-->
					</span>
					<input type="checkbox" name="external2" id="external2" value="1949" onclick="sup2();">
					<!--<input type="checkbox" name="external2b" id="external2b" value="1949" onclick="sup2();" checked>-->
					<input type="hidden" name="ext2" id="ext2" size="5">
					<input type="hidden" name="ext2b" id="ext2b" size="5">
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
					<input type="radio" name="tspec" id="tspec" value="1" onclick="$('#hidden').hide(); multi();"
						checked>
					<label>Single Column</label>
					<input type="radio" name="tspec" id="tspec" value="2" onclick="$('#hidden').show(); multi();">
					<label>Multi Column</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<textarea name="spec" id="spec2" required="true" class="easyui-validatebox"
						style="width:1125px; height: 55px;"></textarea>
				</div>
				<div id="hidden" style="display: none;">
					<div class="fitem" style="padding:5px;">
						<input type="hidden" name="h1" id="h1" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h2" id="h2" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h3" id="h3" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h4" id="h4" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h5" id="h5" style="width: 138px; height:34px;" readonly>
						<input type="hidden" name="h6" id="h6" style="width: 138px; height:34px;" readonly>

						<input name="hspec1" id="hspec1" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec2" id="hspec2" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec3" id="hspec3" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec4" id="hspec4" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec5" id="hspec5" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec6" id="hspec6" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec7" id="hspec7" class="easyui-validatebox" style="width: 138px; height:34px;"
							placeholder="header...">
						<input name="hspec8" id="hspec8" class="easyui-validatebox" style="width: 138px; height:34px;"
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
					<label>Color Name</label>&emsp;
					<label>Color Codes</label>
				</div>
				<div class="fitem" style="padding:5px;">
					<input name="colname" id="colname" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input color...">&nbsp;
					<input name="colcode" id="colcode" class="easyui-validatebox" required="true"
						style="width: 150px; height:34px;" placeholder="Input code...">
					<a href="javascript:void(0)" onclick="lookup_col();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
				</div>
				<div class="fitem" style="padding:5px;">
					<label>Size</label></br>
					<input name="sizegar" id="sizegar" class="easyui-validatebox" required="true"
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
						style="width: 103px; height:34px;" placeholder="0">&nbsp;
					<input name="curpk" id="curpk"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="valueField:'curpk',textField:'curid',url:'view/get_data.php?dt=cur',prompt:'USD',limitToList:'true'">
				</div>
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">Bdown Qty.</label></br>
					<input name="bdownqty" id="bdownqty" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="canbdown2(); myFunction2a();" onchange="canbdown2(); myFunction2a();">
					<a href="javascript:void(0)" onclick="lookup_bdown();"
						style="color:#359DD9; text-decoration:none;">Lookup</a>
					<input type="hidden" name="canbd" id="canbd2" size="5">
					<!--<input type="checkbox" name="canbdown1" id="canbdown1" value="1" style="display: none;"><label id="lcan" style="display: none;">Cancel Lookup</label>-->
				</div>
				<div style="padding-left:5px;">
					<label style="margin-left: 24px;font-size: 15px;padding-bottom:5px;">Allowance%</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Allowman</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Costing Cons.</label>&emsp;&emsp;&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Purcashing Cons.</label>&emsp;&emsp;
					<label style="font-size: 15px;padding-bottom:5px;">Variance Cons.</label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="allowcons" id="allowcons" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">&nbsp;
					<input name="allowman" id="allowman" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">&nbsp;
					<input name="negocons" id="negocons" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">&nbsp;
					<input name="estcons" id="estcons" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
					<input name="varcons" id="varcons" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<label style="padding-bottom:0px;">Netto</label>&emsp;
					<label style="padding-bottom:0px;">Formula </label>
					<label></label>
				</div>
				<div class="fitem" style="padding-left:5px;">
					<input name="totcons" id="totcons" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input id="formula1" value="estcons * bdownqty" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" readonly>
					<!--<select class="easyui-combobox" name="f1a" id="f1a"
					data-options="editable:false, panelHeight:'auto'" style="width:50px;">
					<option value=""></option>
					<option value="1"> + </option>
					<option value="2"> - </option>
					<option value="3"> * </option>
					<option value="4"> / </option>
					</select>-->
					<input name="f1" id="f1" placeholder=" /100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2a();" onchange="myFunction2a();">
					<!--<select class="easyui-combobox" name="f2a" id="f2a"
					data-options="editable:false, panelHeight:'auto'" style="width:50px;">
					<option value=""></option>
					<option value="+"> + </option>
					<option value="-"> - </option>
					<option value="*"> * </option>
					<option value="/"> / </option>
					</select>-->
					<input name="f2" id="f2" placeholder=" +100000000 " class="easyui-validatebox"
						style="width:100px; height:34px;" onkeyup="myFunction2a();" onchange="myFunction2a();">
				</div>
				<!--<div class="fitem">
				<label>Netto</label></br>
				<input name="totcons" id="totcons" class="easyui-validatebox" style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
				</div>-->
				<div class="fitem" style="padding:5px;">
					<label style="padding-bottom:10px;">PPS</label></br>
					<input name="qrs" id="qrs" class="easyui-validatebox" style="width: 150px; height:34px;"
						placeholder="0" onkeyup="myFunction2a();" onchange="myFunction2a();">
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
					<input name="pocons1" id="pocons" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="pocons2b" id="pocons2" class="easyui-validatebox"
						style="width: 150px; height:34px; background-color:#F1F1F1;" placeholder="0" readonly>
					<input name="unit" id="unit"
						style="width: 88px; height:34px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
						class="easyui-combobox"
						data-options="editable:false,valueField:'unita',textField:'unita',url:'view/get_data.php?dt=piunit',prompt:'Unit',limitToList:true">
				</div>
				<a style="text-decoration:none; left:750px; margin-top:-32px;" href="javascript:void(0)"
					class="button-cancel"
					onclick="$('#dialog-formb').dialog('close'); $('#formb').form('reset'); sup2b(); $('#div_input_usage2').hide();">Cancel</a>
				<!-- <a style="text-decoration:none;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>-->
				<a style="text-decoration:none; left:825px; margin-top:-30px;" href="javascript:void(0)" value="Save"
					class="button-submit" onclick="save2(); sup2b(); $('#div_input_usage2').hide();">Save</a>
				<!--<a style="text-decoration:none; left:700px; bottom: 75px;" href="javascript:void(0)" class="button-request-po" onclick="save2b();">Save & Request PO</a>-->
			</div>
		</div>
	</form>
</div>