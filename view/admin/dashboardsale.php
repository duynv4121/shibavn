<?php  
  
    loadModalScanPackage();
    
	
	include("../controller/accountant.php");
?>

<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
		
			<div class="col-lg-12">
			 <?php 
		  
		  
		  	#### Thanh lọc search
		 
							if(@$_GET['id_user'] != '')
							  {
								  $laydulieuusertao = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".@$_GET['id_user']."'"));
								  @$fill_userid = " AND `uid`='".$_GET['id_user']."'";
								  $string_user = 'Hiện đang lọc dữ liệu Username: '.$laydulieuusertao['username'].'<b>['.$laydulieuusertao['congty'].']</b>';
							  }
						
			
							$string_status='';
							  if(@$_GET['status'] == '1')
							  {
								  $fill_status = " AND `status`='1'";
								  $string_status = 'Đơn hàng Import';
							  }else if(@$_GET['status'] == '2')
							  {
								  $fill_status = " AND `status`='2'";
								  $string_status = 'Đơn hàng Export';

							  }else if(@$_GET['status'] == '0')
							  {
								  $fill_status = " AND `status`='0'";
								  $string_status = 'Đơn hàng Create Bill';

							  }else if(@$_GET['status'] == 5)
							  {
								  $fill_status = " AND `status`='5'";
								  $string_status = 'Đơn hàng Returned';

							  }
							  else
							  {
								  $fill_status = " ";
								  $string_status ='Đơn hàng';
							  }
		  
		  
		  
		  
		  
		  
		   if ($roleid == 1 || $roleid == 3 || $roleid == 4) {
			   if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 
		 
						
									  
							  
							  
		 else
		 {
			 $day_start = date('Y-m-d', strtotime("-30 days"));;
			 $day_end = date('Y-m-d');
		 }
		 
		 	if(isset($_GET['select_month']))
		{
			$month=$_GET['select_month'];
		}else
		{
			$month =  date('Y-m');
		}
		
		$new_month = substr($month, -2);
		 
		 echo'		<div class="row">
		<form action="m_document.php" method="GET">
		Thống kê theo tháng 
		
		<input type="hidden" id="select_month" name="m" value="dashboardsale">
		<input type="month" id="select_month" name="select_month" value="'.$month.'">
		<button type="submit" class="btn btn-warning btn-sm">Lọc theo tháng</button> </form>	

			
				</div>   <hr>
	';
			
			
			
							
							
							
							  
					
					
						
							if(isset($_GET['cn']))
							{						
								if($_GET['cn'] == 'HCM')
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND `kg_chinhanh`='HCM' ".$fill_status." ".@$fill_userid." AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'HN')
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND `kg_chinhanh`='HN'  ".$fill_status." ".@$fill_userid." AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'DAD')
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND `kg_chinhanh`='DAD'  ".$fill_status."  ".@$fill_userid." AND date >= '$day_start' AND date <= '$day_end'");
								}
								else
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND date >= '$day_start' AND date <= '$day_end'  ".@$fill_status." ".@$fill_userid." ");
								}
							}
							else
							{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND date >= '$day_start' AND date <= '$day_end'  ".$fill_status." ".@$fill_userid." ");
							}
						
						
						
			
			
	
	
	
	
	
	
	
	
	$totaldonhang = 0;
	$totalcannang = 0;
	$totaltien = 0;
	while($laydilieukienhanga = mysqli_fetch_array($laydilieukienhang,MYSQLI_ASSOC))
	{
		$totaldonhang += 1;
		$totalcannang += $laydilieukienhanga['charge_weight'];
		
		if($laydilieukienhanga['id_sale'] == 0)
		{
		$totaltien += $laydilieukienhanga['khach_cuocbay'] + $laydilieukienhanga['khach_cuocnoidia'] + $laydilieukienhanga['khach_phuthu'] + $laydilieukienhanga['khach_thuho'] + $laydilieukienhanga['vat'];
		}
		else
		{
			if($laydilieukienhanga['vat'] == 1)
				{
				$totaltien += $laydilieukienhanga['khach_cuocbay']+($laydilieukienhanga['khach_cuocbay']*8/100)+$laydilieukienhanga['khach_phuthu']+$laydilieukienhanga['khach_cuocnoidia']+$laydilieukienhanga['khach_thuho'];
				}
				else
				{
				$totaltien += $laydilieukienhanga['khach_cuocbay']+$laydilieukienhanga['khach_phuthu']+$laydilieukienhanga['khach_cuocnoidia']+$laydilieukienhanga['khach_thuho'];

				}		
		}
	}
	
	
	$laydilieuuser = mysqli_query($conn,"select * from ns_user");
	$totalfwd = 0;
	$totalcongty = 0;
	while($laydilieuusera = mysqli_fetch_array($laydilieuuser,MYSQLI_ASSOC))
	{
		if($laydilieuusera['roleid'] == 2)
		{
		$totalfwd += 1;
		}else 
		{
		$totalcongty += 1;
		}
	}
			
			
			
			
			
			
			
			
			}
			
			
			
			### Lấy dữ liệu sale & fwd
			else if ($roleid == 2 || $roleid == 6) {
			   if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 else
		 {
			 $day_start = date('Y-m-d', strtotime("-30 days"));;
			 $day_end = date('Y-m-d');
		 }
		 echo'		<div class="row"style="" >
<div class="col-sm-9" style="margin-left:20px;">
		 		 <form method="GET" action="">

			<div class="form-group">
			<label for="aa">Select Date:</label>
			<input type="date" id="aa" name="day_start" value="'.@$day_start.'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="'.@$day_end.'">
				<input type="hidden" id="aa" name="m"  value="dashboard">
										<input hidden id="aa" name="id"  value="'.@$_GET['id'].'">
										
										
			<label for="aa">Chi Nhánh:</label>';
	
	
	
	echo'	<select name="cn"> 
										<option>Tất cả</option>
										<option value="HCM"';if(@$_GET['cn'] == 'HCM'){echo'selected';}echo'>Hồ Chí Minh</option>
										<option value="HN"';if(@$_GET['cn'] == 'HN'){echo'selected';}echo'>Hà Nội</option>
										<option value="DAD"';if(@$_GET['cn'] == 'DAD'){echo'selected';}echo'>Đà Nẵng</option>
										</select>';
										
										echo'
										<button type="submit" name="" class="btn btn-danger btn-sm" ><i class="fas fa-search"></i> Search	</button>
										
										</div>							

			</form>
			<br>
			

			
				</div>   <hr></div>

	';
							 
			
			
			
					
						
							if(isset($_GET['cn']))
							{						
								if($_GET['cn'] == 'HCM')
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND `kg_chinhanh`='HCM' AND uid='$uid' AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'HN')
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND `kg_chinhanh`='HN' AND uid='$uid' AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'DAD')
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND `kg_chinhanh`='DAD' AND uid='$uid' AND date >= '$day_start' AND date <= '$day_end'");
								}
								else
								{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND date >= '$day_start' AND uid='$uid' AND date <= '$day_end'");
								}
							}
							else
							{
							$laydilieukienhang = mysqli_query($conn,"select * from ns_package where `delete` IS NULL AND date >= '$day_start' AND uid='$uid' AND date <= '$day_end'");
							}
						
						
						
			
			
	
	
	
	
	
	
	
	
	$totaldonhang = 0;
	$totalcannang = 0;
	$totalcannang_gross = 0;
	$totaltien = 0;
	while($laydilieukienhanga = mysqli_fetch_array($laydilieukienhang,MYSQLI_ASSOC))
	{
		$totaldonhang += 1;
		$totalcannang += $laydilieukienhanga['charge_weight'];
		$totalcannang_gross += $laydilieukienhanga['gross_weight'];
	$totaltien += $laydilieukienhanga['khach_cuocbay'] + $laydilieukienhanga['khach_cuocnoidia'] + $laydilieukienhanga['khach_phuthu'] + $laydilieukienhanga['khach_thuho'] + $laydilieukienhanga['vat'];

		
	}
	
	
	$laydilieuuser = mysqli_query($conn,"select * from ns_user");
	$totalfwd = 0;
	$totalcongty = 0;
	while($laydilieuusera = mysqli_fetch_array($laydilieuuser,MYSQLI_ASSOC))
	{
		if($laydilieuusera['roleid'] == 2)
		{
		$totalfwd += 1;
		}else 
		{
		$totalcongty += 1;
		}
	}
			
			
			
			
			
			
			
			
			}
		  
		  ?>
			</div>
           <div class="col-lg-6 col-6">

		  <div class="card" >
              <div class="card-header border-0" style="background-color:#0066CC;color:white	" >
                <h3 class="card-title" >Thống kê doanh số Sale <?php echo $month;?></h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle" id="example5">
                  <thead>
                  <tr>
                    <th>Tên Sale</th>
                    <th>Doanh Thu (đ)</th>
                    <th>Lợi Nhuận</th>
                    <th>Tổng Đơn Hàng</th>
                    <th>Tổng Khối Lượng</th>
                  </tr>
                  </thead>
                  <tbody>
                  
				  
				  
				  
				  <?php 
				  $total_doanhthu = 0;
				  $total_loinhuan = 0;
				$laydulieulienketfwd = mysqli_query($conn,"select id,ten,hanmuc from ns_user where roleid='6'");
