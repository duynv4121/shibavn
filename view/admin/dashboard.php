<?php  
  
    loadModalScanPackage();
    
	
	
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
		 echo'		<div class="row">
			<div class="col-sm-8" style="">
		 		 <form method="GET" action="">

			<div class="form-group">
			<label for="aa">Select Date:</label>
			<input type="date" id="aa" name="day_start" value="'.@$day_start.'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="'.@$day_end.'">
				<input type="hidden" id="aa" name="m"  value="dashboard">
										<input hidden id="aa" name="id"  value="'.@$_GET['id'].'">
										
			<label for="aa">Chi Nhánh:</label>';
			
			?>
										
										<select name="cn"> 
										<option>Tất cả</option>
										<option value="HCM" <?php if(@$_GET['cn'] == 'HCM'){echo'selected';}?>>Hồ Chí Minh</option>
										<option value="HN" <?php if(@$_GET['cn'] == 'HN'){echo'selected';}?>>Hà Nội</option>
										<option value="DAD" <?php if(@$_GET['cn'] == 'DAD'){echo'selected';}?>>Đà Nẵng</option>
										</select>
										
										<label for="aa">Trạng thái:</label>
										<select name="status"> 
										<option>All</option>
										<option value="1" <?php if(@$_GET['status'] == 1){echo'selected';}?>>Imported</option>
										<option value="2" <?php if(@$_GET['status'] == 2){echo'selected';}?>>Exported</option>
										<option value="0" <?php if(@$_GET['status'] == '0'){echo'selected';}?>>Create Bill</option>
										<option value="5" <?php if(@$_GET['status'] == 5){echo'selected';}?>>Returned</option>
										</select>
										</div><?php echo @$string_user.'<br>';?>
										</div>
										
										
										
										
										<?php
										if($roleid == 1)
										{
										echo'
										
										<div class="col-sm-3" style="">
 		<div class="form-group">										<label for="aa">DANH SÁCH USER:</label>


										
										
<select class="form-control  select2bs4" id="nguoinhan_countries-dropdown" name="id_user" >';
						
												$username = mysqli_query($conn,"SELECT * FROM ns_user where roleid='6' OR roleid='2'");
												echo'<option style="color:blue" value="">Tất cả</option>
';
												while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
													echo '
													<option style="color:blue" value="'.$item['id'].'" '; 
													if(@$_GET['id_user'] == $item['id']){echo'selected';} 
													echo'>'.$item['username'].' ['.$item['congty'].']</option>
													';
												}
										echo'</select>
				
										</div>
										<button type="submit" name="" class="btn btn-danger btn-sm" ><i class="fas fa-search"></i> Search	</button>
										
										</div>';
										
										}
										echo'
										</div>
			</div>							

			</form>

			
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $totaldonhang ;?></h3>

                <p><?php echo $string_status;?></p>
              </div>
              <div class="icon">
                <i class="ion ion-box"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $totalcannang ;?><sup style="font-size: 20px">kg</sup></h3>

                <p>Khối lượng (Charge Weight)</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>'.$totalfwd.'</h3>
		
		  <p>Tổng User FWD</p>
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
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>'.$totalcongty.'</h3>

                <p>Tổng User Công Ty</p>
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
		  
		 
		  
		  
		  <div class="col-lg-6 col-6">

		  <div class="card" >
              <div class="card-header border-0" style="background-color:#0066CC;color:white	" >
                <h3 class="card-title" >Thống kê dịch vụ từ <?php echo $day_start.' đến '.$day_end;?></h3>
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
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Dịch Vụ</th>
                    <th>Số lượng đơn</th>
                    <th>Gross Weight</th>
                    <th>Charge Weight</th>
                  </tr>
                  </thead>
                  <tbody>
                  
				  
				  
				  
				  <?php 
				  
				$dichvua = mysqli_query($conn,"select * from ksn_dichvu");
				$totaldonhang = 0;
				$totalcannang = 0;
				while($dichvu = mysqli_fetch_array($dichvua,MYSQLI_ASSOC))
				{
					
					$total = 0;
					$gross_weight = 0;
					$charge_weight = 0;
					
					
					
						if($roleid == 1 || $roleid == 3 ||  $roleid == 4)
						{
							if(isset($_GET['cn']))
							{						
								if($_GET['cn'] == 'HCM')
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL AND kg_dichvu='".$dichvu['id']."'  ".$fill_status." ".@$fill_userid."  AND kg_chinhanh='HCM' AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'HN')
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL AND kg_dichvu='".$dichvu['id']."'  ".$fill_status."  ".@$fill_userid." AND kg_chinhanh='HN' AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'DAD')
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL AND kg_dichvu='".$dichvu['id']."'  ".$fill_status." ".@$fill_userid." AND kg_chinhanh='DAD' AND date >= '$day_start' AND date <= '$day_end'");
								}
								else
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL AND kg_dichvu='".$dichvu['id']."'  ".$fill_status." ".@$fill_userid." and date >= '$day_start' AND date <= '$day_end'");
								}
							}
							else
							{
							$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight from ns_package where `delete` IS NULL AND  kg_dichvu='".$dichvu['id']."'  ".$fill_status." ".@$fill_userid." AND date >= '$day_start' AND date <= '$day_end'");
							}
						
						}
						else
						{
							if(isset($_GET['cn']))
							{						
								if($_GET['cn'] == 'HCM')
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL AND uid='$uid' AND kg_dichvu='".$dichvu['id']."'  AND kg_chinhanh='HCM' AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'HN')
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL  AND uid='$uid' AND kg_dichvu='".$dichvu['id']."'  AND kg_chinhanh='HN' AND date >= '$day_start' AND date <= '$day_end'");
								}else if($_GET['cn'] == 'DAD')
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL  AND uid='$uid' AND kg_dichvu='".$dichvu['id']."'  AND kg_chinhanh='DAD' AND date >= '$day_start' AND date <= '$day_end'");
								}
								else
								{
								$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight FROM ns_package where `delete` IS NULL  AND uid='$uid' AND kg_dichvu='".$dichvu['id']."' and date >= '$day_start' AND date <= '$day_end'");
								}
							}
							else
							{
							$laydilieukienhang = mysqli_query($conn,"SELECT gross_weight,charge_weight from ns_package where `delete` IS NULL  AND uid='$uid' AND  kg_dichvu='".$dichvu['id']."' AND date >= '$day_start' AND date <= '$day_end'");
							}
						}
					
					
					
					
					
					
					
					
					
					
					while($laydilieukienhanga = mysqli_fetch_array($laydilieukienhang,MYSQLI_ASSOC))
					{
						
						
						$total += 1;
						$gross_weight += $laydilieukienhanga['gross_weight'];
						$charge_weight += $laydilieukienhanga['charge_weight'];
						
						
					}
					echo' <tr>
                    <td style="color:blue">

                     '.$dichvu['dichvu'].'
                    </td>
                    <td>'.$total.' bill</td>
                    <td>'.$gross_weight.' kg</td>
                    <td>'.$charge_weight.'kg</td>
                  
                  
                  </tr>';
					
					
				}
				  
				  
				  ?>
                 
				  
				  
				  
                  </tbody>
                </table>
              </div>
            </div>
			</div><div class="col-sm-6 col-6">
			<?php
			### du lieu tien
			
			
			
			
			
							if(@$_GET['cn'] == 'HCM')
							{
							$laydulieuchi = mysqli_query($conn,"select * from ksn_ketoanchi where DATE(datetime) >= '$day_start' AND  DATE(datetime)  <= '$day_end' AND kg_chinhanh='HCM'");
							$laydulieuthu = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale='0' AND kg_chinhanh='HCM'");
							$laydulieuthusale = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale<>'0' AND kg_chinhanh='HCM'");

							
							}else if(@$_GET['cn'] == 'HN')
							{
							$laydulieuchi = mysqli_query($conn,"select * from ksn_ketoanchi where DATE(datetime) >= '$day_start' AND  DATE(datetime)  <= '$day_end' AND kg_chinhanh='HN'");
							$laydulieuthu = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale='0' AND kg_chinhanh='HN'");
							$laydulieuthusale = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale<>'0' AND kg_chinhanh='HN'");

							}else if(@$_GET['cn'] == 'DAD')
							{
							$laydulieuchi = mysqli_query($conn,"select * from ksn_ketoanchi where DATE(datetime) >= '$day_start' AND  DATE(datetime)  <= '$day_end' AND kg_chinhanh='DAD'");
							$laydulieuthu = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale='0' AND kg_chinhanh='DAD'");
							$laydulieuthusale = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale<>'0' AND kg_chinhanh='DAD'");
	
							}
							else
							{
							$laydulieuchi = mysqli_query($conn,"select * from ksn_ketoanchi where DATE(datetime) >= '$day_start' AND  DATE(datetime)  <= '$day_end'");
							$laydulieuthu = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale='0' ");
							$laydulieuthusale = mysqli_query($conn,"select * from ns_package where DATE(date) >= '$day_start' AND  DATE(date)  <= '$day_end' AND id_sale<>'0'");

							}
			
			
			
			$totalchi = 0;
			while($dulieuchi = mysqli_fetch_array($laydulieuchi,MYSQLI_ASSOC))
			{
				$totalchi += $dulieuchi['payment_price'];
			}
			
			
			$totalthu = 0;
			while($dulieuthu = mysqli_fetch_array($laydulieuthu,MYSQLI_ASSOC))
			{
				$totalthu += $dulieuthu['khach_cuocbay']+$dulieuthu['khach_phuthu']+$dulieuthu['vat'];
			}	
			
			
			$totalthusale = 0;
			while($dulieuthusale = mysqli_fetch_array($laydulieuthusale,MYSQLI_ASSOC))
			{
				if($dulieuthusale['vat'] == 1)
				{
				$totalthusale += $dulieuthusale['khach_cuocbay']+($dulieuthusale['khach_cuocbay']*8/100)+$dulieuthusale['khach_phuthu']+$dulieuthusale['khach_cuocnoidia']+$dulieuthusale['khach_thuho'];
				}
				else
				{
				$totalthusale += $dulieuthusale['khach_cuocbay']+$dulieuthusale['khach_phuthu']+$dulieuthusale['khach_cuocnoidia']+$dulieuthusale['khach_thuho'];

				}
			}				
			?>
			
			<?php
			
			if($roleid == 1)
			{
			echo'
			<div class="row">
<div class="col-sm-3 col-6">
<div class="description-block border-right">
<!--<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>-->
<h5 class="description-header">$'.number_format($totalthu).'</h5>
<span class="description-text">TOTAL REVENUE (FWD)</span>
</div>
</div>

<div class="col-sm-3 col-6">
<div class="description-block border-right">
<!--<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>-->
<h5 class="description-header">$'.number_format($totalthusale).'</h5>
<span class="description-text">TOTAL REVENUE (Sale)</span>
</div>

</div>

<div class="col-sm-3 col-6">
<div class="description-block border-right">
<!--<span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>-->
<h5 class="description-header">$'.number_format($totalchi).'</h5>
<span class="description-text">TOTAL COST</span>
</div>

</div>

<div class="col-sm-3 col-6">
<div class="description-block border-right">
<!--<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
<h5 class="description-header">$'.number_format($totalthu+$totalthusale-$totalchi).'</h5>
<span class="description-text">TOTAL PROFIT</span>
</div>

</div>
</div>';
			}
			
			
			?>

