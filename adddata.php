<?php
$dsn = "pgsql:"
    . "host=ec2-23-21-129-50.compute-1.amazonaws.com;"
    . "dbname=dfd97o1ehpqpnh;"
    . "user=greeojbcxckhvv;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=e3221695be10dad64a793f3949720bc522c81d1f3c71c71d2d53d998b196f5e8";
$db = new PDO($dsn);
$query = "insert into IOpoliceNPM values (2, "nawa", "2018-06-10",5)";
$result = $db->query($query);    
    print_r($result->fetchAll());
    

$result->closeCursor();
?>
  
