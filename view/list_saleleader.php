<?php  
	include('top.php');
	include('../controller/bill.php');
	include("../controller/accountant.php");

	
	
	if (isset($_POST['btn_add'])) {
		
		$id_saleleader = $_POST['idkhachhang'];
		mysqli_query($conn,"INSERT INTO `ksn_sale_leader` (`id_saleleader`, `datetime`) VALUES ('$id_saleleader', '$datenow')");
		
		echo'<script> 
			alert("Thêm Sale Leader thành công!");						window.location = "list_saleleader.php?action=team";

        </script>';
		
	}if (isset($_POST['btn_add_master'])) {
		
		$id_saleleader = $_POST['idkhachhang'];
		mysqli_query($conn,"INSERT INTO `ksn_sale_master` (`id_saleleader`, `datetime`) VALUES ('$id_saleleader', '$datenow')");
		
		echo'<script> 
			alert("Thêm trưởng phòng thành công!");						window.location = "list_saleleader.php?action=teammaster";

        </script>';
		
	}if (isset($_POST['btn_addfwdcost2'])) {
		
		foreach($_POST['id_user'] as $key) {
			mysqli_query($conn,"INSERT INTO `ksn_sale_fwd` (`id_fwd`, `id_dichvu`, `cost_leader`, `cost_member`, `cost_leadermember`) VALUES ('$key', '".$_POST['id_dichvu']."', '".$_POST['cost_leader']."', '".$_POST['cost_member']."', '".$_POST['cost_leadermember']."')") or die("Loi");
			
			
			
		}
				//echo'<script> alert("Thêm Áp giá thành công!");						window.location = "list_saleleader.php?action=price_fwd_sale";</script>';	
	}
	
	
	if (isset($_POST['btn_addlinkfwd_sale'])) {
		
		$id_salemember = $_POST['id_company'];
		mysqli_query($conn,"INSERT INTO `ksn_sale_fwd_add` (`id_saleleader`, `id_fwd`,`datetime`) VALUES ('".$uid."', '".$id_salemember."','$datenow')");
		
		echo'<script> 
			alert("Thêm liên kết thành công, vui lòng đợi Admin xác nhận!");						window.location = "list_saleleader.php?action=fwdmanager";

        </script>';
				exit();

	}
	if (isset($_POST['btn_deleteapgia'])) {
		
		mysqli_query($conn,"DELETE FROM `ksn_sale_fwd` WHERE (`id`='".$_POST['delete']."')")or die(mysqli_error($conn));
		echo'<script> 
			alert("Xóa Áp giá COST cho dịch vụ riêng thành công!");

        </script>';		
		
	}
	
	
	
	if (isset($_POST['btn_active'])) {
		
		$id_saleleader = $_POST['id_saleleader'];
		$id_member = $_POST['id_member'];
		$id_add = $_POST['id_add'];
		$checktontai = mysqli_fetch_array(mysqli_query($conn,"select * from ksn_sale_leader_detail where id_saleleader='$id_saleleader' AND id_member='$id_member'"));
		
		
		if($checktontai['id_member'] != "")
		{
			
		}
		else
		{
		mysqli_query($conn,"INSERT INTO `ksn_sale_leader_detail` (`id_saleleader`, `id_member`,`datetime`) VALUES ('".$id_saleleader."', '".$id_member."','$datenow')");
		mysqli_query($conn,"UPDATE `ksn_sale_leader_detail_add` SET `check`='1' WHERE (`id`='$id_add')");
		
		echo'<script> 
			alert("Xác nhận thêm member cho leader thành công!");	

        </script>';
		}
	}if (isset($_POST['btn_active2'])) {
		
		$id_saleleader = $_POST['id_saleleader'];
		$id_member = $_POST['id_member'];
		$id_add = $_POST['id_add'];
		mysqli_query($conn,"UPDATE `ns_user` SET `idsale_service`='".$id_saleleader."' WHERE (`id`='".$id_member."')");
		mysqli_query($conn,"UPDATE `ksn_sale_fwd_add` SET `check`='1' WHERE (`id`='$id_add')");
	}
	if (isset($_POST['btn_delete_fwdsale'])) {
		

		$id_add = $_POST['id_add'];
		$checktontai = (mysqli_query($conn,"DELETE FROM `ksn_sale_fwd_add` WHERE (`id`='$id_add')"));
		
		
	}
	
	if (isset($_POST['btn_delete2'])) {
		

		$id_add = $_POST['id_add'];
		$checktontai = (mysqli_query($conn,"DELETE FROM `ksn_sale_leader_detail_add` WHERE (`id`='$id_add')"));
		
		
	}
	
	
	if (isset($_POST['btn_addlinkfwd'])) {
		
		$id_salelink = $_POST['id_salelink'];
		$id_company = $_POST['id_company'];
		mysqli_query($conn,"UPDATE `ns_user` SET `idsale_service`='$id_salelink' WHERE (`id`='$id_company')");
		
		echo'<script> 
			alert("Liên kết FWD với Sale thành công!");						window.location = "list_saleleader.php?action=fwdmanager";

        </script>';
		
	}
	if (isset($_POST['delete_linkfwd'])) {
		
		$id_company = $_POST['id_company'];
		mysqli_query($conn,"UPDATE `ns_user` SET `idsale_service`='0' WHERE (`id`='$id_company')");
		
		echo'<script> 
			alert("Liên kết FWD với Sale thành công!");						window.location = "list_saleleader.php?action=fwdmanager";

        </script>';
		
	}
	if(isset($_POST['btn_delete_leader']))	
	{
		$id_saleleadera = $_POST['idsale_leader_delete'];
		
		mysqli_query($conn,"DELETE FROM `ksn_sale_leader` WHERE (`id_saleleader`='$id_saleleadera')");
		mysqli_query($conn,"DELETE FROM `ksn_sale_leader_detail` WHERE (`id_saleleader`='$id_saleleadera')");
		echo'<script> 
			alert("Xóa thành công Leader!");					

        </script>';

	}if(isset($_POST['btn_delete_master']))	
	{
		$id_saleleadera = $_POST['idsale_master_delete'];
		
		mysqli_query($conn,"DELETE FROM `ksn_sale_master` WHERE (`id_saleleader`='$id_saleleadera')");
		mysqli_query($conn,"DELETE FROM `ksn_sale_master_detail` WHERE (`id_saleleader`='$id_saleleadera')");
		echo'<script> 
			alert("Xóa thành công trưởng phòng!");					

        </script>';

	}
	
	if (isset($_POST['btn_add2_master'])){
		
		$id_master = $_POST['id_master'];
		$id_salemember = $_POST['idkhachhang'];

			mysqli_query($conn,"INSERT INTO `ksn_sale_master_detail` (`id_saleleader`, `id_member`,`datetime`) VALUES ('".$id_master."', '".$id_salemember."','$datenow')");
		
		echo'<script> 
			alert("Thêm Sale Member cho trưởng phòng thành công!");

        </script>';

		

	}
	
