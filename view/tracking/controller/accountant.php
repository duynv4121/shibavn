<?php
	function sum_package_code($id_dichvu,$total_weight,$id_city,$id_countries,$kg_chinhanh,$conn,$post_code,$state)
	{
		
		if($kg_chinhanh == "HCM")
		{
			$bang_gia = 'price_hcm_code'; 
		}
		else if($kg_chinhanh  == "HN")
		{
			$bang_gia = 'price_hn_code'; 

		}else if($kg_chinhanh  == "DAD")
		{
			$bang_gia = 'price_dn_code'; 

		}
		$totalprice = 0;	
		if($total_weight > 20.5)
				{
						$total_weight = ceil($total_weight);
				}
	
	//* Tinh Gia DICH VU KSN-AU , KSN-AU 2, KSN-AU EXPRESS
	if($id_dichvu == 1 || $id_dichvu == 2 || $id_dichvu == 24)
	{
		
		$laydulieuremote = mysqli_query($conn,"select * from ksn_au_remote where post_code='$post_code'");			

		if(mysqli_num_rows($laydulieuremote) >= 1)
		{
			$note = 'remote';

		}
		else
		{
			$note = 'metro';

		}

		if($total_weight < 21)
		{
		
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			
		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;

		}
		
	}
	
	
	else if($id_dichvu == 29)
	{
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));

		if($dulieucity['name'] == "California" || $dulieucity['name'] == "New California"|| $dulieucity['name'] == "California City")
		{
			$note = 'US2KM';

		}
		else
		{
			$note = 'US2KM';

		}
		
		if($total_weight >= 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;
		}
		
	}
	
	
	
	//* Tinh Gia DICH VU KSN-NZD
	else if($id_dichvu == 4)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));

		if($dulieucity['name'] == "Auckland")
		{
			$note = 'Auckland';

		}
		else
		{
			$note = 'other';

		}

		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
			
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	
	//* Tinh Gia DICH VU KSN-CANADA,KSN-UK,ksn-US,KSN-US NDA,KSN-SIN,KSN-AUE
	else if($id_dichvu == 13 || $id_dichvu == 14 || $id_dichvu == 7|| $id_dichvu == 9|| $id_dichvu == 10 || $id_dichvu == 11 || $id_dichvu == 28 || $id_dichvu == 30 || $id_dichvu == 31)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));

		
	

		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='$total_weight'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia];
						$check_price = 1;

		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='45'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='100' "));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='300' "));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	//* Tinh Gia DICH VU KSN-EU
	else if($id_dichvu == 12)
	{
		$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_countries where id='$id_countries'"));
		
		if($dulieuquocgia['name'] == 'Netherlands')
		{
			$note='KSNEU1';
		}
		else if($dulieuquocgia['name'] == 'Luxembourg' || $dulieuquocgia['name'] == 'Germany'|| $dulieuquocgia['name'] == 'Belgium')
		{
			$note='KSNEU2';
		}else if($dulieuquocgia['name'] == 'France' )
		{
			$note='KSNEU3';
		}else if($dulieuquocgia['name'] == 'Span' || $dulieuquocgia['name'] == 'Portugal' || $dulieuquocgia['name'] == 'Austria' || $dulieuquocgia['name'] == 'North Ireland'|| $dulieuquocgia['name'] == 'Italy' )
		{
			$note='KSNEU4';
		}else if($dulieuquocgia['name'] == 'Finland'|| $dulieuquocgia['name'] == 'Denmark'  || $dulieuquocgia['name'] == 'Sweden'   || $dulieuquocgia['name'] == 'Scotland'  || $dulieuquocgia['name'] == 'Wales'   )
		{
			$note='KSNEU5';
		}else if($dulieuquocgia['name'] == 'Croatia'|| $dulieuquocgia['name'] == 'Estonia'  || $dulieuquocgia['name'] == 'Greece'   || $dulieuquocgia['name'] == 'Hungary'  
		|| $dulieuquocgia['name'] == 'Ireland'  || $dulieuquocgia['name'] == 'Latvia' || $dulieuquocgia['name'] == 'Lithuania' || $dulieuquocgia['name'] == 'Poland' || $dulieuquocgia['name'] == 'Romania' 
		|| $dulieuquocgia['name'] == 'Slovakia' || $dulieuquocgia['name'] == 'Slovenia' || $dulieuquocgia['name'] == 'Czech Republic'  || $dulieuquocgia['name'] == 'Bulgaria'   )
		{
			$note='KSNEU6';
		}
		else if($dulieuquocgia['name'] == 'Norway' ||  $dulieuquocgia['name'] == 'Andorra' ||  $dulieuquocgia['name'] == 'Jersey' ||  $dulieuquocgia['name'] == 'Guernsey'||  $dulieuquocgia['name'] == 'Liechtenstein'
		||  $dulieuquocgia['name'] == 'San Marino'||  $dulieuquocgia['name'] == 'Switzerland')
		{
			$note='KSNEU7';
		}
		
		


		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia];
						$check_price = 1;

		}
		else if($total_weight >= 21 && $total_weight <= 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}
		
	}
	
	//KSN-US2
	else if($id_dichvu == 8)
	{
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));

		if($dulieucity['name'] == "California" || $dulieucity['name'] == "New California"|| $dulieucity['name'] == "California City")
		{
			$note = 'California';

		}
		else
		{
			$note = 'other';

		}
		
		if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
		
	}
	else if($id_dichvu == 3)
	{
		
		$laydulieuremote = mysqli_query($conn,"select * from ksn_au_remote where post_code='$post_code'");			

		if(mysqli_num_rows($laydulieuremote) >= 1)
		{
			$note = 'remote';

		}
		else
		{
			$note = 'metro';

		}

		
		 if($total_weight >= 50 && $total_weight < 101 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='50'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 101 && $total_weight < 301 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='101'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}else if($total_weight >= 301 && $total_weight < 501 )

		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='301'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 501 && $total_weight < 1000  )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='501'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}else if($total_weight > 1000  )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='1000'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}
		
	}
	
	
	
	
	else if($id_dichvu == 26)
	{
		
		$note = 'dubaisea';

		
		 if($total_weight >= 21 && $total_weight < 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 50 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )

		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 300)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='300  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}
		
	}
	
	
	
	//* Tinh Gia DICH VU KSN-PH
	else if($id_dichvu == 27)
	{
		
		@$dulieustate = mysqli_fetch_assoc(mysqli_query($conn,"select name,note from zone_ph where name='".$state."'"));

		if(@$dulieustate['note'] != "")
		{
			$note = trim(@$dulieustate['note']);
		}
		else
		{
			$note = 'KSNPH3';
		}

		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
			
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;

						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	
	
	
	return $totalprice;
	}
	
	
	
	function sum_package_sale($khach_cuocbay,$khach_phuthu,$khach_cuocnoidia,$khach_thuho,$khach_phibaohiem,$vat)
	{
		$sum = 0;
		if($vat == '1')
		{
			$sum = $khach_cuocbay+$khach_phuthu+$khach_cuocnoidia+$khach_phibaohiem+$khach_thuho+($khach_cuocbay*10/100);
		}
		else
		{
			$sum = $khach_cuocbay+$khach_phuthu+$khach_cuocnoidia+$khach_phibaohiem+$khach_thuho;
		}
		return $sum;
	}
	
	function donvitiente($id_dichvu)
	{
		
		if($id_dichvu == 13)
		{
		$donvitien = 'GBP';
		}
		else if($id_dichvu == 12)
		{
		$donvitien = 'VND';
		}
		else
		{
		$donvitien = 'USD';	
		}
		return $donvitien;
	}

?>