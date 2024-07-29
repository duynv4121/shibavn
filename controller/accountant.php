<?php

if (!function_exists('sum_package_code')) {

	function sum_package_code($id_dichvu,$total_weight,$id_city,$id_countries,$kg_chinhanh,$conn,$post_code,$state,$id_code)
	{
		
		
		
		$result2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_package where id_code='".$id_code."'"));

		$laydulieuaz = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where (DATE(date_start) <='".$result2['date']."') AND (DATE(date_end) >='".$result2['date']."')"));
		if(@$laydulieuaz['bang_gia'] != "")
		{
		$banggiaapdung = $laydulieuaz['bang_gia'];
		}
		else
		{
		$banggiaapdung = "ksn_giadichvu";
	
		}
		
		
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
		
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			
		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
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
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;
		}
		
	}
	
	
	
	//* Tinh Gia DICH VU KSN-NZD
	else if($id_dichvu == 4)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));
		$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$result2['id_nguoinhan']."'")) ;

		if($dulieucity['name'] == "Auckland")
		{
			$note = 'Auckland';

		}
		else
		{
			$note = 'other';

		}
		if (strstr(strtoupper($receiver['address']), 'AUCKLAND')) {
				$note = 'Auckland';
			}
			if (strstr(strtoupper($receiver['state']), 'AUCKLAND')) {
				$note = 'Auckland';
			}if (strstr(strtoupper($receiver['state']), 'AUK')) {
				$note = 'Auckland';
			}
			if (strstr(strtoupper($receiver['address2']), 'AUCKLAND')) {
				$note = 'Auckland';
			}
			if (strstr(strtoupper($receiver['address3']), 'AUCKLAND')) {
				$note = 'Auckland';
			}
		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
			
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	
	//* Tinh Gia DICH VU KSN-CANADA,KSN-UK,ksn-US,KSN-US NDA,KSN-SIN,KSN-AUE
	else if($id_dichvu == 13 || $id_dichvu == 14 || $id_dichvu == 7|| $id_dichvu == 9|| $id_dichvu == 10 || $id_dichvu == 11 || $id_dichvu == 28 || $id_dichvu == 30 || $id_dichvu == 31 || $id_dichvu == 32|| $id_dichvu == 33|| $id_dichvu == 34 || $id_dichvu == 42 || $id_dichvu == 41 || $id_dichvu == 25)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));

		
	

		if($total_weight < 21)
		{
			@$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='$total_weight'"));
			
			@$totalprice += @$dulieugiadichvu[$bang_gia];
						@$check_price = 1;

		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100' "));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300' "));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	//* Tinh Gia DICH VU KSN-EU
	else if($id_dichvu == 12)
	{
		$note='';
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
		}else if($dulieuquocgia['name'] == 'Spain' || $dulieuquocgia['name'] == 'Portugal' || $dulieuquocgia['name'] == 'Austria' || $dulieuquocgia['name'] == 'North Ireland'|| $dulieuquocgia['name'] == 'Italy' )
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
			
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			
			$totalprice += @$dulieugiadichvu[$bang_gia];
						$check_price = 1;

		}
		else if($total_weight >= 21 && $total_weight <= 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}
		
	}
	
	//KSN-US2
	else if($id_dichvu == 8 || $id_dichvu == 29)
	{
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));
		$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$result2['id_nguoinhan']."'")) ;

		if($dulieucity['name'] == "California" || $dulieucity['name'] == "New California"|| $dulieucity['name'] == "California City")
		{
			$note = 'California';

		}
		else
		{
			$note = 'other';

		}
		
		
			if (strstr(strtoupper($receiver['state']), 'CA')) {
				$note = 'California';
			}
			if (strstr(strtoupper($receiver['address']), 'CALIFORNIA')) {
				$note = 'California';
			}
			if (strstr(strtoupper($receiver['address2']), 'CALIFORNIA')) {
				$note = 'California';
			}
			if (strstr(strtoupper($receiver['address3']), 'CALIFORNIA')) {
				$note = 'California';
			}
		
		
		
		
		if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
		
	}else if($id_dichvu == 37)
	{
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$id_city."'"));
		$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$result2['id_nguoinhan']."'")) ;

		if($dulieucity['name'] == "California" || $dulieucity['name'] == "New California"|| $dulieucity['name'] == "California City")
		{
			$note = 'KSN-SEA-US-CALI';

		}
		else
		{
			$note = 'KSN-SEA-US-OTHER';

		}
		
		
			if (strstr(strtoupper($receiver['state']), 'CA')) {
				$note = 'KSN-SEA-US-CALI';
			}
			if (strstr(strtoupper($receiver['address']), 'CALIFORNIA')) {
				$note = 'KSN-SEA-US-CALI';
			}
			if (strstr(strtoupper($receiver['address2']), 'CALIFORNIA')) {
				$note = 'KSN-SEA-US-CALI';
			}
			if (strstr(strtoupper($receiver['address3']), 'CALIFORNIA')) {
				$note = 'KSN-SEA-US-CALI';
			}
		
		
		
		
		if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
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

		
		 if($total_weight >= 21 && $total_weight < 44 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )

		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 300  )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}
		
	}
	
	
	
	
	else if($id_dichvu == 26)
	{
		
		$note = 'dubaisea';

		
		 if($total_weight >= 21 && $total_weight < 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 50 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )

		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 300)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300  AND note='$note'"));
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
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='$total_weight' AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
			
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;

						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  AND note='$note'"));
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	else
	{
		$checkdulieua = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='".$id_dichvu."'"));
		if($checkdulieua['type'] == '2')
		{
				if($total_weight < 31)
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='$total_weight'"));
				$totalprice += $dulieugiadichvu[$bang_gia];
				$check_price = 1;
				
			}
			else if($total_weight >= 31 && $total_weight < 45 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='31' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
				$check_price = 2;
				

			}else if($total_weight >= 45 && $total_weight < 100 )
			{
				
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;

							$check_price = 2;

			}else if($total_weight >= 100 && $total_weight < 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}else if($total_weight > 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}
		}else if($checkdulieua['type'] == '3')
		{
				
			 if($total_weight >= 21 && $total_weight < 45 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
				$check_price = 2;
				

			}else if($total_weight >= 45 && $total_weight < 100 )
			{
				
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;

							$check_price = 2;

			}else if($total_weight >= 100 && $total_weight < 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}else if($total_weight > 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}
		}else if($checkdulieua['type'] == '4')
		{
			
			 if($total_weight >= 31 && $total_weight < 45 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='31' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
				$check_price = 2;
				

			}else if($total_weight >= 45 && $total_weight < 100 )
			{
				
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;

							$check_price = 2;

			}else if($total_weight >= 100 && $total_weight < 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}else if($total_weight > 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}
		}
		else
		{
			if($total_weight < 21)
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='$total_weight'"));
				$totalprice += $dulieugiadichvu[$bang_gia];
				$check_price = 1;
				
			}
			else if($total_weight >= 21 && $total_weight < 45 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='21' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
				$check_price = 2;
				

			}else if($total_weight >= 45 && $total_weight < 100 )
			{
				
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='45' "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;

							$check_price = 2;

			}else if($total_weight >= 100 && $total_weight < 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='100'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}else if($total_weight > 300 )
			{
				$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from  ".$banggiaapdung."  where id_dichvu='".$id_dichvu."' AND m_price='300'  "));
				$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
							$check_price = 2;

			}
		}
		
	}
	
	
	
	return $totalprice;
	}
	}
	
	if (!function_exists('sum_package_sale')) {

	function sum_package_sale($khach_cuocbay,$khach_phuthu,$khach_cuocnoidia,$khach_thuho,$khach_phibaohiem,$vat)
	{
		$sum = 0;
		if($vat == '1')
		{
			$sum = $khach_cuocbay+$khach_phuthu+$khach_cuocnoidia+$khach_phibaohiem+$khach_thuho+($khach_cuocbay*8/100);
		}
		else
		{
			$sum = $khach_cuocbay+$khach_phuthu+$khach_cuocnoidia+$khach_phibaohiem+$khach_thuho;
		}
		return $sum;
	}
	}
	
	if (!function_exists('donvitiente')) {

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
	
	}
	
	if (!function_exists('saleformonth')) {

	function saleformonth($idsale,$month,$conn){
		$dulieusalea = mysqli_query($conn,"select chiho,charge_weight,khach_cuocnoidia,khach_cuocbay,khach_phuthu,khach_thuho,khach_phibaohiem,vat,id_nguoinhan,id_code,kg_dichvu,kg_chinhanh,status,checkthanhtoan,cuoc_goc,check_hold from ns_package where id_sale='$idsale' AND MONTH(date)='$month' AND status>='1'");
		$sodonhang=0;
		$tongcannang=0;
		$loinhuanthucte = 0;
		$loinhuanthuctecongty = 0;
		$loinhuanthuctetutim = 0;
		$doanhthu = 0;
		$chuathanhtoan = 0;
		while($dulieusale = mysqli_fetch_array($dulieusalea))
		{
              $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT city,country_id,post_code,state FROM ns_nguoinhan WHERE id ='".$dulieusale['id_nguoinhan']."'"));
			$sodonhang+=1;
			$tongcannang+=$dulieusale['charge_weight'];
			
									$laydulieuchiphia = mysqli_query($conn,"select * from kns_listhoadonchiphi where id_code='".$dulieusale['id_code']."'");
									$sotienchiphi = 0;
									while($laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia))
									{
										
									$sotienchiphi+=$laydulieuchiphi['price']*$laydulieuchiphi['soluong'];
									}
									
			
			
			$totalchiphi = $dulieusale['khach_cuocbay']-($dulieusale['khach_cuocnoidia']+$dulieusale['khach_phuthu']+$dulieusale['khach_thuho']+$dulieusale['khach_phibaohiem']+($dulieusale['vat']*8/100)+$sotienchiphi);
			//$sotiengoc= sum_package_code($dulieusale['kg_dichvu'],$dulieusale['charge_weight'],$rName['city'],$rName['country_id'],$dulieusale['kg_chinhanh'],$conn,$rName['post_code'],$rName['state'],$dulieusale['id_code']);
			
			$sotiengoc = $dulieusale['cuoc_goc'];
			if($sotiengoc != 0 && $dulieusale['check_hold'] != '1' && ($dulieusale['status'] == 2 OR $dulieusale['status'] == 1) && $dulieusale['checkthanhtoan'] == 2 )
			{
			$loinhuanthucte += $totalchiphi-$sotiengoc;
			
			if($dulieusale['chiho'] == '0')
			{
				$loinhuanthuctecongty+=$totalchiphi-$sotiengoc;
			}
			else
			{
				$loinhuanthuctetutim+=$totalchiphi-$sotiengoc;

			}
			}
			
			if($dulieusale['checkthanhtoan'] != '2')
			{
				$chuathanhtoan += $dulieusale['khach_cuocbay'];
			}				
			$doanhthu += $dulieusale['khach_cuocbay'];
		}
		$retr_arr["sodonhang"] = $sodonhang;
		$retr_arr["tongcannang"] = $tongcannang;
		$retr_arr["loinhuanthucte"] = $loinhuanthucte;
		$retr_arr["loinhuanthuctecongty"] = $loinhuanthuctecongty;
		$retr_arr["loinhuanthuctetutim"] = $loinhuanthuctetutim;
		$retr_arr["doanhthu"] = $doanhthu;
		$retr_arr["chuathanhtoan"] = $chuathanhtoan;
		return $retr_arr;
	}
	}
	
	if (!function_exists('saleformonth_all')) {

	function saleformonth_all($month,$conn){
		$laydulieukiena =  mysqli_query($conn,"select charge_weight,khach_cuocnoidia,khach_cuocbay,khach_phuthu,khach_thuho,khach_phibaohiem,vat,id_nguoinhan,id_code,kg_dichvu,kg_chinhanh,status,checkthanhtoan,cuoc_goc,check_hold from ns_package where id_sale<>'0' AND month(date)='$month' AND checkthanhtoan='2' ORDER BY id DESC");
		$tongdoanhthu = 0;
		$loinhuanthucte = 0;
		while($laydulieukien = mysqli_fetch_array($laydulieukiena))
		{
			
			$laydulieuchiphia = mysqli_query($conn,"select * from kns_listhoadonchiphi where id_code='".$laydulieukien['id_code']."'");
									$sotienchiphi = 0;
									while($laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia))
									{
										
									$sotienchiphi+=$laydulieuchiphi['price']*$laydulieuchiphi['soluong'];
									}
									
			
			
			$loinhuanthucte += $laydulieukien['khach_cuocbay']-($laydulieukien['khach_cuocnoidia']+$laydulieukien['khach_phuthu']+$laydulieukien['khach_thuho']+$laydulieukien['khach_phibaohiem']+($laydulieukien['vat']*8/100)+$sotienchiphi+$laydulieukien['cuoc_goc']);
		$tongdoanhthu += $laydulieukien['khach_cuocbay'];
		}
		$retr_arr["loinhuanthucte"] = $loinhuanthucte;
		$retr_arr["doanhthu"] = $tongdoanhthu;
		return $retr_arr;

	}
	}
	
	if (!function_exists('saleforquarter')) {

	
	function saleforquarter($idsale,$month,$conn){
		$thangtruoc1 = $month-1;
		$thangtruoc2 = $month-2;
		$dulieusalea = mysqli_query($conn,"select charge_weight,khach_cuocnoidia,khach_cuocbay,khach_phuthu,khach_thuho,khach_phibaohiem,vat,id_nguoinhan,id_code,kg_dichvu,status,kg_chinhanh,checkthanhtoan,cuoc_goc,check_hold from ns_package where id_sale='$idsale' AND (MONTH(date)='$month' OR MONTH(date)='$thangtruoc1'  OR  MONTH(date)='$thangtruoc2') AND status>='1'");
		$sodonhang=0;
		$tongcannang=0;
		$loinhuanthucte = 0;
		$doanhthu = 0;
		$chuathanhtoan = 0;
		while($dulieusale = mysqli_fetch_array($dulieusalea))
		{
              $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT city,country_id,post_code,state FROM ns_nguoinhan WHERE id ='".$dulieusale['id_nguoinhan']."'"));
			$sodonhang+=1;
			$tongcannang+=$dulieusale['charge_weight'];
			
				$laydulieuchiphia = mysqli_query($conn,"select * from kns_listhoadonchiphi where id_code='".$dulieusale['id_code']."'");
									$sotienchiphi = 0;
									while($laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia))
									{
										
									$sotienchiphi+=$laydulieuchiphi['price']*$laydulieuchiphi['soluong'];
									}
									
			
			
			$totalchiphi = $dulieusale['khach_cuocbay']-($dulieusale['khach_cuocnoidia']+$dulieusale['khach_phuthu']+$dulieusale['khach_thuho']+$dulieusale['khach_phibaohiem']+($dulieusale['vat']*8/100)+$sotienchiphi);
			//$sotiengoc= sum_package_code($dulieusale['kg_dichvu'],$dulieusale['charge_weight'],$rName['city'],$rName['country_id'],$dulieusale['kg_chinhanh'],$conn,$rName['post_code'],$rName['state'],$dulieusale['id_code']);
			
			$sotiengoc = $dulieusale['cuoc_goc'];
			if($sotiengoc != 0 && $dulieusale['check_hold'] != '1' && ($dulieusale['status'] == 2 OR $dulieusale['status'] == 1) && $dulieusale['checkthanhtoan'] == 2 )
			{
			$loinhuanthucte += $totalchiphi-$sotiengoc;
			}
			
			if($dulieusale['checkthanhtoan'] != '2')
			{
				$chuathanhtoan += $dulieusale['khach_cuocbay'];
			}				
			$doanhthu += $dulieusale['khach_cuocbay'];
		}
		$retr_arr["sodonhang"] = $sodonhang;
		$retr_arr["tongcannang"] = $tongcannang;
		$retr_arr["loinhuanthucte"] = $loinhuanthucte;
		$retr_arr["doanhthu"] = $doanhthu;
		$retr_arr["chuathanhtoan"] = $chuathanhtoan;
		return $retr_arr;
	}
	}
	
	
	if (!function_exists('saleforyear')) {

	function saleforyear($idsale,$month,$conn){

		$dulieusalea = mysqli_query($conn,"select charge_weight,khach_cuocnoidia,khach_cuocbay,khach_phuthu,khach_thuho,khach_phibaohiem,vat,id_nguoinhan,id_code,kg_dichvu,kg_chinhanh,status,checkthanhtoan,cuoc_goc,check_hold from ns_package where id_sale='$idsale' AND (YEAR(date)='$month') AND status>='1'");
		$sodonhang=0;
		$tongcannang=0;
		$loinhuanthucte = 0;
		$loinhuanthuctecongty = 0;
		$loinhuanthuctetutim = 0;
		$doanhthu = 0;
		$chuathanhtoan = 0;
		while($dulieusale = mysqli_fetch_array($dulieusalea))
		{
              $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT city,country_id,post_code,state FROM ns_nguoinhan WHERE id ='".$dulieusale['id_nguoinhan']."'"));
			$sodonhang+=1;
			$tongcannang+=$dulieusale['charge_weight'];
			
				$laydulieuchiphia = mysqli_query($conn,"select * from kns_listhoadonchiphi where id_code='".$dulieusale['id_code']."'");
									$sotienchiphi = 0;
									while($laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia))
									{
										
									$sotienchiphi+=$laydulieuchiphi['price']*$laydulieuchiphi['soluong'];
									}
									
			
			
			$totalchiphi = $dulieusale['khach_cuocbay']-($dulieusale['khach_cuocnoidia']+$dulieusale['khach_phuthu']+$dulieusale['khach_thuho']+$dulieusale['khach_phibaohiem']+($dulieusale['vat']*8/100)+$sotienchiphi);
			//$sotiengoc= sum_package_code($dulieusale['kg_dichvu'],$dulieusale['charge_weight'],$rName['city'],$rName['country_id'],$dulieusale['kg_chinhanh'],$conn,$rName['post_code'],$rName['state'],$dulieusale['id_code']);
			
			$sotiengoc = $dulieusale['cuoc_goc'];
			if($sotiengoc != 0 && $dulieusale['check_hold'] != '1' && ($dulieusale['status'] == 2 OR $dulieusale['status'] == 1) && $dulieusale['checkthanhtoan'] == 2 )
			{
				
			$loinhuanthucte += $totalchiphi-$sotiengoc;
			$doanhthu += $dulieusale['khach_cuocbay'];
			if($dulieusale['chiho'] == '0')
			{
				$loinhuanthuctecongty+=$totalchiphi-$sotiengoc;
			}
			else
			{
				$loinhuanthuctetutim+=$totalchiphi-$sotiengoc;

			}
			}
			
			if($dulieusale['checkthanhtoan'] != '2')
			{
				$chuathanhtoan += $dulieusale['khach_cuocbay'];
			}				
		}
		$retr_arr["sodonhang"] = $sodonhang;
		$retr_arr["tongcannang"] = $tongcannang;
		$retr_arr["loinhuanthucte"] = $loinhuanthucte;
		$retr_arr["doanhthu"] = $doanhthu;
		$retr_arr["chuathanhtoan"] = $chuathanhtoan;
		$retr_arr["loinhuanthuctecongty"] = $loinhuanthuctecongty;
		$retr_arr["loinhuanthuctetutim"] = $loinhuanthuctetutim;
		return $retr_arr;
	}
	}
	
	
	if (!function_exists('checkkpi')) {

	function checkkpi($idsale,$muctien,$conn)
	{
		$checkteamleadera = mysqli_query($conn,"select * from ksn_sale_leader where id_saleleader='$idsale'");
		$checkteamleader = mysqli_num_rows($checkteamleadera);
		if($checkteamleader >= 1)
			
			{
				if($muctien >= 0 && $muctien <= 10000000)
				{
					$retr_arr["kpi_type"] = 'KPI-01';
					$retr_arr["kpi_luong"] = '3500000';
					$retr_arr["kpi_hoahong"] = '10';
				}else if($muctien > 10000000 && $muctien <= 15000000)
				{
					$retr_arr["kpi_type"] = 'KPI-02';
					$retr_arr["kpi_luong"] = '5000000';
					$retr_arr["kpi_hoahong"] = '15';
				}else if($muctien > 15000000 && $muctien <= 30000000)
				{
					$retr_arr["kpi_type"] = 'KPI-03';
					$retr_arr["kpi_luong"] = '5000000';
					$retr_arr["kpi_hoahong"] = '30';
				}else if($muctien > 30000000 && $muctien <= 50000000)
				{
					$retr_arr["kpi_type"] = 'KPI-04';
					$retr_arr["kpi_luong"] = '6000000';
					$retr_arr["kpi_hoahong"] = '40';
				}else if($muctien > 50000000 && $muctien <= 75000000)
				{
					$retr_arr["kpi_type"] = 'KPI-05';
					$retr_arr["kpi_luong"] = '7000000';
					$retr_arr["kpi_hoahong"] = '45';
				}else if($muctien > 75000000 && $muctien <= 100000000)
				{
					$retr_arr["kpi_type"] = 'KPI-06';
					$retr_arr["kpi_luong"] = '8000000';
					$retr_arr["kpi_hoahong"] = '47';
				}else if($muctien > 100000000 )
				{
					$retr_arr["kpi_type"] = 'KPI-07';
					$retr_arr["kpi_luong"] = '10000000';
					$retr_arr["kpi_hoahong"] = '50';
				}	
			
			}
			else
			{
				if($muctien >= 0 && $muctien <= 12000000)
				{
					$retr_arr["kpi_type"] = 'KPI-01';
					$retr_arr["kpi_luong"] = '3500000';
					$retr_arr["kpi_hoahong"] = '10';
				}else if($muctien > 12000000 && $muctien <= 20000000)
				{
					$retr_arr["kpi_type"] = 'KPI-02';
					$retr_arr["kpi_luong"] = '5000000';
					$retr_arr["kpi_hoahong"] = '15';
				}else if($muctien > 20000000 && $muctien <= 25000000)
				{
					$retr_arr["kpi_type"] = 'KPI-03';
					$retr_arr["kpi_luong"] = '5000000';
					$retr_arr["kpi_hoahong"] = '20';
				}else if($muctien > 25000000 && $muctien <= 35000000)
				{
					$retr_arr["kpi_type"] = 'KPI-04';
					$retr_arr["kpi_luong"] = '6000000';
					$retr_arr["kpi_hoahong"] = '22';
				}else if($muctien > 35000000 && $muctien <= 50000000)
				{
					$retr_arr["kpi_type"] = 'KPI-05';
					$retr_arr["kpi_luong"] = '7000000';
					$retr_arr["kpi_hoahong"] = '25';
				}else if($muctien > 50000000 && $muctien <= 70000000)
				{
					$retr_arr["kpi_type"] = 'KPI-06';
					$retr_arr["kpi_luong"] = '8000000';
					$retr_arr["kpi_hoahong"] = '30';
				}else if($muctien > 70000000 && $muctien <= 150000000)
				{
					$retr_arr["kpi_type"] = 'KPI-07';
					$retr_arr["kpi_luong"] = '10000000';
					$retr_arr["kpi_hoahong"] = '40';
				}		
			}
				
				$laydulieuapgia = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_kpi_private where id_sale='$idsale' AND name='".$retr_arr["kpi_type"]."'"));
				if(@$laydulieuapgia['name'] != "")
				{
					$retr_arr["kpi_luong"] = $laydulieuapgia['muc_luong'];
					$retr_arr["kpi_hoahong"] = $laydulieuapgia['hoahong'];
				}
		return $retr_arr;
			
	}
	}
	
	
	if (!function_exists('checkkpithuong')) {

	function checkkpithuong($idsale,$muctien,$conn)
	{
		$checkleader = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_sale_leader where id_saleleader='$idsale'"));
				if(@$checkleader['id_saleleader'] == "")
				{
					
				
					$mucthuong = 0;
					if($muctien > 50000000 && $muctien <= 75000000)
					{
					$mucthuong = 1000000;
				
					}else if($muctien > 75000000 && $muctien <= 100000000)
					{
								$mucthuong = 1500000;

					}else if($muctien > 100000000)
					{
								$mucthuong = 2000000;

					}	
					return $mucthuong;
				}
				else
				{
					$mucthuong = 0;
					if($muctien > 50000000 && $muctien <= 75000000)
					{
					$mucthuong = 1000000;
				
					}else if($muctien > 75000000 && $muctien <= 100000000)
					{
								$mucthuong = 2000000;

					}else if($muctien > 100000000)
					{
								$mucthuong = 3000000;

					}	
					return $mucthuong;
				}
	}
	}
	
	if (!function_exists('checkkpithuong_quy')) {

	function checkkpithuong_quy($idsale,$muctien,$conn)
	{
		$mucthuong = 0;
				if($muctien > 100000000 && $muctien <= 150000000)
				{
		$mucthuong = 1000000;
			
				}else if($muctien > 150000000 && $muctien <= 300000000)
				{
							$mucthuong = 3000000;

				}else if($muctien > 300000000)
				{
							$mucthuong = 5000000;

				}	
				return $mucthuong;

	}
	}
	
	if (!function_exists('checkkpithuong_year')) {
	
	function checkkpithuong_year($idsale,$muctien,$conn)
	{
		$mucthuong = 0;
				if($muctien > 150000000 && $muctien <= 300000000)
				{
							$mucthuong = 1000000;
			
				}else if($muctien > 300000000 && $muctien <= 500000000)
				{
							$mucthuong = 5000000;

				}else if($muctien > 500000000 && $muctien <= 1000000000)
				{
							$mucthuong = 10000000;

				}else if($muctien > 1000000000)
				{
							$mucthuong = 15000000;

				}	
				return $mucthuong;

	}
	}
	### KPI team
	if (!function_exists('checkkpileaderteam_thang')) {

	function checkkpileaderteam_thang($idsale,$muctien,$conn)
	{
		$mucthuong = 0;
				if($muctien > 200000000 && $muctien <= 300000000)
				{
		$mucthuong = 2000000;
			
				}else if($muctien > 300000000)
				{
							$mucthuong = 5000000;

				}	
				return $mucthuong;

	}
	}
	if (!function_exists('checkkpileaderteam_quy')) {

	function checkkpileaderteam_quy($idsale,$muctien,$conn)
	{
		$mucthuong = 0;
				if($muctien > 300000000 && $muctien <= 500000000)
				{
					$mucthuong = 2000000;
			
				}else if($muctien > 500000000 && $muctien <= 1000000000)
				{
					$mucthuong = 3000000;
			
				}else if($muctien > 1000000000)
				{
					$mucthuong = 5000000;

				}	
				return $mucthuong;

	}
	}
	if (!function_exists('checkkpileaderteam_nam')) {

	function checkkpileaderteam_nam($idsale,$muctien,$conn)
	{
						$mucthuong = 0;
				if($muctien > 500000000 && $muctien <= 1000000000)
				{
						$mucthuong = 2000000;
			
				}else if($muctien > 1000000000 && $muctien <= 2000000000)
				{
						$mucthuong = 5000000;
			
				}else if($muctien > 2000000000 && $muctien <= 3000000000)
				{
						$mucthuong = 10000000;
			
				}else if($muctien > 3000000000)
				{
						$mucthuong = 20000000;

				}	
				return $mucthuong;

	}
	}
	
	if (!function_exists('checkkpileader')) {

	function checkkpileader($muctien,$conn)
	{
		if($muctien > 0 && $muctien <= 50000000 )
		{
			$retr_arr["kpi_type"] = 'KPI-01';
			$retr_arr["kpi_hoahong"] = '7';
		}else if($muctien > 50000000 && $muctien <= 100000000)
		{
			$retr_arr["kpi_type"] = 'KPI-02';
			$retr_arr["kpi_hoahong"] = '10';
		}else if($muctien > 100000000 && $muctien <= 150000000)
		{
			$retr_arr["kpi_type"] = 'KPI-03';
			$retr_arr["kpi_hoahong"] = '11';
		}else if($muctien > 150000000 && $muctien <= 200000000)
		{
			$retr_arr["kpi_type"] = 'KPI-04';
			$retr_arr["kpi_luong"] = '6000000';
			$retr_arr["kpi_hoahong"] = '12';
		}else if($muctien > 200000000 && $muctien <= 300000000)
		{
			$retr_arr["kpi_type"] = 'KPI-05';
			$retr_arr["kpi_hoahong"] = '13';
		}else if($muctien > 300000000)
		{
			$retr_arr["kpi_type"] = 'KPI-06';
			$retr_arr["kpi_hoahong"] = '14';
		}
		else
		{
			$retr_arr["kpi_type"] = 'Chưa Đạt';
			$retr_arr["kpi_hoahong"] = '0';

		}
		return $retr_arr;
			
	}
	}
	
	if (!function_exists('checkbillstatus_sale')) {

	function checkbillstatus_sale($idbill,$conn)
	{
		$laydulieustatus = mysqli_fetch_assoc(mysqli_query($conn,"select status,id from ns_package where id_code='$idbill'"));
		$laykienhang = mysqli_fetch_assoc(mysqli_query($conn,"select id_code from ns_listhoadon where id_package='".$laydulieustatus['id']."'"));
		$dulieustatus = statusbillsale($laydulieustatus['status']);
		$laydulieustatus_hold = mysqli_fetch_assoc(mysqli_query($conn,"select id_hoadon from ns_tracking_bill where id_hoadon='".$laykienhang['id_code']."' AND status LIKE '%hold%' ORDER BY id DESC"));
		
		if(@$laydulieustatus_hold['id_hoadon'] != "")
		{
		$dulieustatus = '<font color=red>HOLD</font>';

		}
		return $laydulieustatus_hold['id_hoadon'];
	}
	}
	
	
	if (!function_exists('checkstatus_hold')) {

	function checkstatus_hold($idhoadon,$conn)
	{
		$kiendulieu = mysqli_fetch_assoc(mysqli_query($conn,"select status,check_hold from ns_package where id_code='".$idhoadon."'"));
		
		$status = statusbillsale($kiendulieu['status']);
		if($kiendulieu['check_hold'] == 1)
		{
			$status = 'HOLD';
		}
		return $status;
	}
	}
	
	if (!function_exists('checkkpifwd')) {

	function checkkpifwd($idfwd,$new_month,$conn)
	{
			$data = mysqli_query($conn,"SELECT charge_weight,kg_dichvu,check_hold,checkthanhtoan FROM ns_package where `uid`='$idfwd' AND (`sokien`>0) AND month(date)='$new_month' AND status='2' order by id DESC ");
			$sotienchiphi_member = 0;
			$sotienchiphi_leader = 0;
			$sotienchiphi_leadermember = 0;
			$charge_weight = 0;
			
			
			while(@$laydulieuchiphi = mysqli_fetch_array($data,MYSQLI_ASSOC))
			{
				if($laydulieuchiphi['check_hold'] != 1 )
				{
									$charge_weight+=$laydulieuchiphi['charge_weight'];

									@$laydulieuapcost = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_sale_fwd where id_dichvu='".$laydulieuchiphi['kg_dichvu']."' AND id_fwd='$idfwd'"));
									if(@$laydulieuapcost['id_dichvu']!= "")
									{
									$sotienchiphi_member+=$laydulieuchiphi['charge_weight']*$laydulieuapcost['cost_member'];
									$sotienchiphi_leader+=$laydulieuchiphi['charge_weight']*$laydulieuapcost['cost_leader'];
									$sotienchiphi_leadermember+=$laydulieuchiphi['charge_weight']*$laydulieuapcost['cost_leadermember'];
									}
									else
									{
									$sotienchiphi_member+=$laydulieuchiphi['charge_weight']*3000;
									$sotienchiphi_leader+=$laydulieuchiphi['charge_weight']*5000;
									$sotienchiphi_leadermember+=$laydulieuchiphi['charge_weight']*2000;
									}
				}
			}
			$retr_arr['charge_weight']= $charge_weight;
			$retr_arr['sotienchiphi_member']= $sotienchiphi_member;
			$retr_arr['sotienchiphi_leader']= $sotienchiphi_leader;
			$retr_arr['sotienchiphi_leadermember']= $sotienchiphi_leadermember;

			return $retr_arr;
						
	}
	}
	
	
	if (!function_exists('loinhuanbill')) {

	function loinhuanbill($total,$phuthu,$noidia,$thuho,$baohiem,$vat,$cpvh,$cuocgoc)
	{
		$loinhuan = $total - ($phuthu+$noidia+$thuho+$baohiem+$vat+$cpvh+$cuocgoc);
		return $loinhuan;
	}
	}
	
	
	if (!function_exists('debitfwd')) {
	
	
	function debitfwd($idfwd,$new_month,$new_year,$conn){
		$laydulieu = mysqli_query($conn,"select * from ns_package where (khach_cuocbay<>'0' OR cuoc_goc<>'0') AND checkthanhtoan<>'2' AND (`status`=1 OR `status`=2) AND MONTH(date)='$new_month' AND YEAR(date)='$new_year' AND uid='$idfwd'");
		$totalno = 0;
		while($laydulieua = mysqli_fetch_array($laydulieu))
		{
			if($laydulieua['checkthanhtoan'] != '2')
			{
				if($laydulieua['id_sale'] != 0 )
				{
					
					
						
							$totalno += $laydulieua['khach_cuocbay'];   
						
					
				}
				else
				{
				if($laydulieua['cuoc_goc'] != 0)
				{
					$totalno +=$laydulieua['cuoc_goc'];
				}
				else
				{
					$totalno += $laydulieua['khach_cuocbay'] +$laydulieua['khach_phuthu']  + $laydulieua['vat'];  
				}
				}
				
			}
		}
		return $totalno;
	}
	}
	
	#### FWD for month
	
	if (!function_exists('fwdformonth')) {

	function fwdformonth($idsale,$month,$conn){
		$dulieusalea = mysqli_query($conn,"select charge_weight,khach_cuocnoidia,khach_cuocbay,khach_phuthu,khach_thuho,khach_phibaohiem,vat,id_nguoinhan,id_code,kg_dichvu,kg_chinhanh,status,checkthanhtoan,cuoc_goc,check_hold from ns_package where uid='$idsale' AND MONTH(date)='$month'");
		$sodonhang=0;
		$tongcannang=0;
		$loinhuanthucte = 0;
		$doanhthu = 0;
		$chuathanhtoan = 0;
		while($dulieusale = mysqli_fetch_array($dulieusalea))
		{
           
									
			$sodonhang+=1;
			
			@$totalchiphi = $dulieusale['khach_cuocbay']-($dulieusale['khach_cuocnoidia']+$dulieusale['khach_phuthu']+$dulieusale['khach_thuho']+$dulieusale['khach_phibaohiem']+($dulieusale['vat']*8/100)+$sotienchiphi);
			//$sotiengoc= sum_package_code($dulieusale['kg_dichvu'],$dulieusale['charge_weight'],$rName['city'],$rName['country_id'],$dulieusale['kg_chinhanh'],$conn,$rName['post_code'],$rName['state'],$dulieusale['id_code']);
			
			$sotiengoc = $dulieusale['cuoc_goc'];
			
			$loinhuanthucte += $totalchiphi-$sotiengoc;
			
			if($dulieusale['checkthanhtoan'] != '2')
			{
				$chuathanhtoan += $dulieusale['khach_cuocbay'];
			}				
			$doanhthu += $dulieusale['khach_cuocbay'];
		}
		$retr_arr["sodonhang"] = $sodonhang;
		$retr_arr["tongcannang"] = $tongcannang;
		$retr_arr["loinhuanthucte"] = $loinhuanthucte;
		$retr_arr["doanhthu"] = $doanhthu;
		$retr_arr["chuathanhtoan"] = $chuathanhtoan;
		return $retr_arr;
	}
	}
	
?>