?>
<link rel="stylesheet" type="text/css" href="../scan_lib/example/css/styles.css" />
<style type="text/css">
	.nopadding {
	   padding: 0 !important;
	   margin: 0 !important;
	}

</style>
<div class="container-fluid">

		
                  
				  <?php
				  
				  if(isset($_GET['select_month']))
		{
			$month=$_GET['select_month'];
		}else
		{
			$month =  date('m');
		}
		if(@$_GET['action'] == ""){

				  if(@$_GET['action'] != "team" && @$_GET['action'] != "fwdmanager" && @$_GET['action'] != "allsale" && @$_GET['action'] != "activemember" && @$_GET['action'] != "activefwd")
				  {
					  if($roleid == 1)
					  {
						  
						  					
for ($i = 0; $i <= 5; $i++) 
{
   $months[] = date("m", strtotime( date( 'Y-m-01' )." -$i months"));
   $dulieuallsale = saleformonth_all($months[$i],$conn);
   if($i == 0)
   {
   $doanhthu0 = $dulieuallsale['doanhthu'];
   $loinhuan0 = $dulieuallsale['loinhuanthucte'];
   $string0 = 'Tháng '.$months[$i];
   }if($i == 1)
   {
   $doanhthu1 = $dulieuallsale['doanhthu'];
   $loinhuan1 = $dulieuallsale['loinhuanthucte'];
   $string1 = 'Tháng '.$months[$i];

   }if($i == 2)
   {
   $doanhthu2 = $dulieuallsale['doanhthu'];
      $loinhuan2 = $dulieuallsale['loinhuanthucte'];
   $string2 = 'Tháng '.$months[$i];

   }if($i == 3)
   {
   $doanhthu3 = $dulieuallsale['doanhthu'];
      $loinhuan3 = $dulieuallsale['loinhuanthucte'];
   $string3 = 'Tháng '.$months[$i];

   }if($i == 4)
   {
   $doanhthu4 = $dulieuallsale['doanhthu'];
      $loinhuan4 = $dulieuallsale['loinhuanthucte'];
   $string4 = 'Tháng '.$months[$i];

   }if($i == 5)
   {
   $doanhthu5 = $dulieuallsale['doanhthu'];
      $loinhuan5 = $dulieuallsale['loinhuanthucte'];
   $string5 = 'Tháng '.$months[$i];

   }
}
						  
						  
					  
	
echo'<div class="row">					  	<div class="col-md-6"><center>
<canvas id="myChart" style="width:50%;max-width:1000px " ></canvas><hr>BIỂU ĐỒ THỐNG KÊ DOANH SỐ SALE THEO THÁNG</center></div>
<div class="col-md-6">
THỐNG KÊ LỢI NHUẬN SALE TRONG 6 THÁNG<br><table class="table table-striped table-valign-middle">
<thead>
<tr>
<th>Tháng</th>
<th>Doanh Thu</th>
<th>Lợi Nhuận</th>
<th>% Rate </th>
</tr>
</thead>
<tbody>
<tr>
<td><i class="fas fa-calendar-alt"></i>
'.$string5.'
</td>
<td style="color:blue">'.number_format($doanhthu5).'đ</td>
<td style="color:green">
';

echo'
'.number_format($loinhuan5).'đ
</td>
<td><small class="text-success mr-1">
<i class="fas fa-arrow-up"></i>
00%
</small></td>
</tr>
<tr>
<td><i class="fas fa-calendar-alt"></i>
'.$string4.'
</td>
<td style="color:blue">'.number_format($doanhthu4).'đ</td>
<td style="color:green">

'.number_format($loinhuan4).'đ
</td>
<td>
';

if($loinhuan4 > $loinhuan5)
{
	echo'<small class="text-success mr-1">
<i class="fas fa-arrow-up"></i>
'.intval($loinhuan4/$loinhuan5*100-100).'%
</small>';
}
else
{
	echo'<small class="text-warning mr-1">
<i class="fas fa-arrow-down"></i>
'.intval(100-$loinhuan4/$loinhuan5*100).'%
</small>';
}
echo'
</td>
</tr><tr>
<td><i class="fas fa-calendar-alt"></i>
'.$string3.'
</td>
<td style="color:blue">'.number_format($doanhthu3).'đ</td>
<td style="color:green">

'.number_format($loinhuan3).'đ
</td>
<td>
';

if($loinhuan3 > $loinhuan4)
{
	echo'<small class="text-success mr-1">
<i class="fas fa-arrow-up"></i>
'.intval($loinhuan3/$loinhuan4*100-100).'%
</small>';
}
else
{
	echo'<small class="text-warning mr-1">
<i class="fas fa-arrow-down"></i>
'.intval(100-$loinhuan4/$loinhuan3*100).'%
</small>';
}
echo'
</td>
</tr><tr>
<td><i class="fas fa-calendar-alt"></i>
'.$string2.'
</td>
<td style="color:blue">'.number_format($doanhthu2).'đ</td>
<td style="color:green">

'.number_format($loinhuan2).'đ
</td>
<td>';

if($loinhuan2 > $loinhuan3)
{
	echo'<small class="text-success mr-1">
<i class="fas fa-arrow-up"></i>
'.intval($loinhuan2/$loinhuan3*100-100).'%
</small>';
}
else
{
	echo'<small class="text-warning mr-1">
<i class="fas fa-arrow-down"></i>
'.intval(100-$loinhuan3/$loinhuan2*100).'%
</small>';
}
echo'
</td>
</tr><tr>
<td><i class="fas fa-calendar-alt"></i>
'.$string1.'
</td>
<td style="color:blue">'.number_format($doanhthu1).'đ</td>
<td style="color:green">

'.number_format($loinhuan1).'đ
</td>
<td>';

if($loinhuan1 > $loinhuan2)
{
	echo'<small class="text-success mr-1">
<i class="fas fa-arrow-up"></i>
'.intval($loinhuan1/$loinhuan2*100-100).'%
</small>';
}
else
{
	echo'<small class="text-warning mr-1">
<i class="fas fa-arrow-down"></i>
'.intval(100-$loinhuan2/$loinhuan1*100).'%
</small>';
}
echo'
</td>
</tr><tr>
<td><i class="fas fa-calendar-alt"></i>
'.$string0.'
</td>
<td style="color:blue">'.number_format($doanhthu0).'đ</td>
<td style="color:green">


'.number_format($loinhuan0).'đ
</td>
<td>
';

if($loinhuan0 > $loinhuan1)
{
	echo'<small class="text-success mr-1">
<i class="fas fa-arrow-up"></i>
'.intval($loinhuan0/$loinhuan1*100-100).'%
</small>';
}
else
{
	echo'<small class="text-warning mr-1">
<i class="fas fa-arrow-down"></i>
'.intval(100-$loinhuan1/$loinhuan0*100).'%
</small>';
}
echo'</td>
</tr>

</tbody>
</table>
</div></div>
					  ';
					  }
					  $laysocot1 = mysqli_num_rows(mysqli_query($conn,"select * from ksn_sale_leader"));
					  $laysocot2 = mysqli_num_rows(mysqli_query($conn,"select * from ns_user where idsale_service<>'0'"));
					  $laysocot3 = mysqli_num_rows(mysqli_query($conn,"select * from ns_user where roleid='6'"));
					  $laysocot4 = mysqli_num_rows(mysqli_query($conn,"select * from ksn_sale_leader_detail_add where `check`='0'"));
					  $laysocot5 = mysqli_num_rows(mysqli_query($conn,"select * from ksn_sale_fwd_add where `check`='0'"));
					 
					  echo'<h1>SALE MANAGER</h1><div class="row">';
					  
					  if($roleid == 6)
					  {
						  echo'
						<div class="col-md-3 col-sm-6 col-12"><a href="list_saleleader.php?action=team">

						<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-user-tie"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Quản Lý Team</span>
						</div>

						</div>
						</a>

						</div>

						<div class="col-md-3 col-sm-6 col-12">
						<a href="list_saleleader.php?action=fwdmanager">
						<div class="info-box">
						<span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Quản lý Sale hỗ trợ FWD</span>
						</div>

						</div>
						</a>
						</div>

						<div class="col-md-3 col-sm-6 col-12"><a href="m_admin.php?m=sale_detail&id='.$uid.'">
						<div class="info-box">
						<span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">THỐNG KÊ THEO THÁNG</span>
						</div>
</div>

</a>

</div>
						';
						
					  }
					  else
					  {
						  
						  
						  
					  echo'
						<div class="col-md-3 col-sm-6 col-12"><a href="list_saleleader.php?action=teammaster">

						<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-user-tie"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Quản Lý Trường Phòng</span>
						<span class="info-box-number"></span>
						</div>

						</div>
						</a>

						</div>
						
						
						
						
						<div class="col-md-3 col-sm-6 col-12"><a href="list_saleleader.php?action=team">

						<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-user-tie"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Quản Lý Sale Leader</span>
						<span class="info-box-number">'.$laysocot1.' Sale Leader</span>
						</div>

						</div>
						</a>

						</div>
						

						<div class="col-md-3 col-sm-6 col-12">
						<a href="list_saleleader.php?action=activemember">
						<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-user-plus"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Duyệt Member Trong Team</span>
						<span class="info-box-number" style="color:red">'.$laysocot4.' member cần duyệt</span>
						</div>

						</div>
						</a>
						</div>
						
						<div class="col-md-3 col-sm-6 col-12">
						<a href="list_saleleader.php?action=activefwd">
						<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-user-plus"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Duyệt Quản Lý FWD</span>
						<span class="info-box-number" style="color:red">'.$laysocot5.' FWD liên kết cần duyệt</span>
						</div>

						</div>
						</a>
						</div>
						
						<div class="col-md-3 col-sm-6 col-12">
						<a href="list_saleleader.php?action=fwdmanager">
						<div class="info-box">
						<span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Quản lý Sale hỗ trợ FWD</span>
						<span class="info-box-number">'.$laysocot2.' FWD hỗ trợ</span>
						</div>

						</div>
						</a>
						</div>

						<div class="col-md-3 col-sm-6 col-12"><a href="list_saleleader.php?action=allsale">
						<div class="info-box">
						<span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">Quản lý toàn bộ Sale</span>
						<span class="info-box-number">'.$laysocot3.' nhân viên Sale</span>
						</div>
						
						</div>

</a>

</div>
						

						';
			
		
					  }

				  





				  }
				  ###############
				  
				  }
				  
				  
				  
				  
				  ?>
				  
				  
				 <div class="row">
 
                  <?php 	
					
				  
				  if(@@$_GET['action'] == "activemember")
				  {
					  echo'
					  	<div class="col-md-8">
					  <table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:white;background-color:blue">
               <tr>
                  <th style="text-align: center;color:white">Leader</th>
                  <th style="text-align: center;color:white">Member Add</th>
                  <th style="text-align: center;color:white">Date Time</th>
    
                  <th style="text-align: center;color:white"></th>
                 
               </tr>
            </thead>
            <tbody>';

                  $data = mysqli_query($conn,"SELECT * FROM ksn_sale_leader_detail_add where `check`='0'");
               
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
		   
				  $laythongtinleader = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['id_saleleader']."'"));
				  $laythongtinmember = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['id_member']."'"));
                  $i++;
                  echo '<tr>
                  <td style="text-align: left; color:black">'.$laythongtinleader['ten'].'</td>
                  <td style="text-align: left; color:black">Thêm member: '.$laythongtinmember['ten'].'</td>
                  <td style="text-align: left; color:black">'.$item['datetime'].'</td>
                 <td>
				  <form action="" method="POST">
				  <input type="hidden" value="'.$item['id_saleleader'].'" name="id_saleleader">
				  <input type="hidden" value="'.$item['id_member'].'" name="id_member">
				  <input type="hidden" value="'.$item['id'].'" name="id_add">
				  <button type="submit" name="btn_active" class="btn btn-success btn-sm">Xác Nhận</button>
				  ';
				 
				  echo'<button type="submit" name="btn_delete2" class="btn btn-danger btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn hủy lệnh này?\')" />Hủy lệnh</button></form>
					
                  </td>
                  </tr>';
               }
			   echo'
            </tbody>
         </table></div>';
					  
					  
				  }					  
				   
				  if(@@$_GET['action'] == "activefwd")
				  {
					  echo'
					  	<div class="col-md-8">
					  <table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:white;background-color:blue">
               <tr>
                  <th style="text-align: center;color:white">Leader</th>
                  <th style="text-align: center;color:white">Member Add</th>
                  <th style="text-align: center;color:white">Date Time</th>
    
                  <th style="text-align: center;color:white"></th>
                 
               </tr>
            </thead>
            <tbody>';

                  $data = mysqli_query($conn,"SELECT * FROM ksn_sale_fwd_add where `check`='0'");
               
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
		   
				  $laythongtinleader = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['id_saleleader']."'"));
				  $laythongtinmember = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['id_fwd']."'"));
                  $i++;
                  echo '<tr>
                  <td style="text-align: left; color:black;font-weight:bold">'.$laythongtinleader['ten'].'</td>
                  <td style="text-align: left; color:black">Thêm Company vào quản lý FWD: <b>'.$laythongtinmember['congty'].'</b></td>
                  <td style="text-align: left; color:black">'.$item['datetime'].'</td>
                 <td>
				  <form action="" method="POST">
				  <input type="hidden" value="'.$item['id_saleleader'].'" name="id_saleleader">
				  <input type="hidden" value="'.$item['id_fwd'].'" name="id_member">
				  <input type="hidden" value="'.$item['id'].'" name="id_add">
				  <button type="submit" name="btn_active2" class="btn btn-success btn-sm">Xác Nhận</button>
				  ';
				 
				  echo'<button type="submit" name="btn_delete_fwdsale" class="btn btn-danger btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn hủy lệnh này?\')" />Hủy lệnh</button></form>
					
                  </td>
                  </tr>';
               }
			   echo'
            </tbody>
         </table></div>';
					  
					  
				  }					  
				  
				  
				  
				  
				  if(@$_GET['action'] == "team")
				  {
				  echo'	<div class="col-md-12">';
				  
				  if($roleid != 6)
				  {
				  echo'
					<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus-circle"></i> Add Sale Leader</button>';
				  }
					echo'
<br><br>
      <!-- Default box -->';
	  
				if(isset($_GET['select_month']))
		{
			$month=$_GET['select_month'];
		}else
		{
			$month =  date('Y-m');
		}
		
		$new_month = substr($month, -2);
		$year = substr($month,0, 4);
		echo'
		';  
				  
				
echo'	
<form action="list_saleleader.php?action=allsale" method="GET">
		Thống kê theo tháng 
		
		<input type="hidden" id="select_month" name="action" value="team">
		<input type="month" id="select_month" name="select_month" value="'.$month.'">
		<button type="submit" class="btn btn-warning btn-sm">Lọc theo tháng</button> </form>	<br>';
	  echo'
      <div class="card card-primary">
        <div class="card-header" style="background-color:blue; color:white">
          <h3 class="card-title" >SALE LEADER MANAGER</h3>

         
        </div>
       ';
				  
				  echo' <div class="card-body">
          <table class="table table-striped projects" style="width:100%">
              <thead>
                  <tr>
                      <th>
                          STT
                      </th>
                      <th>
                          SALE LEADER
                      </th>
                      <th>
                          TEAM MEMBER
                      </th>
                      
                      <th >
                      </th>
                  </tr>
              </thead>
              <tbody>';
					if($roleid == 6){
						$laydulieusale = mysqli_query($conn,"SELECT * FROM ksn_sale_leader where id_saleleader='$uid'")or die("Loi");

					}
					  else
					  {
							$laydulieusale = mysqli_query($conn,"SELECT * FROM ksn_sale_leader")or die("Loi");
					  }
							while ($item = mysqli_fetch_array($laydulieusale,MYSQLI_ASSOC)) {
								$thongtinsale = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['id_saleleader']."'"));
								echo' <tr>
                      <td>
                          1
                      </td>
                      <td>
                          <a>
                             <a href="m_admin.php?m=sale_detail&id='.$thongtinsale['id'].' "> <i class="fas fa-user-tie"></i> '.$thongtinsale['ten'].' </a>
                          </a>
                          <br/>
                          <small>
                              Created at '.$item['datetime'].'
                          </small>
						  						 <br><a href="mani_saleleader.php?id='.$thongtinsale['id'].'&month='.$new_month.'" ><i class="fas fa-download"></i> Export dữ liệu tháng '.$new_month.'</a>

                      </td>
                      <td>
					  <!--
                          <ul class="list-inline">
                              <li class="list-inline-item">
                                  <img alt="Avatar" class="table-avatar" src="gd/dist/img/AdminLTELogo.png">
                              </li>
                             
                          </ul>
						  -->
						  ';
						  $check_teammembera = mysqli_query($conn,"select * from ksn_sale_leader_detail where id_saleleader='".$item['id_saleleader']."'");
	$sothanhvien = mysqli_num_rows($check_teammembera);
	echo'<table class="table table-hover text-nowrap">
		<tr>
		<th>Tên thành viên nhóm</th><th>Mã User Account</th><th>Lợi nhuận thực tế</th><th></th></tr>';

