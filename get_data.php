<?php
   include ("session.php");
   include ("dbconnect.php");
   include ("functions.php");
//$board_name = "myboard1";
         $sql = "SELECT filtered_dht FROM tbl_settings ";
         $result = mysqli_query($conn, $sql);         
         $board_name_monitored = "";
         if (mysqli_num_rows($result) > 0)
         {
             // output data of each row
             while ($row = mysqli_fetch_assoc($result))
             {
                 $board_name_monitored = $row['filtered_dht'];
             }
         }	


//date_default_timezone_set("Asia/Riyadh");


// [ { plot0 : 6.18769855340767450,"scale-x": "15:4:30", } ]


					
    $sql = "SELECT * FROM tbl_boards WHERE board_name = '$board_name_monitored'  ";
    $result = mysqli_query($conn, $sql);                        
    if (mysqli_num_rows($result) > 0) 
    {
		// output data of each row
        while($row = mysqli_fetch_assoc($result)) 
		{
			$active =  $row["active"];
		}
    } 
				
	
	

//create server list
$sql = "SELECT * FROM tbl_dht WHERE board_name = '$board_name_monitored' ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {

        $id = $row['id'];
        $temp = $row['temp'];
        $hum = $row['hum'];
        $time = strtotime($row['dt']);
        $dt = $row['dt'];
        //$dt_remote = $row['dt_remote'];
        //$y = date("Y",$time); // year
        //$mo = date("m",$time); //month
        //$d = date("d",$time); //day
        $h = date("H", $time); // hour
        $m = date("i", $time); //minute
        $s = date("s", $time); //minute
        $tm = "$h:$m:$s";
    }
}

	if($active == 0){
		$temp = 0;
		$hum = 0;		
	}

//echo  $temp."dddd";
//echo "[ { plot0 : ".$temp.",'scale-x': '{'transform':{'type':'date','all':'".$tm."'}}', } ]";
//echo '[ { plot0 : 16.90435793947980,"scale-x": "16:15:40", plot1 : 15.90435793947980,"scale-x": "16:15:40"} ]';
//echo '[ { plot0 : '.$temp.',"scale-x": "'.$tm.'", plot1 : '.$hum.',"scale-x": "'.$tm.'"} ]';
//echo '[ { plot0 : '.$temp.',"scale-x": "1", plot1 : '.$hum.',"scale-x": "1"} ]';
//echo '[ { plot0 : '.$temp.', plot1 : '.$hum.'} ]';
echo '[ { plot0 : ' . $temp . ',"scale-x":"' . $tm . '", plot1 : ' . $hum . ',"scale-x": "' . $tm . '"} ]';
//echo '[ { plot0 : '. $temp .',"scale-x":"'. date('H:i:s') .'", plot1 : '. $hum .',"scale-x": "'. date('H:i:s') .'"} ]';
//[ { plot0 : 30,'scale-x': '{'transform':{'type':'date','all':'02:54:23'}}', } ]
//$dt = "02:54:23";
//echo '[ { plot0 : '.$temp.',"scale-x":{"values":["'.$dt.'"]} ,} ]';

?>



<?php
//echo '[ { plot0 : 16.90435793947980,"scale-x": "16:15:40", } ]';
/*

"scale-x":{  
    "values":["January","February","March","April","May",  
        "June","July","August","September",  
        "October","November","December"],  
}, 

		"scale-x":{
		  "transform":{
			"type":"date",
			"all":"%d %M<br />%h:%i %A"
		  }
		},			
		
*/

//echo "	[{	  plot0: 51,	  scale-x: '13:32:58'	}]";



?>
