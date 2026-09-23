<html>

<head>
  <link rel="stylesheet" type="text/css" href="media/bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <script type="text/javascript" src="media/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
    body {
      /* font-family: "Arial"; */
    }

    .tooltip {
      position: absolute;
      display: inline-block;
      border: none;
      background-color: transparent;
      margin-top: -15px;
      margin-left: -10px;
      z-index: 3;
    }

    .tooltip .tooltiptext {
      visibility: hidden;
      width: 182px;
      height: auto;
      color: #fff;
      text-align: left;
      border-width: 1px 1px 1px 1px;
      border-style: solid;
      border-color: #E0E0E0;
      padding: 5px 0;
      left: -180px;
      top: -67px;
      /* Position the tooltip */
      position: absolute;
      z-index: 1;
      background: #FFFFFF;
      box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
    }

    .tooltip:hover .tooltiptext {
      visibility: visible;
    }

    .dropbtn1x {
      background-color: #3498DB;
      color: white;
      padding: 16px;
      font-size: 16px;
      /* margin-left: -400px; */
      border: none;
      cursor: pointer;
    }

    .dropbtn1x:hover,
    .dropbtn1x:focus {
      background-color: #2980B9;
    }

    .dropdown1x {
      position: relative;
      display: inline-block;
    }

    .dropdown1-content1x {
      display: none;
      position: absolute;
      background-color: #FFFFFF;
      min-width: 235px;
      overflow: auto;
      /* margin-left: -250px; */
      margin-top: 10px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
      text-align: left;
    }

    .dropdown1-content1x a {
      color: black;
      padding: 5px;
      text-decoration: none;
      display: block;
    }

    .dropdown1x a:hover {
      background-color: #ddd;
    }

    .show {
      display: block;
    }

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
      top: 58px;
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

    .datagrid-body {
      /* overflow-x:hidden; */
      /* overflow-y:hidden; */
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

    .lines-no3 .datagrid-body td {
      border-right: 1px dotted transparent;
      border-bottom: 1px dotted transparent;
    }

    .suggestions-container {
      position: absolute;
      width: 185px;
      /* border: 0px solid #ccc; */
      max-height: 85px;
      overflow-y: auto;
      z-index: 5;
      background-color: #ffffff;
      box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
      border-radius: 5px;
    }

    .suggestions-container ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .suggestions-container li {
      padding: 5px;
      cursor: pointer;
    }

    .suggestions-container li:hover {
      background-color: #f1f1f1;
    }

    .dropdown-toggle-custom {
      border-style: none !important;
    }

    .dropdown-toggle-custom:active {
      border-style: none !important;
    }

    .dropdown-menu {
      box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
      border-radius: 0px;
      border-style: none !important;
    }

    .dropdown-item {
      border-style: none !important;
      /* font-family: Arial; */
      font-style: normal;
      font-weight: 400;
      font-size: 14px;
      line-height: 18px;
      color: #359DD9;
    }

    .dropdown-item:hover {
      background-color: transparent;
      border-style: none !important;
      color: #359DD9;

    }

    .dropdown-item:active {
      background-color: transparent;
      border-style: none !important;

    }
  </style>

  <script type="text/javascript">
    $(window).scroll(function() {
      checkScroll();
    });

    var url;

    $(function() {
			if (performance.navigation.type == 1) {
				console.log("Halaman di-refresh");
				// window.location.href = "?hal=order";
				$('#cari1').val('');
				$('#cari2').val('');
				$('#cari3').val('');
				$('#cari7').val('');
				$('#cari8').val('');
			} else {
				console.log("Halaman tidak di-refresh");
				Search();
			}

      $('#dg').datagrid('getPanel').find('div.datagrid-header').css('background', '#FFFFFF');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-top', '1px solid #858585');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-top-left-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-bottom', '1px solid #858585');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-bottom-left-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-top-right-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-bottom-right-radius', '8px');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-left', '1px solid #858585');
			//   $('#dg').datagrid('getPanel').find('div.datagrid-header').css('border-right', '1px solid #858585');
			$('#dg').datagrid('getPanel').find('div.datagrid-header td[field]').css('border-right', 'none');
			$('#dg').datagrid('getPanel').find('div.datagrid-header').addClass('lines-no');
			$('#dg').datagrid('getPanel').find('div.datagrid-header').addClass('lines-no3');
			$('#dg').datagrid('getPanel').find('div.datagrid-header').addClass('col');
			$('#dg').datagrid('getPanel').addClass('lines-no');
			$('#dg').datagrid('getPanel').addClass('lines-no3');
			//   $('#dg').datagrid('getPanel').addClass('col');

			$('#cari8').combobox({
				onSelect: function(rec) {
					// alert(rec.deppk);
					var cari2 = $('#cari2').val();
					var cari3 = $('#cari3').val();
					var cari7 = $('#cari7').val();
					var cari8 = $('#cari8').val();

					//   var url1 = 'view/get_data.php?dt=md&thn='+cari8;
					//   $('#cari7').combobox('reload', url1);

					var url2 = 'view/get_data.php?dt=byr&md=' + cari7 + '&thn=' + rec.value;
					$('#cari2').combobox('reload', url2);

					var url3 = 'view/get_data.php?dt=season&md=' + cari7 + '&byr=' + cari2 + '&thn=' + rec.value;
					$('#cari3').combobox('reload', url3);

					$('#expthn').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn').val());

					$('#expthn2').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn2').val());

					$('#expthn3').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn3').val());

					$('#expthn4').combobox('setValue', rec.value);
					console.log('Nilai combobox setelah disetel:', $('#expthn4').val());
				}
			});

			$('#cari7').combobox({
				onSelect: function(rec) {
					// alert(rec.deppk);
          console.log("cari7",rec);
					var cari2 = $('#cari2').val();
					var cari3 = $('#cari3').val();
					var cari7 = $('#cari7').val();
					var cari8 = $('#cari8').val();

					var url2 = 'view/get_data.php?dt=byr2&md=' + rec.fupk + '&thn=' + cari8;
					$('#cari2').combobox('reload', url2);

					var url3 = 'view/get_data.php?dt=season2&md=' + rec.fupk + '&byr=' + cari2 + '&thn=' + cari8;
					$('#cari3').combobox('reload', url3);
				}
			});

			$('#cari2').combobox({
				onSelect: function(rec) {
					// alert(rec.deppk);
          console.log("cari2",rec);
					var cari2 = $('#cari2').val();
					var cari3 = $('#cari3').val();
					var cari7 = $('#cari7').val();
					var cari8 = $('#cari8').val();

					var url3 = 'view/get_data.php?dt=season2&md=' + cari7 + '&byr=' + rec.byrpk + '&thn=' + cari8;
					$('#cari3').combobox('reload', url3);
				}
			});

			// $('#dl').datalist({
			// url: 'datalist_data1.json',
			// checkbox: true,
			// lines: true
			// });

			srcbyr();
			srcprodes();
			srcseason();

			$('#dg2').datagrid({
				onLoadSuccess: function(data) {
					var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
					console.log("data total dg2 : " + tcount);

					settingTableHeight(tcount);
				},
			})

		});

    function checkScroll() {
      var scrollYPosition = window.pageYOffset;

      var scroll = {};
      scroll.scrollYPosition = scrollYPosition;
      localStorage.setItem('scroll', JSON.stringify(scroll));
      // localStorage.setItem('scroll', JSON.stringify(scroll));
    }

    /*menu*/
    function menu() {
      var row = $('#dg').datagrid('getSelected');
      if (row) {
        $('#myHeader').show();
        /*count_row();*/
      } else {
        $('#myHeader').hide();
        //$('#dg').datagrid('clearSelections');
      }
    }

    function menu2() {
      var row = $('#dg').datagrid('getSelected');
      if (row) {
        $('#myHeader').hide();
        detail2();
      } else {
        //$('#dg').datagrid('clearSelections');
      }
    }

    // function detail(){
    // 	var row = $('#dg').datagrid('getSelected');
    // 	if(row){
    // 	/*url = "?hal=qty&ord="+row.ordpk;
    //   window.open(url);*/
    // 	window.location.href="?hal=dfqty&ord=" +row.ordpk;
    // 	} else {
    // 	$.messager.alert('Warning','No order data selected','warning');
    // 	}
    // }
    function detail(ordpk) {
      var cari1 = $('#cari1').val();
      var cari2 = $('#cari2').val();
      var cari3 = $('#cari3').val();
      var cari7 = $('#cari7').val();
      var cari8 = $('#cari8').val();
      window.location.href = "?hal=dfqty&ord=" + ordpk + "&c1=" + cari1 + "&c2=" + cari2 + "&c3=" + cari3 + "&c7=" + cari7 + "&c8=" + cari8 + "&scy=" + scrollY;
    }

    function detail3(ordpk) {
      var cari1 = $('#cari1').val();
      var cari2 = $('#cari2').val();
      var cari3 = $('#cari3').val();
      var cari7 = $('#cari7').val();
      var cari8 = $('#cari8').val();
      url = "?hal=dfqty&ord=" + ordpk + "&c1=" + cari1 + "&c2=" + cari2 + "&c3=" + cari3 + "&c7=" + cari7 + "&c8=" + cari8;
      window.open(url);
      //window.location.href="?hal=qty&ord=" +row.ordpk;
    }

    function detail2() {
      var row = $('#dg').datagrid('getSelected');
      if (row) {
        /*if(row.filenm){*/
        /*url = "admin.php?hal=detord&ord=" +row.ordpk;
        window.open(url);*/
        window.location.href = "?hal=dfqty&ord=" + row.ordpk;
        /*} else {
        $('#dialog-form').dialog('open').dialog('setTitle','');
        $('#form').form('load',row);	
        }*/
      } else {
        $.messager.alert('Warning', 'No order data selected', 'warning');
      }
    }

    function fresh() {
      $('#dg').datagrid('reload');
    }

    function Search() {
      $('#dg').datagrid('load', {
        cari1: $('#cari1').val(),
        cari2: $('#cari2').val(),
        cari3: $('#cari3').val(),
        cari7: $('#cari7').val(),
        cari8: $('#cari8').val()
      });



      $('#dg2').datagrid('load', {
        cari1: $('#cari1').val(),
        cari2: $('#cari2').val(),
        cari3: $('#cari3').val(),
        cari7: $('#cari7').val(),
        cari8: $('#cari8').val()
      });

      $('#dg2').datagrid({
        onLoadSuccess: function(data) {
          var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
          console.log("data total dg2 : " + tcount);

          settingTableHeight(tcount);
        },
      })

      $('#dg').datagrid({
        onLoadSuccess: function(data) {
          var returnBack = localStorage.getItem('returnBack');
          var retrievedScrollYData = localStorage.getItem('scroll');
          var parsedScrollYData = retrievedScrollYData ? JSON.parse(retrievedScrollYData) : null;

          if (returnBack) {
            if (parsedScrollYData && parseInt(parsedScrollYData.scrollYPosition) > 0) {
              console.log("parsedScrollYData.scrollYPosition : " + parsedScrollYData.scrollYPosition);

              $('html, body').animate({
                scrollTop: parsedScrollYData.scrollYPosition
              }, 'slow');
            }
            localStorage.removeItem('scroll');
            localStorage.removeItem('returnBack');
          }
        }
      })
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
        cari1: $('#cari1').val(),
        cari2: $('#cari2').val(),
        cari3: $('#cari3').val(),
        cari7: $('#cari7').val(),
        cari8: $('#cari8').val(),
        cari4: $('#cari4b').val()
      });
      $('#newest').show();
      $('#oldest').hide();
    }

    function Search2b() {
      $('#dg').datagrid('load', {
        cari1: $('#cari1').val(),
        cari2: $('#cari2').val(),
        cari3: $('#cari3').val(),
        cari7: $('#cari7').val(),
        cari8: $('#cari8').val(),
        cari5: $('#cari5b').val()
      });
      $('#newest').hide();
      $('#oldest').show();
    }

    $(function() {
      $('#byr').datagrid({
        onCheck: function(index, row, value) {
          $('#tabel1').css("margin-top", "50px");
          var ckk = $('#byr').datagrid('getRows')[index].byrnm;
          document.getElementById("filtera" + index).value = ckk;
          document.getElementById("idxa" + index).value = index;
          document.getElementById("talla" + index).value = 1;
          $('#filtera' + index).show();
          $('#crossa' + index).show();
          $('#dg').datagrid('load', {
            byr0: $('#filtera0').val(),
            byr1: $('#filtera1').val(),
            prodes0: $('#filterb0').val(),
            rodes1: $('#filterb1').val(),
            season0: $('#filterc0').val(),
            season1: $('#filterc1').val()
          });
          tall();
          var counta = JSON.stringify($('#dg').datagrid('getData').total);
          document.getElementById("fltr2").innerHTML = counta + " result";
          $('#fltr1').show();
          $('#fltr2').show();
          $('#fltr3').show();
        },
        onUncheck: function(index, row, value) {
          var total = document.getElementById("total").value;
          if (total == 1) {
            reset();
          } else {
            document.getElementById("carispl").value = "";
            Search5();
            document.getElementById("filtera" + index).value = "";
            $('#filtera' + index).hide();
            $('#crossa' + index).hide();
            $('#dg').datagrid('load', {
              byr0: $('#filtera0').val(),
              byr1: $('#filtera1').val(),
              prodes0: $('#filterb0').val(),
              prodes1: $('#filterb1').val(),
              season0: $('#filterc0').val(),
              season1: $('#filterc1').val()
            });
            document.getElementById("talla" + index).value = 0;
            tall();
            var counta = JSON.stringify($('#dg').datagrid('getData').total);
            document.getElementById("fltr2").innerHTML = counta + " result";
            $('#fltr1').show();
            $('#fltr2').show();
            $('#fltr3').show();
          }
        }
      });
    });

    function uncekbyr2(cross) {
      var total = document.getElementById("total").value;
      if (total == 1) {
        reset();
      } else {
        var c = cross;
        //alert(c);
        var ca = document.getElementById("idxa" + c).value;
        $('#byr').datagrid('unselectRow', ca);
        document.getElementById("carispl").value = "";
        Search5();
        document.getElementById("filtera" + c).value = "";
        document.getElementById("talla" + c).value = 0;
        $('#filtera' + c).hide();
        $('#crossa' + c).hide();
        $('#dg').datagrid('load', {
          byr0: $('#filtera0').val(),
          byr1: $('#filtera1').val(),
          prodes0: $('#filterb0').val(),
          prodes1: $('#filterb1').val(),
          season0: $('#filterc0').val(),
          season1: $('#filterc1').val()
        });
        document.getElementById("idxa" + c).value = "";
      }
    }

    $(function() {
      $('#prodes').datagrid({
        onCheck: function(index, row, value) {
          $('#tabel1').css("margin-top", "50px");
          var ckk = $('#prodes').datagrid('getRows')[index].prodes;
          document.getElementById("filterb" + index).value = ckk;
          $('#filterb' + index).show();
          $('#filterb' + index).show();
          $('#crossb' + index).show();
          $('#fltr1').show();
          $('#fltr2').show();
          $('#fltr3').show();
          document.getElementById("idxb" + index).value = index;
          document.getElementById("tallb" + index).value = 1;
          tall();
          $('#dg').datagrid('load', {
            byr0: $('#filtera0').val(),
            byr1: $('#filtera1').val(),
            prodes0: $('#filterb0').val(),
            prodes1: $('#filterb1').val(),
            season0: $('#filterc0').val(),
            season1: $('#filterc1').val()
          });
          var counta = JSON.stringify($('#dg').datagrid('getData').total);
          document.getElementById("fltr2").innerHTML = counta + " result";
        },
        onUncheck: function(index, row, value) {
          var total = document.getElementById("total").value;
          if (total == 1) {
            reset();
          } else {
            document.getElementById("carispl").value = "";
            Search5();
            document.getElementById("filterb" + index).value = "";
            $('#filterb' + index).hide();
            $('#crossb' + index).hide();
            $('#dg').datagrid('load', {
              byr0: $('#filtera0').val(),
              byr1: $('#filtera1').val(),
              prodes0: $('#filterb0').val(),
              prodes1: $('#filterb1').val(),
              season0: $('#filterc0').val(),
              season1: $('#filterc1').val()
            });
            document.getElementById("tallb" + index).value = 0;
            tall();
            var counta = JSON.stringify($('#dg').datagrid('getData').total);
            document.getElementById("fltr2").innerHTML = counta + " result";
            $('#fltr1').show();
            $('#fltr2').show();
            $('#fltr3').show();
          }
        }
      });
    });

    function uncekprodes2(cross) {
      var total = document.getElementById("total").value;
      if (total == 1) {
        reset();
      } else {
        var c = cross;
        //alert(c);
        var ca = document.getElementById("idxb" + c).value;
        $('#prodes').datagrid('unselectRow', ca);
        document.getElementById("carispl").value = "";
        Search5();
        document.getElementById("filterb" + c).value = "";
        document.getElementById("tallb" + c).value = 0;
        $('#filterb' + c).hide();
        $('#crossb' + c).hide();
        $('#dg').datagrid('load', {
          byr0: $('#filtera0').val(),
          byr1: $('#filtera1').val(),
          prodes0: $('#filterb0').val(),
          prodes1: $('#filterb1').val(),
          season0: $('#filterc0').val(),
          season1: $('#filterc1').val()
        });
        document.getElementById("idxb" + c).value = "";
      }
    }

    $(function() {
      $('#season').datagrid({
        onCheck: function(index, row, value) {
          $('#tabel1').css("margin-top", "50px");
          var ckk = $('#season').datagrid('getRows')[index].season;
          document.getElementById("filterc" + index).value = ckk;
          $('#filterc' + index).show();
          $('#filterc' + index).show();
          $('#crossc' + index).show();
          $('#fltr1').show();
          $('#fltr2').show();
          $('#fltr3').show();
          document.getElementById("idxc" + index).value = index;
          document.getElementById("tallc" + index).value = 1;
          tall();
          $('#dg').datagrid('load', {
            byr0: $('#filtera0').val(),
            byr1: $('#filtera1').val(),
            prodes0: $('#filterb0').val(),
            prodes1: $('#filterb1').val(),
            season0: $('#filterc0').val(),
            season1: $('#filterc1').val()
          });
          var counta = JSON.stringify($('#dg').datagrid('getData').total);
          document.getElementById("fltr2").innerHTML = counta + " result";
        },
        onUncheck: function(index, row, value) {
          var total = document.getElementById("total").value;
          if (total == 1) {
            reset();
          } else {
            document.getElementById("carispl").value = "";
            Search5();
            document.getElementById("filterc" + index).value = "";
            $('#filterc' + index).hide();
            $('#crossc' + index).hide();
            $('#dg').datagrid('load', {
              byr0: $('#filtera0').val(),
              byr1: $('#filtera1').val(),
              prodes0: $('#filterb0').val(),
              prodes1: $('#filterb1').val(),
              season0: $('#filterc0').val(),
              season1: $('#filterc1').val()
            });
            document.getElementById("tallc" + index).value = 0;
            tall();
            var counta = JSON.stringify($('#dg').datagrid('getData').total);
            document.getElementById("fltr2").innerHTML = counta + " result";
            $('#fltr1').show();
            $('#fltr2').show();
            $('#fltr3').show();
          }
        }
      });
    });

    function uncekseason2(cross) {
      var total = document.getElementById("total").value;
      if (total == 1) {
        reset();
      } else {
        var c = cross;
        //alert(c);
        var ca = document.getElementById("idxc" + c).value;
        $('#season').datagrid('unselectRow', ca);
        document.getElementById("carispl").value = "";
        Search5();
        document.getElementById("filterc" + c).value = "";
        document.getElementById("tallc" + c).value = 0;
        $('#filterc' + c).hide();
        $('#crossc' + c).hide();
        $('#dg').datagrid('load', {
          byr0: $('#filtera0').val(),
          byr1: $('#filtera1').val(),
          prodes0: $('#filterb0').val(),
          prodes1: $('#filterb1').val(),
          season0: $('#filterc0').val(),
          season1: $('#filterc1').val()
        });
        document.getElementById("idxc" + c).value = "";
      }
    }

    function totrec() {
      var tcount = JSON.stringify($('#dg').datagrid('getData').total);
      document.getElementById("fltr2").innerHTML = tcount + " result";
    }

    function tall() {
      /*for(var i=0; i<=5; i++){
      const ck = [document.getElementById('tall'+i).value];
      var tall = ck;
      var tall = ck.reduce(myFunc);
      alert(ck);
      document.getElementById('tall').innerHTML = +ck;
      document.getElementById('fltr1').innerHTML = "Search filters("+ck.reduce(myFunc)+")";
      }*/
      var cka0 = document.getElementById("talla0").value;
      var cka1 = document.getElementById("talla1").value;
      var ckb0 = document.getElementById("tallb0").value;
      var ckb1 = document.getElementById("tallb1").value;
      var ckc0 = document.getElementById("tallc0").value;
      var ckc1 = document.getElementById("tallc1").value;
      var tall = parseInt(cka0) + parseInt(cka1) + parseInt(ckb0) + parseInt(ckb1) + parseInt(ckc0) + parseInt(ckc1);
      //alert(tall);
      if (tall >= 1) {
        document.getElementById('total').value = tall;
        document.getElementById('fltr1').innerHTML = "Search filters(" + tall + ")";
      } else {
        document.getElementById('total').value = tall;
        document.getElementById('fltr1').innerHTML = "Search filters(0)";
      }
    }

    function reset() {
      //var total = document.getElementById("total").value;
      document.getElementById("carispl").value = "";
      Search5();
      document.getElementById('total').value = 0;
      $('#byr').datagrid('clearSelections');
      $('#prodes').datagrid('clearSelections');
      $('#season').datagrid('clearSelections');
      $('#tabel1').css("margin-top", "");
      $(".dropdown2-content").slideUp("fast");
      $('#fltr1').hide();
      $('#fltr2').hide();
      $('#fltr3').hide();
      for (var i = 0; i <= 2; i++) {
        $('#filtera' + i).hide();
        $('#crossa' + i).hide();
        document.getElementById('filtera' + i).value = '';
        document.getElementById('talla' + i).value = 0;
        $('#filterb' + i).hide();
        $('#crossb' + i).hide();
        document.getElementById('filterb' + i).value = '';
        document.getElementById('tallb' + i).value = 0;
        $('#filterc' + i).hide();
        $('#crossc' + i).hide();
        document.getElementById('filterc' + i).value = '';
        document.getElementById('tallc' + i).value = 0;
        $('#dg').datagrid('load', {
          byr0: $('#filtera0').val(),
          byr1: $('#filtera1').val(),
          prodes0: $('#filterb0').val(),
          prodes1: $('#filterb1').val(),
          season0: $('#filterc0').val(),
          season1: $('#filterc1').val()
        });
      }
    }

    function toggle(source) {
      checkboxes = document.getElementsByName('ck');
      for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
      }
    }

    function cheka1() {
      var c1 = document.getElementById("chek1");
      if (c1.checked) {
        $('#dg').datagrid('showColumn', 'ordno');
        //$('#dg').datagrid('showColumn', 2);
      } else {
        $('#dg').datagrid('hideColumn', 'ordno');
      }
    }

    function cheka2() {
      var c2 = document.getElementById("chek2");
      if (c2.checked) {
        $('#dg').datagrid('showColumn', 'byrnm');
      } else {
        $('#dg').datagrid('hideColumn', 'byrnm');
      }
    }

    function cheka3() {
      var c3 = document.getElementById("chek3");
      if (c3.checked) {
        $('#dg').datagrid('showColumn', 'artno');
      } else {
        $('#dg').datagrid('hideColumn', 'artno');
      }
    }

    function cheka4() {
      var c4 = document.getElementById("chek4");
      if (c4.checked) {
        $('#dg').datagrid('showColumn', 'prodes');
      } else {
        $('#dg').datagrid('hideColumn', 'prodes');
      }
    }

    function cheka5() {
      var c5 = document.getElementById("chek5");
      if (c5.checked) {
        $('#dg').datagrid('showColumn', 'season');
      } else {
        $('#dg').datagrid('hideColumn', 'season');
      }
    }

    function cheka6() {
      var c6 = document.getElementById("chek6");
      if (c6.checked) {
        $('#dg').datagrid('showColumn', 'funm');
      } else {
        $('#dg').datagrid('hideColumn', 'funm');
      }
    }

    function cheka7() {
      var c7 = document.getElementById("chek7");
      if (c7.checked) {
        $('#dg').datagrid('showColumn', 'qty');
      } else {
        $('#dg').datagrid('hideColumn', 'qty');
      }
    }

    function cheka7b() {
      var c7b = document.getElementById("chek7b");
      if (c7b.checked) {
        $('#dg').datagrid('showColumn', 'user');
      } else {
        $('#dg').datagrid('hideColumn', 'user');
      }
    }

    function cheka8() {
      var c8 = document.getElementById("chek8");
      if (c8.checked) {
        $('#dg').datagrid('showColumn', 'cut');
      } else {
        $('#dg').datagrid('hideColumn', 'cut');
      }
    }

    function cheka9() {
      var c9 = document.getElementById("chek9");
      if (c9.checked) {
        $('#dg').datagrid('showColumn', 'ssew');
      } else {
        $('#dg').datagrid('hideColumn', 'ssew');
      }
    }

    function cheka10() {
      var c10 = document.getElementById("chek10");
      if (c10.checked) {
        $('#dg').datagrid('showColumn', 'fsew');
      } else {
        $('#dg').datagrid('hideColumn', 'fsew');
      }
    }

    function cheka11() {
      var c11 = document.getElementById("chek11");
      if (c11.checked) {
        $('#dg').datagrid('showColumn', 'linnm');
      } else {
        $('#dg').datagrid('hideColumn', 'linnm');
      }
    }

    function testku() {
      var dg = $('#prodes');
      var dg2 = $('#byr');
      var dg3 = $('#season');
      dg.datagrid();
      dg2.datagrid();
      dg3.datagrid();
      dg.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
      dg2.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
      dg3.datagrid('getPanel').find('div.datagrid-header').css('display', 'none');
      $('#prodes').datagrid('getPanel').addClass('lines-no');
      $('#byr').datagrid('getPanel').addClass('lines-no');
      $('#season').datagrid('getPanel').addClass('lines-no');
      $('#prodes').datagrid('getPanel').addClass('lines-no2');
      $('#byr').datagrid('getPanel').addClass('lines-no2');
      $('#season').datagrid('getPanel').addClass('lines-no2');
      $('#prodes').datagrid('getPanel').addClass('col');
      $('#byr').datagrid('getPanel').addClass('col');
      $('#season').datagrid('getPanel').addClass('col');
    }

    $.extend($.fn.datagrid.methods, {
      lockColumn: function(jq, field) {
        return jq.each(function() {
          var p = $('#kolom1').datagrid('getPanel'); // get the panel
          var cell = p.find('div.datagrid-header td[field=' + field + '] > div.datagrid-cell'); // get the cell
          cell.resizable({
            disabled: true
          }); // disable resize
        });
      }
    });

    function testku2() {
      $('#kolom1').datagrid('getPanel').addClass('col');
      $('#kolom1').datagrid('getPanel').addClass('lines-no');
      $('#kolom1').datagrid('getPanel').addClass('lines-no2');
      $('#kolom1').datagrid('lockColumn', 'kolomnm');
      //$('#kolom1').datagrid('getPanel').find('div.datagrid-header input[type=checkbox]').css('outline','2px solid deeppink');
    }

    function expand() {
      const togglePassword2a = document.querySelector("#togglePassword2a");
      const togglePassword2b = document.querySelector("#togglePassword2b");
      const togglePassword2c = document.querySelector("#togglePassword2c");

      togglePassword2a.addEventListener("click", function() {
        test1 = $('#test1').val();
        test2 = $('#test2').val();
        if (test1 == "" && test2 == "") {
          $('.tabela').hide();
          document.getElementById('test1').value = 1;
          // $(".prodesa").css("margin-top","0px");
          // $(".tabelb").css("margin-top","0px");
          // $(".tabelc").css("margin-top","0px");
        } else if (test1 == 1 && test2 == 1) {
          // $(".tabelb").css("margin-top","-45px");
          // $(".tabelc").css("margin-top","15px");
          $('.tabela').show();
          // $(".prodesa").css("margin-top","60px");
          document.getElementById('test1').value = "";
        } else if (test1 == "" && test2 == 1) {
          $('.tabela').hide();
          // $(".prodesa").css("margin-top","-15px");
          // $(".tabelb").css("margin-top","-70px");
          document.getElementById('test1').value = 1;
          // $(".tabelc").css("margin-top","-50px");
        } else if (test1 == 1 && test2 == "") {
          $('.tabela').show();
          // $(".byr").css("margin-top","20px");
          // $(".prodesa").css("margin-top","60px");
          // $(".seasona").css("margin-top","55px");
          // $(".tabelb").css("margin-top","-15px");
          document.getElementById('test1').value = "";
          // $(".tabelc").css("margin-top","85px");
        } else {
          $('.tabela').show();
          document.getElementById('test1').value = "";
          // $(".prodesa").css("margin-top","25px");
          // $(".tabelb").css("margin-top","-40px");
          // $(".tabelc").css("margin-top","55px");
        }
        this.classList.toggle("bi-eye2");
      });

      togglePassword2b.addEventListener("click", function() {
        test1 = $('#test1').val();
        test2 = $('#test2').val();
        if (test1 == "" && test2 == "") {
          $('.tabelb').hide();
          document.getElementById('test2').value = 1;
          // $(".seasona").css("margin-top","-10px");
          // $(".tabelc").css("margin-top","20px");
        } else if (test1 == 1 && test2 == 1) {
          // $(".tabelc").css("margin-top","25px");
          $('.tabelb').show();
          // $(".seasona").css("margin-top","65px");
          document.getElementById('test2').value = "";
        } else if (test1 == 1 && test2 == "") {
          // $(".tabelb").css("margin-top","-85px");
          $('.tabelb').hide();
          // $(".seasona").css("margin-top","-15px");
          document.getElementById('test2').value = 1;
          // $(".tabelc").css("margin-top","-60px");
        } else if (test1 == "" && test2 == 1) {
          // $(".prodesa").css("margin-top","60px");
          // $(".tabelb").css("margin-top","-15px");
          $('.tabelb').show();
          // $(".seasona").css("margin-top","55px");
          document.getElementById('test2').value = "";
          // $(".tabelc").css("margin-top","100px");
        } else {
          $('.tabelb').show();
          document.getElementById('test2').value = "";
          // $(".seasona").css("margin-top","30px");
          // $(".tabelc").css("margin-top","55px");
        }
        this.classList.toggle("bi-eye2");
      });
      togglePassword2c.addEventListener("click", function() {
        $('.tabelc').toggle();
        this.classList.toggle("bi-eye2");
      });
    }

    function filterFunction() {
      var input, filter, ul, li, a, i;
      input = document.getElementById("cari6");
      filter = input.value.toUpperCase();
      div = document.getElementById("myDropdown2");
      a = div.getElementsByTagName("a");
      for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          a[i].style.display = "";
        } else {
          a[i].style.display = "none";
        }
      }
    }

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

    // $(function(){
    // $('#dg').datagrid({
    //   onClickCell: function(index,field,value){
    //    var row = $(this).datagrid('getRows')[index];
    //     if (field == 'cut'){
    //      document.getElementById('ordpkcut').value=row.ordpk;
    //      $('#dialog-formcut').dialog('open').dialog('setTitle','');
    // 		 document.getElementById('opcut').innerHTML="OP "+row.ordno+" - Cutting";
    //      $('#dgcut').datagrid('load',{
    //      ordpk: $('#ordpkcut').val()
    //      });
    //      //$.ajax({
    //      //type:"POST",
    //     //url:"view/get_infob.php?pono="+row.pono,
    //      //data:"rkbpk="+row.rkbpk,
    //      //success:function(data){
    //      //document.getElementById('qtyinfo').innerHTML=data;
    //      //},
    //      //});
    //      }
    // 		else if (field == 'ssew'){
    //      document.getElementById('ordpksew').value=row.ordpk;
    //      $('#dialog-formsew').dialog('open').dialog('setTitle','');
    // 		 document.getElementById('opsew').innerHTML="OP "+row.ordno+" - Sewing";
    //      $('#dgsew').datagrid('load',{
    //      ordpk: $('#ordpksew').val()
    //      });
    //      //$.ajax({
    //      //type:"POST",
    //      //url:"view/get_infob.php?pono="+row.pono,
    //      //data:"rkbpk="+row.rkbpk,
    //      //success:function(data){
    //      //document.getElementById('qtyinfo').innerHTML=data;
    //      //},
    //      //});
    //      }
    // 		 	else if (field == 'fsew'){
    //      document.getElementById('ordpkfin').value=row.ordpk;
    //      $('#dialog-formfin').dialog('open').dialog('setTitle','');
    // 		 document.getElementById('opfin').innerHTML="OP "+row.ordno+" - Finishing";
    //      $('#dgfin').datagrid('load',{
    //      ordpk: $('#ordpkfin').val()
    //      });
    //      //$.ajax({
    //      //type:"POST",
    //      //data:"rkbpk="+row.rkbpk,
    //      //document.getElementById('qtyinfo').innerHTML=data;
    //      //},
    //      //});
    // 		}
    // 	}
    // });
    // });

    function loadcutting(index) {
      var a = $('#dg').datagrid('selectRow', index)
      if (a) {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
          document.getElementById('ordpkcut').value = row.ordpk;
          $('#dialog-formcut').dialog('open').dialog('setTitle', '');
          document.getElementById('opcut').innerHTML = "OP " + row.ordno + " - Cutting";
          $('#dgcut').datagrid('load', {
            ordpk: $('#ordpkcut').val()
          });
        }
      }
    }

    function loadsewing(index) {
      var a = $('#dg').datagrid('selectRow', index)
      if (a) {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
          document.getElementById('ordpksew').value = row.ordpk;
          $('#dialog-formsew').dialog('open').dialog('setTitle', '');
          document.getElementById('opsew').innerHTML = "OP " + row.ordno + " - Sewing";
          $('#dgsew').datagrid('load', {
            ordpk: $('#ordpksew').val()
          });
        }
      }
    }

    function loadfinish(index) {
      var a = $('#dg').datagrid('selectRow', index)
      if (a) {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
          document.getElementById('ordpkfin').value = row.ordpk;
          $('#dialog-formfin').dialog('open').dialog('setTitle', '');
          document.getElementById('opfin').innerHTML = "OP " + row.ordno + " - Finishing";
          $('#dgfin').datagrid('load', {
            ordpk: $('#ordpkfin').val()
          });
        }
      }
    }

    //jasa
		function loadjs(index) {
			var a = $('#dg').datagrid('selectRow', index)
			if (a) {
				var row = $('#dg').datagrid('getSelected');
				if (row) {
					document.getElementById('ordpkjs').value = row.ordpk;
					$('#dialog-formjs').dialog('open').dialog('setTitle', '');
					document.getElementById('opjs').innerHTML = "OP " + row.ordno + " - Jasa";
					$('#dgjs').datagrid('load', {
						ordpk: $('#ordpkjs').val()
					});
				}
			}
		}

    $(function() {
      $('#dgcut').datagrid({
        onClickCell: function(index, field, value) {
          var row = $(this).datagrid('getRows')[index];
          if (field == 'pocons') {
            if (row.pocons2 > 0) {
              document.getElementById('ponoi').value = row.pono;
              document.getElementById('rkbpki').value = row.rkbpk;
              $('#dialog-forminfo').dialog('open').dialog('setTitle', '');
              $('#dginf').datagrid('load', 'view/get_infolpb.php?popk=' + row.popk + '&rkbpk=' + row.rkbpk);
              $.ajax({
                type: "POST",
                url: "view/get_infolpbb.php?popk=" + row.popk,
                data: "rkbpk=" + row.rkbpk,
                success: function(data) {
                  document.getElementById('qtyinfo').innerHTML = data;
                },
              });
            }
          }
        }
      });
    });

    $(function() {
      $('#dgsew').datagrid({
        onClickCell: function(index, field, value) {
          var row = $(this).datagrid('getRows')[index];
          if (field == 'pocons') {
            if (row.pocons2 > 0) {
              document.getElementById('ponoi').value = row.pono;
              document.getElementById('rkbpki').value = row.rkbpk;
              $('#dialog-forminfo').dialog('open').dialog('setTitle', '');
              $('#dginf').datagrid('load', 'view/get_infolpb.php?popk=' + row.popk + '&rkbpk=' + row.rkbpk);
              $.ajax({
                type: "POST",
                url: "view/get_infolpbb.php?popk=" + row.popk,
                data: "rkbpk=" + row.rkbpk,
                success: function(data) {
                  document.getElementById('qtyinfo').innerHTML = data;
                },
              });
            }
          }
        }
      });
    });

    $(function() {
      $('#dgfin').datagrid({
        onClickCell: function(index, field, value) {
          var row = $(this).datagrid('getRows')[index];
          if (field == 'pocons') {
            if (row.pocons2 > 0) {
              document.getElementById('ponoi').value = row.pono;
              document.getElementById('rkbpki').value = row.rkbpk;
              $('#dialog-forminfo').dialog('open').dialog('setTitle', '');
              $('#dginf').datagrid('load', 'view/get_infolpb.php?popk=' + row.popk + '&rkbpk=' + row.rkbpk);
              $.ajax({
                type: "POST",
                url: "view/get_infolpbb.php?popk=" + row.popk,
                data: "rkbpk=" + row.rkbpk,
                success: function(data) {
                  document.getElementById('qtyinfo').innerHTML = data;
                },
              });
            }
          }
        }
      });
    });

    function dtlimport(popkship, importpk) {
      //  alert(importpk);
      $('#dialog-enroute2').dialog('open').dialog('setTitle', '');
      $('#dg2c').datagrid('load', {
        importpkb: importpk
      });
      $.ajax({
        type: "POST",
        url: "view/get_data.php?x=vasnm2",
        data: "popk=" + popkship,
        success: function(data) {
          let text = data;
          const arr = text.split(",");
          // alert(data);
          document.getElementById('typenm2').value = arr[0];
          document.getElementById('vassalnm2').value = arr[1];
          document.getElementById('bill2').value = arr[2];
          document.getElementById('arrival2').value = arr[3];
          document.getElementById('port2').value = arr[4];

          document.getElementById('gw2').value = arr[5];
          document.getElementById('dp2').value = arr[6];
          document.getElementById('dl2').value = arr[7];
          document.getElementById('dt2').value = arr[8];
          document.getElementById('amount2').value = arr[9];

          document.getElementById('etd222').value = arr[10];
          document.getElementById('eta222').value = arr[11];
          document.getElementById('eih222').value = arr[12];

          document.getElementById('importpkb2').value = arr[13];
          // document.getElementById('supnm').value=arr[14];
        },
      });
    }

    function formatterpo(value, row) {
      if (!value) return '-';
      return value.length > 30 ? value.substring(0, 30) + '...' : value;
    }

    function formatter2b(value, row) {
      if (row.vassalnm == "N/A") {
        return value;
      } else {
        return '<span style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);cursor:pointer;" onclick="dtlimport(' + row.popk + ',' + row.importpk + ')">' + value + '</span>'

      }
    }

    function formatter1(value, row) {
      return '<div class="p-0 d-flex">' +
        '<div class="p-0 d-flex justify-content-center align-items-center">' + value + '</div>' +
        '<div class="ps-1">' +
        '<div class="p-0" style="font-size: 14px;font-weight: 700;line-height: 18px;">' + row.artno + '</div>' +
        '<div class="p-0" style="font-size: 12px;font-weight: 400;line-height: 18px;color:#00000061;">' + row.byrnm + ', ' + row.season + '</div>' +
        '</div>' +
        '</div>';
    }

		function formatter2(value, row) {
			if (value != '-') {
				return '<div style="margin-top:20px;margin-left:-70px;font-size: 14px;font-weight: 400;line-height: 18px;">' + value + '</div>' +
					'<div style="margin-left:35px;margin-top:-35px;padding:5px;"><div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061">C:' + row.cut + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061">S:' + row.ssew + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061">F:' + row.fsew + '</div></div>';
			} else {
				return '<span style="color:#00000061">Awaiting Schedule</span>';
			}
		}

		function formatter3(value, row, index) {
			// if (row.stscut != '' || row.stsssew != '' || row.stsfsew != '') {
			// 	return '<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadcutting(' + index + ')">C:' + row.stscut + '</div>' +
			// 		'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadsewing(' + index + ')">S:' + row.stsssew + '</div>' +
			// 		'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadfinish(' + index + ')">F:' + row.stsfsew + '</div>';
			// } 
			// jasa
			if (row.stscut != '' || row.stsssew != '' || row.stsfsew != '' || row.stsjs != '') {
				return '<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadcutting(' + index + ')">C:' + row.stscut + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadsewing(' + index + ')">S:' + row.stsssew + '</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadfinish(' + index + ')">F:' + row.stsfsew + '</div>'+
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="loadjs(' + index + ')">J:' + row.stsjs + '</div>';
			} 
			else {
				// return '<span style="color:#00000061">N/A</span>';
				return '<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="">C:waiting</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="">S:waiting</div>' +
					'<div style="font-size: 12px;font-weight: 400;line-height: 16px;color:#00000061" onclick="">F:waiting</div>';
			}
		}

    <?php if ($_SESSION['gusernm'] == "pur2") { ?>

      function formatter4(value, row, index) {
        // return '<div class="tooltip" style="cursor:pointer;">' + value + '<div class="tooltiptext">' +
        //       '<a href="javascript:void(0);" onclick="detail('+row.ordpk+');" oncontextmenu="detail3('+row.ordpk+');" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;View order details</a>' +
        // 	  '<hr style="height:1px; background-color:#D9D9D9; color:#D9D9D9; border:none;">' + 
        // 	  '<a href="javascript:void(0);" onclick="report('+row.ordpk+');" oncontextmenu="report3('+row.ordpk+');" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;Input Traceability</a>' + 
        // 	  '</div></div>';
        return '<button id="button-action" type="button" class="btn dropdown-toggle-custom pt-0" data-bs-toggle="dropdown"><img src="css/images/More.png" height="24px" width="24px"></button>' +
          '<ul id="dropdown-menu-action' + index + '" class="dropdown-menu pt-1 pb-1">' +
          '<li><a class="dropdown-item" href="javascript:void(0);" onclick="detail(' + row.ordpk + ');" oncontextmenu="detail3(' + row.ordpk + ');">View order details</a></li>' +
          '<li><hr class="dropdown-divider mt-1 mb-1"></li>' +
          '<li><a class="dropdown-item" href="javascript:void(0);" onclick="report(' + row.ordpk + ');" oncontextmenu="report3(' + row.ordpk + ');">Input Traceability</a></li>' +
          '</ul>'
      }
    <?php } else { ?>

      function formatter4(value, row, index) {
        // return '<div class="tooltip" style="cursor:pointer;">' + value + '<div class="tooltiptext">' +
        //       '<a href="javascript:void(0);" onclick="detail('+row.ordpk+');" oncontextmenu="detail3('+row.ordpk+');" style="padding:5px;text-decoration:none;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;">&ensp;&ensp;View order details</a>' +
        //       '</div></div>';

        return '<button id="button-action" type="button" class="btn dropdown-toggle-custom pt-0" data-bs-toggle="dropdown"><img src="css/images/More.png" height="24px" width="24px"></button>' +
          '<ul id="dropdown-menu-action' + index + '" class="dropdown-menu pt-1 pb-1">' +
          '<li><a class="dropdown-item" href="javascript:void(0);" onclick="detail(' + row.ordpk + ');" oncontextmenu="detail3(' + row.ordpk + ');">View order details</a></li>' +
          '<li><hr class="dropdown-divider mt-1 mb-1"></li>' +
          '<li><a class="dropdown-item" href="javascript:void(0);" onclick="exp(' + row.ordpk + ')">Export excel</a></li>' +
          '</ul>'
      }
    <?php } ?>

    function styler1(index, row) {
      return 'border-top:1px solid #ededed;border-bottom:3px solid #ededed;border-left:1px solid #ededed;border-top-left-radius:5px;' +
        'border-bottom-left-radius:5px;height:75px;';
    }

    function styler2(index, row) {
      return 'border-top:1px solid #ededed;border-bottom:3px solid #ededed;';
    }

    function styler3(index, row) {
      return 'border-top:1px solid #ededed;border-bottom:3px solid #ededed;border-right:1px solid #ededed;border-top-right-radius:5px;' +
        'border-bottom-right-radius:5px;';
    }

    function styler4(index, row) {
      return 'color:#359DD9;';
    }

    function myFunction1x() {
      document.getElementById("myDropdown1x").classList.toggle("show");
    }

    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn1x')) {
        var dropdowns = document.getElementsByClassName("dropdown1-content1x");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }

    function report(ordpk) {
      window.location.href = "?hal=report&ord=" + ordpk;
    }

    function report3(ordpk) {
      url = "?hal=report&ord=" + ordpk;
      window.open(url);
      //window.location.href="?hal=qty&ord=" +row.ordpk;
    }

    function expordlist() {
			$('#dialog-formo').dialog('open').dialog('setTitle', '');
		}

		function ordlist() {
			// var cek = $('input[name="cek"]:checked').attr("value");
			var thn = $('#expthn2').val();
			// alert(cek);
			url = "excel/excel_ord?thn=" + thn + "&fu=<?php echo $_SESSION['fu']; ?>";
			window.open(url);
		}

    function canexp2() {
			$('#dialog-formo').dialog('close');
			// $('#formo').form('reset');
		}

    function settingTableHeight(length) {
      // if (length <= 5) {
      //   console.log("here data 100");
      //   $('#dg').datagrid({
      //     height: '500px',
      //     LoadMsg:''
      //   });
      // } 
      // else {
      //   console.log("here auto");
      //   $('#dg').datagrid({
      //     height: 'auto',
      //     LoadMsg:''
      //   });
      // }
      if (length <= 6) {
        console.log("here <= 6");
        $('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', '500px');
        //$('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', windowHeight);
      } else {
        console.log("here auto");
        $('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', 'auto');
        //$('#dg').datagrid('getPanel').find('div.datagrid-view2').css('height', 'auto');
      }
    }


    $(function() {
      // $('#dg').datagrid({
      //   onLoadSuccess: function (data) {
      //     var tcount = JSON.stringify($('#dg2').datagrid('getData').total);
      //     console.log("data total dg2 : " + tcount);

      //     settingTableHeight(tcount)
      //   },
      // })

      // $('#dg').datagrid({
      //   onLoadSuccess: function (data) {
      //     // console.log("onloadsuccess data dg : " + JSON.stringify(data));

      //     for (var i = 0; i < data.total; i++) {
      //       $('#button-action-' + i).click(function (e) {
      //         e.stopPropagation();
      //       });
      //       $('#dropdown-menu-action-' + i).click(function (e) {
      //         e.stopPropagation();
      //       });
      //     }
      //   }
      // })
    })

    function tnew() {

    }

    function exp(ordpk) {
      document.getElementById("ordpkexp").value = ordpk;
      $.ajax({
        type: "POST",
        url: "view/get_ordno.php",
        data: "ord=" + ordpk,
        success: function(data) {
          let text = data;
          const arr = text.split(",");
          var ordno = arr[0];
          var filenm = arr[1];
          document.getElementById('ordnoexp').innerHTML = ordno;
        },
      });
      $('#dialog-formb').dialog('open').dialog('setTitle', '');
    }

		function expord() {
			$('#dialog-formc').dialog('open').dialog('setTitle', '');
		}

    function canexp() {
      $('#dialog-form').dialog('close');
      $('#form').form('reset');

      $('#dialog-formb').dialog('close');
      $('#formb').form('reset');

      $('#dialog-formc').dialog('close');
      $('#formc').form('reset');
    }

		function exp2() {
			var cek = $('input[name="cek"]:checked').attr("value");
			var ord = $('#ordpkexp').val();
			// alert(cek);
			if (cek == 1) {
				url = "excel/excel_rkb2?cari=ALL&ord=" + ord;
				// url = "http://192.168.0.11/RKB/excel/excel_rkb?cari=ALL&ord=" + ord;
				window.open(url);
			} else {
				url = "excel/excel_op2?ord=" + ord;
				window.open(url);
			}
		}

		function exp2b() {
			var ord = $('#ordpkexp2').val();
			var bln = $('#expbln').val();
			var thn = $('#expthn').val();
      var byr = $('#cari2').val();
			// alert(cek);
			url = "excel/excel_outord?ord=" + ord + "&bln=" + bln + "&thn=" + thn + "&fu=<?php echo $_SESSION['fu']; ?>&byr="+byr;
			window.open(url);
		}

    function attrStage(value, row, index) {
      var stagenm = row.samplenm ?? row.stagenm ?? undefined;
      var srno = row.srno ? `SR ${row.srno}` : undefined;

      var stage = `<div class="d-flex flex-column">`;
      if (srno) stage += `<span>${srno}</span>`;
      if (stagenm) stage += `<span>${stagenm}</span>`;
      stage += `</div>`;

      return stage;
    }
  </script>