$totalloinhuan = 0;
while($check_teammember = mysqli_fetch_array($check_teammembera))
{
		$date_add = $check_teammember['datetime'];
	$add_year = date('Y', strtotime($date_add));
	$add_month = date('m', strtotime($date_add));
	if(($add_month<= $new_month) OR ($add_year<$year))
	{
	$loinhuancanhan = saleformonth($check_teammember['id_member'],$new_month,$conn)['loinhuanthucte'];
	$check_wrong = 0;
	}
	else
	{
	$loinhuancanhan = 0;
	$check_wrong = 1;
	}
	$totalloinhuan+=$loinhuancanhan;
	$laydulieumember = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$check_teammember['id_member']."'"));
	echo'	<tr>
		<td>'.$laydulieumember['ten'].'</td><td>'.$laydulieumember['cus_code'].'</td><td  style="color:green;font-weight:bold">';
		if($check_wrong == 1)
		{
			echo'Add member ['.date('Y-m-d', strtotime($date_add)).'] nên chưa được tính';
		}
		else
		{
			
		echo number_format($loinhuancanhan).'đ';
		}
		echo' </td>
		
		<td><form action="" method="POST">
						 <input type="hidden" value="'.$laydulieumember['id'].'" name="idsale_leader_delete">
                       
						  </form>
		</td>
		
		</tr>';
}
$hoahongleader = checkkpileader($totalloinhuan,$conn)['kpi_hoahong'];

