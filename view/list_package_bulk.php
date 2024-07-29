<?php  
    include('top.php');
    include('modals.php');
	include('../controller/bill.php');

    loadModalScanPackage();

	
	/*if($uid != 1)
	{
		echo'<script> 
               window.location.href="list_packfwd.php";
            </script>';
	}
	*/
	
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 

   
   
   <div class="row">
      <div class="col-md-12">
			
		

	
<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">
    <!-- Import & Export link -->
    <div class="col-md-12 head">
      
    </div>
    <!-- CSV file upload form -->
   <center> <div class="col-md-12" id="importFrm" >
		<a href="./labelau/bulk_SHIBAVN.zip">CSV IMPORT SAMPLE </a>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="Tạo Bill">
        </form>
    </div> </center>
	
    <!-- Data list table --> 
  
</div><br>
<?php


	if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
			
			function roundUp($number, $nearest){
			return ceil($number/0.5)*0.5;;
			}
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            $date = date('Y-m-d');
			$datenow2 = date('Y-m-d H:i:s');
			$status = 1;
			$note = 1;
			$pcs = 1;
			$checkrow = 1;
            // Parse data from CSV file line by line
			$demsokien=0;

			$kienhang_cannang_array= Array();
			$kienhang_length_array= Array();
			$kienhang_width_array= Array();
			$kienhang_height_array= Array();
            while(($line = fgetcsv($csvFile)) !== FALSE){
				
				
				$checkrow++;
                // Get row data
				
				if($line[1] != "" && $line[2] != "")
				{
                $account_code   = $conn->real_escape_string($line[0]);
                $kg_chinhanh   = $conn->real_escape_string($line[1]);
                $dichvu   = $conn->real_escape_string($line[2]);
                $nguoinhan_countries  = $line[3];
                $nguoinhan_name  = $conn->real_escape_string($line[4]);
                $nguoinhan_company = $conn->real_escape_string($line[5]);
                $nguoinhan_add = $conn->real_escape_string($line[6]);
                $nguoinhan_add2 = $conn->real_escape_string($line[7]);
                $nguoinhan_city = $conn->real_escape_string($line[8]);
                $nguoinhan_post_code = $conn->real_escape_string($line[9]);
                $nguoinhan_state = $conn->real_escape_string($line[10]);
                $nguoinhan_phone = $conn->real_escape_string($line[11]);
                $kg_ref = $conn->real_escape_string($line[12]);
                $package_type = $conn->real_escape_string($line[13]);
                $kg_reiceiversign = $conn->real_escape_string($line[14]);
				if($kg_reiceiversign == 'YES')
				{
					$kg_reiceiversign=1;
				}
				else
				{	
					$kg_reiceiversign=0;
				}
                $package_tenhang = $conn->real_escape_string($line[15]);
                $package_valueinvoice = $conn->real_escape_string($line[16]);
                $package_reason = $conn->real_escape_string($line[17]);
                $sokien = $conn->real_escape_string($line[18]);
               
				$string_status = 'Đã tạo nhãn cho kiện hàng';
				$string_detail = location_chinhanh($kg_chinhanh);
				$nguoigui_info = getCustomerByCode($account_code,$conn);
				$nguoigui_npp = '';
				$nguoigui_company = '';
				$id_no = '';
				$nguoinhan_add3 = '';
				$save = '';
				$chiho = '';
				}
				
				
				$kienhang_cannang = $conn->real_escape_string($line[19]);
                $kienhang_length = $conn->real_escape_string($line[20]);
                $kienhang_height = $conn->real_escape_string($line[21]);
                $kienhang_width = $conn->real_escape_string($line[22]);
				array_push($kienhang_cannang_array,$kienhang_cannang);
				array_push($kienhang_length_array,$kienhang_length);
				array_push($kienhang_height_array,$kienhang_height);
				array_push($kienhang_width_array,$kienhang_width);
				
				$demsokien++;
			
				if($demsokien == $sokien)
				{
				
				if($roleid == 2 || $roleid == 6)
				{
					if($nguoigui_info['cus_code'] != $datauser['cus_code'])
					{
						echo $nguoigui_info['cus_code'].$datauser['cus_code'];
						echo'<script> 
					   alert("Account ID trong file CSV không trùng với Mã User của bạn của bạn");
						window.location = "list_package_bulk.php";

					  </script>';
					exit();

					}
				}
				$checkref = mysqli_query($conn,"select kg_ref from ns_package where kg_ref='$kg_ref' LIMIT 1");
				if(mysqli_num_rows($checkref) >= 1 && (trim($kg_ref) != "")){
					echo $nguoigui_info['cus_code'].$datauser['cus_code'];
						echo'<script> 
					   alert("Lỗi mã Ref Code bị trùng, xin kiểm tra lại những bill đã tạo và upload lại file");
						window.location = "list_package.php";

					  </script>';
					exit();
				}
				$layiddichvu = mysqli_fetch_assoc(mysqli_query($conn,"select id from ksn_dichvu where dichvu='$dichvu'"));
				$get_countries = mysqli_fetch_assoc(mysqli_query($conn,"select id from ns_countries where iso2='".$nguoinhan_countries."'"));

				$check_valid_services = mysqli_query($conn,"select id from ksn_quocgia_dichvu where id_dichvu='".$layiddichvu['id']."' AND id_quocgia='".$get_countries['id']."' LIMIT 1") ;
				if(mysqli_num_rows($check_valid_services) < 1)
				{
					echo $nguoigui_info['cus_code'].$datauser['cus_code'];
						echo'<script> 
					   alert("Dịch vụ bạn chọn không áp dụng với quốc gia vận chuyển, xin kiểm tra lại những bill đã tạo và upload lại file - Error Row: '.$checkrow.'-'.$get_countries['id'].'('.$nguoinhan_countries.')-ID Service:'.$layiddichvu['id'].'");
						window.location = "list_package.php";

					  </script>';
					exit();
				}
				
				
				$get_city = mysqli_fetch_assoc(mysqli_query($conn,"select id from cities where name='".$nguoinhan_city."'"));
				$id_nguoigui = createSender($nguoigui_npp,$nguoigui_info['name'],$nguoigui_info['province_id'], $nguoigui_info['district_id'], $nguoigui_info['ward_id'], $nguoigui_info['address'], $nguoigui_info['phone'],$nguoigui_info['name'],$account_code,$conn);
				$id_nguoinhan = createReceiver($nguoinhan_name,$nguoinhan_company,$nguoinhan_phone,$get_countries['id'],$get_city['id'],$nguoinhan_add,$account_code,$id_no,$nguoinhan_add2,$nguoinhan_add3,$nguoinhan_state,$nguoinhan_post_code,$save,$conn);
				
				$test = createPackage($id_nguoigui,$account_code,$id_nguoinhan,$uid,$sokien,$date,$chiho,$layiddichvu['id'],$kg_chinhanh,$kg_ref,$kg_reiceiversign,$datauser['payment_type'],$conn);
				$i = 0;
				$gross_weight = 0;
				$sum_charge_weight = 0;
				$sokienaa = 0;
				$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,thetich from ksn_dichvu where id='".$layiddichvu['id']."'"));

				for($i;$i<$sokien;$i++)
				{
					$sokienaa++;
					$convert_weight = roundup((($kienhang_length_array[$i]*$kienhang_width_array[$i]*$kienhang_height_array[$i])/$dulieudichvu['thetich']),0.5);
				
				
				
					if($convert_weight > $kienhang_cannang_array[$i])
					{
						$charge_weight = $convert_weight;
						
					}
					else
					{
						$charge_weight = roundup($kienhang_cannang_array[$i],0.5);
						
					}
					if($charge_weight > 20.5)
						{
							$charge_weight = ceil($charge_weight);
						}
					$excute = createBillForPacker($uid,$test,$date,$datenow2,$kienhang_cannang_array[$i],1,$status, $note,$pcs,$account_code,'Carton',$kienhang_length_array[$i],$kienhang_width_array[$i],$kienhang_height_array[$i],$convert_weight,$charge_weight,$conn);
					$layid_code = mysqli_fetch_assoc(mysqli_query($conn,"select id,id_code from ns_listhoadon where id='$excute'"));
					add_trackingBill($layid_code['id_code'],$string_status,$string_detail,$conn);
					$gross_weight+= $kienhang_cannang_array[$i];
					$sum_charge_weight+= $charge_weight;
				}
				
				
				if($sum_charge_weight >= 21)
				{
					$sum_charge_weight = 0;
					$laydulieucannang = mysqli_query($conn,"select id,charge_weight,cannang,convert_weight from ns_listhoadon where id_package='$test'");
					while($checkdulieucannang = mysqli_fetch_array($laydulieucannang,MYSQLI_ASSOC))
					{
						$kien_charge_weight = ceil($checkdulieucannang['charge_weight']);
						$sum_charge_weight+= $kien_charge_weight;
						mysqli_query($conn,"UPDATE `ns_listhoadon` SET `charge_weight`='$kien_charge_weight' WHERE (`id`='".$checkdulieucannang['id']."')");
					}
				}
				
				
				
				mysqli_query($conn,"UPDATE `ns_package` SET `sokien`='$sokienaa',`kg_tenhang`='$package_tenhang', `kg_type`='$package_type',`kg_reason`='$package_reason',`kg_valueinvoice`='$package_valueinvoice',`gross_weight`='$gross_weight',`charge_weight`='$sum_charge_weight' WHERE (`id`='$test')");
				
				
				//lam trang lai mang
					$kienhang_cannang_array= Array();
					$kienhang_length_array= Array();
					$kienhang_width_array= Array();
					$kienhang_height_array= Array();
					$demsokien = 0;

				}
				
					
				
            }

            // Close opened CSV file
			
					fclose($csvFile);
				
					echo $nguoigui_info['cus_code'].$datauser['cus_code'];
						echo'<script> 
					   alert("Tạo Bill bằng file CSV thành công !");
						window.location = "list_package.php";

					  </script>';
					exit();   
					
					
					}
					
					else{
            echo'abc';;
        }
    }else{
            echo'abcd';;
    }
}



