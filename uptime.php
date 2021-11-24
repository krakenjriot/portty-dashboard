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
				$sql2 = "SELECT * FROM tbl_boards WHERE board_name = '$board_name' ";
				$result2 = mysqli_query($conn, $sql2);         
				//$pin_mode = "";
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
				//$pin_mode = "";
				if (mysqli_num_rows($result1) > 0)
				{
						// output data of each row
						while ($row1 = mysqli_fetch_assoc($result1))
						{				
							$monitor_timezone = $row1['monitor_timezone'];	
						}
				} else {
							$monitor_timezone = "Asia/Riyadh";	
				}
				
				/******************************************/		
				/******************************************/
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
						//file_put_contents("test.txt", "inactive" );
					}						
				}							
				/******************************************/
				/******************************************/
				/******************************************/
				/******************************************/
				if($pin_mode == "set_time"){
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
						//file_put_contents("test.txt", "inactive" );
					}												
				}
				/******************************************/
							
				/******************************************/
				if($pin_mode == "set_start_stop"){				
						
							if((time() > strtotime($row['startdt'])) &&
								(time() < strtotime($row['stopdt'])) ){
								
								if($row['active'] == 1 ){
									$startdt = $row['stopdt'];
									$stopdt = date("Y-m-d H:i:s", strtotime($startdt) + $row['dur_stop']);		
								
									$sql0 = "UPDATE tbl_pins SET " . 		 
									" active = 0," . 
									" startdt = '$startdt'," . 								
									" stopdt = '$stopdt' " . 							
									" WHERE id = $id ";
									$conn->query($sql0); 															
								}
								if($row['active'] == 0 ){
									$startdt = $row['stopdt'];
									$stopdt = date("Y-m-d H:i:s", strtotime($startdt) + $row['dur_start']);		
								
									$sql0 = "UPDATE tbl_pins SET " . 		 
									" active = 1," . 
									" startdt = '$startdt'," . 								
									" stopdt = '$stopdt' " . 							
									" WHERE id = $id ";
									$conn->query($sql0); 															
								}	
							}
				}												
				
				/******************************************/
				/******************************************/
				update_pins($board_name);	
			}
	} 
	
	//file_put_contents("time.txt", time() );	
	//file_put_contents("testxxxx.txt",$id);		

?>