echo'
</table>';
						  echo'
						  
                      </td>
                     
                      <td class="project-actions text-right">
                         <form action="" method="POST">
						 <input type="hidden" value="'.$thongtinsale['id'].'" name="idsale_leader_delete">
                         ';
							if($roleid != 6)
							echo'						 
							<button type="submit" name="btn_delete_leader" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi danh sách Leader?\')">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </button>';
						  echo'
						  </form>
                      </td>
                  </tr>
                  ';
							}
							
							echo'          
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>';
	  
	  echo'  
      <!-- /.card -->
	</div>	';
				  } 
				  
				  
				  
				  if(@$_GET['action'] == "teammaster")
				  {
				  echo'	<div class="col-md-12">';
				  
				  if($roleid != 6)
				  {
				  echo'
					<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-master"><i class="fas fa-plus-circle"></i> Thêm Trưởng Phòng Mới</button>';
				  }
					echo'
<br><br>
      <!-- Default box -->';
	  
				if(isset($_GET['select_month']))
		{
			$month=$_GET['select_month'];
		}else
		{
			$month =  date('Y-m');
		}
		
		$new_month = substr($month, -2);
		$year = substr($month,0, 4);
		echo'
		';  
				  
				
echo'	
<form action="list_saleleader.php?action=allsale" method="GET">
		Thống kê theo tháng 
		
		<input type="hidden" id="select_month" name="action" value="team">
		<input type="month" id="select_month" name="select_month" value="'.$month.'">
		<button type="submit" class="btn btn-warning btn-sm">Lọc theo tháng</button> </form>	<br>';
	  echo'
      <div class="card card-primary">
        <div class="card-header" style="background-color:blue; color:white">
          <h3 class="card-title" >DANH SÁCH TRƯỞNG PHÒNG VÀ THÀNH VIÊN</h3>

         
        </div>
       ';
				  
				  echo' <div class="card-body">
          <table  class="table table-striped projects" style="width:100%">
          <table  class="table table-striped projects" style="width:100%">
              <thead>
                  <tr>
                      <th>
                          STT
                      </th>
                      <th>
                          TRƯỞNG PHÒNG
                      </th>
                      <th>
                          THÀNH VIÊN
                      </th>
                      
                      <th >
                      </th>
                  </tr>
              </thead>
              <tbody>';
					if($roleid == 6){
						$laydulieusale = mysqli_query($conn,"SELECT * FROM ksn_sale_master where id_saleleader='$uid'")or die("Loi");

					}
					  else
					  {
							$laydulieusale = mysqli_query($conn,"SELECT * FROM ksn_sale_master")or die("Loi");
					  }
							while ($item = mysqli_fetch_array($laydulieusale,MYSQLI_ASSOC)) {
								$thongtinsale = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['id_saleleader']."'"));
								echo' <tr>
                      <td>
                          1
                      </td>
                      <td>
                          <a>
                             <a href="m_admin.php?m=sale_detail&id='.$thongtinsale['id'].' "> <i class="fas fa-user-tie"></i> '.$thongtinsale['ten'].' </a>
                          </a>
                          <br/>
                          <small>
                              Created at '.$item['datetime'].'
                          </small>
						  						<!-- <br><a href="mani_saleleader.php?id='.$thongtinsale['id'].'&month='.$new_month.'" ><i class="fas fa-download"></i> Export dữ liệu tháng '.$new_month.'</a>-->

                      </td>
                      <td>
					  <!--
                          <ul class="list-inline">
                              <li class="list-inline-item">
                                  <img alt="Avatar" class="table-avatar" src="gd/dist/img/AdminLTELogo.png">
                              </li>
                             
                          </ul>
						  -->
						  ';
						  $check_teammembera = mysqli_query($conn,"select * from ksn_sale_master_detail where id_saleleader='".$item['id_saleleader']."'");
	$sothanhvien = mysqli_num_rows($check_teammembera);
	echo'<table class="table table-hover text-nowrap">
		<tr>
		<th>Tên thành viên </th><th>Mã User Account</th><th>Lợi nhuận thực tế</th><th></th></tr>';

