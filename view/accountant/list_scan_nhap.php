
<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   <form action="" method="POST">

      
   </form>
   
   
   
   <div class="row">

      <div class="col-md-12">
			
		

			
			
			
		<table id="example" class="display nowrap cell-border" style="width:100%">
            <thead style="color:blue">
               <tr>
                  <th style="text-align: center;color:#9f7d48"></th>
				  <th style="text-align: center;color:#9f7d48">Import Scan Time</th>

                  <th style="text-align: center;color:#9f7d48">ID BILL</th>
                  <th style="text-align: center;color:#9f7d48">N.V SCAN</th>
                  <th style="text-align: center;color:#9f7d48">Account Tạo</th>
                  <th style="text-align: center;color:#9f7d48">Contact Name</th>
                  <th style="text-align: center;color:#9f7d48">Quốc gia</th>
                  <th style="text-align: center;color:#9f7d48">Dịch Vụ</th>
                  <th style="text-align: center;color:#9f7d48">Kích thước</th>
                  <th style="text-align: center;color:#9f7d48">Cân nặng</th>
                  <th style="text-align: center;color:#9f7d48">Mặt hàng phụ thu</th>
                  <th style="text-align: center;color:#9f7d48">Công nợ</th>
				  <th style="text-align: center;color:#9f7d48">Status</th>
				  <th style="text-align: center;color:#9f7d48"></th>

               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5) {
                  $data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap INNER JOIN ns_listhoadon ON ksn_scan_nhap.id_listhoadon=ns_listhoadon.id_code where ns_listhoadon.status='1'");
               }else{
                  //$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap");
               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  $laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$item['id_listhoadon']."'"))or die(mysql_error());
                  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id ='".$laydulieukien['id_package']."'"))or die ("loi");
                  $cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("loi");
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
				  @$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten from ns_user where id='".$item['uid']."'"));
				  
                  echo '<tr>
				  <td style="text-align: center; color:black;font-size:14px;"></td>
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['datetime'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;">'.$laydulieukien['id_code'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;">'.@$dulieunhanvien['ten'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;"><a href="customer_detail.php?code='.$cuscode['id'].'">'.$package['cus_code'].'</a></td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$sName['name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$dulieuquocgia['name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.dichvu($conn,$package['kg_dichvu']).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$laydulieukien['length'].'x'.$laydulieukien['width'].'x'.$laydulieukien['height'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$laydulieukien['cannang'].' kg</td>
                 <td  style="font-size:14px;">';
				  $laydulieuphuthua = mysqli_query($conn,"select * from kns_listhoadonphuthu where id_code='".$laydulieukien['id_code']."'");
				  while($laydulieuphuthu = mysqli_fetch_array($laydulieuphuthua,MYSQLI_ASSOC))
				  {
					  echo $laydulieuphuthu['tenphuthu'].'|';
				  }
				  
                  echo'</td>
                  <td style="text-align: center; color:black">'.congno($package['congno']).'</td> <td style="text-align: center; color:black">'.statusbill($laydulieukien['status']).'</td>
                  <td style="text-align: center; color:black"><a href="../upload/'.$laydulieukien['img'].'" target="_blank"><i class="fas fa-images"></i></a></td>
				
                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
      </div>
   </div>
</div>
