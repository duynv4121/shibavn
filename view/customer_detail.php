<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
 
	
	
	
	
	$layid = $_GET['code'];
	$laythongtin = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_customer where id='$layid'"));
	$makhachhang = $laythongtin['cus_code'];
	$laythongtinuser = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where cus_code='$makhachhang'"));
	
	if($laythongtinuser['roleid'] != 2)
	{
		echo '
			<script>
				alert("Account không phải FWD");
			</script>
			<script> location.href="welcome.php"</script>
		';
	}
	if(isset($_POST['btn_submit']))
	{
		
		
		@$checkbox1 = $_POST['chkl'];  
		
		
			$vat_fee = $_POST['vat_fee'] ;  

			$layiddebit = add_debit($uid,$makhachhang,$vat_fee,$conn);
		

		for ($i=0; $i<sizeof($checkbox1);$i++){
		$id_baga = $checkbox1[$i];
		mysqli_query($conn,"INSERT INTO `ksn_debit_detail` (`id_debit`, `id_code`) VALUES ('$layiddebit', '$id_baga')")or die("Loi");
		mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='1' WHERE (`id_code`='$id_baga')")or die("Loi");
		}
			echo '
			<script>
				alert("Thêm Debit thành công !");
			</script>
			<script> location.href="list_debit.php"</script>
		';
		
	}
	
	
	
	if($uid == 1 || $roleid == 3)
	{
		
	}
	else
	{
		echo'<script> 
               window.location.href="list_packfwd.php";
            </script>';
	}
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   
         <!-- <div class="col-xs-3">
            <div class="input-group date mr-2">
               <div class="form-group ">
                  <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
               </div>
            </div>
         </div> -->
             
<!--
			 <button onclick="openModalCatalog()" class="btn btn-info mb-2">Export Customer</button>
