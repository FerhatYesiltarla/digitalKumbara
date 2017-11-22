<?php
session_start();
include("baglanti.php");



/*if (!isset($_SESSION['oturum']))
{
	header("refresh:0; url=sifresiz_giris.php");
	exit();
}*/
?>
<html>
<head>
<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css" type="text/css" />
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

 	<script src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script> <!--Effect İçin-->


   	<script type="text/javascript">
   		$(document).ready(function()
   		{ 

   			var kagit=false; //Bozuk Para aktif
   			var resim_ad="";

   			ana_toplam();

   			goster("01","bes_krs",kagit);
   			goster("02","on_krs",kagit);
   			goster("03","y_bes_krs",kagit);
   			goster("04","elli_krs",kagit);
   			goster("05","bir_lira",kagit);

   			toplam("01");
   			toplam("02");
   			toplam("03");
   			toplam("04");
   			toplam("05");
   			$("#ana_para_miktar_bilgi").hide();
   			$("#ana_para_miktar_bilgi").show('slide', {direction : 'up'}, 1000); 

   			$("#tur_kagit").hide();
			var uzun=500;
   			var sure;
			$("img").on('mousedown',function(e){
   				sure= new Date().getTime();
   			});
   			$("img").on('mouseleave',function(e){
   				sure=0;   				
   			});
   			$("img").on('mouseup', function( e ){
   				var tiklanan_id=$(this).attr("id");
   				var id_numara=tiklanan_id.substring(6, 8); 
   				if (tiklanan_id.substring(4,5)=="e")
   				{
   					if (new Date().getTime() >= (sure + uzun))
        			{
           			var miktar = prompt("Lütfen Eklenecek Miktarı Girin.", "");
   						 if (miktar != null)
   						 {
        					for (var i = 0; i < miktar; i++)
        					{
        						$("#para_goster_"+id_numara).append("<li><img src='img/"+resim_ad+".png' width='50'/></li>"); 
        					}
        					$.ajax({
   								type:"POST",
   								url:"sql.php",
   								data:{
   									'turu':kagit,
   									'tutar':id_numara,	
   									'miktar':miktar,
   									'islem_turu':'e'
   									},
   								success:function()
   									{
   										toplam(id_numara);	
   										ana_toplam();		
   									}
   								});
    					 } 

        			}
        			else
        			{     
        				$("#para_goster_"+id_numara).append("<li><img src='img/"+resim_ad+".png' width='50'/></li>"); 
   						$.ajax({
   							type:"POST",
   							url:"sql.php",
   							data:{
   								'turu':kagit,
   								'tutar':id_numara,
   								'miktar':"1",
   								'islem_turu':'e'   								
   							},
   							success:function()
   							{
   							toplam(id_numara);	
   							ana_toplam();	
   							}
   						});


   					
        			}
   				}
   				else
   				{
   					if (new Date().getTime() >= (sure + uzun))
        			{
           			var miktar = prompt("Lütfen Çıkarılacak Miktarı Girin.", "");
   						 if (miktar != null)
   						 {
        					$.ajax({
   							type:"POST",
   							url:"sql.php",
   							data:{
   								'turu':kagit,
   								'tutar':id_numara,
   								'miktar':miktar,
   								'islem_turu':'c'
   							},
   							success:function(data)
   							{
   								
   								if (data==0)
   								{
   									alert("Mevcut Bakiyeden Fazla Giriş Yaptınız.\nSilme İşlemi Gerçekleşemedi.");
   								}
   								else
   								{
   									for (var i = 0; i < miktar; i++)
        							{
        								$("#para_goster_"+id_numara+ " li:last").remove(); 
        							}
   									toplam(id_numara);	
   									ana_toplam();
   								}
   							}
   							});
    					 } 
        			}
        			else
        			{     
        				$("#para_goster_"+id_numara+ " li:last").remove(); 
        				$.ajax({
   							type:"POST",
   							url:"sql.php",
   							data:{
   								'turu':kagit,
   								'tutar':id_numara,
   								'miktar':"1",
   								'islem_turu':'c'
   							},
   							success:function()
   							{
   							toplam(id_numara);	
   							ana_toplam();	
   							}
   					
   						});

        			}
   				}
    		});

   			$("#img_up").click(function(){
   				kagit=false;
   				var p_deger="";
   				for (var i = 1; i <=5; i++)
        					{
        						if (i==1)
        						{
        							goster("01","bes_krs",kagit);
        							toplam("01");
        						}
        						else if (i==2)
        						{
        							goster("02","on_krs",kagit);
        							toplam("02");
        						}
        						else if (i==3)
        						{
        							goster("03","y_bes_krs",kagit);
        							toplam("03");
        						}
        						else if (i==4)
        						{
        							goster("04","elli_krs",kagit);
        							toplam("04");
        						}
        						else if (i==5)
        						{
        							goster("05","bir_lira",kagit);
        							toplam("05");
        						}
        					}
   				$("#tur_kagit").hide('slide',{direction:'up'},500,function(){
   					$("#tur_bozuk").show('slide', {direction: 'down'}, 500);	
   				});
   				

   				$("#pmb_text_01, #pmb_text_02, #pmb_text_03, #pmb_text_04, #pmb_text_05").slideToggle(500, function() 
   				{
    				$("#pmb_text_01").html("05 Kuruş");
    				$("#pmb_text_02").html("10 Kuruş");
    				$("#pmb_text_03").html("25 Kuruş");
    				$("#pmb_text_04").html("50 Kuruş");
    				$("#pmb_text_05").html("1 TL");
    				$(this).slideToggle(500);
				});
				$("#toplam_tutar_01, #toplam_tutar_02, #toplam_tutar_03, #toplam_tutar_04, #toplam_tutar_05").slideToggle(500, function() 
   					{
   						$(this).slideToggle(500);	
   					});
				
   				
   			});
			function toplam(div_id)
			{
				var para="";
				var para_deger=0;
				if(kagit==true)
				{
					krs_or_tl="TL";

					if (div_id=="01")
					{
						para="bes_tl";
						para_deger=5;
					}
					else if(div_id=="02")
					{
						para="on_tl";
						para_deger=10;
					}
					else if(div_id=="03")
					{
						para="y_tl";
						para_deger=20;
					}
					else if(div_id=="04")
					{
						para="elli_tl";
						para_deger=50;
					}
					else if(div_id=="05")
					{
						para="yuz_tl";
						para_deger=100;
					}
				}
				else
				{
					krs_or_tl="Kuruş";

					if (div_id=="01")
					{
						para="bes_krs";
						para_deger=0.050;
					}
					else if(div_id=="02")
					{
						para="on_krs";
						para_deger=0.10;
					}
					else if(div_id=="03")
					{
						para="y_bes_krs";
						para_deger=0.25;
					}
					else if(div_id=="04")
					{
						para="elli_krs";
						para_deger=0.50;
					}
					else if(div_id=="05")
					{
						para="bir_lira";
						para_deger=1;
					}
				}
				$.ajax({
   					type:"POST",
   					url:"miktar_sql.php",
   					data:{
   							'para_miktar':para
   						},
   					success:function(data)
   						{
   							if((data*para_deger).toFixed(2)>=1.00)
   							{
   								krs_or_tl="TL";
   								$("#toplam_tutar_"+div_id).html("Toplam: "+(data*para_deger).toFixed(2)+" "+krs_or_tl);
   							}
   							else
   								$("#toplam_tutar_"+div_id).html("Toplam: "+(data*para_deger).toFixed(2)+" "+krs_or_tl);	
   					 	}
   					});	
			}
			function ana_toplam()
			{
				var paralar=['bes_krs','on_krs','y_bes_krs','elli_krs','bir_lira','bes_tl','on_tl','y_tl','elli_tl','yuz_tl'];
				var tutar=[0.050,0.10,0.25,0.50,1,5,10,20,50,100];
					$.ajax({
   					type:"POST",
   					url:"ana_toplam_tutar.php",
   					data:{
   							'para_miktar':paralar,
   							'para_tutar':tutar
   						},
   					success:function(data)
   						{
   							if (data>=1.00)
   								$("#ttb_text").html("Toplam: "+data+" TL");
   							else
   								$("#ttb_text").html("Toplam: "+data+" Kuruş");
   					 	}
   					});	
			}
			function goster(div_id,para,k_or_b)
			{
				
				if(k_or_b==true)
				{
					resim_ad="k_para";
				}
				else
					resim_ad="b_para";
				$("#para_goster_"+div_id+" li").empty();
				$.ajax({
   					type:"POST",
   					url:"miktar_sql.php",
   					data:{
   							'para_miktar':para
   						},
   					success:function(data)
   						{
   							for (var j = 1; j <= data; j++)
   								{
   									$("#para_goster_"+div_id).append("<li><img src='img/"+resim_ad+".png' width='50'/></li>"); 
   								}
   					 	}
   					});	
			}
	
   			$("#img_down").click(function(){ 
   				kagit=true; 
   				var p_deger="";
   				for (var i = 1; i <=5; i++)
        					{
        						if (i==1)
        						{
        							goster("01","bes_tl",kagit);
        							toplam("01");
        						}
        						else if (i==2)
        						{
        							goster("02","on_tl",kagit);
        							toplam("02");
        						}
        						else if (i==3)
        						{
        							goster("03","y_tl",kagit);
        							toplam("03");
        						}
        						else if (i==4)
        						{
        							goster("04","elli_tl",kagit);
        							toplam("04");
        						}
        						else if (i==5)
        						{
        							goster("05","yuz_tl",kagit);
        							toplam("05");
        						}
        					}

   				$("#tur_bozuk").hide('slide',{direction:'down'},500,function(){
   					$("#tur_kagit").show('slide', {direction: 'up'}, 500);	
   				});	
   				
   				

   				$("#pmb_text_01, #pmb_text_02, #pmb_text_03, #pmb_text_04, #pmb_text_05").slideToggle(500, function() 
   				{
    				$("#pmb_text_01").html("5 TL");
    				$("#pmb_text_02").html("10 TL");
    				$("#pmb_text_03").html("20 TL");
    				$("#pmb_text_04").html("50 TL");
    				$("#pmb_text_05").html("100 TL");
    				$(this).slideToggle(500);
				});
				$("#toplam_tutar_01, #toplam_tutar_02, #toplam_tutar_03, #toplam_tutar_04, #toplam_tutar_05").slideToggle(500, function() 
   					{
   						$(this).slideToggle(500);	
   					});
   			});
   			$("#img_log_out").click(function()
   			{
   				$("#ana_para_miktar_bilgi").slideUp(1000);
   				$("#body_admin").hide(1000);
    			window.setTimeout(function()
    			{ window.location="cikis.php"},2000);    			
   			});
   			$("#bkk_text").effect("slide", {times:3}, 2000);
   			$("#ttb_text").effect("slide",{times:3},2000);
   		});
   	</script>
   	<style type="text/css">

 		#img_e_01
 		{
 			width: 60;
 			margin-top: 5;
 			margin-left: 35;
 		}
 		#img_c_01
 		{
 			width: 60;
 		}
 		#img_e_02, #img_e_03, #img_e_04, #img_e_05
 		{
 			width: 60;
 			margin-top: 5;
 			margin-left: 35;
 		}
 		#img_c_02, #img_c_03, #img_c_04, #img_c_05
 		{
 			width: 60;
 		}

 		#img_down, #img_up
 		{
 			float: right;
 			width: 30;
 		}
 		#tur_bozuk
 		{
 			width: 200;
 			float: left;
 		}
 		#tur_kagit
 		{
 			width: 200;
 			float: left;
 		}
 		
 		
   	</style>
