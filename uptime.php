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
    //$curr_ts_from_db = "";
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
				 $curr_ts_from_db = "";
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
				$alive = file_put_contents("xxx.txt", $current_ts - $curr_ts_from_db);
				
				if(($current_ts - $curr_ts_from_db) > $refresh_sec*3){
					$sql = "UPDATE tbl_monitors SET " . 		 
					" active = 0 " . 
					" WHERE monitor_name = '$monitor_name' ";
					
				} else {
					$sql = "UPDATE tbl_monitors SET " . 		 
					" active = 1 " . 
					" WHERE monitor_name = '$monitor_name' ";
					
				}
					if ($conn->query($sql) === true);
				
				//*************************************************		
				//*************************************************		
				//*************************************************		
            }
    }//
	
	
	echo $current_ts;



    $sql0 = "SELECT * FROM tbl_boards";
    $result0 = mysqli_query($conn, $sql0);         
    $board_name = "";
    if (mysqli_num_rows($result0) > 0)
	{
			// output data of each row
            while ($row = mysqli_fetch_assoc($result0))
            {				
				$board_name = $row['board_name'];
				//*************************************************		
				//*************************************************		
				//*************************************************
				 $sql1 = "SELECT * FROM tbl_dht WHERE board_name = '$board_name' ORDER BY id DESC LIMIT 1 "; 
				 $result1 = mysqli_query($conn, $sql1);         
				 //$curr_ts_from_db = "";
				 if (mysqli_num_rows($result1) > 0)
				 {
					 // output data of each row
					 while ($row = mysqli_fetch_assoc($result1))
					 {
						$dt_remote1 = $row['dt_remote']; 
					 }
				 }

				 $sql2 = "SELECT * FROM tbl_dht WHERE board_name = '$board_name' ORDER BY id DESC LIMIT 1,1 ";
				 $result2 = mysqli_query($conn, $sql2);         
				 //$curr_ts_from_db = "";
				 if (mysqli_num_rows($result2) > 0)
				 {
					 // output data of each row
					 while ($row = mysqli_fetch_assoc($result2))
					 {
						$dt_remote2 = $row['dt_remote']; 
					 }
				 }
				 //file_put_contents("dt_remote1.txt", $dt_remote1);
				 //file_put_contents("dt_remote2.txt", $dt_remote2);
				 
				 
				 if($dt_remote1 == $dt_remote2){					
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




/*  $sql0 = "SELECT * FROM tbl_boards";
    $result0 = mysqli_query($conn, $sql0);         
    $board_name = "";
    if (mysqli_num_rows($result0) > 0)
	{
			// output data of each row
            while ($row = mysqli_fetch_assoc($result0))
            {				
				$board_name = $row['board_name'];
				//*************************************************		
				//*************************************************		
				//*************************************************
				 $sql = "SELECT * FROM tbl_monitors WHERE monitor_name = '$monitor_name' ";
				 $result = mysqli_query($conn, $sql);         
				 $curr_ts_from_db = "";
				 if (mysqli_num_rows($result) > 0)
				 {
					 // output data of each row
					 while ($row = mysqli_fetch_assoc($result))
					 {
						 
					 }
				 }				 
			}
	} */




?>