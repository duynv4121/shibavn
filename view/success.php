
<?php

header( "refresh:5;url=list_debit.php" );

include('top.php');

include 'thanhtoan/config.php';
include 'thanhtoan/lib/nganluong.class.php';
if (isset($_GET['payment_id'])) {
	// Lấy các tham số để chuyển sang Ngânlượng thanh toán:

	$transaction_info =$_GET['transaction_info'];
	$order_code =$_GET['order_code'];
	$price =$_GET['price'];
	$payment_id =$_GET['payment_id'];
	$payment_type =$_GET['payment_type'];
	$error_text =$_GET['error_text'];
	$secure_code =$_GET['secure_code'];
    //Khai báo đối tượng của lớp NL_Checkout
	$nl= new NL_Checkout();
	$nl->merchant_site_code = MERCHANT_ID;
	$nl->secure_pass = MERCHANT_PASS;
	//Tạo link thanh toán đến nganluong.vn
	$checkpay= $nl->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);
	
    if ($checkpay) {	
		echo '<div class="alert alert-success alert-dismissible">
                  <h5><i class="icon fas fa-check"></i> Đã thanh toán thành công DEBIT No: '.$order_code.'!</h5>
                  Thời gian thanh toán: '.date("Y-m-d h:i:sa").'
                </div>'; 
				 
				$laydulieudebit = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit where debitno='$order_code'"));
				$id_debit = $laydulieudebit['id'];
				$result = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='".$id_debit."'")or die("Loi");
				 while($item = mysqli_fetch_array($result,MYSQLI_ASSOC))
			   {
				   mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2' WHERE (`id_code`='".$item['id_code']."')");
				   
			   }
			   mysqli_query($conn,"UPDATE `ksn_debit` SET `checkthanhtoan`='2',`nganluong.php`,`timethanhtoan`=NOW() WHERE (`debitno`='$order_code')");

		// bạn viết code vào đây để cung cấp sản phẩm cho người mua		
	}else{
		echo "payment failed";
	}
	
}

echo'';
include('footer.php');
?>