while($laydulieulienketfwda = mysqli_fetch_array($laydulieulienketfwd))
{
	
		$dulieuformonth =  saleformonth($laydulieulienketfwda['id'],$new_month,$conn);
	echo'	<tr>
		<td><i class="fas fa-user-tie"></i> <a href="m_admin.php?m=sale_detail&id='.$laydulieulienketfwda['id'].' "> '.$laydulieulienketfwda['ten'].' </a></td>
		<td style="color:orange">'.number_format($dulieuformonth['doanhthu']).'</td>
		<td style="color:green">'.number_format($dulieuformonth['loinhuanthucte']).'đ</td>
		<td style="color:red">'.number_format(@$dulieuformonth['sodonhang']).' đơn hàng</td>
		<td style="color:red">'.number_format(@$dulieuformonth['tongcannang']).' kg</td>
		
		</tr>';
		$total_doanhthu+= $dulieuformonth['doanhthu'];
		$total_loinhuan+= $dulieuformonth['loinhuanthucte'];
}
				  
				  
				  ?>
                 
				  
				  
				  
                  </tbody>
                </table>
              </div>
            </div>
			</div>
          <!-- ./col -->
		  
		  <?php
		  if(@$_GET['id_user'] == "" )
		  {
		  if(($roleid == 1 ||$roleid == 3 ||$roleid == 4)){
		echo'
              
		  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>'.number_format($total_doanhthu).' VNĐ</h3>
		
		  <p>Tổng Doanh Thu</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
		  
		  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>'.number_format($total_loinhuan).' VNĐ</h3>

                <p>Tổng Lợi Nhuận</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
		  ';
		  }
		  }
		  else
		  {
			  if($roleid == 1 ){
		echo'
             <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>'.number_format($totaltien).'<sup style="font-size: 20px">vnđ</sup></h3>

                <p>Tổng doanh thu</p>
              </div>
              <div class="icon">
                <i class="ion ion-box"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
		  ';
		  }
		  }
		  
		  
		  if($roleid == 2)
		  {
			 echo'
             <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>'.number_format($totaltien).'<sup style="font-size: 20px">vnđ</sup></h3>

                <p>Tổng doanh thu</p>
              </div>
              <div class="icon">
                <i class="ion ion-box"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
		  ';
		  }
		  ?>
		  
		  
		  
		  
		  
		  </div>
		  <div class="row">
		  
		 
		  
		  
	
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.con
<?php  
?>

<script type="text/javascript">
   $('#modalInScanPackage').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget); 
       var recipient = button.data('whatever');
       var modal = $(this);
       $('#exampleModalLabelFake').val(recipient);
       modal.find('.modal-body input').val(recipient)
       $('#myFramed').attr('src', '../inbill/inscanpackage/inscanpakage.php?id=' + recipient );

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

   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })


</script>