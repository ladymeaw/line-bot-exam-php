<html>
 <head>
  <title>io รายเดือน</title>
 </head>
 <body>
	   <table border=1>
	   <thead>
		<tr>
		 
<?php

$dsn = "pgsql:"
    . "host=ec2-23-21-129-50.compute-1.amazonaws.com;"
    . "dbname=dfd97o1ehpqpnh;"
    . "user=greeojbcxckhvv;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=e3221695be10dad64a793f3949720bc522c81d1f3c71c71d2d53d998b196f5e8";

$db = new PDO($dsn);

	   $dt = date_create();
	   $dt->setTime(0, 0);
			
		//current month	
	   //$month_start = date_format($dt,"Y-m-01 H:i:s");
	   //$month_end = date_format($dt,"Y-m-t H:i:s");
	   
			
	   $month_start = date("Y-m-d H:i:s",strtotime("first day of last month midnight"));
	   $month_end = date("Y-m-d H:i:s",strtotime("last day of last month midnight"));
			
			
	   //echo $month_start.'<br/>';
	   //echo $month_end.'<br/>';

    
	   $where = "where postdate between '" . $month_start . "' and '" .$month_end. "' ";
	   //$query = "select * from IOpoliceNPM ".$where." order by postdate";
	   $query = "SELECT DISTINCT postdate FROM IOpoliceNPM " .$where . " order by postdate";
	   //echo $query.'<br/>';
	   $result = $db->query($query);
	   $postdatearr = $result->fetchAll(PDO::FETCH_COLUMN, 0);
	   //print_r($postdatearr);
	   //echo "<br/><br/>";	   
	   
	   $query = "SELECT DISTINCT stationname FROM IOpoliceNPM " .$where . " order by stationname";
	   //echo $query.'<br/>';
	   $result = $db->query($query);
	   $namearr = $result->fetchAll(PDO::FETCH_COLUMN, 0);
	   //print_r($namearr);
	   //echo "<br/><br/>";
	   	   
	   $array = array();
			$totalio = array();
	   for($i=0; $i<count($postdatearr); $i++){
		   $array[$postdatearr[$i]] = array();
		   $totalio[$postdatearr[$i]] = 0;
		   for($j=0; $j<count($namearr); $j++){
			   $array[$postdatearr[$i]][$namearr[$j]] = 0;
		   }
	   }
	
	   //print_r($array);
	   //echo "<br/><br/>";
			
		

       $query = "select postdate, stationname, numio from IOpoliceNPM ".$where." order by postdate, stationname";	   
	   //echo $query.'<br/>';
	   //echo "<br/><br/>";
	   $result = $db->query($query);    
	   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		   $cmp = strcmp($row["stationname"],"ภ.จว.นครพนม");
		   if($cmp == 0){
			   $num = $row["numio"]*2;
		   }else{
			   $num = $row["numio"];						
		   }
		   $array[$row["postdate"]][$row["stationname"]] += $num;
		   $totalio[$row["postdate"]] += $num;
		
		   /*
		   echo "*********************************************";
		   print_r($row);
		   echo "<br/><br/>";
		   //print_r($array);
		   echo "<br/><br/>";
		   print_r($totalio);
		   echo "<br/><br/>";
		   */
	   }
	   //print_r($array);    	
	   //echo "<br/><br/>";
	   

		echo "<td></td>";
		for($i=0; $i<count($postdatearr); $i++){
			echo "<td>". $postdatearr[$i]."</td>";
		}
		echo "</tr></thead>";
			
		
		echo "<tbody>";
		echo print_r($namearr);
		$stationnamearr = array("ภ.จว.","สภ.กุตาไก้","สภ.ท่าอุเทน","สภ.ธาตุพนม","สภ.นาแก","สภ.นาโดน","สภ.นาทม","สภ.นาหว้า","สภ.บ้านกลาง","สภ.บ้านแพง","สภ.ปลาปาก","สภ.พระซอง","สภ.โพนสวรรค์","สภ.เมืองนครพนม","สภ.เรณูนคร","สภ.วังยาง","สภ.ศรีสงคราม","สภ.หนองบ่อ","สภ.หนองฮี","สภ.หลักศิลา");
        //$namearr is from db	   
		for($j=0; $j<count($stationnamearr); $j++){
			echo "<tr><td>".$stationnamearr[$j]."</td>";
			$indexinarr = array_search($stationnamearr[$j], $namearr);
			echo $indexinarr;
			if(!$indexinarr) {//not found stationname
				for($i=0; $i<count($postdatearr); $i++){
					echo "<td></td>";
				}
			}else{
				for($i=0; $i<count($postdatearr); $i++){
					echo "<td>". $array[$postdatearr[$i]][$namearr[$indexinarr]]."</td>";
				}
			}
			echo "</tr>";
	   	}
		
			echo "<tr><td>รวม</td>";
			for($i=0; $i<count($postdatearr); $i++){
				echo "<td>". $totalio[$postdatearr[$i]]."</td>";
			}
			echo "</tr>";
			//print_r($totalio);
    
	   //$result = $db->query($query);    
	
	   //print_r($result->fetchAll());
	   /*
	   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	   echo "<tr>";
	   echo "<td>" . $row["postdate"] . "</td>";
	   echo "<td>" . htmlspecialchars($row["stationname"]) . "</td>";
	   echo "<td>" . htmlspecialchars($row["numio"]) . "</td>";
	   echo "</tr>";
	   }
	   */
	   $result->closeCursor();

?>
   </tbody>
  </table>
 </body>
</html>
