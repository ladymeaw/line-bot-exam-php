<?php

$str = "ภ.จว.นครพนม\nประจำวันที่ 13 มิ.ย. 2561\nยอดรวม  10  เรื่อง";

$s1 = strpos($str, "ยอดรวม") + strlen("ยอดรวม");
$s2 = strpos($str, "เรื่อง", $s1);
$str2 = substr($str, $s1, $s2-$s1);
echo $str2;
echo "<br/><br/><br/>";
/*
$num = preg_replace("/[^0-9]/", '', $str2);
echo $num;
echo "<br/><br/><br/>";
$numio = $num[0];

echo $numio;
echo "<br/><br/><br/>";
*/




?>