$totalloinhuan = 0;
while($check_teammember = mysqli_fetch_array($check_teammembera))
{
		$date_add = $check_teammember['datetime'];
	$add_year = date('Y', strtotime($date_add));
	$add_month = date('m', strtotime($date_add));
	if(($add_month<= $new_month) OR ($add_year<$year))
	{
	$loinhuancanhan = saleformonth($check_teammember['id_member'],$new_month,$conn)['loinhuanthucte'];
	$check_wrong = 0;
	}
	else
	{
	$loinhuancanhan = 0;
	$check_wrong = 1;
	}
	$totalloinhuan+=$loinhuancanhan;
	$laydulieumember = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$check_teammember['id_member']."'"));
	echo'	<tr>
		<td>'.$laydulieumember['ten'].'</td><td>'.$laydulieumember['cus_code'].'</td><td  style="color:green;font-weight:bold">';
		if($check_wrong == 1)
		{
			echo'Add member ['.date('Y-m-d', strtotime($date_add)).'] nên chưa được tính';
		}
		else
		{
			
		echo number_format($loinhuancanhan).'đ';
		}
		echo' </td>
		
		<td><form action="" method="POST">
						 <input type="hidden" value="'.$laydulieumember['id'].'" name="idsale_master_delete">
                       
						  </form>
		</td>
		
		</tr>
		
		';
}
$hoahongleader = checkkpileader($totalloinhuan,$conn)['kpi_hoahong'];
echo'
		<tr>	<form action="" method="POST" >
			';
						
			
			echo'		
				<input type="hidden" name="id_master" value="'.$item['id_saleleader'].'">
			<label for="inputPassword3" class="control-label">Chọn Sale Add Member </font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown" name="idkhachhang" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='6' AND id NOT IN (select id_member from ksn_sale_master_detail)AND id NOT IN (select id_saleleader from ksn_sale_master)")or die("Loi");
							while ($item2 = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item2['id'].'">'.$item2['ten'].' ['.$item2['username'].']</option>
								';
							}
					echo'</select>';
			
				
			echo'
			<br><button type="submit" name="btn_add2_master" class="btn btn-danger">Thêm Member</button>
			</form></tr>';
