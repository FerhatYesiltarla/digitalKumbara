<?php
include("baglanti.php");

$sql=mysql_query("Select * from paralar");
while ($kayit=mysql_fetch_array($sql)) 
{
	echo $kayit["bes_krs"]." Tane";
	echo "<br>";
	echo $kayit["bes_krs"]*0.5 ." Kuruş";
}

echo "string";
?>

