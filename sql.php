<?php
	include("baglanti.php");
	
	$bozuk_or_kagit=$_POST['turu'];
	$para_tutar=$_POST['tutar'];
	$miktar=$_POST['miktar'];
	$ekle_or_cikar=$_POST['islem_turu'];

	
	$para_turu="";
	$veri_para_miktari=0;
	if ($bozuk_or_kagit=="true")
	{
		if ($para_tutar=="01")
			$para_turu="bes_tl";
		elseif($para_tutar=="02")
			$para_turu="on_tl";
		elseif($para_tutar=="03")
			$para_turu="y_tl";
		elseif($para_tutar=="04")
			$para_turu="elli_tl";
		elseif($para_tutar=="05")
			$para_turu="yuz_tl";
	}
	else
	{
		if ($para_tutar=="01")
			$para_turu="bes_krs";
		elseif($para_tutar=="02")
			$para_turu="on_krs";
		elseif($para_tutar=="03")
			$para_turu="y_bes_krs";
		elseif($para_tutar=="04")
			$para_turu="elli_krs";
		elseif($para_tutar=="05")
			$para_turu="bir_lira";
	}

	$sorgu = mysql_query("SELECT $para_turu FROM uye WHERE k_adi='ferhat'");
	$row = mysql_fetch_row($sorgu);
	$veri_para_miktari = $row[0];

	if ($ekle_or_cikar=='e')
	{
		$veri_para_miktari=$veri_para_miktari+$miktar;
	}
	else
	{
		if ($veri_para_miktari>=$miktar)
		{
			$veri_para_miktari=$veri_para_miktari-$miktar;
			echo 1;
		}	
		else
			echo 0;	
	}
	
	mysql_query("UPDATE uye set $para_turu=$veri_para_miktari");
	mysql_close();
?>