echo'
</table>';
						  echo'
						  
                      </td>
                     
                      <td class="project-actions text-right">
                         <form action="" method="POST">
						 <input type="hidden" value="'.$thongtinsale['id'].'" name="idsale_master_delete">
                         ';
							if($roleid != 6)
							echo'						 
							<button type="submit" name="btn_delete_master" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi danh sách TRƯỞNG PHÒNG?\')">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </button>';
						  echo'
						  </form>
                      </td>
                  </tr>
                  ';
							}
							
							echo'          
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>';
	  
	  echo'  
      <!-- /.card -->
	</div>	';
				  }
				  
				  ?>
                 
                
                  
                 
  
<?php

				



				  if(@@$_GET['action'] == "fwdmanager")
				  {

echo'<div class="col-md-12">';

 if($roleid != 6)
				  {
				  echo'
					<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-linkfwd"><i class="fas fa-plus-circle"></i> Link FWD to Sale</button>&nbsp;
';
					//echo'<a href="list_saleleader.php?action=price_fwd_sale" class="btn btn-primary btn-sm"><i class="fas fa-dollar-sign"></i> Áp giá cost cho FWD</a><br>&nbsp;';
				  }
				  else
				  {
					    echo'
					<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-linkfwd-sale"><i class="fas fa-plus-circle"></i> Thêm FWD quản lý</button><br>&nbsp;
';    
				  }

	  
				if(isset($_GET['select_month']))
		{
			$month=$_GET['select_month'];
		}else
		{
			$month =  date('Y-m');
		}
		
		$new_month = substr($month, -2);
		echo'
		';  
				  
		 			
				
echo'	
<form action="list_saleleader.php?action=allsale" method="GET">
		Thống kê theo tháng 
		
		<input type="hidden" id="select_month" name="action" value="fwdmanager">
		<input type="month" id="select_month" name="select_month" value="'.$month.'">
		<button type="submit" class="btn btn-warning btn-sm">Lọc theo tháng</button> 
		<a href="mani_fwd_month.php?month='.$new_month.'" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Export tháng '.$new_month.'</a>
		
		</form>	<br>';
		
		 
		 
		 #### BANG THONG KE LIEN KET FWD
		 
		  echo' <div class="card-body">
          <table class="table 	projects border" style="width:100%">
              <thead>
                  <tr>
                      <th>
                          
                      </th>
                      <th>
                          SALE NAME
                      </th>
                      <th>
                          FWD MANAGER
                      </th>
                      
                     
                  </tr>
              </thead>
              <tbody>';
					if($roleid == 6){
				  	$laydulieusale = mysqli_query($conn,"SELECT * FROM ns_user where idsale_service='$uid'  GROUP BY idsale_service")or die("Loi 121213");

					}
					else
					{
			  
			  
				  	$laydulieusale = mysqli_query($conn,"SELECT * FROM ns_user where idsale_service<>'0' AND idsale_service NOT IN(select id_member from ksn_sale_leader_detail) GROUP BY idsale_service");
					}
					$counta = 0;
							while ($item = mysqli_fetch_array($laydulieusale,MYSQLI_ASSOC)) {
								$counta++;
								$thongtinsale = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['idsale_service']."'"));
								echo' <tr>
                      <td>
                      </td>
                      <td>
                          <a>
                             <a href="m_admin.php?m=sale_detail&id='.$thongtinsale['id'].' "> <i class="fas fa-user-tie"></i> '.$thongtinsale['ten'].' </a>
                          </a>
                          <br/>
                          <small>
                          </small>
                      </td>
                      <td>
					  <!--
                          <ul class="list-inline">
                              <li class="list-inline-item">
                                  <img alt="Avatar" class="table-avatar" src="gd/dist/img/AdminLTELogo.png">
                              </li>
                             
                          </ul>
						  -->
						  ';
						  $check_fwdcompanya = mysqli_query($conn,"select * from ns_user where idsale_service='".$thongtinsale['id']."'");
	echo'<table class="table table-hover text-nowrap">
		<tr style="background-color:blue;color:white">
		<th width=70%>FWD Company</th><th>Total C.W</th><th></th></tr>';

		while($check_fwdcompany = mysqli_fetch_array($check_fwdcompanya))
		{
					$checkkpifwd = checkkpifwd($check_fwdcompany['id'],$new_month,$conn);


			echo'	<tr >
				<td><a href="m_admin.php?m=sale_detailfwd&id='.$check_fwdcompany['id'].'">'.$check_fwdcompany['congty'].'</a></td><td  style="color:red;font-weight:bold">'.number_format(@$checkkpifwd['charge_weight']).' kg</td>
				
				<td><form method="POST" action="">
								  
								  <input type="hidden" value="'.$check_fwdcompany['id'].'" name="id_company">
								  <input type="hidden" value="services_country" name="m"><button type="submit" name="delete_linkfwd" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi lên kết Sale vs FWD?\')"> 
								  
								  <i class="fas fa-trash-alt"></i> Delete</button></form>
				</td>
				
				</tr>';
		}
		
		## danh sách user member nếu là quản lý fwdmanager
		$laydulieuusermemberfwd = mysqli_query($conn,"select * from ksn_sale_leader_detail where id_saleleader='".$item['idsale_service']."'");
while($check_fwdcompanymember = mysqli_fetch_array($laydulieuusermemberfwd))
		{
			$checkcofwd = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where idsale_service='".$check_fwdcompanymember['id_member']."'"));
			if(@$checkcofwd['id'] != "");
			{
			$laydylieumember = mysqli_fetch_array(mysqli_query($conn,"select * from ns_user where id='".$check_fwdcompanymember['id_member']."'"));
			echo'<tr>
			<th width=70%><i class="fas fa-bezier-curve"></i> MEMBER: '.$laydylieumember['ten'].'</th><th></th><th></th></tr>';
			}
			
			
			
			$check_fwdcompanyb = mysqli_query($conn,"select * from ns_user where idsale_service='".$laydylieumember['id']."'");

			while($check_fwdcompany = mysqli_fetch_array($check_fwdcompanyb))
		{
					$checkkpifwd2 = checkkpifwd($check_fwdcompany['id'],$new_month,$conn);


			echo'	<tr>
				<td><i class="fas fa-ellipsis-v"></i> <a href="m_admin.php?m=sale_detailfwd&id='.$check_fwdcompany['id'].'">'.$check_fwdcompany['congty'].'</a></td><td  style="color:red;font-weight:bold">'.number_format(@$checkkpifwd2['charge_weight']).' kg</td>
				
				<td><form method="POST" action="">
								  
								  <input type="hidden" value="'.$check_fwdcompany['id'].'" name="id_company">
								  <input type="hidden" value="services_country" name="m"><button type="submit" name="delete_linkfwd" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi lên kết Sale vs FWD?\')"> 
								  
								  <i class="fas fa-trash-alt"></i> Delete</button></form>
				</td>
				
				</tr>';
		}
			
		}


