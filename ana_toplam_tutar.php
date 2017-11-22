<?php
include("baglanti.php");
$tur_miktar=$_POST['para_miktar'];
$ucret=$_POST['para_tutar'];
$toplam=0;

for($i=0;$i<10;$i++)
{
	$sorgu = mysql_query("SELECT $tur_miktar[$i] FROM uye WHERE k_adi='ferhat'");
	$row = mysql_fetch_row($sorgu);
	$veri_para_miktari = $row[0];
    $toplam=$toplam+round(($veri_para_miktari*$ucret[$i]),2);
}
echo $toplam; 

mysql_close();
?>