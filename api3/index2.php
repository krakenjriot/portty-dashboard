<?php
	header("Content-Type: application/json; charset=UTF-8");
	include ("../dbconnect.php");
	include ("../functions.php");


	// if(isset($_POST['monitor_name'])){		
		// $monitor_name = $_POST['monitor_name'];		
	// } else {
		// $monitor_name = "";
	// }		

	//https://www.datacamp.com/community/tutorials/making-http-requests-in-python

	////////////////////////////////////////////////
	
	if(isset($_POST['dht']))
	{
		$dht = $_POST['dht'];	
		$dht = substr($dht, 0, -1);			
		$dht_arr = explode("*", $dht);						
		
		//$i = 0;
		foreach ($dht_arr as $value) 
		{
			$dht_arr_arr = explode(",", $value);
			
			if(count($dht_arr_arr) == 3) {
				$bn = $dht_arr_arr[0];
				$temp = $dht_arr_arr[1];
				$hum = $dht_arr_arr[2];				
			} else {
				$bn = "sample";
				$temp = 0;
				$hum = 0;				
			}
			

			
			$sql = "INSERT INTO tbl_dht (board_name, temp, hum)
			VALUES ('$bn', $temp, $hum )";

			if ($conn->query($sql) === TRUE) {
			  //echo "New record created successfully";
			} else {
			  //echo "Error: " . $sql . "<br>" . $conn->error;
			}			
			
			$sql = "UPDATE tbl_boards SET temp = $temp, hum = $hum WHERE board_name  = '$bn' ";

			if ($conn->query($sql) === TRUE) {
			  //echo "Record updated successfully";
			} else {
			  //echo "Error updating record: " . $conn->error;
			}	
		}			
	}

	////////////////////////////////////////////////

	if(isset($_POST['monitor_name'])){		
		$monitor_name = $_POST['monitor_name'];	
		$sql = "SELECT board_name, pins FROM tbl_boards WHERE " . 
		" monitor_name = '$monitor_name' ";
		
		$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
		$count = mysqli_num_rows($result);

		if($count > 0){		
			
			//create an array
			$data = array();
			while($row =mysqli_fetch_assoc($result))
			{
				$data[] = $row;
			}
			
			echo json_encode($data);
		} else {
			echo '[{"error":"1","err_desc":"no_board_found_link_to_monitor"}]';
		}
	} else {
		
		echo '[{"error":"1","err_desc":"no_board_found_link_to_monitor"}]';
		
	}





		$refresh_sec = 0;
		$curr_ts_from_db = 0;
		$current_ts = 0;
		//insert here 
		//get current time stamp from db and add to last stamp
		//get current time stamp from function and add to current stamp

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
		 
        $sql = "UPDATE tbl_monitors SET " . 		 
		" last_ts = $curr_ts_from_db " . 
		" WHERE monitor_name = '$monitor_name' ";
        if ($conn->query($sql) === true);
		

		$current_ts = time();	
		 
        $sql = "UPDATE tbl_monitors SET " . 		 
		" current_ts = $current_ts " . 
		" WHERE monitor_name = '$monitor_name' ";
        if ($conn->query($sql) === true);

		//$alive = file_put_contents("xxx.txt", $current_ts - $curr_ts_from_db);
		
		if(($current_ts - $curr_ts_from_db) > $refresh_sec){
			$sql = "UPDATE tbl_monitors SET " . 		 
			" active = 0 " . 
			" WHERE monitor_name = '$monitor_name' ";
			
		} else {
			$sql = "UPDATE tbl_monitors SET " . 		 
			" active = 1 " . 
			" WHERE monitor_name = '$monitor_name' ";
			
		}
			if ($conn->query($sql) === true);
	
		
    //close the db connection
    mysqli_close($conn);
?>