echo'
</table>';
						  echo'
						  
                      </td>
                     
                      
                  </tr>
                  ';
							}
							
							echo'          
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>';
	  
	  echo'  
      <!-- /.card -->
	</div>	';		
	
				
		/*
		### Bang thong ke
echo'
      <!-- Default box -->
      <div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><i class="fas fa-users"></i> LIST FWD FOR SALE</h3>
</div>
<div class="card-body"><table class="table table-hover border">
		<tr>
		<th>COMPANY NAME</th><th>SALE NAME</th><th>Cost Leader<th><th>Cost Member</th><th>Cost Leader Member</th><th>Total C.W(Exported)</th><th>Total Cost</th>
		<th></th>
		</tr>
';
$laydulieulienketfwd = mysqli_query($conn,"select * from ns_user where idsale_service <> 0");
while($laydulieulienketfwda = mysqli_fetch_array($laydulieulienketfwd))
{
	$laydulieumember = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$laydulieulienketfwda['idsale_service']."'"));
		$checkkpifwd =  checkkpifwd($laydulieulienketfwda['id'],$new_month,$conn);

	echo'	<tr>
		<td style="color:blue"><a href="m_admin.php?m=sale_detailfwd&id='.$laydulieulienketfwda['id'].'">'.$laydulieulienketfwda['congty'].'</a></td><td>'.$laydulieumember['ten'].'</td>
		<td>'.$checkkpifwd['charge_weight'].' kg</td>
		
		<td>'.number_format($checkkpifwd['sotienchiphi']).' đ</td><td>
		<form method="POST" action="">
						  
						  <input type="hidden" value="'.$laydulieulienketfwda['id'].'" name="id_company">
						  <input type="hidden" value="services_country" name="m"><button type="submit" name="delete_linkfwd" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi lên kết Sale vs FWD?\')"> 
						  
						  <i class="fas fa-trash-alt"></i> Delete</button></form></td>
						  
						  
		</tr>';
}

echo'</table>
</div>

</div>
      <!-- /.card -->
	</div>';
	##############################################################
	*/
	
	
				  }
				  
				  
				  
				  
				  
				  
	
	echo'
	';
				  
				  
?>

	
	
	

<?php
		if(@$_GET['action'] == "allsale")
		{
					  
					  
				if(isset($_GET['select_month']))
		{
			$month=$_GET['select_month'];
		}else
		{
			$month =  date('Y-m');
		}
		
		$new_month = substr($month, -2);
		echo'
		';  
				  
				
echo'	<div class="col-md-6">
<form action="list_saleleader.php?action=allsale" method="GET">
		Thống kê theo tháng 
		
		<input type="hidden" id="select_month" name="action" value="allsale">
		<input type="month" id="select_month" name="select_month" value="'.$month.'">
		<button type="submit" class="btn btn-warning btn-sm">Lọc theo tháng</button> </form>	<br>
      <!-- Default box -->
      <div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><i class="fas fa-users"></i> LIST ALL SALE MEMBER</h3>
</div>
<div class="card-body">                <table class="table table-striped table-valign-middle" id="example5">

		<tr>
		<th>SALE NAME</th><th>Doanh Thu</th><th>Lợi Nhuận</th><th>Hạn mức còn lại</th><th>Chưa thanh toán</th></tr>
';
$laydulieulienketfwd = mysqli_query($conn,"select id,ten,hanmuc from ns_user where roleid='6'");
while($laydulieulienketfwda = mysqli_fetch_array($laydulieulienketfwd))
{
	
		$dulieuformonth =  saleformonth($laydulieulienketfwda['id'],$new_month,$conn);
	echo'	<tr>
		<td><i class="fas fa-user-tie"></i> <a href="m_admin.php?m=sale_detail&id='.$laydulieulienketfwda['id'].' "> '.$laydulieulienketfwda['ten'].' </a></td>
		<td style="color:orange">'.number_format($dulieuformonth['doanhthu']).'đ</td>
		<td style="color:green">'.number_format($dulieuformonth['loinhuanthucte']).'đ</td>
		<td style="color:red">'.number_format(@$laydulieulienketfwda['hanmuc']).'đ</td>
		<td style="color:red">'.number_format(@$laydulieulienketfwda['chuathanhtoan']).'đ</td>
		
		</tr>';
}

echo'</table>
</div>

</div>
      <!-- /.card -->
	</div>';
				  }
				  
				  
				  
				  
				if(@$_GET['action'] == "price_fwd_sale")
				{
					
					
						$laydulieuapcosta = mysqli_query($conn,"select * from ksn_sale_fwd");
						echo'<div class="col-md-8">';
						
							echo'<center>BẢNG GIÁ ÁP GIÁ CODE FWD CHO SALE (<a href="list_saleleader.php?action=fwdmanager">DANH SÁCH SALE HỖ TRỢ</a>)<br>Nếu không có trong danh sách mặc định (Cost Leader Member:2,000đ</i>)</font></center>';
						
						echo'
						<table class="table table-hover table-border"><tr style="background-color:red;color:white">
						<td>FWD Company name</td>
						<td>Dịch Vụ</td>
						<td>Cost Leader</td>
						<td>Cost Member</td>
						<td>Cost Leader Member</td>
						<td></td>
						</tr>
						';
		while($laydulieuapcost = mysqli_fetch_array($laydulieuapcosta,MYSQLI_ASSOC))
		{
		
			$laytendichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='".$laydulieuapcost['id_dichvu']."'"));
			$laytenfwd = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$laydulieuapcost['id_fwd']."'"));
			echo'<tr><td>'.$laytenfwd['congty'].'</td>
		<td>'.$laytendichvu['dichvu'].'</td><td>'.$laydulieuapcost['cost_leader'].'đ/kg</td><td>'.$laydulieuapcost['cost_member'].'đ/kg</td><td>'.$laydulieuapcost['cost_leadermember'].'đ/kg</td><td>
		<form method="POST" action="">
						  
						  <input type="hidden" value="'.$laydulieuapcost['id'].'" name="delete">
						  <input type="hidden" value="services_country" name="m">
						  <button type="submit" name="btn_deleteapgia" class="btn btn-danger btn-sm"> 
						  
						  <i class="fas fa-trash-alt"></i> Delete</button></form></td>
		</tr>';
		}		
				echo '</table></div>
				
				';
					
					
					echo'<div class="col-md-4"><div class="card card-danger">
			<div class="card-header">
			<h3 class="card-title"><i class="fas fa-user-tag"></i> Thêm Áp Giá Cho FWD Theo Dịch Vụ </h3>
			</div>
			<div class="card-body">	
					<form action="" method="POST">
			';
			
			
			echo'					
					
					<label for="inputPassword3" class="control-label">Chọn User Discount<font color=red> * </font></label>
