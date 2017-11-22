<?php
include("baglanti.php");
$tur_miktar=$_POST['para_miktar'];

$sorgu = mysql_query("SELECT $tur_miktar FROM uye WHERE k_adi='ferhat'");
$row = mysql_fetch_row($sorgu);
$veri_para_miktari = $row[0];

echo $veri_para_miktari; 

mysql_close();
?>