echo'



';
?>



<div class="row">
    <!-- Import & Export link -->
	<div class="col-md-6">
	<h3> -Hướng Dẫn Tạo Csv Order nhiều nhãn</h3>
<p style="color:red">+ Những ô tô màu đỏ là trường hợp bắt buộc điền.</p>
<p>+  <b>Account ID</b> là Số Tài Khoản Account của bạn tại SHIBAVN Express<?php echo'( <font color=red>Your Account ID: <b>'.$datauser['cus_code'].'</b> </font>)' ?></p>
<p>+  <b>Brand</b> là chi nhánh bạn gửi hàng (HCM,HN,DAD)</p>
<p>+  <b>Service</b> là dịch vụ bạn chọn (TSC-US,TSC-EU,...)</p>
<p>+ <b>Internal Reference</b>: Số tham chiếu theo dõi riêng của bạn.</p>
<p>+ <b>Package Type</b> : SPX nếu là hàng hóa, DOX nếu là tài liệu hoặc thư từ.</p>
<p>+ <b>Receiver's Signature</b>: Nếu có vui lòng điền Yes và sẽ phát sinh phí chữ kí , vui lòng kiểm tra với SHIBAVN.Nếu không vui lòng để trống.</p>
<p>+ <b>Description of goods</b>: Mặt hàng mô tả gần chính xác, vui lòng điền đúng tên mặt hàng bằng tiếng anh hoặc tiếng việt.</p>
<p>+ <b>Value invoice</b>: Giá trị khai báo invoice của lô hàng mà bạn khai báo.</p>
<p>+ <b>Reason For Export</b>: Lý do xuất khẩu , nếu bạn để trống hệ thống sẽ mặt định là Gift hàng quà tặng.</p>
<p>+ <b>Total number of Packages</b>: Tổng số kiện mà bạn gửi có thể điền 1,2,3,4….</p>
<p>+ <b>Length, Height, Width</b> : Chiều dài rộng cao mô phỏng của một kiện hàng đại diện.</p>

	 </div>
    <div class="col-md-6">
    <table class="table table-striped" width=100%>
	<tr >
	<th>#</th>
	<th>Tên quốc gia</th>
	<th>Mã</th>
	<th>Dịch vụ có thể sử dụng</th>
	</tr>
	
	<?php
	$dulieuquocgiaa = mysqli_query($conn,"select * from ns_countries");
	while($dulieuquocgia = mysqli_fetch_array($dulieuquocgiaa,MYSQLI_ASSOC))
	{
	echo'<tr >
	<td>'.$dulieuquocgia['id'].'</td>
	<td>'.$dulieuquocgia['name'].'</td>
	<td>'.$dulieuquocgia['iso2'].'</td>
	<td></td>
	</tr>';
	}
	?>
	
	
	
	</table>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-6" id="importFrm" >
		
    </div>

    <!-- Data list table --> 
  
</div>




<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
			
			
			
	
      </div>
   </div>
</div>

<?php  
    include('footer.php');
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

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

  
   
	$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'desc' ]
    } );
} );

</script>