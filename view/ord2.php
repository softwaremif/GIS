<html>
<head>
<link rel="stylesheet" type="text/css" media="screen" href="media/DataTables/Bootstrap-3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="media/DataTables/DataTables-1.12.1/css/dataTables.bootstrap.min.css">
<!-- <script type="text/javascript" src="media/DataTables/jQuery-3.6.0/jquery.3.6.0.min.js"></script> -->
<script type="text/javascript" src="media/DataTables/jQuery-3.6.0/jquery-3.6.0.js"></script>
<script type="text/javascript" src="media/DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="media/DataTables/DataTables-1.12.1/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tabel-data').DataTable({
            searching : false, 
            pagingType : 'full_numbers',
        });
    });
</script>
<style type="text/css">
	.table-wrapper {
        background: #fff;
        padding: 10px 25px;
        	
    }
	.table-title {
		padding-bottom: 5px;
		background: #fff;
		color: #000;
		
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    div.dataTables_length label {
       float: left;
        font-size:15px;
        font-family: "Arial";  
    }
    div.dataTables_length select {
        font-size:15px;
        font-family: "Arial";  
    }
    div.dataTables_info {
        float: left;
        font-size:15px;
        font-family: "Arial";
    }
    table.table tr th, table.table tr td {
        border-color: #f1f1f1;
		padding: 4px 11px;
		vertical-align: middle;
        font-size:16px;
        font-family: "Arial";
        color: #000;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-bordered tr th{
    border-bottom-width:1px;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #f1f1f1;
	}
	table.table-striped.table-hover tbody tr:hover {
		background-color: #359DD9;
        /* color: #FFFFFF; */
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		/* font-weight: bold; */
		color: #000;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		 color: #000;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float:right;
        margin: 0 0 5px;
        /* border:1px solid; */
        font-family: "Arial";
    }
    .pagination li a {
        border: 1px solid;
        border-color: #f1f1f1;
        font-size: 14px;
        min-width: 30px;
        min-height: 30px;
        color: #000;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #000;
        border: 1px solid;
    }
    .pagination li.active a, .pagination li.active a.page-link {
        background: #359DD9;
        color: #000;
        border: 1px solid;
    }
    .pagination li.active a:hover {
        background: #F1f1f1;
         color: #000;
         border: 1px solid;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}
	.modal form label {
		font-weight: normal;
	}
</style>
</head>
<body>
<?php
$m=$_GET['m'];
$hal=$_GET['hal'];
$cari1=$_GET['cari1'];
$cari2=$_GET['cari2'];
$cari3=$_GET['cari3'];
$desc=$_GET['desc'];
if($desc==""){ $sort="ORDER BY ord.ordpk DESC"; }
if($desc==1){ $sort=" ORDER BY ord.ordpk ASC"; }
?>
<div id="judul">Order List</div>
<div id="menu">
<div class="detail"><a href="" style="color: #FFFFFF; text-decoration: none;"> View Details </a></div>
<div class="delete"><a href="" style="color: #FFFFFF; text-decoration: none;"> Delete </a></div>
</div>
<form name="form1" id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?hal=ord2" method="get">
<div id="frame-utama-cari">    
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png"></a>
<input name="cari1" id="cari1" value="<?php echo $cari1; ?>" placeholder="Search..." class="input" onchange="this.form.submit();">
</div>
</div>
<select name="cari2" id="cari2" class="select" onchange="this.form.submit();">
<?php
if($cari2>0){
$cr1a=mysqli_query($koneksi,"select byr.byrnm, byr.byrpk
FROM byr where byr.byrpk='$cari2'");
$dt1a=mysqli_fetch_array($cr1a);   
?>
<option value="<?php echo $dt1a['byrpk']; ?>"><?php echo $dt1a['byrnm']; ?></option>
<?php } else { ?>
<option value="">Buyer</option>
<?php }  ?>
<option value=""></option>
<?php
$cr1=mysqli_query($koneksi,"select byr.byrnm, byr.byrpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.byrpk<>''
group by byr.byrpk order by byr.byrnm asc");
while($dt1=mysqli_fetch_array($cr1)){
?>
<option value="<?php echo $dt1['byrpk']; ?>"><?php echo $dt1['byrnm']; ?></option>
<?php } ?>
</select>
<select name="cari3" id="cari3" class="select" onchange="this.form.submit();">
<?php
if($cari3<>""){
?>
<option value="<?php echo $cari3; ?>"><?php echo $cari3; ?></option>
<?php } else { ?>
<option value="">Season</option>
<?php } ?>
<option value=""></option>
<?php
$cr2=mysqli_query($koneksi,"select ord.season
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.fupk='$_SESSION[fu]' and ord.season<>''
group by ord.season order by ord.season desc");
while($dt2=mysqli_fetch_array($cr2)){
?>
<option value="<?php echo $dt2['season']; ?>"><?php echo $dt2['season']; ?></option>
<?php } ?>
</select>
</div>
</form>

<div id="frame-filter">
<div id="frame-filter-fields">    
<div class="fields">Fields</div>
<div class="all">All</div> 
<img class="panah2" src="css/images/Polygon.png" style="filter:brightness(0%);"> 
</div>
<div id="frame-filter-newest">
<?php if($desc==""){ ?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?hal=ord2&desc=1">
<input type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button">
<div class="newest">Oldest</div>
</a>
<?php } if($desc==1){ ?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?hal=ord2">
<input type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button">
<div class="newest">Newest</div>
</a>
<?php } ?>
</div>
<div id="frame-filter2">
<input type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px" alt="Submit button">
<div class="filter">Filter</div>
</div>
</div>

<div id="tabel">
<form name="form1" id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?hal=ord2" method="get">
<table id="tabel-data" class="table table-hover table-bordered table-striped" style="width:100%;">
<thead>
<tr>
<th width="55">No.</th>
<th width="115">Order no</th>
<th width="156">Buyer</th>
<th width="284">Product Description</th>
<th width="115">Season</th>
<th width="85">MD</th>
<th width="115">Cutting</th>
<th width="115">Sewing</th>
<th width="115">Finishing</th>
<th width="115">Line</th>
</tr>
</thead>
<tbody>
<?php
if($cari1<>""){ 
$where = "where ord.fupk='$_SESSION[fu]' and ord.ordno like '%$cari1%' or byr.byrnm like '%$cari1%'
or ord.prodes like '%$cari1%' or ord.season like '%$cari1%'";
} else if($cari2>0 || $cari3<>""){
if($cari2>0 && $cari3<>""){
$where = "where ord.fupk='$_SESSION[fu]' and byr.byrpk='$cari2' and ord.season='$cari3'";       
} else if($cari2>0) {
$where = "where ord.fupk='$_SESSION[fu]' and byr.byrpk='$cari2'";   
} else {
$where = "where ord.fupk='$_SESSION[fu]' and ord.season='$cari3'";     
}
}else {
$where = "where ord.fupk='$_SESSION[fu]'";    
}

$result = mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.artno, ord.prodes,
ord.season, ord.buymonth, ord.deldate, ord.codate, ord.ordpk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
$where $sort ");
while($row=mysqli_fetch_array($result)){
$k++;
$sql2=mysqli_query($koneksi,"select sched.cut, sched.ssew, sched.fsew, lin.linnm
from sched
left outer join ord on ord.ordpk=sched.ordpk
left outer join lin on lin.linpk=sched.linpk
where sched.ordpk='$row[ordpk]'");
$x2=mysqli_fetch_array($sql2);
if($x2['cut']==""){ $cut="-"; } else { $cut=$x2['cut']; }
if($x2['ssew']==""){ $ssew="-"; } else { $ssew=$x2['ssew']; }
if($x2['fsew']==""){ $fsew="-"; } else { $fsew=$x2['fsew']; }
if($x2['linnm']==""){ $linnm="-"; } else { $linnm=$x2['linnm']; }
?>
<tr>
<td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?hal=ord2&m=1"><?php echo $k; ?></a></td>
<td><?php echo $row['ordno']; ?></td>
<td><?php echo $row['byrnm']; ?></td>
<td><?php echo $row['prodes']; ?></td>
<td><?php echo $row['season']; ?></td>
<td><?php echo $row['funm']; ?></td>
<td><?php echo $cut; ?></td>
<td><?php echo $ssew; ?></td>
<td><?php echo $fsew; ?></td>
<td><?php echo $linnm; ?></a></td>
<?php
}
?>
</tr>
</tbody>
</table>
</form>
</div>
</body>
</html>