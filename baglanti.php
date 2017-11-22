<?php
	if(!@$baglan=mysql_connect("localhost","root",""))
	{
		die("MySql'e Bağlanamadı".mysql_error());
	}//mysql bağlantısı
	if(!@ mysql_select_db("kasa",$baglan))
	{
		die("veritabanı Bağlanamadı".mysql_error());
	}//veritabanı bağlantısı
?>