</head>
<body>
	<div id="body_admin">		
		<div id="ust_bar">
			<div id="ust_bar_icerik">
				<div id="uye_ad_soyad"><font>Ferhat Yeşiltarla</font></div>
				<div id="ayar_cikis_logo">
					<img src="img/settings.png" id="img_settings" onmouseover="this.src='img/over_settings.png'" onmouseout="this.src='img/settings.png'"/>
					<img src="img/log_out.png" id="img_log_out" onmouseover="this.src='img/over_log_out.png'" onmouseout="this.src='img/log_out.png'" />				
				</div>
			</div>
		</div>
		<div id="ana_bozuk_kagit_bilgi">
			<div id="bozuk_kagit_bilgi">
				<div id="bkk_text">			
					<div id="tur_bozuk">Bozuk Paralar<img src="img/down.png" id="img_down" onmouseover="this.src='img/over_down.png'" onmouseout="this.src='img/down.png'"/></div>
					<div id="tur_kagit">Kağıt Paralar<img src="img/up.png" id="img_up" onmouseover="this.src='img/over_up.png'" onmouseout="this.src='img/up.png'"/></div>
					
				</div>
			</div>
		</div>
		<div id="ana_para_miktar_bilgi">
			<div id="para_miktar_bilgi_01">
				<div id="pmb_text_01">05 Kuruş</div>
				<div id="para_ekle_cikar_01">					
					<img src="img/ekle.png" id="img_e_01" onmouseover="this.src='img/over_ekle.png'" onmouseout="this.src='img/ekle.png'"/>
					<img src="img/cikar.png" id="img_c_01" onmouseover="this.src='img/over_cikar.png'" onmouseout="this.src='img/cikar.png'"/>
				</div>
				<div id="tarih_saat_01">
					<ul id="para_goster_01">

					</ul>				
				</div>
				<div id="toplam_tutar_01">

				</div>				
			</div>
			<div id="para_miktar_bilgi_02">
				<div id="pmb_text_02">10 Kuruş</div>
				<div id="para_ekle_cikar_01">
					<img src="img/ekle.png" id="img_e_02" onmouseover="this.src='img/over_ekle.png'" onmouseout="this.src='img/ekle.png'"/>
					<img src="img/cikar.png" id="img_c_02" onmouseover="this.src='img/over_cikar.png'" onmouseout="this.src='img/cikar.png'"/>
				</div>
				<div id="tarih_saat_02">
					<ul id="para_goster_02">
										
					</ul>	
				</div>
				<div id="toplam_tutar_02">

				</div>				
			</div>
			<div id="para_miktar_bilgi_02">
				<div id="pmb_text_03">25 Kuruş</div>
				<div id="para_ekle_cikar_01">
					<img src="img/ekle.png" id="img_e_03" onmouseover="this.src='img/over_ekle.png'" onmouseout="this.src='img/ekle.png'"/>
					<img src="img/cikar.png" id="img_c_03" onmouseover="this.src='img/over_cikar.png'" onmouseout="this.src='img/cikar.png'"/>
				</div>
				<div id="tarih_saat_02">
					<ul id="para_goster_03">
						<li><img src="img/b_para.png" width="50"/></li>
						<li><img src="img/b_para.png" width="50"/></li>
						<li><img src="img/b_para.png" width="50"/></li>				
					</ul>	
				</div>
				<div id="toplam_tutar_03">

				</div>				
			</div>
			<div id="para_miktar_bilgi_02">
				<div id="pmb_text_04">50 Kuruş</div>
				<div id="para_ekle_cikar_01">
					<img src="img/ekle.png" id="img_e_04" onmouseover="this.src='img/over_ekle.png'" onmouseout="this.src='img/ekle.png'"/>
					<img src="img/cikar.png" id="img_c_04" onmouseover="this.src='img/over_cikar.png'" onmouseout="this.src='img/cikar.png'"/>
				</div>
				<div id="tarih_saat_02">
					<ul id="para_goster_04">
											
					</ul>	
				</div>
				<div id="toplam_tutar_04">

				</div>				
			</div>
			<div id="para_miktar_bilgi_02">
				<div id="pmb_text_05">1 TL</div>
				<div id="para_ekle_cikar_01">
					<img src="img/ekle.png" id="img_e_05" onmouseover="this.src='img/over_ekle.png'" onmouseout="this.src='img/ekle.png'"/>
					<img src="img/cikar.png" id="img_c_05" onmouseover="this.src='img/over_cikar.png'" onmouseout="this.src='img/cikar.png'"/>
				</div>
				<div id="tarih_saat_02">
					<ul id="para_goster_05">
								
					</ul>	
				</div>
				<div id="toplam_tutar_05">
					
				</div>				
			</div>

			<div id="ana_toplam_tutar_bilgi">
			<div id="toplam_tutar_bilgi">
				<div id="ttb_text">
				
				</div>
			</div>
		</div>
		</div>		
		<div id="hk">
			<div id="hk_logo">
				<img src="img/logo.fw.png" id="hk_logo"/>
			</div>
		</div>
	</div>

</body>
</html>
