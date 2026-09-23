<div id="modal_detail_edit_summary" class="easyui-dialog" title="Cost & Consumption Detail" 
     style="width:550px; height:auto; padding:10px;display:none;" 
     data-options="closed:true, modal:true, border:'thin', resizable:false">
    
    <div id="detail_content_placeholder">
        <div style="margin-bottom: 10px;">
            <div style="font-weight: bold; color: #6c757d; font-size: 14px;">Consumption</div>
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed;">
                <tr>
                    <td style="width: 40%; color: #6c757d; padding: 4px 0;">Allowance / pcs</td>
                    <td style="width: 35%; text-align: right; font-weight: 400;">
                        <span class="label_allowance_detail"></span> 
                        <span class="label_unit"></span></td>
                    <td style="width: 25%; text-align: center;"></td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Order breakdown quantity</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="text_bdownqty"></span>
                    </td>
                    <td style="width: 25%;text-align: center; color: #6c757d;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;color: #6c757d; padding: 8px 0 4px 0;">Total allowance addition</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="label_total_add_cost"></span> 
                        <span class="label_unit"></span>
                    </td>
                    <td style="width: 25%;text-align: center;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">PPS addition</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="text_cons_pps_edit"></span> 
                        <span class="label_unit"></span>
                    </td>
                    <td style="width: 25%;text-align: center;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Manual addition</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="text_cons_other_edit"></span> 
                        <span class="label_unit"></span>
                    </td>
                    <td style="width: 25%;text-align: center;"></td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Formula addition</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;"><span class="">0</span> <span class="label_unit"></span></td>
                    <td style="width: 25%;text-align: center; color: #6c757d;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;font-weight: bold; padding: 5px 0;">Total consumption addition</td>
                    <td style="width: 35%;text-align: right; font-weight: bold;">
                        <span style="font-size: 14px;">
                        <span style="font-weight: bold;" class="text_totalconsumption_edit"></span>
                        <span style="font-weight: bold;" class="label_unit">-</span>
                        <!-- <span class="text_persent_totalconsumption_edit_detail"></span></span> -->
                    </td>
                    <td style="width: 25%; text-align: left; padding-left: 10px; white-space: nowrap;">
                        <small class="text_persent_totalconsumption_edit_detail" style="font-weight: bold;"></small>
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-bottom: 10px;">
            <div style="font-weight: bold; color: #6c757d; font-size: 14px;">Cost impact</div>
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed;">
                <tr>
                    <td style="width: 40%; color: #6c757d; padding: 4px 0;">Allowance cost / pcs</td>
                    <td style="width: 35%; text-align: right; font-weight: 400;">
                        <span class="label_allowancecost_detail"></span> 
                        <span class="text_currency"></span></td>
                    <td style="width: 25%; text-align: center;"></td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Order breakdown quantity</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="text_bdownqty"></span>
                    </td>
                    <td style="width: 25%;text-align: center; color: #6c757d;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;color: #6c757d; padding: 8px 0 4px 0;">Total additional item cost</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="label_total_add_itemcost"></span> 
                        <span class="text_currency"></span>
                    </td>
                    <td style="width: 25%;text-align: center;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">PPS addition cost</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="text_cons_costpps"></span> 
                        <span class="text_currency"></span>
                    </td>
                    <td style="width: 25%;text-align: center;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Manual addition cost</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span class="text_cons_costother"></span> 
                        <span class="text_currency"></span>
                    </td>
                    <td style="width: 25%;text-align: center;"></td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Formula addition cost</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;"><span class="">0</span> <span class="text_currency"></span></td>
                    <td style="width: 25%;text-align: center; color: #6c757d;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;font-weight: bold; padding: 5px 0;">Additional cost for order</td>
                    <td style="width: 35%;text-align: right; font-weight: bold;">
                        <span style="font-size: 14px;">
                        <span style="font-weight: bold;" class="text_totalconsumption_detail"></span>
                        <span style="font-weight: bold;" class="text_currency">-</span>
                        <!-- <span class="text_persent_totalconsumption_edit_detail"></span></span> -->
                    </td>
                    <td style="width: 25%; text-align: left; padding-left: 10px; white-space: nowrap;">
                        <small class="text_persent_consumption_detail" style="font-weight: bold; font-size: 12px;"></small>
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-bottom: 10px;">
            <div style="font-weight: bold; color: #6c757d; font-size: 14px;">Costing budget</div>
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed;">
                <tr>
                    <td style="width: 40%; color: #6c757d; padding: 4px 0;">Costing consumption quantity</td>
                    <td style="width: 35%; text-align: right; font-weight: 400;">
                        <span class="label_coscons_detail"></span> 
                        <span class="label_unit"></span></td>
                    <td style="width: 25%; text-align: center;"></td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Unit price</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span style="font-size: 14px;">
                            <span class="label_unit_price"></span>
                            <span class="text_currency">-</span>
                        </span>
                    </td>
                    <td style="width: 25%;text-align: center; color: #6c757d;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;color: #6c757d; padding: 8px 0 4px 0;">Item costing budget</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span style="font-size: 14px;">
                            <span class="text_totalbudget_edit"></span>
                            <span class="text_currency">-</span>
                        </span>
                    </td>
                    <td style="width: 25%;text-align: center;"></td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="width: 40%;color: #6c757d; padding: 4px 0;">Total item cost</td>
                    <td style="width: 35%;text-align: right; font-weight: 400;">
                        <span style="font-size: 14px;">
                            <span class="text_total_cost_edit"></span>
                            <span class="text_currency">-</span>
                        </span>
                    </td>
                    <td style="width: 25%;text-align: center; color: #6c757d;"></td>
                </tr>
                <tr>
                    <td style="width: 40%;font-weight: bold; padding: 5px 0;">Balance</td>
                    <td style="width: 35%;text-align: right; font-weight: bold;">
                        <span style="font-size: 14px;">
                            <span class="balanceWrapperSummaryEdit">
                                <span style="font-weight: bold;" class="text_totalbalance_edit"></span>
                                <span style="font-weight: bold;" class="text_currency"></span>
                            </span>
                        </span>
                    </td>
                    <td style="width: 25%; text-align: left; padding-left: 10px; white-space: nowrap;">
                        <small class="" style="font-weight: bold;"></small>
                    </td>
                </tr>
            </table>
        </div>

       
    </div>
</div>