-->
      
   <div class="row">
      <div class="col-md-12">
	  
	  <?php 
	  
	  if($laythongtin['fwd'] == 1)
	  {
		  $ttcannang = 0;
		  $sokienhang = 0;
		  $data2 = mysqli_query($conn,"SELECT id FROM ns_package WHERE cus_code = '$makhachhang' ");
          while($itema = mysqli_fetch_array($data2,MYSQLI_ASSOC))
		  {
			  $laysokienadd = mysqli_query($conn,"select cannang from ns_listhoadon where id_package='".$itema['id']."' order by id DESC");

			  while ($dulieukien = mysqli_fetch_array($laysokienadd,MYSQLI_ASSOC))
					  {

			  @$ttcannang += $dulieukien['charge_weight'];
			  $sokienhang += 1;
					  }
			  
		  }

		echo'<div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-" style="background-color:#0099FF;color:white">
                <h3 class="widget-user-username"><b>'.$laythongtin['name'].'</b></h3>
                <h5 class="widget-user-desc">Mã khách hàng: <b>'.$laythongtin['cus_code'].'</b></h5>
              </div>
              <div class="widget-user-image">
                <img class="" style="  border: 3px solid #555;" src="../inbill/inbilltw/'.$laythongtinuser['logo'].'" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Contact</h5>
                      <span class="description-text">'.$laythongtinuser['phone'].'</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
				  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Mã số thuế</h5>
                      <span class="description-text">'.$laythongtinuser['mst'].'</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Total package</h5>
                      <span class="description-text">'.$sokienhang.'</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <div class="description-block">
                      <h5 class="description-header">Total Weight</h5>
                      <span class="description-text">'.@$ttcannang.'</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>';
	  }  
	  if($laythongtin['fwd'] != 1)
	  {
		   $ttcannang = 0;
		  $data2 = mysqli_query($conn,"SELECT id FROM ns_package WHERE cus_code = '$makhachhang' ");
          while($itema = mysqli_fetch_array($data2,MYSQLI_ASSOC))
		  {
			  $laysokienadd = mysqli_query($conn,"select cannang from ns_listhoadon where id_package='".$itema['id']."' order by id DESC");

			  while ($dulieukien = mysqli_fetch_array($laysokienadd,MYSQLI_ASSOC))
					  {

			  $ttcannang += $dulieukien['cannang'];
					  }
			  
		  }

		echo'<div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-" style="background-color:#99CCFF">
                <h3 class="widget-user-username"><b>'.$laythongtin['name'].'</b></h3>
                <h5 class="widget-user-desc">Mã khách hàng: <b>'.$laythongtin['cus_code'].'</b></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="../inbill/inbilltw/'.$laythongtinuser['logo'].'" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">##</h5>
                      <span class="description-text">TỔNG SỐ KG</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
				  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">##</h5>
                      <span class="description-text">TỔNG SỐ KG</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">##</h5>
                      <span class="description-text">TỔNG SỐ KIỆN</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <div class="description-block">
                      <h5 class="description-header">#</h5>
                      <span class="description-text">Số kiện đi trong tháng</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>';
	  }
	  ?>
	  
	  
	  
	  
	   <?php
		 if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 else
		 {
			 if($roleid == 2 || $roleid == 6)
			 {
			 $day_start = date('Y-m-d', strtotime("-15 days"));;

			 }
			 else
			 {
			 $day_start = date('Y-m-d', strtotime("-10 days"));;
			 }
			 $day_end = date('Y-m-d');
		 }
		 

		 ?>
		 
		
		<?php
         if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 6|| $roleid == 2 ) {
		 echo'		<div class="row"style="background-color:#EEEEEE;padding-top:20px;border: 1px solid black;border-style: outset;" >
<div class="col-sm-7" >
		 		 <form method="GET" action="">

			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start" value="'.@$day_start.'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="'.@$day_end.'">
				<input type="hidden" id="aa" name="code"  value="'.$layid.'">
										<input hidden id="aa" name="id"  value="'.@$_GET['id'].'">';
										
			echo'<div class="form-group">

				<label for="" class="control-label">Dịch vụ vận chuyển (Services) *</label>
					<select multiple  class="select2bs4" name="kg_dichvu[]" id="" width=100% placeholder="Chọn dịch vụ">';
						
						$dichvushipa = mysqli_query($conn,"SELECT * FROM ksn_dichvu where status='2' order by id asc");
							while ($dichvuship = mysqli_fetch_array($dichvushipa,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$dichvuship['id'].'">'.$dichvuship['dichvu'].'</option>';
							}
			
					echo'</select>
					</div>';
					


				
			echo'<label for="aa">Status:</label>';
			
			?>
				
										<select name="status"> 
										<option>Import,Export</option>
										<option value="1" <?php if(@$_GET['status'] == 1){echo'selected';}?>>Imported</option>
										<option value="2" <?php if(@$_GET['status'] == 2){echo'selected';}?>>Exported</option>
									
										</select>
										
										<?php
										echo'
										<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
										
										</div>							

			</form>
				
			</div>
			  
	  
<form action="" method="POST">
			Bao gồm VAT 8% : 
				NO <input type="radio" id="css" name="vat_fee" value="0" checked>

			  YES <input type="radio" id="css" name="vat_fee" value="1">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button type="submit" name="btn_submit" class="btn-info" style="text-align:right"  onclick="return confirm(\'Chắc chắn xác nhận tạo debit những bill đã chọn?\');"/>Tạo Debit </button>
				</div>   <hr>

	';
			}
	  
		?>
	  
	  
	  
	  
	  
	
         <table id="examplex" class="table hover stripe" data-page-length='50'  data-order='[[0, "DESC"]]' style="font-size:14px;    border-collapse: collapse; 
">
            <thead style="color:white;background-color:#0099FF">
               <tr>
                  <th style="text-align: center;color:#FFFFFF">Date</th>
                  <th style="text-align: center;color:#FFFFFF">MAWB <input type="checkbox" onclick="toggle(this);" />Check all?<br />
</th>
                  <th style="text-align: center;color:#FFFFFF">Countries</th>
                  <th style="text-align: center;color:#FFFFFF">Services</th>
                  <th style="text-align: center;color:#FFFFFF">Reicever</th>
                  <th style="text-align: center;color:#FFFFFF">Sub Package</th>
                  <th style="text-align: center;color:#FFFFFF">Status</th>
            
               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3) {
				    $filldichvu = "";
				    $fillstatus = "";
				    if(isset($_GET['kg_dichvu']))
					{
						if($_GET['kg_dichvu'] == "")
						{
							
						}
						else
						{
							
						$filldichvu = "AND (";
							foreach ($_GET['kg_dichvu'] as $a){
								$filldichvu .= "kg_dichvu='".$a."' OR ";
							}
							$filldichvu = substr($filldichvu,0,-3);
							$filldichvu.=")";
						}
					}
					if(isset($_GET['status']))
					{
						if($_GET['status'] == 1)
						{
							$fillstatus = " AND status='1' ";
						}else if($_GET['status'] == 2)
						{
							$fillstatus = " AND status='2' ";
						}
						else
						{
							$fillstatus = " AND (status='1' OR status='2') ";

						}
					}
					
				   
				   
                  $data = mysqli_query($conn,"SELECT * FROM ns_package WHERE  cus_code = '$makhachhang'  ".$filldichvu." ".$fillstatus." AND   date >= '$day_start' AND date <= '$day_end' ORDER BY id DESC");
               }else{
                  $data = mysqli_query($conn,"SELECT * FROM ns_package WHERE cus_code = '$makhachhang' AND date >= '$day_start' AND date <= '$day_end'");
               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$item['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$item['id_nguoinhan']."'"));
				  				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));

					$laysokienadd = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$item['id']."' order by id DESC");
				   $laysokien = mysqli_num_rows($laysokienadd);
                  $i++;
                  echo '<tr style="background-color:white">
                  <td style="text-align: center; color:black;border:1px solid black">'.$item['date'].'</td>
                  <td style="text-align: center; color:black;border:1px solid black">
				  ';
				  
				  if($item['checkthanhtoan'] == 2)
				  {
					  echo checkthanhtoan($item['checkthanhtoan']);
				  } else if($item['checkthanhtoan'] == 1)
				  {
					  echo checkthanhtoan($item['checkthanhtoan']);
				  }
				  else
				  {
					echo' <input type="checkbox" name="chkl[]" id="form1" class="" value="'.$item['id_code'].'" ">';
				  }

					echo' <a href="package_fn.php?id='.$item['id'].'">'.$item['id_code'].'</a></td>
                  <td style="text-align: center; color:black;border:1px solid black">'.@$dulieuquocgia['name'].'</td>
                  <td style="text-align: left; color:black;border:1px solid black">'.@(dichvu($conn,$item['kg_dichvu'])).'</td>
                  <td style="text-align: left; color:black;border:1px solid black">'.@($rName['name']).'</td>
                  <td style="text-align: ; color:black;;border:1px solid black">';
				  
				  if($laysokien == 0)
				  {
					  echo'<font color=red>Need update sub package</font>';
				  }
				  else
				  {
					  while ($dulieukien = mysqli_fetch_array($laysokienadd,MYSQLI_ASSOC))
					  {
						  
						  echo '<a href="edit_extraprice.php?id='.$dulieukien['id_code'].'">  <i class="fas fa-edit"></i></a> '.$dulieukien['id_code'].' - '.$dulieukien['cannang'].' kg '.statusbill($dulieukien['status']);
						  
						  echo'<br>';
					  }
				  }
				  
				  
				  
				  echo'</td>
                
                  <td style=";border:1px solid black">
				  
				   ';
					
					 
				 echo'
                  </td>
                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
		 
		 </form>
      </div>
   </div>
</div>

  
<?php  
    include('footer.php');
?>

<script type="text/javascript">
   $('#modalInScanPackage').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget); 
       var recipient = button.data('whatever');
       var modal = $(this);
       $('#exampleModalLabelFake').val(recipient);
       modal.find('.modal-body input').val(recipient)
       $('#myFramed').attr('src', '../inbill/inbilltw/inbills.php?id=' + recipient );

   })
   $(function() {
      // customercode-dropdown
      $.ajax({
        url: '../controller/ajax.php',
        type: 'POST',
        data: {
          action: 'getCustomerName'
        },
        cache: false,
        success: function(result){
          $("#customercode-dropdown").html(result);
        }
      })
   });
   function openModalCatalog(){
      $('#listCatalog').modal('show');
   }
   $('#example2').DataTable({
  "ordering": false
   })


function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>