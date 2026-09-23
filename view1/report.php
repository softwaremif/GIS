<html>

<head>
<style>
        #traceability {
            align-items: center;
            width: 100%;
            position: absolute;
            top: 150px;
            padding: 20px;
        }
        #T1, #T2, #T3, #T4 {
            width: 80% !important;
        }
        h3, h6 {
            margin-left: 125px;
            padding: 0;
        }
        h2, h5 {
            margin-left: 80px;
            padding: 0;
        }
        hr {
            width: 80%;
        }
        label {
            cursor: pointer;
            background-color: #fff;
            width: 112px;
            height: 34px;
            color: #000;
            border-radius: 8px;
            text-align:center;
            padding: 10px;
            font-weight: 300;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px black solid;
        }

        a {
            text-decoration:none;
        }

        .preview {
            color: #3333cc;
        }

    </style>

    <script>
        function updateFileName(displayId, inputId) {
            const fileInput = document.getElementById(inputId);
            const fileNameDisplay = document.getElementById(displayId);

            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = fileInput.files[0].name;
            } else {
                fileNameDisplay.textContent = "";
            }
        }

        function submitForm() {
            var ord = $("#ord").val();
            var treportpk = $("#treportpk").val();
            var nameT1 = $("#nameT1").val();
            var alamatT1 = $("#alamatT1").val();
            var stageT1 = $("#stageT1").val();
            var reportpk1 = $("#reportpk1").val();
            
            var nameT2 = $("#nameT2").val();
            var alamatT2 = $("#alamatT2").val();
            var stageT2 = $("#stageT2").val();
            var reportpk2 = $("#reportpk2").val();

            var nameT2_a = $("#nameT2_a").val();
            var alamatT2_a = $("#alamatT2_a").val();
            var stageT2_a = $("#stageT2_a").val();
            var reportpk2_a = $("#reportpk2_a").val();

            var nameT3 = $("#nameT3").val();
            var alamatT3 = $("#alamatT3").val();
            var stageT3 = $("#stageT3").val();
            var reportpk3 = $("#reportpk3").val();

            var nameT4 = $("#nameT4").val();
            var alamatT4 = $("#alamatT4").val();
            var stageT4 = $("#stageT4").val();
            var reportpk4 = $("#reportpk4").val();

            const formData = new FormData();
            formData.append('ord', ord);
            formData.append('treportpk', treportpk);
            formData.append('nameT1', nameT1);
            formData.append('alamatT1', alamatT1);
            formData.append('stageT1', stageT1);
            formData.append('reportpk1', reportpk1);

            formData.append('nameT2', nameT2);
            formData.append('alamatT2', alamatT2);
            formData.append('stageT2', stageT2);
            formData.append('reportpk2', reportpk2);

            formData.append('nameT2_a', nameT2_a);
            formData.append('alamatT2_a', alamatT2_a);
            formData.append('stageT2_a', stageT2_a);
            formData.append('reportpk2_a', reportpk2_a);

            formData.append('nameT3', nameT3);
            formData.append('alamatT3', alamatT3);
            formData.append('stageT3', stageT3);
            formData.append('reportpk3', reportpk3);

            formData.append('nameT4', nameT4);
            formData.append('alamatT4', alamatT4);
            formData.append('stageT4', stageT4);
            formData.append('reportpk4', reportpk4);

            for (var i = 1; i <= 5; i++) { 
                var fileInput = $("#fileDokT1_" + i)[0].files[0];
                if (fileInput) {
                    formData.append('fileT1_' + i, fileInput);
                }

                var filepkT1 = $("#filepkT1-" + i).val();
                var filenmT1 = $("#filenmT1-" + i).val();
                var poT1 = $("#poT1-" + i).val();
                formData.append('filepkT1_' + i, filepkT1);
                formData.append('filenmT1_' + i, filenmT1);
                formData.append('poT1_' + i, poT1);
            }

            for (var i = 1; i <= 5; i++) { 
                var fileInput = $("#fileDokT2_" + i)[0].files[0];
                if (fileInput) {
                    formData.append('fileT2_' + i, fileInput);
                }

                var filepkT2 = $("#filepkT2-" + i).val();
                var filenmT2 = $("#filenmT2-" + i).val();
                var poT2 = $("#poT2-" + i).val();
                formData.append('filepkT2_' + i, filepkT2);
                formData.append('filenmT2_' + i, filenmT2);
                formData.append('poT2_' + i, poT2);
            }

            for (var i = 1; i <= 5; i++) { 
                var fileInput = $("#fileDokT2_a" + i)[0].files[0];
                if (fileInput) {
                    formData.append('file2T2_a' + i, fileInput);
                }

                var filepkT2_a = $("#filepkT2_a-" + i).val();
                var filenmT2_a = $("#filenmT2_a-" + i).val();
                var poT2_a = $("#poT2_a-" + i).val();
                formData.append('filepkT2_a_' + i, filepkT2_a);
                formData.append('filenmT2_a_' + i, filenmT2_a);
                formData.append('poT2_a_' + i, poT2_a);
            }

            for (var i = 1; i <= 5; i++) { 
                var fileInput = $("#fileDokT3_" + i)[0].files[0];
                if (fileInput) {
                    formData.append('fileT3_' + i, fileInput);
                }

                var filepkT3 = $("#filepkT3-" + i).val();
                var filenmT3 = $("#filenmT3-" + i).val();
                var poT3 = $("#poT3-" + i).val();
                formData.append('filepkT3_' + i, filepkT3);
                formData.append('filenmT3_' + i, filenmT3);
                formData.append('poT3_' + i, poT3);
            }

            for (var i = 1; i <= 5; i++) { 
                var fileInput = $("#fileDokT4_" + i)[0].files[0];
                if (fileInput) {
                    formData.append('fileT4_' + i, fileInput);
                }

                var filepkT4 = $("#filepkT4-" + i).val();
                var filenmT4 = $("#filenmT4-" + i).val();
                var poT4 = $("#poT4-" + i).val();
                formData.append('filepkT4_' + i, filepkT4);
                formData.append('filenmT4_' + i, filenmT4);
                formData.append('poT4_' + i, poT4);
            }

            $.ajax({
                method: "POST",
                url: "action/simpan_traceability.php?x=insertform",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    location.reload();
                    $.messager.show({
                        title:'',
                        msg: '<div class=text-infohijau style=width:285px;>Data Berhasil Tersimpan &nbsp; &#10004; </div>', 
                        timeout:3000,
                        showType:'slide',
                        icon:'info',
                        width:300,
                        height:55,
                        style:{
                            left:0,
                            right:'',
                            top:'',
                            bottom:-document.body.scrollTop-document.documentElement.scrollTop
                        }
                    });
                },
                error: function(xhr, status, error) {
                    $('#fileformat2').css('display', 'inline-flex');
                }
            });

            return false;
        }

        function printabs () {
            url = "pdf/preview_traceability.php?ord=<?php echo $_GET["ord"]; ?>";
            window.open(url);
        }

        function getReport() {
            var selectBox = document.getElementById("nameT2");
            var selectedSupplier = selectBox.value;

            var selectTreportpk = document.getElementById("treportpk");
            var selectedTreportpk = selectTreportpk.value;
            
            $.ajax({
                type: "GET",
                url: "view/get_report.php?x=getReport",
                data: { supplier: selectedSupplier, treportpk: selectedTreportpk},
                dataType: "json",
                success: function (data) {
                    document.getElementById("alamatT2").value = data.alamat;
                    document.getElementById("stageT2").value = data.stage;
                    document.getElementById("reportpk2").value = data.reportpk;

                    console.log("INI NILAI DATA GET YAA : "+data.reportpk +data.stage);

                    var reportpk2 = data.reportpk;

                    $.ajax({
                        type: "GET",
                        url: "view/get_report.php?x=getReport1",
                        data: { reportpk2: reportpk2 },
                        dataType: "json",
                        success: function (data) {
                            document.getElementById("filenmT2-1").value = data.Filenm1;
                            document.getElementById("filepkT2-1").value = data.Filepk1;
                            document.getElementById("poT2-1").value = data.PoT1;
                            document.getElementById("file2T2-1").value = data.File2T1;
                            document.getElementById("fileNameDisplayT21").innerText = data.File2T1;

                            console.log("INI NILAI PK : "+data.Filepk1);

                            var filepk1 = data.Filepk1;

                            $.ajax({
                                type: "GET",
                                url: "view/get_report.php?x=getReport2",
                                data: { reportpk2: reportpk2, filepk1: filepk1, treportpk: selectedTreportpk},
                                dataType: "json",
                                success: function (data) {
                                    document.getElementById("filenmT2-2").value = data.Filenm2;
                                    document.getElementById("filepkT2-2").value = data.Filepk2;
                                    document.getElementById("poT2-2").value = data.PoT2;
                                    document.getElementById("file2T2-2").value = data.File2T2;
                                    document.getElementById("fileNameDisplayT22").innerText = data.File2T2;

                                    var filepk2 = data.Filepk2;

                                    $.ajax({
                                        type: "GET",
                                        url: "view/get_report.php?x=getReport3",
                                        data: { reportpk2: reportpk2, filepk1: filepk1, filepk2: filepk2, treportpk: selectedTreportpk},
                                        dataType: "json",
                                        success: function (data) {
                                            document.getElementById("filenmT2-3").value = data.Filenm3;
                                            document.getElementById("filepkT2-3").value = data.Filepk3;
                                            document.getElementById("poT2-3").value = data.PoT3;
                                            document.getElementById("file2T2-3").value = data.File2T3;
                                            document.getElementById("fileNameDisplayT23").innerText = data.File2T3;
                                            
                                            var filepk3 = data.Filepk3;

                                            $.ajax({
                                                type: "GET",
                                                url: "view/get_report.php?x=getReport4",
                                                data: { reportpk2: reportpk2, filepk1: filepk1, filepk2: filepk2, filepk3: filepk3, treportpk: selectedTreportpk },
                                                dataType: "json",
                                                success: function (data) {
                                                    document.getElementById("filenmT2-4").value = data.Filenm4;
                                                    document.getElementById("filepkT2-4").value = data.Filepk4;
                                                    document.getElementById("poT2-4").value = data.PoT4;
                                                    document.getElementById("file2T2-4").value = data.File2T4;
                                                    document.getElementById("fileNameDisplayT214").innerText = data.File2T4;

                                                    var filepk4 = data.Filepk4;

                                                    $.ajax({
                                                        type: "GET",
                                                        url: "view/get_report.php?x=getReport5",
                                                        data: { reportpk2: reportpk2, filepk1: filepk1, filepk2: filepk2, filepk3: filepk3, filepk4: filepk4, treportpk: selectedTreportpk },
                                                        dataType: "json",
                                                        success: function (data) {
                                                            document.getElementById("filenmT2-5").value = data.Filenm5;
                                                            document.getElementById("filepkT2-5").value = data.Filepk5;
                                                            document.getElementById("poT2-5").value = data.PoT5;
                                                            document.getElementById("file2T2-5").value = data.File2T5;
                                                            document.getElementById("fileNameDisplayT25").innerText = data.File2T5;
                                                        },
                                                    });
                                                },
                                            });

                                        },
                                    });
                                },
                            });
                        },
                    });  
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                    alert("Failed to fetch report data. Please try again later.");
                }
            });
            console.log("INI NILAI PILIHAN YAA : "+selectedSupplier);
        }

        $(function() {
            getReport();
        });

    </script>

    
