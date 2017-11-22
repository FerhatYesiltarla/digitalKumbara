<?php
	include("baglanti.php");
	session_start();

	$gelen_kadi=$_POST['username'];
	$gelen_sifre=$_POST['password'];
	
	$sorgu=mysql_query("select * from uye where k_adi='$gelen_kadi' and sifre='$gelen_sifre'");
	if(mysql_num_rows($sorgu)>0)
	{
		echo "1";		
		$_SESSION['oturum']=true;
		$_SESSION['username']=$gelen_kadi;
	}
	else
		echo "0";
			
	mysql_close();
?>