</head>

<body style="font-family: Inter, sans-serif !important;">
  <input type="hidden" name="test1" id="test1">
  <input type="hidden" name="test2" id="test2">
  <input type="hidden" name="total" id="total" value="0" size="5">
  <div class="contenta">
    <div id="frame-utama-cari" style="width:825px;">
      <div id="container-cari">
        <div id="frame-cari">
          <img src="css/images/Shape.png" width="18px" height="18px">
          <input id="cari1" placeholder="Search..." class="input" plain="true" value="<?php echo $_GET['c1']; ?>" onkeyup="Search();">
        </div>
      </div>
      <!-- <input style="margin-top:-2px;margin-left:0px;" type="button" name="submit" id="upld" value="Export"
        class="button-submit-add" onclick="ordlist();"> -->
      <!-- <div class="dropdown1x" style="left:5px;">
				<button class="dropbtn1x" id="act" onclick="myFunction1x()"
					style="display:none;padding:5px;color:#FFFFFF;background-color:#000000;border-radius:8px;cursor:pointer">Export
					&#9660;</button>
				<div id="myDropdown1x" class="dropdown1-content1x">
					<a href="Javascript:void(0);" onclick="costing();">Bulk upload costing data</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="dcost();">Download costing template</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="add();">Add order</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="update2();">Upload multiple breakdown</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="ordlist();">Export Order List</a>
					<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
					<a href="javascript:void(0);" onclick="expord();">Export Outstanding Order</a>
				</div>
			</div> -->

      <div class="dropdown1x" style="left:0px;">
        <button class="dropbtn1x" id="act" onclick="myFunction1x()"
          style="padding:5px;color:#FFFFFF;background-color:#000000;border-radius:8px;cursor:pointer">Action &#9660;</button>
        <div id="myDropdown1x" class="dropdown1-content1x">
          <a href="javascript:void(0);" onclick="expordlist();">Export Order List</a>
          <hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
          <a href="javascript:void(0);" onclick="expord();">Export Outstanding Order</a>
        </div>
      </div>
      <input style="width:140px; height:28px;" id="cari7" name="cari7" class="easyui-combobox" value="<?php echo $_GET['c7']; ?>"
        data-options="valueField:'fupk',textField:'funm',url:'view/get_data.php?dt=fu',prompt:'MD',onChange:Search,limitToList:'true'">
      <input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox" value="<?php echo $_GET['c2']; ?>"
        data-options="valueField:'byrpk',textField:'byrnm',prompt:'Buyer',onChange:Search,limitToList:'true'">
      <input style="width:140px; height:28px;" id="cari3" class="easyui-combobox" value="<?php echo $_GET['c3']; ?>"
        data-options="valueField:'season',textField:'season',prompt:'Season',onChange:Search,limitToList:'true'">
      <!-- <select class="easyui-combobox" id="cari3" name="cari3" data-options=" prompt:'Season', editable:false, panelHeight:'auto',onChange:Search" style="width:85px;">
			<option></option>		
      <option value="All">All</option>
				<option value="Spring">Spring</option>
				<option value="Summer">Summer</option>
				<option value="Fall">Fall</option>
				<option value="Winter">Winter</option>
			</select> -->

      <select class="easyui-combobox" id="cari8" data-options="editable:false, panelHeight:'auto',onChange:Search"
        style="width:100px;">
        <?php
        if ($_GET['c8'] > 0) {
        ?>
          <option value="<?php echo $_GET['c8']; ?>"><?php echo $_GET['c8']; ?></option>
        <?php } ?>
        <?php
        for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
        ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php } ?>
      </select>
    </div>


    <div id="frame-filter">
      <div id="frame-filter-fields">
        <div class="fields"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();"
            style="text-decoration:none; color: #AFAFAF;">Fields</a></div>
        <div class="all"><a href="javascript:void(0)" onclick="myFunction1c(); testku2();"
            style="text-decoration:none; color: #000000;">All</a></div>
        <div id="panah2">
          <div class="dropdown1">
            <input onclick="myFunction1c(); testku2();" type="image" src="css/images/Polygon.png" class="dropbtn1"
              style="filter:brightness(0%);" alt="Submit button" width="10px" height="10px">
            <div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:450px;">
              <div class="content-search2">
                <div id="frame-cari2">
                  <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
                  <input id="cari6" placeholder="Search..." class="input" onkeyup="filterFunction();">
                </div>
              </div>
              <div style="margin-top:50px;margin-left:-5px;display: inline-block; text-align: left;">
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div><b>Select All</b></div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="all"
                      value="all" id="chek0"
                      onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka7(); cheka7b(); cheka8(); cheka9(); cheka10(); cheka11();"
                      checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Order No</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="ordno" id="chek1" onclick="cheka1();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Buyer</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="buyer" id="chek2" onclick="cheka2();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Style</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="style" id="chek3" onclick="cheka3();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Style desc</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="prodes" id="chek4" onclick="cheka4();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Season</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="season" id="chek5" onclick="cheka5();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>MD</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="md" id="chek6" onclick="cheka6();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Qty</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="qty" id="chek7" onclick="cheka7();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Handle</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="handle" id="chek7b" onclick="cheka7b();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Cutting</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="cut" id="chek8" onclick="cheka8();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Sewing</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="sew" id="chek9" onclick="cheka9();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Finishing</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="fin" id="chek10" onclick="cheka10();" checked></div>
                </a>
                <a href="Javascript:void(0);" style="padding: 5px 16px;">
                  <div>Line</div>
                  <div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="ck"
                      value="line" id="chek11" onclick="cheka11();" checked></div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="frame-filter-newest">
        <div class="dropdwn">
          <input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button"
            class="dropbtn" style="left:80px;">
          <div id="myDropdown" class="dropdwn-content">
            <input type="hidden" id="cari4b" value="1" name="cari4">
            <div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Search2a();">Newest entry</a>
            </div>
            <input type="hidden" id="cari5b" value="1" name="cari5">
            <div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Search2b();">Oldest entry</a>
            </div>
          </div>
        </div>
        <a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
          <div id="newest" class="newest" style="left:65px;width:150px;" onclick="myFunction()">Newest entry</div>
          <div id="oldest" class="newest" style="left:65px;width:150px; display:none;" onclick="myFunction()">Oldest entry</div>
        </a>
      </div>
      <div id="frame-filter2">
        <div id="dropdown2">
          <input type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px"
            alt="Submit button" onclick="myFunction1d(); testku();">
          <div class="filter"><a href="javascript:void(0);" onclick="myFunction1d(); testku();"
              style="text-decoration:none; color: #000000;">Filter</a></div>
          <div id="myDropdown3" class="dropdown2-content" style="width:220px;height:395px">
            <div class="content-search2">
              <div id="frame-cari2">
                <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button"
                  onclick="myFunction1d(); testku();">
                <input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
              </div>
            </div>
            <div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">Buyer
              <div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
                <i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;" onmouseover="expand();"
                  onmouseout="expand();"></i>
              </div>
            </div>
            <div id="tbbyr" class="tabela" onmousemove="totrec();"
              style="width:200px;height:auto;border:0px solid;margin-top:0px;margin-left:5px;">
              <table id="byr" class="easyui-datagrid" idField="byrpk" title="" style="width:100%;height:auto;"
                align="center" url="view/get_data2.php?dt=byr2" toolbar="#tb" striped="false" multiple="true"
                collapsible="true" fitColumns="false" method="post" data-options="border:false,loadMsg:''">
                <thead>
                  <tr>
                    <th field="byrnm2" width="160" sortable="false"></th>
                    <th field="ck" checkbox="true" width="50"></th>
                  </tr>
                </thead>
              </table>
            </div>

            <div id="byr1a" class="prodesa" style="margin-top:0px;margin-left:15px;">
              <hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
              Style desc
              <div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
                <i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;" onmouseover="expand();"
                  onmouseout="expand();"></i>
              </div>
            </div>
            <div id="tbprodes" class="tabelb" onmousemove="totrec();"
              style="width:200px;height:auto;margin-top:0px;margin-left:5px;">
              <table id="prodes" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
                url="view/get_data2.php?dt=prodes2" toolbar="" idField="ordpk" striped="false" multiple="true"
                collapsible="true" fitColumns="false" method="post" data-options="border:false,loadMsg:''">
                <thead>
                  <tr>
                    <th field="prodes2" width="160" sortable="false"></th>
                    <th field="ck" checkbox="true" width="50"></th>
                  </tr>
                </thead>
              </table>
            </div>

            <div id="byr1a" class="seasona" style="margin-top:0px;margin-left:15px;;">
              <hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
              Season
              <div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img3">
                <i class="bi bi-eye-slash-fill" id="togglePassword2c" style="cursor: pointer;" onmouseover="expand();"
                  onmouseout="expand();"></i>
              </div>
            </div>
            <div id="tbseason" class="tabelc" onmousemove="totrec();"
              style="width:200px;height:auto;margin-top:0px;margin-left:5px;">
              <table id="season" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
                url="view/get_data2.php?dt=season2" toolbar="#tb" idField="ordpk" striped="false" multiple="true"
                collapsible="true" fitColumns="false" method="post" data-options="border:false,loadMsg:''">
                <thead>
                  <tr>
                    <th field="season2" width="160" sortable="false"></th>
                    <th field="ck" checkbox="true" width="50"></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%;">
			<div id="fltr1"
				style="margin-top:-35px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			</div>
			<div id="fltr2"
				style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
			</div>
			<div id="fltr3"
				style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;display:none;"
				onclick="reset();">
				<a href="javascript:void(0)" style="text-decoration:none; color: #359DD9;">Reset All</a>
			</div>
			<div style="margin-left:150px;margin-top:-20px;">
				<!--<div style="width:20px; height:auto;" id="cross" class="cross" value="<?php //echo $i; 
																							?>" onclick="uncek(<?php //echo $i; 
																												?>);">
