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
				 
/* 				$sql = "UPDATE tbl_monitors SET " . 		 
				" last_ts = $curr_ts_from_db " . 
				" WHERE monitor_name = '$monitor_name' ";
				if ($conn->query($sql) === true); */
				

				$current_ts = time();	
				 
/* 				$sql = "UPDATE tbl_monitors SET " . 		 
				" current_ts = $current_ts " . 
				" WHERE monitor_name = '$monitor_name' ";
				if ($conn->query($sql) === true); */

				//$alive = file_put_contents("xxx.txt", $current_ts - $curr_ts_from_db);
				
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
    }
	
	
	echo $current_ts;









?>