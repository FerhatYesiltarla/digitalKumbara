<?php
	echo '<!DOCTYPE html>
	<html>
		<style type="text/css">
			#dikkat_body
			{	
			background-size: 100% 100%; 
			width: 100%;
			height:100%;
			margin:0;
			}
			#dikkat_orta
			{
			width: 300px;
			height: 300px;
			margin-left: -128px;
			margin-top: -128px;
			position: absolute;
    		top: 50%;
    		left: 50%;
    		text-align:center;
			}
		</style>
	<body style="background-color:#236EBB">
		<div id=dikkat_body">
			<div id="dikkat_orta">
				<img src="img/dikkat.png"/><br/>
				Kullanıcı Girişi Yapmadan Erişim Sağlanamaz.<br/>
				İndex Sayfasına Yönlendiriliyorsunuz...
			</div>
		</div>
		
	</body>
	</html>';	
	header("refresh:3; url=index.html");
?>