<select multiple class="form-control select2bs4" id="nguoinhan_countries-dropdown2" name="id_user[]" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='2'");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'"
								
								';
						
								echo'>'.$item['username'].' ['.$item['congty'].']</option>
								';
							}
					echo'</select>';
					
					echo'
					<label for="inputPassword3" class="control-label">Chọn dịch vụ áp giá COST</font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown333" name="id_dichvu" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ksn_dichvu where status='2'")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['dichvu'].' </option>
								';
							}
					echo'</select>					

					<label for="inputPassword3" class="control-label">$ Cost Leader</font></label>
					<input type="number" class="form-control" value="5000" name="cost_leader">
					<label for="inputPassword3" class="control-label">$ Cost Member</font></label>
					<input type="number" class="form-control" value="3000" name="cost_member">
					<label for="inputPassword3" class="control-label">$ Cost Leadermember</font></label>
					<input type="number" class="form-control" value="2000" name="cost_leadermember">
					
					';
			
				
			echo'
			<br><button type="submit" name="btn_addfwdcost2" class="btn btn-danger">Thêm áp giá riêng</button>
			</form></div>
           <hr>
		   
					
					</div>
					';
		
		
		
		
				}

				  
?>

	
	
	
	

	</div>
<br>



<?php

	if($roleid == 1 || $roleid == 4 || $roleid == 3)
	{
		echo'<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Sale Leader</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
			echo'					<label for="inputPassword3" class="control-label">Chọn Sale đề cử Leader </font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown3" name="idkhachhang" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='6' AND id NOT IN (select id_saleleader from ksn_sale_leader)")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['ten'].' ['.$item['username'].']</option>
								';
							}
					echo'</select>';
			
				
			echo'
			<br><button type="submit" name="btn_add" class="btn btn-danger">Thêm Leader</button>
			</form>
           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	  
	  echo'<div class="modal fade" id="modal-default-master">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm Trường Phòng mới</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
			echo'					<label for="inputPassword3" class="control-label">Chọn Sale đề cử trưởng phòng </font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown3" name="idkhachhang" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='6' AND id NOT IN (select id_saleleader from ksn_sale_master)")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['ten'].' ['.$item['username'].']</option>
								';
							}
					echo'</select>';
			
				
			echo'
			<br><button type="submit" name="btn_add_master" class="btn btn-danger">Thêm Leader</button>
			</form>
           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	}
	if($roleid == 1 || $roleid == 4 || $roleid == 3)
	{
		echo'<div class="modal fade" id="modal-default-linkfwd">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Link Sale To FWD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
			echo'					<label for="inputPassword3" class="control-label">Select Sale Name</font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown2" name="id_salelink" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='6'")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['ten'].' ['.$item['username'].']</option>
								';
							}
					echo'</select>	
					
					
					<label for="inputPassword3" class="control-label">Select FWD Company</font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown" name="id_company" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='2' AND id NOT IN (select id_fwd from ksn_sale_fwd)")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['congty'].' </option>
								';
							}
					echo'</select>
					
					';
			
				
			echo'
			<br><button type="submit" name="btn_addlinkfwd" class="btn btn-danger">Liên Kết</button>
			</form>
           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	}
	if($roleid == 6)
	{
		echo'<div class="modal fade" id="modal-default-linkfwd-sale">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Link FWD to Sale Account</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
			echo'					<label for="inputPassword3" class="control-label">Select Sale Name</font></label>
				
					
					
					<label for="inputPassword3" class="control-label">Chọn FWD bạn hỗ trợ</font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown" name="id_company" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='2' AND idsale_service='0'")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['congty'].' </option>
								';
							}
					echo'</select>
					
					';
			
				
			echo'
			<br><button type="submit" name="btn_addlinkfwd_sale" class="btn btn-danger">Liên Kết</button>
			</form>
           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>
	  
	  
	  
	  ';
	}



  
    include('footer.php');

?>

<?php 

// With date e.g.: "May, 31", outputs:
// May, 2018, May 2018, March 2018, March 2018, January 2018, December 2017

if($roleid == 1 && @$_GET['action'] == "")
{
	
	
echo'
<script>
const xValues = ["Tháng'.$months[5].'","Tháng'.$months[4].'","Tháng'.$months[3].'","Tháng'.$months[2].'","Tháng'.$months[1].'","Tháng'.$months[0].'"];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
	    label: "Doanh thu tháng",

      data: ['.$doanhthu5.','.$doanhthu4.','.$doanhthu3.','.$doanhthu2.','.$doanhthu1.','.$doanhthu0.'],
      borderColor: "blue",
      fill: true
    }, { 
		    label: "Lợi nhuận thực tế tháng",

      data: ['.$loinhuan5.','.$loinhuan4.','.$loinhuan3.','.$loinhuan2.','.$loinhuan1.','.$loinhuan0.'],
      borderColor: "green",
      fill: true
    }]
  },
  options: {
    legend: {display: true},
	 scales: {
       yAxes: [{
         ticks: {
           callback: function(value, index, values) {
             return value.toLocaleString("en-US",{style:"currency", currency:"VND"});
           }
         }
       }]
     }
	 
  }
});
</script>';
}


?>



<script src="gd/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
<script src="../scan_lib/dist/quagga.js" type="text/javascript"></script>
<script src="../scan_lib/example/live_w_locator.js" type="text/javascript"></script>
<!-- <script type="text/javascript">
	function CreateByBarcode(){
		let value = $('#bc').val();
		window.location.href = `create_sub_package.php?id=${value}`;
	}

</script> -->
<style type="text/css">
	.drawingBuffer{
		margin-top: -29rem;
	}
</style>

<script>
	
	


</script>