<?php 
	include ("dbconnect.php");
	include ("functions.php");
		$refresh_sec = 0;
		$curr_ts_from_db = 0;
		$current_ts = 0;
		//insert here 
		//get current time stamp from db and add to last stamp
		//get current time stamp from function and add to current stamp

    $sql0 = "SELECT * FROM tbl_monitors";
    $result0 = mysqli_query($conn, $sql0);         
    $curr_ts_from_db = "";
    $refresh_sec = "";
				 
    if (mysqli_num_rows($result0) > 0)
	{
			// output data of each row
            while ($row = mysqli_fetch_assoc($result0))
            {
				$monitor_name = $row['monitor_name'];	
				//*************************************************		
				//*************************************************		
				//*************************************************
				 $sql = "SELECT * FROM tbl_monitors WHERE monitor_name = '$monitor_name' ";
				 $result = mysqli_query($conn, $sql);         

				 if (mysqli_num_rows($result) > 0)
				 {
					 // output data of each row
					 while ($row = mysqli_fetch_assoc($result))
					 {
						 $curr_ts_from_db = $row['current_ts'];
						 $refresh_sec = $row['refresh_sec'];
					 }
				 }

				$current_ts = time();	
				//$alive = file_put_contents("xxx.txt", $current_ts - $curr_ts_from_db);
				$monitor_stat = false;
				if(($current_ts - $curr_ts_from_db) > $refresh_sec*3){
					$sql7 = "UPDATE tbl_monitors SET " . 		 
					" active = 0 " . 
					" WHERE monitor_name = '$monitor_name' ";
					
					$sql8 = "UPDATE tbl_boards SET " . 		 
					" active = 0 " . 
					" WHERE monitor_name = '$monitor_name' ";	
					$monitor_stat = false;
					if ($conn->query($sql8) === true);
					
				} else {
					$sql7 = "UPDATE tbl_monitors SET " . 		 
					" active = 1 " . 
					" WHERE monitor_name = '$monitor_name' ";
					$monitor_stat = true;
				}
					if ($conn->query($sql7) === true);					
				
				//*************************************************		
				//*************************************************		
				//*************************************************		
            }
    }//
	
	
	echo $current_ts;



    $sql0 = "SELECT * FROM tbl_boards";
    $result0 = mysqli_query($conn, $sql0);         
    $board_name = "";
	$dt_remote1 = "";	
	$dt_remote2 = "";
    if (mysqli_num_rows($result0) > 0)
	{
			// output data of each row
            while ($row = mysqli_fetch_assoc($result0))
            {				
				$board_name = $row['board_name'];
				//$dt_remote1 = 0;
				//$dt_remote2 = 0;
				//*************************************************		
				//*************************************************		
				//*************************************************
				 $sql1 = "SELECT * FROM tbl_dht WHERE board_name = '$board_name' ORDER BY id DESC LIMIT 1 "; 
				 $result1 = mysqli_query($conn, $sql1);         
				 
				 if (mysqli_num_rows($result1) > 0)
				 {
					 // output data of each row
					 while ($row = mysqli_fetch_assoc($result1))
					 {
						$dt_remote1 = $row['dt_remote']; 
					 }
				 }

				 $sql2 = "SELECT * FROM tbl_dht WHERE board_name = '$board_name' ORDER BY id DESC LIMIT 1,2 ";
				 $result2 = mysqli_query($conn, $sql2);         
				 
				 if (mysqli_num_rows($result2) > 0)
				 {
					 // output data of each row
					 while ($row = mysqli_fetch_assoc($result2))
					 {
						$dt_remote2 = $row['dt_remote']; 
					 }
				 }
				 
				 if(($dt_remote1 == $dt_remote2) || $monitor_stat == false){					
					$sql9 = "UPDATE tbl_boards SET " . 		 
					" active = 0 " . 
					" WHERE board_name = '$board_name' ";					 
				 } else {					
					$sql9 = "UPDATE tbl_boards SET " . 		 
					" active = 1 " . 
					" WHERE board_name = '$board_name' ";					 
				 }	 				
				 if ($conn->query($sql9) === true);	
			}
	} 




    $sql = "SELECT * FROM tbl_pins";
    $result = mysqli_query($conn, $sql);         
    $pin_mode = "";
    if (mysqli_num_rows($result) > 0)
	{
			// output data of each row
            while ($row = mysqli_fetch_assoc($result))
            {				
				$id = $row['id'];
				$pin_mode = $row['pin_mode'];
				$board_name = $row['board_name'];
				/******************************************/		
				/******************************************/
				/* $sql2 = "SELECT * FROM tbl_boards WHERE board_name = '$board_name' ";
				$result2 = mysqli_query($conn, $sql2);         
				
				if (mysqli_num_rows($result2) > 0)
				{
						// output data of each row
						while ($row2 = mysqli_fetch_assoc($result2))
						{				
							$monitor_name = $row2['monitor_name'];	
						}
				}										
				
				
				$sql1 = "SELECT * FROM tbl_monitors WHERE monitor_name = '$monitor_name' ";
				$result1 = mysqli_query($conn, $sql1);         
				
				if (mysqli_num_rows($result1) > 0)
				{
						// output data of each row
						while ($row1 = mysqli_fetch_assoc($result1))
						{				
							$monitor_timezone = $row1['monitor_timezone'];	
						}
				} else {
							$monitor_timezone = "Asia/Riyadh";	
				} */
				
				/******************************************/		
				/******************************************/
				$monitor_timezone = get_tz($board_name);
				date_default_timezone_set($monitor_timezone);
				//file_put_contents("test.txt", $monitor_timezone );	
				if($pin_mode == "set_date_time"){
					
					if((time() > strtotime($row['startdt'])) &&
						(time() < strtotime($row['stopdt'])) ){							
						/****************************************/
						$sql0 = "UPDATE tbl_pins SET " . 		 
						" active = 1 " . 
						" WHERE id = $id ";
						$conn->query($sql0);
						/****************************************/	
						//file_put_contents("test.txt", "active" );	
					} else {
						/****************************************/
						$sql0 = "UPDATE tbl_pins SET " . 		 
						" active = 0 " . 
						" WHERE id = $id ";
						$conn->query($sql0);
						/****************************************/
	
						/****************************************/								
						//file_put_contents("test.txt", "inactive" );
					}						
				}//set_date_time							
				/******************************************/
				/******************************************/
				/******************************************/
				/******************************************/
			
				
				/******************************************/
			if($pin_mode == "set_filter"){
					
				date_default_timezone_set($monitor_timezone);
					
				$startdt = $row['startdt'];	
				$stopdt = $row['stopdt'];	
				
				//start d/t
				$h0 = intval(date("H", strtotime($startdt)));		
				$m0 = intval(date("i", strtotime($startdt)));		
				$s0 = intval(date("s", strtotime($startdt)));
				
				//stop d/t
				$h1 = intval(date("H", strtotime($stopdt)));		
				$m1 = intval(date("i", strtotime($stopdt)));		
				$s1 = intval(date("s", strtotime($stopdt)));

				//current d/t
				$h2 = intval(date("H"));		
				$m2 = intval(date("i"));		
				$s2 = intval(date("s"));
				
				if(($h2 >= $h0 && $h2 <= $h1)){
					//file_put_contents("testH.txt", "YES $h0 $h2 ". time() );	
					$ok_h = 1;
				} else {
					//file_put_contents("testH.txt", "NO $h0 $h2 ". time() );	
					$ok_h = 0;
				}					
				
				
				
				//file_put_contents("testX.txt", "$h0 $h2 " );	
				
				if(($m2 >= $m0 && $m2 <= $m1)){
					//file_put_contents("testM.txt", "YES $m0" );
					//file_put_contents("testM.txt", "TRUE $m0" );						
					$ok_m = 1;
				} else {
					//file_put_contents("testM.txt", "NO" );	
					//file_put_contents("testM.txt", "FALSE $m0" );
					$ok_m = 0;
				}					
				
				
				
				//if($s0 != 0){
				if(($s2 >= $s0 && $s2 <= $s1)){
					//file_put_contents("testS.txt", "YES $s0 $s1 $s2" );	
					$ok_s = 1;
				} else {
					//file_put_contents("testS.txt", "NO $s0 $s1 $s2" );	
					$ok_s = 0;
				}
				
				if($row['hour_box'] == 1 ){ $ok_h = 1; } 
				if($row['min_box'] == 1){ $ok_m = 1; } 	
				if($row['sec_box'] == 1) { $ok_s = 1; } 
				
				//file_put_contents("testH.txt", $row['hour_box'] );
				
				/* file_put_contents("testH.txt", "XXXX $h0 $h1 $h2 $ok_h" );	
				file_put_contents("testM.txt", "XXXX $m0 $m1 $m2 $ok_m" );	
				file_put_contents("testS.txt", "XXXX $s0 $s1 $s2 $ok_s" );	 */
				
					if(($ok_h==1) && ($ok_m==1) && ($ok_s==1) ){							
						////////////////////////////////////////////////////////
						$sql0 = "UPDATE tbl_pins SET " . 		 
						" active = 1 " . 
						" WHERE id = $id ";
						$conn->query($sql0);
						////////////////////////////////////////////////////////	
						//file_put_contents("testMATCH.txt", "active" );		
					} else {
						////////////////////////////////////////////////////////
						$sql0 = "UPDATE tbl_pins SET " . 		 
						" active = 0 " . 
						" WHERE id = $id ";
						$conn->query($sql0);
						////////////////////////////////////////////////////////								
						//file_put_contents("testMATCH.txt", "inactive" );						
					}// 

					
							
				

					
			}//set_match
				/******************************************/
				
				if($pin_mode == "set_start_stop"){				
					/******************************************/
					$file = 'test.txt';			
					/******************************************/						
 					if( 
					((time() > strtotime($row['startdt'])) &&						
					(time() < strtotime($row['stopdt'])))  
					|| (time() > strtotime($row['startdt'])) //just in case lost timing						
					  )
					{		
								if($row['active'] == 1 ){
									$startdt = $row['stopdt'];
									//$startdt = date("Y-m-d H:i:s");
									$stopdt = date("Y-m-d H:i:s", strtotime($startdt) + $row['dur_stop']);		
								
									$sql0 = "UPDATE tbl_pins SET " . 		 
									" active = 0," . 
									" startdt = '$startdt'," . 								
									" stopdt = '$stopdt' " . 							
									" WHERE id = $id ";
									$conn->query($sql0); 
									/***********************************************/									
									$message = date("Y-m-d H:i:s") . " OFF $startdt/$stopdt";
									file_put_contents($file, PHP_EOL . $message, FILE_APPEND);							
									/***********************************************/									
								}
								if($row['active'] == 0 ){
									$startdt = $row['stopdt'];
									//$startdt = date("Y-m-d H:i:s");
									$stopdt = date("Y-m-d H:i:s", strtotime($startdt) + $row['dur_start']);		
								
									$sql0 = "UPDATE tbl_pins SET " . 		 
									" active = 1," . 
									" startdt = '$startdt'," . 								
									" stopdt = '$stopdt' " . 							
									" WHERE id = $id ";
									$conn->query($sql0); 	
									/***********************************************/									
									$message = date("Y-m-d H:i:s") . " ON $startdt/$stopdt";
									file_put_contents($file, PHP_EOL . $message, FILE_APPEND);							
									/***********************************************/	
								}	
							}
					////////////////////////////////////////////////////////////////////

					////////////////////////////////////////////////////////////////////		
				}//set_start_stop				
				/******************************************/
				/******************************************/
				update_pins($board_name);	
			}
	} 
	
	//file_put_contents("time.txt", time() );	
	//file_put_contents("testxxxx.txt",$id);		

?>