</head>

<body>
    <div id="traceability">
        <?php
            $ordid = isset($_GET['ord']) ? $_GET['ord'] : '';
            $ord = $ordid;

            $queryData = mysqli_query($koneksi, "SELECT *, YEAR(datecreate) AS tahun FROM ord WHERE ordpk = '$ord'");
            $data = mysqli_fetch_array($queryData);

            $periode = $data['tahun'];
            $fupk = $data['fupk'];
            $byrpk = $data['byrpk'];
            $artno = $data['artno'];

            // TREPORT
            $queryCheck = mysqli_query($koneksi, "SELECT * FROM treport WHERE periode = '$periode' AND fupk = '$fupk' AND byrpk = '$byrpk' AND artno = '$artno'");
            $rowCount = mysqli_num_rows($queryCheck);
            $row = mysqli_fetch_array($queryCheck);
            $treportpk = $row['treportpk'];
            // REPORT1
            $queryCheckR1 = mysqli_query($koneksi, "SELECT * FROM report1 WHERE treportpk = '$treportpk'");
            $rowR1 = mysqli_fetch_array($queryCheckR1);
            // REPORT2
            $queryCheckR2 = mysqli_query($koneksi, "SELECT * FROM report2 WHERE treportpk = '$treportpk' AND trader = 0");
            $rowR2 = mysqli_fetch_array($queryCheckR2);

            $queryCheckR2_a = mysqli_query($koneksi, "SELECT * FROM report2 WHERE treportpk = '$treportpk' AND trader != 0");
            $rowR2_a = mysqli_fetch_array($queryCheckR2_a);
            // REPORT3
            $queryCheckR3 = mysqli_query($koneksi, "SELECT * FROM report3 WHERE treportpk = '$treportpk'");
            $rowR3 = mysqli_fetch_array($queryCheckR3);
            // REPORT4
            $queryCheckR4 = mysqli_query($koneksi, "SELECT * FROM report4 WHERE treportpk = '$treportpk'");
            $rowR4 = mysqli_fetch_array($queryCheckR4);
        ?>

        <!-- Keseluruhan Table Traceability -->
        <div class="container" style="display:flex; justify-content:space-between; margin-right:90px; margin-left:90px;">
            <p class="satu" style="margin-right:auto; font-weight:700; font-size:25px;">INPUT TRACEABILITY REPORT</p>
            <p class="dua" style="cursor:pointer;"><a class="preview" onclick="printabs()">Preview PDF Here</a></p>
        </div>
        <br>
        <!-- Form Traceability -->
        <form id="traceability-form" class="traceability-form" name="traceability-form" enctype="multipart/form-data">

            <!-- text Value -->
            <input value="<?php echo htmlspecialchars($ord); ?>" type="hidden" name="ord" id="ord"></td>
            <input value="<?php echo $treportpk; ?>" type="hidden" name="treportpk" id="treportpk">
                        
            <!-- Table untukT1 -->
            <h3 style="text-align:left!important;">Buyer/License vs. T1 Transaction LIST OF MATERIALS</h3>
            <h6 style="text-align:left!important; margin-top:0; margin-bottom:10px; padding:0;">Upload Dokumen maksimal 2 MB dengan format .jpg .jpeg .png</h6>
            <h6 style="text-align:left!important; margin-top:0; padding:0;"><a href="https://www.google.com/search?q=pdf+to+png&oq=pdf+to+png&gs_lcrp=EgZjaHJvbWUyDwgAEEUYORiDARixAxiABDIHCAEQABiABDIHCAIQABiABDIHCAMQABiABDIHCAQQABiABDIHCAUQABiABDIHCAYQABiABDIGCAcQBRhA0gEJMTEzNjFqMGo3qAIAsAIA&sourceid=chrome&ie=UTF-8">(?) Bantuan convert PDF ke Gambar (JPG, JPEG, PNG)</a></h6>
            <table id="T1" name="T1">
                <input value="<?php echo $rowR1['reportpk']; ?>" type="hidden" name="reportpk1" id="reportpk1">
                <tr>
                    <td style="width:150px;">Supplier</td>
                    <td><input value="PT Morich Indo Fashion (MIF)" readonly id="nameT1" name="nameT1" type="text" placeholder="Masukkan Nama Supplier" class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input value="Jalan Raya Karangjati KM.25, Kec.Bergas" readonly id="alamatT1" name="alamatT1" type="text" multiline="true" class="easyui-textbox" style="width: 394px; height: 100px;">
                    </td>
                </tr>
                <tr>
                    <td>Involved Stage</td>
                    <td><input value="<?php echo $rowR1['stage']; ?>" id="stageT1" name="stageT1" type="text" placeholder="Masukkan Stage.." class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr style="padding-top: 100px;">
                    <td>Dokumen</td>
                    <td>
                        <table id="fileTable">
                            <?php
                                $queryFile1_a = mysqli_query($koneksi, "SELECT * FROM file1 WHERE reportpk = '$rowR1[reportpk]' AND filenm LIKE '%BOM%' LIMIT 5");
                                $rowFile1_a = mysqli_num_rows($queryFile1_a);
                            ?>
                            <?php if ($rowFile1_a > 0) {
                                $File1_a = mysqli_fetch_array($queryFile1_a);
                            ?>
                                <tr>
                                    <td>
                                        <input class="easyui-validatebox" type="hidden" value="<?php echo $File1_a['filepk']; ?>" style="width: 50px; height: 34px;" name="filepkT1-1" id="filepkT1-1">
                                        <input class="easyui-validatebox" type="text" value="BOM" readonly style="width: 150px; height: 34px;" name="filenmT1-1" id="filenmT1-1" readonly>
                                        <input class="easyui-validatebox" type="text" value="<?php echo $File1_a['pono']; ?>" placeholder="Nomor PO" style="width: 100px; height: 34px;" name="poT1-1" id="poT1-1">
                                        <input class="easyui-validatebox" type="hidden" value="<?php echo $File1_a['file']; ?>" style="width: 100px; height: 34px;" name="file1T1-1" id="file1T1-1">
                                        <label for="fileDokT1_1" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                        <input id="fileDokT1_1" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT1_1', 'fileDokT1_1')">
                                        <span id="fileNameDisplayT1_1"><?php echo $File1_a['file']; ?></span>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td>
                                        <input class="easyui-validatebox" type="hidden" style="width: 50px; height: 34px;" name="filepkT1-1" id="filepkT1-1">
                                        <input class="easyui-validatebox" type="text" value="BOM" readonly style="width: 150px; height: 34px;" placeholder="Nama File" name="filenmT1-1" id="filenmT1-1">
                                        <input class="easyui-validatebox" type="text" style="width: 100px; height: 34px;" placeholder="Nomor PO" name="poT1-1" id="poT1-1">
                                        <input class="easyui-validatebox" type="hidden" style="width: 100px; height: 34px;"  placeholder="Nomor PO" name="file1T1-1" id="file1T1-1">
                                        <label for="fileDokT1_1" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                        <input id="fileDokT1_1" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT1_1', 'fileDokT1_1')">
                                        <span id="fileNameDisplayT1_1"></span>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php 
                            $maxRows = 5;
                            $queryFile1 = mysqli_query($koneksi, "SELECT * FROM file1 WHERE reportpk = '$rowR1[reportpk]'  AND filenm NOT LIKE '%BOM%' LIMIT 5");
                            $rowFile1 = mysqli_num_rows($queryFile1);

                            for ($i = 2; $i <= $maxRows; $i++) {
                                if ($i <= $rowFile1) {
                                    $File1 = mysqli_fetch_array($queryFile1);
                            ?>
                            <style> 
                                #fileNameDisplayT1<?php echo $i; ?> {
                                    display: inline-block;
                                    width: 350px;
                                }
                            </style>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File1['filepk']; ?>" style="width: 50px; height: 34px;" name="filepkT1-<?php echo $i; ?>" id="filepkT1-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File1['filenm']; ?>" placeholder="Nama File" style="width: 150px; height: 34px;" name="filenmT1-<?php echo $i; ?>" id="filenmT1-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File1['pono']; ?>" placeholder="Nomor PO" style="width: 100px; height: 34px;" name="poT1-<?php echo $i; ?>" id="poT1-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File1['file']; ?>" style="width: 100px; height: 34px;" name="file1T1-<?php echo $i; ?>" id="file1T1-<?php echo $i; ?>">
                                            <label for="fileDokT1_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT1_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT1<?php echo $i; ?>', 'fileDokT1_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT1<?php echo $i; ?>"><?php echo $File1['file']; ?></span>
                                        </td>
                                    </tr>
                            <?php } else { ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" style="width: 50px; height: 34px;" name="filepkT1-<?php echo $i; ?>" id="filepkT1-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 150px; height: 34px;" placeholder="Nama File" name="filenmT1-<?php echo $i; ?>" id="filenmT1-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 100px; height: 34px;" placeholder="Nomor PO" name="poT1-<?php echo $i; ?>" id="poT1-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" style="width: 100px; height: 34px;"  placeholder="Nomor PO" name="file1T1-<?php echo $i; ?>" id="file1T1-<?php echo $i; ?>">
                                            <label for="fileDokT1_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT1_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT1<?php echo $i; ?>', 'fileDokT1_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT1<?php echo $i; ?>"></span>
                                        </td>
                                    </tr>
                            <?php }
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>

            <br><br>
            <hr>
            <br>

            <h3 style="text-align:left!important;">T1 vs. T2 Transaction LIST OF MATERIALS</h3>
            <h6 style="text-align:left!important; margin-top:0; margin-bottom:10px; padding:0;">Upload Dokumen maksimal 2 MB dengan format .jpg .jpeg .png</h6>
            <h6 style="text-align:left!important; margin-top:0; padding:0;"><a href="https://www.google.com/search?q=pdf+to+png&oq=pdf+to+png&gs_lcrp=EgZjaHJvbWUyDwgAEEUYORiDARixAxiABDIHCAEQABiABDIHCAIQABiABDIHCAMQABiABDIHCAQQABiABDIHCAUQABiABDIHCAYQABiABDIGCAcQBRhA0gEJMTEzNjFqMGo3qAIAsAIA&sourceid=chrome&ie=UTF-8">(?) Bantuan convert PDF ke Gambar (JPG, JPEG, PNG)</a></h6>
            <h5 style="text-align:left!important; margin-left:125;">SUPPLIER :</h5>
            <table style="margin-left:100px;" id="T2" name="T2">
                <input type="hidden" name="reportpk2" id="reportpk2">
                <tr>
                    <td style="width:150px;">Supplier</td>
                    <td>
                        <select onchange="getReport()" class="" name="nameT2" id="nameT2" data-options="editable:false, prompt:'Pilih Nama Supplier', limitToList:'true', panelHeight:true" style="width:394px; height:34px; border-radius:8px;">
                            <!-- <option></option> -->
                            <?php
                                $sql = mysqli_query($koneksi,
                                "SELECT ord.ordpk, ord.fupk, ord.byrpk, byr.byrnm, TRIM(ord.artno) as artno, ord.prodes, YEAR(ord.datecreate) as periode
                                FROM ord
                                LEFT OUTER JOIN byr ON ord.byrpk = byr.byrpk
                                WHERE ord.ordpk = '$ord'");
                                $dtsql = mysqli_fetch_array($sql);

                                $supplier = mysqli_query($koneksi, "SELECT TRIM(sup.supnm) AS supnm
                                FROM po
                                LEFT OUTER JOIN podt ON po.popk = podt.popk
                                LEFT OUTER JOIN sup ON po.suppk = sup.suppk
                                LEFT OUTER JOIN ord ON ord.ordpk = podt.ordpk
                                LEFT OUTER JOIN cur ON cur.curpk = podt.curpk
                                WHERE podt.kelnm = 'CUTTING' AND ord.artno LIKE '%$dtsql[artno]%' AND sup.supnm NOT LIKE '%STOCK%'
                                AND YEAR(ord.datecreate)='$dtsql[periode]' AND po.polipk = '2'
                                GROUP BY sup.supnm
                                ORDER BY sup.supnm ASC");

                            while ( $dts = mysqli_fetch_array($supplier)) {?>
                                <option value="<?php echo $dts['supnm']; ?>"><?php echo $dts['supnm']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        <textarea id="alamatT2" name="alamatT2" cols="30" rows="10" style="width: 394px; height: 100px;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Involved Stage</td>
                    <td><input value="" id="stageT2" name="stageT2" type="text" placeholder="Masukkan Stage.." class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr style="padding-top: 100px;">
                    <td>Dokumen</td>
                    <td>
                        <table id="fileTable">
                            <?php 

                            $maxRows = 5;
                            $queryFile2 = mysqli_query($koneksi, "SELECT * FROM file2 WHERE reportpk = '$_POST[reportpk2]'");
                            $rowFile2 = mysqli_num_rows($queryFile2);

                            for ($i = 1; $i <= $maxRows; $i++) {
                                if ($i <= $rowFile2) {
                                    $File2 = mysqli_fetch_array($queryFile2);
                            ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" style="width: 50px; height: 34px;" name="filepkT2-<?php echo $i; ?>" id="filepkT2-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" placeholder="Nama File" style="width: 150px; height: 34px;" name="filenmT2-<?php echo $i; ?>" id="filenmT2-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" placeholder="Nomor PO" style="width: 100px; height: 34px;" name="poT2-<?php echo $i; ?>" id="poT2-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" style="width: 100px; height: 34px;" name="file2T2-<?php echo $i; ?>" id="file2T2-<?php echo $i; ?>">
                                            <label for="fileDokT2_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT2_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT2<?php echo $i; ?>', 'fileDokT2_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT2<?php echo $i; ?>"></span>
                                        </td>
                                    </tr>
                            <?php } else { ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" style="width: 50px; height: 34px;" name="filepkT2-<?php echo $i; ?>" id="filepkT2-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 150px; height: 34px;" placeholder="Nama File" name="filenmT2-<?php echo $i; ?>" id="filenmT2-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 100px; height: 34px;" placeholder="Nomor PO" name="poT2-<?php echo $i; ?>" id="poT2-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" style="width: 100px; height: 34px;"  placeholder="Nomor PO" name="file2T2-<?php echo $i; ?>" id="file2T2-<?php echo $i; ?>">
                                            <label for="fileDokT2_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT2_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT2<?php echo $i; ?>', 'fileDokT2_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT2<?php echo $i; ?>"></span>
                                        </td>
                                    </tr>
                            <?php }
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
            <h5 style="text-align:left!important; margin-left:125;">TRADER :</h5>
            <table style="margin-left:100px;" id="T2" name="T2">
                <input value="<?php echo $rowR2_a['reportpk']; ?>" type="hidden" name="reportpk2_a" id="reportpk2_a">
                <tr>
                    <td style="width:150px;">Supplier</td>
                    <td><input value="<?php echo $rowR2_a['supnm']; ?>" id="nameT2_a" name="nameT2_a" type="text" placeholder="Masukkan Nama Supplier" class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input value="<?php echo $rowR2_a['alamat']; ?>" id="alamatT2_a" name="alamatT2_a" type="text" multiline="true" class="easyui-textbox" style="width: 394px; height: 100px;"></td>
                </tr>
                <tr>
                    <td>Involved Stage</td>
                    <td><input value="<?php echo $rowR2_a['stage']; ?>" id="stageT2_a" name="stageT2_a" type="text" placeholder="Masukkan Stage.." class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr style="padding-top: 100px;">
                    <td>Dokumen</td>
                    <td>
                        <table id="fileTable">
                            <?php 
                            $maxRows2_a = 5;
                            $queryFile2_a = mysqli_query($koneksi, "SELECT * FROM file2 WHERE reportpk = '$rowR2_a[reportpk]' LIMIT 5");
                            $rowFile2_a = mysqli_num_rows($queryFile2_a);

                            for ($i = 1; $i <= $maxRows2_a; $i++) {
                                if ($i <= $rowFile2_a) {
                                    $File2_a = mysqli_fetch_array($queryFile2_a);
                            ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File2_a['filepk']; ?>" style="width: 50px; height: 34px;" name="filepkT2_a-<?php echo $i; ?>" id="filepkT2_a-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File2_a['filenm']; ?>" placeholder="Nama File" style="width: 150px; height: 34px;" name="filenmT2_a-<?php echo $i; ?>" id="filenmT2_a-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File2_a['pono']; ?>" placeholder="Nomor PO" style="width: 100px; height: 34px;" name="poT2_a-<?php echo $i; ?>" id="poT2_a-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File2_a['file']; ?>" style="width: 100px; height: 34px;" name="file2T2_a-<?php echo $i; ?>" id="file2T2_a-<?php echo $i; ?>">
                                            <label for="fileDokT2_a<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT2_a<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT2_a<?php echo $i; ?>', 'fileDokT2_a<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT2_a<?php echo $i; ?>"><?php echo $File2_a['file']; ?></span>
                                        </td>
                                    </tr>
                            <?php } else { ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" style="width: 50px; height: 34px;" name="filepkT2_a-<?php echo $i; ?>" id="filepkT2_a-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 150px; height: 34px;" placeholder="Nama File" name="filenmT2_a-<?php echo $i; ?>" id="filenmT2_a-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 100px; height: 34px;" placeholder="Nomor PO" name="poT2_a-<?php echo $i; ?>" id="poT2_a-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" style="width: 100px; height: 34px;"  placeholder="Nomor PO" name="file2T2_a-<?php echo $i; ?>" id="file2T2_a-<?php echo $i; ?>">
                                            <label for="fileDokT2_a<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT2_a<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT2_a<?php echo $i; ?>', 'fileDokT2_a<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT2_a<?php echo $i; ?>"></span>
                                        </td>
                                    </tr>
                            <?php }
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>

            <br><br>
            <hr>
            <br>

            <h3 style="text-align:left!important;">T2 vs. T3 Transaction LIST OF MATERIALS</h3>
            <h6 style="text-align:left!important; margin-top:0; margin-bottom:10px; padding:0;">Upload Dokumen maksimal 2 MB dengan format .jpg .jpeg .png</h6>
            <h6 style="text-align:left!important; margin-top:0; padding:0;"><a href="https://www.google.com/search?q=pdf+to+png&oq=pdf+to+png&gs_lcrp=EgZjaHJvbWUyDwgAEEUYORiDARixAxiABDIHCAEQABiABDIHCAIQABiABDIHCAMQABiABDIHCAQQABiABDIHCAUQABiABDIHCAYQABiABDIGCAcQBRhA0gEJMTEzNjFqMGo3qAIAsAIA&sourceid=chrome&ie=UTF-8">(?) Bantuan convert PDF ke Gambar (JPG, JPEG, PNG)</a></h6>
            <table id="T3" name="T3">
                <input value="<?php echo $rowR3['reportpk']; ?>" type="hidden" name="reportpk3" id="reportpk3">
                <tr>
                    <td style="width:150px;">Supplier</td>
                    <td><input value="<?php echo $rowR3['supnm']; ?>" id="nameT3" name="nameT3" type="text" placeholder="Masukkan Nama Supplier" class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input value="<?php echo $rowR3['alamat']; ?>" id="alamatT3" name="alamatT3" type="text" multiline="true" class="easyui-textbox" style="width: 394px; height: 100px;">
                    </td>
                </tr>
                <tr>
                    <td>Involved Stage</td>
                    <td><input value="<?php echo $rowR3['stage']; ?>" id="stageT3" name="stageT3" type="text" placeholder="Masukkan Stage.." class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr style="padding-top: 100px;">
                    <td>Dokumen</td>
                    <td>
                        <table id="fileTable">
                            <?php 
                            $maxRows = 5;
                            $queryFile3 = mysqli_query($koneksi, "SELECT * FROM file3 WHERE reportpk = '$rowR3[reportpk]' LIMIT 5");
                            $rowFile3 = mysqli_num_rows($queryFile3);

                            for ($i = 1; $i <= $maxRows; $i++) {
                                if ($i <= $rowFile3) {
                                    $File3 = mysqli_fetch_array($queryFile3);
                            ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File3['filepk']; ?>" style="width: 50px; height: 34px;" name="filepkT3-<?php echo $i; ?>" id="filepkT3-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File3['filenm']; ?>" placeholder="Nama File" style="width: 150px; height: 34px;" name="filenmT3-<?php echo $i; ?>" id="filenmT3-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File3['pono']; ?>" placeholder="Nomor PO" style="width: 100px; height: 34px;" name="poT3-<?php echo $i; ?>" id="poT3-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File3['file']; ?>" style="width: 100px; height: 34px;" name="file3T3-<?php echo $i; ?>" id="file3T3-<?php echo $i; ?>">
                                            <label for="fileDokT3_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT3_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT3<?php echo $i; ?>', 'fileDokT3_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT3<?php echo $i; ?>"><?php echo $File3['file']; ?></span>
                                        </td>
                                    </tr>
                            <?php } else { ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" style="width: 50px; height: 34px;" name="filepkT3-<?php echo $i; ?>" id="filepkT3-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 150px; height: 34px;" placeholder="Nama File" name="filenmT3-<?php echo $i; ?>" id="filenmT3-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 100px; height: 34px;" placeholder="Nomor PO" name="poT3-<?php echo $i; ?>" id="poT3-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" style="width: 100px; height: 34px;"  placeholder="Nomor PO" name="file3T3-<?php echo $i; ?>" id="file3T3-<?php echo $i; ?>">
                                            <label for="fileDokT3_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT3_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT3<?php echo $i; ?>', 'fileDokT3_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT3<?php echo $i; ?>"></span>
                                        </td>
                                    </tr>
                            <?php }
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
            
            <br><br>
            <hr>
            <br>

            <h3 style="text-align:left!important;">T3 vs. T4 Transaction LIST OF MATERIALS</h3>
            <h6 style="text-align:left!important; margin-top:0; margin-bottom:10px; padding:0;">Upload Dokumen maksimal 2 MB dengan format .jpg .jpeg .png</h6>
            <h6 style="text-align:left!important; margin-top:0; padding:0;"><a href="https://www.google.com/search?q=pdf+to+png&oq=pdf+to+png&gs_lcrp=EgZjaHJvbWUyDwgAEEUYORiDARixAxiABDIHCAEQABiABDIHCAIQABiABDIHCAMQABiABDIHCAQQABiABDIHCAUQABiABDIHCAYQABiABDIGCAcQBRhA0gEJMTEzNjFqMGo3qAIAsAIA&sourceid=chrome&ie=UTF-8">(?) Bantuan convert PDF ke Gambar (JPG, JPEG, PNG)</a></h6>
            <table id="T4" name="T4">
                <input value="<?php echo $rowR4['reportpk']; ?>" type="hidden" name="reportpk4" id="reportpk4">
                <tr>
                    <td style="width:150px;">Supplier</td>
                    <td><input value="<?php echo $rowR4['supnm']; ?>" id="nameT4" name="nameT4" type="text" placeholder="Masukkan Nama Supplier" class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input value="<?php echo $rowR4['alamat']; ?>" id="alamatT4" name="alamatT4" type="text" multiline="true" class="easyui-textbox" style="width: 394px; height: 100px;">
                    </td>
                </tr>
                <tr>
                    <td>Involved Item</td>
                    <td><input value="<?php echo $rowR4['item']; ?>" id="stageT4" name="stageT4" type="text" placeholder="Masukkan Stage.." class="easyui-validatebox" style="width: 394px; height: 34px;"></td>
                </tr>
                <tr style="padding-top: 100px;">
                    <td>Dokumen</td>
                    <td>
                        <table id="fileTable">
                            <?php 
                            $maxRows = 5;
                            $queryFile4 = mysqli_query($koneksi, "SELECT * FROM file4 WHERE reportpk = '$rowR4[reportpk]' LIMIT 5");
                            $rowFile4 = mysqli_num_rows($queryFile4);

                            for ($i = 1; $i <= $maxRows; $i++) {
                                if ($i <= $rowFile4) {
                                    $File4 = mysqli_fetch_array($queryFile4);
                            ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File4['filepk']; ?>" style="width: 50px; height: 34px;" name="filepkT4-<?php echo $i; ?>" id="filepkT4-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File4['filenm']; ?>" placeholder="Nama File" style="width: 150px; height: 34px;" name="filenmT4-<?php echo $i; ?>" id="filenmT4-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" value="<?php echo $File4['pono']; ?>" placeholder="Nomor PO" style="width: 100px; height: 34px;" name="poT4-<?php echo $i; ?>" id="poT4-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" value="<?php echo $File4['file']; ?>" style="width: 100px; height: 34px;" name="file4T4-<?php echo $i; ?>" id="file4T4-<?php echo $i; ?>">
                                            <label for="fileDokT4_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT4_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT4<?php echo $i; ?>', 'fileDokT4_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT4<?php echo $i; ?>"><?php echo $File4['file']; ?></span>
                                        </td>
                                    </tr>
                            <?php } else { ?>
                                    <tr>
                                        <td>
                                            <input class="easyui-validatebox" type="hidden" style="width: 50px; height: 34px;" name="filepkT4-<?php echo $i; ?>" id="filepkT4-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 150px; height: 34px;" placeholder="Nama File" name="filenmT4-<?php echo $i; ?>" id="filenmT4-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="text" style="width: 100px; height: 34px;" placeholder="Nomor PO" name="poT4-<?php echo $i; ?>" id="poT4-<?php echo $i; ?>">
                                            <input class="easyui-validatebox" type="hidden" style="width: 100px; height: 34px;"  placeholder="Nomor PO" name="file4T4-<?php echo $i; ?>" id="file4T4-<?php echo $i; ?>">
                                            <label for="fileDokT4_<?php echo $i; ?>" style="cursor: pointer; background-color: #000; color: #fff; border-radius: 8px; padding: 8px; border: 1px black solid; font-size:13px;">Upload File</label>
                                            <input id="fileDokT4_<?php echo $i; ?>" type="file" style="display: none;" onchange="updateFileName('fileNameDisplayT4<?php echo $i; ?>', 'fileDokT4_<?php echo $i; ?>')">
                                            <span id="fileNameDisplayT4<?php echo $i; ?>"></span>
                                        </td>
                                    </tr>
                            <?php }
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>

            <div style="text-align: right; margin-right: 200px; margin-bottom: 20px; margin-top: 30px;">
                <button style="cursor:pointer; display: inline-flex; align-items: center; justify-content: center; background-color: #fff; width: 112px; height: 34px; color: #000; border-radius: 8px; padding: 20px; border: none; font-weight:700;">Cancel</button>
                <button style="cursor:pointer; display: inline-flex; align-items: center; justify-content: center; width: 112px; height: 34px; border-radius: 8px; padding: 20px; border: none; font-weight:500; background-color:#000; color: #fff;" id="saveButton" type="button" onclick="submitForm()" name="submit">Simpan</button>
                <div id="fileformat2" name="fileformat2" style="width:100%; display:none; inline-flex; align-items: right; justify-content: right; font-size: 11px; color: red; margin-right: 30px;">
                    <p>File maksimal 2MB dengan format .jpg .jpeg .png</p>
                </div>
            </div>

            <br><br>
        </form>
    </div>
</body>

</html>