<div class="row">
<div class="col-sm-12 col-6">
 <?php 
 
 
 
		
		if($roleid == 1 ||$roleid == 3 || $roleid == 4)
		{			
		echo'
		<div class="card">
              <div class="card-header border-0" style="background-color:#0066CC;color:white	" >
                <h3 class="card-title">Thống kê TOP 10 User</h3>
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
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên Công Ty</th>
                    <th>Gross Weight</th>
                    <th>Charge Weight</th>
                  </tr>
                  </thead>
                  <tbody>
                  ';
				  
				  
				 
				$dichvua = mysqli_query($conn,"select uid,sum(charge_weight) AS sum_chargeweight,sum(gross_weight) AS sum_gross_weight from ns_package GROUP BY uid order by sum_chargeweight DESC ");
				$totaldonhang = 0;
				$totalcannang = 0;
				$i=0;
				while($dichvu = mysqli_fetch_array($dichvua,MYSQLI_ASSOC))
				{
					$i++;
					$dulieuuser = mysqli_fetch_array(mysqli_query($conn,"select * from ns_user where id='".$dichvu['uid']."'"));
					echo' <tr>
					                    <td>'.@$i.'</td>

                    <td style="color:blue">

                     '.@$dulieuuser['ten'].'['.@$dulieuuser['congty'].']
                    </td>
                    <td>'.round($dichvu['sum_gross_weight'],1).' kg</td>
                    <td>'.$dichvu['sum_chargeweight'].' kg</td>
                  
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>';
					
					
				}
		}
				  
				  ?>
                 
				  
				  
				  
                  </tbody>
                </table>
              </div>
            </div>

</div>



</div>


</div>
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