&nbsp;&#215;&nbsp;
</div>-->
				<!--A-->
				<?php for ($i = 0; $i <= 1; $i++) { ?>
					<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" readonly>
					<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
					<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross"
						onclick="uncekbyr2(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
				<?php } ?>
				<!--B-->
				<?php for ($j = 0; $j <= 1; $j++) { ?>
					<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" readonly>
					<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
					<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross"
						onclick="uncekprodes2(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
				<?php } ?>
				<!--C-->
				<?php for ($k = 0; $k <= 1; $k++) { ?>
					<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" readonly>
					<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
					<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross"
						onclick="uncekseason2(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
					<input type="hidden" name="tall" id="tallc<?php echo $k; ?>" value="0" size="5">
				<?php } ?>
				<!--<input type="button" id="filter1" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross1" class="cross" onclick="UnSearchsupp(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter2" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross2" class="cross" onclick="UnSearchcolor(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter3" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross3" class="cross" onclick="UnSearchspec(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>-->
			</div>
		</div>

    <div class="d-none">
      <table id="dg2" class="easyui-datagrid" title="" style="width:100%;height:auto" align="center"
        url="view/get_dford.php"
        toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]" method="post"
        data-options="loadMsg:'',singleSelect:false,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,border:false,autoRowHeight:true">
      </table>
    </div>

    <div id="tabel1" onclick="" ondblclick="">
      <!-- <table id="dg" class="easyui-datagrid" title="" style="width:100%;height:440px;" align="center"
url="view/get_dford.php" toolbar="#tb" striped="true" pageSize="100" pageList="[100,200,300,500]"
pagination="true" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="false" method="post"
data-options="multiSort:true,remoteSort:false">
<thead>
<tr>
<th field="ordno" width="120" sortable="true">Order no</th>
<th field="byrnm" width="125" sortable="true">Buyer</th>
<th field="artno" width="120" sortable="true">Style</th>
<th field="prodes" width="170" sortable="true">Product Description</th>
<th field="season" width="85" sortable="true">Season</th>
<th field="stage" width="90" sortable="true">Stage</th>
<th field="funm" width="80" sortable="false">MD</th>
<th field="qty" width="80" sortable="true">Qty</th>
<th field="user" width="80" sortable="false">Handle</th>
<th field="cut" width="90" sortable="true">Cutting</th>
<th field="ssew" width="90" sortable="true">Sewing</th>
<th field="fsew" width="90" sortable="true">Finishing</th>
<th field="linnm" width="90" sortable="true">Line</th>
</tr>
</thead>
</table> -->
      <table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
        url="view/get_dford.php"
        toolbar="#tb" striped="false" pageSize="50" pageList="[50,100,150,200]" method="post"
        data-options="singleSelect:false,pagination:true,collapsible:true,rownumbers:false,fitColumns:true,border:false,autoRowHeight:true">
        <thead>
          <tr>
            <th field="ordinf" width="170" styler="styler1" formatter="formatter1">Order information</th>
            <th field="ordno" width="90" styler="styler2" sortable="true">Order no.</th>
            <th field="pono" width="90" styler="styler2" sortable="true" formatter="formatterpo">PO no.</th>
            <th field="stage" width="90" styler="styler2" sortable="true">Stage</th>
            <th field="prodes" width="200" styler="styler2" sortable="true">Style description</th>
            <th field="fob" width="85" styler="styler2"
              <?php if ($_SESSION['gusernm'] == "wh1" || $_SESSION['gusernm'] == "ppic" || $_SESSION['gusernm'] == "pur2") { ?>
              hidden="true"
              <?php } ?>>FOB (Costing)</th>
            <th field="qty" width="85" styler="styler2">Qty</th>
            <!-- <th field="packed" width="75" styler="styler2">Total Output</th> -->
            <th field="deldate2" width="100" styler="styler2"> Delivery date</th>
            <th field="stagenm" width="100" styler="styler2" formatter="attrStage" align="center">Sample</th>
            <th field="smv" width="100" styler="styler2" align="center">SMV</th>
            <th field="funm" width="85" styler="styler2">MD</th>
            <th field="linnm" width="175" styler="styler2" formatter="formatter2" align="center">Line information</th>
            <th field="mat" width="100" styler="styler2" formatter="formatter3">Materials</th>
            <th field="status" width="85" styler="styler2">Status</th>
            <th field="act" width="55" styler="styler3" formatter="formatter4" align="center">Act</th>
          </tr>
        </thead>
      </table>
      <br>
    </div>
  </div>

  <!--MENU-->
  <div class="header" id="myHeader" style="display:none;" onclick="">
    <div class="detail"><a href="javascript:void(0)" plain="true" onclick="detail();" oncontextmenu="detail3();"
        title="if right click automatically new tab" class="easyui-tooltip"
        style="color: #FFFFFF; text-decoration: none;"> View Details </a></div>
    <div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true"
        onclick="$('#myHeader').hide(); $('#dg').datagrid('clearSelections');"
        style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
  </div>

  <div id="dialog-formcut" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
    data-options="border:false,title:false,closable:false,resizable:false,modal:true"
    style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
    <form id="formcut" method="post">
      <input type="hidden" name="ordpkcut" id="ordpkcut" value="">
      <div class="modal-content">
        <div id="close" style="margin-top:10px; margin-left:95%;">
          <a id="close" href="javascript:void(0)"
            style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
            onclick="$('#dialog-formcut').dialog('close'); $('#formcut').form('reset');">X</a>
        </div>
        <div
          style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
          Material arrival records</div>
        <div id="opcut"
          style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
        </div>
        <div id="tabelcut" style="margin-top:15px;margin-left: 10px;">
          <table id="dgcut" class="easyui-datagrid" title="" style="width:98%;height:515px;" align="center"
            url="view/get_dtcut.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
            pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
            method="post" data-options="multiSort:true,remoteSort:false">
            <thead>
              <tr>
                <th field="pono" width="80">PO</th>
                <th field="item" width="120">Item</th>
                <th field="spec" width="120">Description</th>
                <th field="supnm" width="120">Supplier</th>
                <th field="colname" width="80">Color</th>
                <!-- <th field="price" width="90">Price</th> -->
                <th field="pocons" width="90" styler="styler4">Quantity</th>
                <th field="qtydtg" width="90">Arrival qty</th>
                <th field="balance" width="90">Balance</th>
                <th field="etd" width="90">Supplier ETD</th>
                <th field="eta" width="90">ETA</th>
                <th field="eih" width="90">EIH</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </form>
  </div>

  <div id="dialog-formsew" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
    data-options="border:false,title:false,closable:false,resizable:false,modal:true"
    style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
    <form id="formsew" method="post">
      <input type="hidden" name="ordpksew" id="ordpksew" value="">
      <div class="modal-content">
        <div id="close" style="margin-top:10px; margin-left:95%;">
          <a id="close" href="javascript:void(0)"
            style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
            onclick="$('#dialog-formsew').dialog('close'); $('#formsew').form('reset');">X</a>
        </div>
        <div
          style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
          Material arrival records</div>
        <div id="opsew"
          style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
        </div>
        <div id="tabelsew" style="margin-top:15px;margin-left: 10px;">
          <table id="dgsew" class="easyui-datagrid" title="" style="width:98%;height:515px;;" align="center"
            url="view/get_dtsew.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
            pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
            method="post" data-options="multiSort:true,remoteSort:false">
            <thead>
              <tr>
                <th field="pono" width="80">PO</th>
                <th field="item" width="120">Item</th>
                <th field="spec" width="120">Description</th>
                <th field="supnm" width="120">Supplier</th>
                <th field="colname" width="80">Color</th>
                <!-- <th field="price" width="90">Price</th> -->
                <th field="pocons" width="90" styler="styler4">Quantity</th>
                <th field="qtydtg" width="90">Arrival qty</th>
                <th field="balance" width="90">Balance</th>
                <th field="etd" width="90">Supplier ETD</th>
                <th field="eta" width="90">ETA</th>
                <th field="eih" width="90">EIH</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </form>
  </div>

  <div id="dialog-formfin" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
    data-options="border:false,title:false,closable:false,resizable:false,modal:true"
    style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
    <form id="formfin" method="post">
      <input type="hidden" name="ordpkfin" id="ordpkfin" value="">
      <div class="modal-content">
        <div id="close" style="margin-top:10px; margin-left:95%;">
          <a id="close" href="javascript:void(0)"
            style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
            onclick="$('#dialog-formfin').dialog('close'); $('#formfin').form('reset');">X</a>
        </div>
        <div
          style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
          Material arrival records</div>
        <div id="opfin"
          style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
        </div>
        <div id="tabelfin" style="margin-top:15px;margin-left: 10px;">
          <table id="dgfin" class="easyui-datagrid" title="" style="width:98%;height:515px;" align="center"
            url="view/get_dtfin.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
            pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
            method="post" data-options="multiSort:true,remoteSort:false">
            <thead>
              <tr>
                <th field="pono" width="80">PO</th>
                <th field="item" width="120">Item</th>
                <th field="spec" width="120">Description</th>
                <th field="supnm" width="120">Supplier</th>
                <th field="colname" width="80">Color</th>
                <!-- <th field="price" width="90">Price</th> -->
                <th field="pocons" width="90" styler="styler4">Quantity</th>
                <th field="qtydtg" width="90">Arrival qty</th>
                <th field="balance" width="90">Balance</th>
                <th field="etd" width="90">Supplier ETD</th>
                <th field="eta" width="90">ETA</th>
                <th field="eih" width="90">EIH</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </form>
  </div>

  	<!-- //jasa -->
	<div id="dialog-formjs" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,closable:false,resizable:false,modal:true"
		style="width:90%;height:100%;display:none;top:0px;border-radius:8px;">
		<form id="formjs" method="post">
			<input type="hidden" name="ordpkjs" id="ordpkjs" value="">
			<div class="modal-content">
				<div id="close" style="margin-top:10px; margin-left:95%;">
					<a id="close" href="javascript:void(0)"
						style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
						onclick="$('#dialog-formjs').dialog('close'); $('#formjs').form('reset');">X</a>
				</div>
				<div
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
					Material arrival records</div>
				<div id="opfin"
					style="margin-left:15px;font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">
				</div>
				<div id="tabeljs" style="margin-top:15px;margin-left: 10px;">
					<table id="dgjs" class="easyui-datagrid" title="" style="width:98%;height:515px;" align="center"
						url="view/get_dtjs.php" toolbar="#tb" striped="false" pageSize="100" pageList="[100,200,300,500]"
						pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true"
						method="post" data-options="multiSort:true,remoteSort:false">
						<thead>
							<tr>
								<th field="pono" width="80">PO</th>
								<th field="item" width="120">Item</th>
								<th field="spec" width="120">Description</th>
								<th field="supnm" width="120">Supplier</th>
								<th field="colname" width="80">Color</th>
								<!-- <th field="price" width="90">Price</th> -->
								<th field="pocons" width="90" styler="styler4">Quantity</th>
								<th field="qtydtg" width="90">Arrival qty</th>
								<th field="balance" width="90">Balance</th>
								<th field="etd" width="90">Supplier ETD</th>
								<th field="eta" width="90">ETA</th>
								<th field="eih" width="90">EIH</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</form>
	</div>

  <div id="dialog-forminfo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
    data-options="border:false,title:false,resizable:false,modal:true,closable:false"
    style="width:30%;height:47%;padding:5px 5px;display:none;top:0px;border-radius:8px;">
    <form id="forminfo" method="post">
      <!-- <div class="modal-content"> -->
      <div id="close" style="margin-top:0px; margin-left:90%;">
        <a id="close" href="javascript:void(0)"
          style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
          onclick="$('#dialog-forminfo').dialog('close'); $('#forminfo').form('reset');"> X</a>
      </div>
      <input type="hidden" id="ponoi" name="ponoi">
      <input type="hidden" id="rkbpki" name="rkbpki">
      <div
        style="margin-top:-25px;margin-left: 15px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;color: rgba(0, 0, 0, 0.6);">
        Arrival date record</div><br>
      <div id="tbinf" style="margin-left:15px;">
        <table id="dginf" class="easyui-datagrid" title="" style="width:92%;height:180px;" align="center"
          toolbar="#tb2" striped="false" border="true" pageSize="100" pageList="[100,200,300,500]" pagination="false"
          rownumbers="false" singleSelect="true" collapsible="true" fitColumns="true" data-options="multiSort:false">
          <thead>
            <tr>
              <th field="vassalnm" width="100" formatter="formatter2b">Shipment</th>
              <th field="tgldtg" width="99">Date</th>
              <th field="qtydtg" width="120">Amount</th>
              <th field="popk" width="120" hidden="true">Popk</th>
              <th field="importpk" width="120" hidden="true">importpk</th>
            </tr>
          </thead>
        </table>
      </div>
      <span
        style="margin-left: 15px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"
        id="qtyinfo"></span>
      <!-- </div> -->
    </form>
  </div>

  <!--Shipment detail -->
  <div id="dialog-enroute2" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
    data-options="border:false,title:false,resizable:false,modal:true,closable:false"
    style="width:90%;height:100%;padding:5px 5px;display:none;top:0px;border-radius:8px;">
    <div id="close" style="margin-top:5px; margin-left:95%;">
      <a id="close" href="javascript:void(0)"
        style="font-weight:normal; text-decoration:none; color:#000; font-size:20px;"
        onclick="$('#dialog-enroute2').dialog('close');"> X</a>
    </div>
    <div id="shipdetail2" style="margin-top:-15px;">
      <div class="ShipmentDetails"
        style="margin-top:15px;margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">
        Shipment details</div>
      <table border="0" style="width:90%;margin-left:15px;">
        <tr>
          <th width="150" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              Vassal type</div>
          </th>
          <th width="200" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              Vassal name</div>
          </th>
          <th width="200" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              AirwayBill Number</div>
          </th>
          <th width="200" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              Arrival city</div>
          </th>
          <th width="200" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              Port name</div>
          </th>
        </tr>
        <tr>
          <td align="left"><input type="text" name="typenm2" id="typenm2" style="border:none;" readonly></td>
          <td align="left"><input type="text" name="vassalnm2" id="vassalnm2" style="width: 200px;border:none;"
              readonly></td>
          <td align="left"><input type="text" name="bill2" id="bill2" style="width: 200px;border:none;" readonly></td>
          <td align="left"><input type="text" name="arrival2" id="arrival2" style="border:none;" readonly></td>
          <td align="left"><input type="text" name="port2" id="port2" style="border:none;" readonly></td>
        </tr>
      </table>
      <br>
      <div class="ItemDetails"
        style="margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word">
        Item details</div>
      <table border="0" style="margin-left:15px;">
        <tr>
          <th width="150" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              Gross weight</div>
          </th>
          <th width="250" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              Dimension of boxes</div>
          </th>
          <th width="250" align="left">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word">
              Total Package</div>
          </th>
        </tr>
        <tr>
          <td align="left"><input type="text" name="gw2" id="gw2" style="border:none;" readonly></td>
          <td align="left">(P)<input type="text" name="dp2" id="dp2" style="width: 35px;border:none;" readonly>x
            (L)<input type="text" name="dl2" id="dl2" style="width: 35px;border:none;" readonly>x (T)<input type="text"
              name="dt2" id="dt2" style="width: 35px;border:none;" readonly>cm</td>
          <td align="left"><input type="text" name="amount2" id="amount2" style="border:none;" readonly></td>
        </tr>
      </table>
      <br>
      <div class="ItemDetails2"
        style="margin-left:15px;color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">
        Shipment dates</div>
      <table border="0" style="margin-left:15px;">
        <tr>
          <th align="left" width="150">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
              ETD</div>
          </th>
          <th align="left" width="150">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
              ETA</div>
          </th>
          <th align="left" width="150">
            <div style="color: #d3d3d3; font-size: 14px;  font-weight: 400; line-height: 18px; word-wrap: break-word;">
              EIH (Estimate in house)</div>
          </th>
        </tr>
        <tr>
          <td align="left"><input type="text" name="etd222" id="etd222" class="easyui-validatebox" style="border:none;"
              data-options="formatter:myformatter,parser:myparser" readonly></td>
          <td align="left"><input type="text" name="eta222" id="eta222" class="easyui-validatebox" style="border:none;"
              data-options="formatter:myformatter,parser:myparser" readonly></td>
          <td align="left"><input type="text" name="eih222" id="eih222" class="easyui-validatebox" style="border:none;"
              data-options="formatter:myformatter,parser:myparser" readonly></td>
        </tr>
      </table>
      <br>
      <div id="tabel2c" onclick="" onmousemove="" style="margin-top:10px;margin-left:15px;">
        <div class="ItemDetails"
          style="color: rgba(0, 0, 0, 0.60); font-size: 14px;  font-weight: 700; line-height: 18px; word-wrap: break-word;">
          Shipment Log</div>
        <table id="dg2c" class="easyui-datagrid" title="" style="width:80%;height:275px;" align="center"
          url="view/get_log_shipment.php" border="none" striped="false" idField="importdtpk"
          data-options="fitColumns:true,singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
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

  <!--export excel-->
  <div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
    data-options="border:false,title:false,resizable:true,modal:true,closable:false"
    style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
    <form id="formb" method="post" enctype="multipart/form-data">
      <input type="hidden" name="ordpk" id="ordpkexp" size="8">
      <!-- <div class="modal-dialog" style="height:175px;"> -->
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
            Export excel Order no. <span id="ordnoexp"></span> <br>
          </div>
        </div>
        <!-- Modal body -->
        <div style="padding:5px; margin-top:60px; margin-left:25px;">
          <span id="cek1"><input type="radio" name="cek" id="cek" value="1" checked>Excel RKB</span>
          <span id="cek2"><input type="radio" name="cek" id="cek" value="2">Excel OP</span>
        </div>
        <!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
        <a style="text-decoration:none; left: 169px; top: 100px;" href="javascript:void(0)"
          class="button-cancel" onclick="canexp();">Cancel</a>
        <a style="text-decoration:none; width:100px; left: 246px; top: 100px;" href="javascript:void(0)"
          class="button-submit" onclick="exp2();">Export</a>
        <!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
        <!-- </div> -->
    </form>
  </div>

	<!--outstanding-->
	<div id="dialog-formc" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="formc" method="post">
			<input type="hidden" name="ordpk" id="ordpkexp2" size="8">
			<!-- <div class="modal-dialog" style="height:175px;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Export Outstanding Order <br>
						<span style="color:red; font-style: italic; font-size:12px;line-height:16px;font-weight:400;">
							(based on month and year of shipping date in order breakdown)
						</span>
					</div>
				</div><br>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<?php
					$bln = array(
						1 => "January",
						"February",
						"March",
						"April",
						"May",
						"June",
						"July",
						"August",
						"September",
						"October",
						"November",
						"Desember"
					);
					$bln1 = date('m');
					if ($bln1 <= 9) {
						$bln2 = substr($bln1, 1, 1);
					} else {
						$bln2 = $bln1;
					}
					?>
					<select class="easyui-combobox" id="expbln"
						data-options="editable:false,limitToList:'true'" style="width:150px;">
						<option value="">All Month</option>
						<option value="<?php echo $bln1; ?>"><?php echo $bln[$bln2]; ?></option>
						<?php
						for ($bulan = 1; $bulan <= 12; $bulan++) {
						?>
							<option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
						<?php } ?>
					</select>
					<select class="easyui-combobox" id="expthn" data-options="editable:false, panelHeight:'auto'"
						style="width:85px;">
						<?php
						for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
				<a style="text-decoration:none; left: 169px; top: 150px;" href="javascript:void(0)"
					class="button-cancel" onclick="canexp();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 150px;" href="javascript:void(0)"
					class="button-submit" onclick="exp2b();">Export</a>
				<!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
				<!-- </div> -->
		</form>
	</div>
	</div>

  <div id="dialog-formo" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:20%;border-radius:8px;">
		<form id="formo" method="post">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Export Order List <br>
						<span style="color:red; font-style: italic; font-size:12px;line-height:16px;font-weight:400;">
							(based on year schedule shipping date)
						</span>
					</div>
				</div><br>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<?php
					// $bln=array(1=>"January","February","March","April","May",
					// "June","July","August","September","October",
					// "November","Desember");
					// $bln1=date('m');
					// if($bln1<=9){
					// $bln2 = substr($bln1,1,1);
					// } else {
					// $bln2 = $bln1; 
					// }
					?>
					<!-- <select class="easyui-combobox" id="expbln"
				data-options="editable:false,limitToList:'true'" style="width:150px;" >
				<option value="">All Month</option>
				<option value="<?php //echo $bln1; 
								?>"><?php //echo $bln[$bln2]; 
									?></option>
				<?php
				//for($bulan=1; $bulan<=12; $bulan++){
				?>
				<option value="<?php //echo $bulan; 
								?>"><?php //echo $bln[$bulan]; 
									?></option>
				<?php //} 
				?>
				</select> -->
					<select class="easyui-combobox" id="expthn2" data-options="editable:false, panelHeight:'auto'"
						style="width:85px;">
						<?php
						for ($i = date('Y'); $i >= date('Y') - 3; $i -= 1) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<a style="text-decoration:none; left: 169px; top: 150px;" href="javascript:void(0)"
					class="button-cancel" onclick="canexp2();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 150px;" href="javascript:void(0)"
					class="button-submit" onclick="ordlist();">Export</a>
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