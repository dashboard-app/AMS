 <?php
 /************************************************************************************************      
Name			:  AccountScorecardUI.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  15-July-2012 
Description     :   AccountScorecard  screen for Am companies
Modified Date   :  
Reason          :            
************************************************************************************************/
  session_start();
  include "AccountScorecardTableDesign.php"; 
   
		$comp_Name=$_GET['company'];
	  $companyName=str_replace("'", "", $comp_Name); 
	 setcookie("last_page","AccountScorecardUI.php?company=".$_GET['company'], time()+3600, '/');
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>		
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>CapgeminiAMS</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/stylesheets/master.css" />

<script src="assets/javascripts/iscroll.js"></script> 
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/highcharts.js"></script>
<!-- META -->
	 
		<meta name = "viewport" content = "width=device-width, minimum-scale=1, maximum-scale=1">
		<meta name = "apple-mobile-web-app-capable" content = "yes" /> 
		
		<style type="text/css">
			.iosSlider {
				width: 900px;
				height: 800px;
				overflow: hidden;
			}
			
			.iosSlider .slider {
				width: 100%;
				height: 100%;
			}
			
			.iosSlider .slider .item {
				position: relative;
				top: 10px;
				left: 0;
				float: left;
				width: 100%;
				height: 80%;
				background: #fff;
				
				margin-left:40px;
				
				margin-top:5px;
				
			}
			.iosSliderButtons {
				margin: 10px 0 0 180px;
				width: 490px;
				height:60px;
			}
			
			.iosSliderButtons .button {
				float: center;
				margin: 0 0 0 10px;
				width: 80px;
				height: 60px;
				opacity: 0.5;
				filter: alpha(opacity:50);
			}
			
			.iosSliderButtons .button .border {
				border: 0px ;
				opacity: 0.5;
				width: 75px;
				height: 50px;
			}
			
			.iosSliderButtons #item1 {
				background: url(h-slider-1.png) no-repeat 0 0;
			}
			
			.iosSliderButtons #item2 {
				background: url(h-slider-2.png) no-repeat 0 0;
			}
			
			.iosSliderButtons #item3 {
				background: url(h-slider-3.png) no-repeat 0 0;
			}
			.iosSliderButtons #item4 {
				background: url(h-slider-4.png) no-repeat 0 0;
			}
				
			.iosSliderButtons .first {
				margin-left: 0;
			}
			
			.iosSliderButtons .selected,
			.iosSliderButtons .button:hover {
				opacity: 1;
				filter: alpha(opacity:100);
			}

		</style>
		
		<!-- jQuery library -->
		<script type="text/javascript" src = "assets/js/jquery-1.6.1.min.js"></script>
		<script type="text/javascript" src = "assets/js/jquery.easing-1.3.js"></script>
		<!-- iosSlider plugin -->
		<script src = "assets/js/jquery.iosslider.js"></script>
		
		<script type="text/javascript">
			 
			
			
			$(document).ready(function() {
				
				$('.iosSlider').iosSlider({
					desktopClickDrag: true,
					snapToChildren: true,
					navSlideSelector: '.sliderContainer .slideSelectors .item',
					onSlideComplete: slideComplete,
					onSliderLoaded: sliderLoaded,
					onSlideChange: slideChange,
					scrollbar: true,
					scrollbarContainer: '.sliderContainer .scrollbarContainer',
					scrollbarMargin: '0',
					navSlideSelector: $('.iosSliderButtons .button'),
					scrollbarBorderRadius: '0'
				});
				
			});
/* autoSlide: true,*/
			
			
			function slideChange(args) {
			
				$('.sliderContainer .slideSelectors .item').removeClass('selected');
				$('.sliderContainer .slideSelectors .item:eq(' + args.currentSlideNumber + ')').addClass('selected');
				console.log(args);
				/* indicator */
					$('.iosSliderButtons .button').removeClass('selected');
					$('.iosSliderButtons .button:eq(' + args.currentSlideNumber + ')').addClass('selected');
			}
			
			function slideComplete(args) {
					
				$(args.sliderObject).find('.text1, .text2').attr('style', '');
				
				$(args.currentSlideObject).find('.text1').animate({
					right: '100px',
					opacity: '0.8'
				}, 400, 'easeOutQuint');
				
				$(args.currentSlideObject).find('.text2').delay(200).animate({
					right: '50px',
					opacity: '0.8'
				}, 400, 'easeOutQuint');
				/* indicator */
					$('.iosSliderButtons .button').removeClass('selected');
					$('.iosSliderButtons .button:eq(' + args.currentSlideNumber + ')').addClass('selected');
			}
			
			function sliderLoaded(args) {
					
				slideComplete(args);
				
				slideChange(args);
				
				/* indicator */
					$('.iosSliderButtons .button').removeClass('selected');
					$('.iosSliderButtons .button:eq(' + args.currentSlideNumber + ')').addClass('selected');
				
			}
		</script>


<script type="text/javascript">
var items_Pyramid = new Array('A','B','C','D/E/F');
var compName="";
 function  PyramidClearOptions(renderto,type,title)
		{
		 
			 options = {
				 chart: {
                renderTo: renderto,
					defaultSeriesType: type 
                 
            },
            title: {
                text: title 
            },
			 
			plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					color: '#000000',
					connectorColor: '#000000',
					formatter: function() {
						return '<b>'+ '(' + this.point.name+ '):' + Math.round(this.percentage) +' %';
					}
				}
			}
		},
				series: []
			};
		}
		
		function GetCompanyPyramidGraphs()
		 {
		  compName=<?php echo $_GET['company'];?> ;
		 
		   PyramidArrayList(compName);
		   PlotBlendedGraph(compName);
		   PlotRightshoreChart(compName);
		 }
		 
	     function PlotBlendedGraph(companyname)
		 {

		 
		 PyramidClearOptions('shore','pie','Current Month Blended');
		  
			var series = {
								data: []
							};
				
						   
							// options.plotOptions.pie.dataLabels.name="A"; 
						  	for(var i=0;i<itemsBlended.length;i++)
							{
							 	// alert(itemsBlended[i]);
							series.data.push([items_Pyramid[i],parseFloat(itemsBlended[i])]);
							 
							}
				   
					options.series.push(series);
				
				var chart = new Highcharts.Chart(options);
		 }
		  
		   function PlotRightshoreChart(companyname)
		 {

		 
		 PyramidClearOptions('blended','pie','Current Month RS %');
		  
			var series = {
								data: []
							};
				
						   
							// options.plotOptions.pie.dataLabels.name="A"; 
						  	for(var i=0;i<itemsRightshore.length;i++)
							{
							//alert(itemsRightshore[i]);
                             if(i==0)
							series.data.push(["A/B/C",parseFloat(itemsRightshore[i])]);
							else
							series.data.push(["D/E/F",parseFloat(itemsRightshore[i])]);
							 
							}
				   
					options.series.push(series);
				
				var chart = new Highcharts.Chart(options);
		 }
		
        //	function to form the array for Onshore/Offshore/BlendedRatio/Target	
		function PyramidArrayList(comName)
		{
	
			itemsRightshore = [];
			itemsOffshore = [];
			itemsTarget = [];
			itemsBlended =[];
			var rnum=0;
				var rsnum=0;
			for (var row = 0; row < rCountPyramid; row++)
			{
			 
				if(itemArrayPchart[row][0]== comName)
				{
				//alert(itemArrayPchart[row][5]);
				 itemsBlended[rnum]=itemArrayPchart[row][5];
				 rnum++;
				 }
				 
				 
		   } 
		   
		   for (var row = 0; row < rsCountPyramid; row++)
			{
			      if(itemRSArrayPchart[row][0]== comName)
				  {
				  
				   itemsRightshore[rsnum]=itemRSArrayPchart[row][2];
				    rsnum++;
				  }
				
			}
		
		}
	function link(selectedCompanyName)
	{
	 
	window.location.href ="AccountScorecardUI.php?company='"+selectedCompanyName+"'";
	 
	}
		 
</script>
</head>
<body onorientationchange="updateOrientation();" onload=" GetCompanyPyramidGraphs();">
	   
<div id="main" class="abs">
	     <div class="abs header_upper chrome_dark">
		<span class="float_left button" id="button_navigation">
			Navigation
		</span>
		<a onclick="location.href='./OperationalMetricsAmUI.php?metrics=op&sector=AM&sectorid=14&mnt=<?php echo $_GET['mnt'];?>'" class="float_left button">
			Back
		</a>
		<a onclick="location.href='./logout.php'" class="float_right button">
			Sign out
		</a>
		<a class="icon icon_refresh float_right" onclick="link(<?php echo $comp_Name ?>);"></a>
	 	 
		 <?php
		
	    $companyName=str_replace("'", "", $comp_Name); 
		echo "Account Management Scorecard ";
		?> 
	    </div>
	
	<!-- Navigation -->
			
	    <div id="main_content" class="abs" >
		<div style="background-color:dimgray;padding:1px;">
			<div  class = 'iosSliderButtons'>
		
			<div class = 'button first' id = 'item1'>
				<div class = 'border'></div>
			</div>					
			<div class = 'button' id = 'item2'>
				<div class = 'border'></div>
			</div>
			<div class = 'button' id = 'item3'>
				<div class = 'border'></div>
			</div>
			 <div class = 'button' id = 'item4'>
				<div class = 'border'></div>
			</div>
		
		</div>
        
		<br />
		
		</div>
		
		   <div style="text-align:center">
<h1><b>
		   <?php
		   echo strtoupper($companyName);
		   ?></b>
		   </h1>
		   </div>
		 														
	 		<div class = 'iosSlider' >
				<div class = 'slider abs'>
				
				<!--1st div content starts-->
					<div class = 'item'  id = 'item1' >
					<script>
					$("#sort_div").hide();$("#arrow").hide();$("#arrow2").hide();$("#nav_div").hide();
					</script>
			
					<?php
					$vt= new View;
					$vt->DisplayPyramid($companyName);
					$vt->GetPieChartData();
					$vt->GetRightshorePieChartData();
					?>
					<script type="text/javascript">
					$(document).ready(function() {
					var myScroll = new iScroll('wrapper');
					});
					</script>
					</div>
				<!--1st div content ends-->
				
				<!--2nd div content starts-->
					<div class = 'item'  id = 'item2'>
						<?php
						$vt->DisplayRightShore($companyName);
						?>
						<div id="blended" class='item' style="top:180px;width:80%; height: 45%; display:inline-block;float:bottom;">
						</div>
					</div>
				<!--2nd div content ends-->
				
				<!--3rd div content starts-->
					<div class= 'item' id='item3'>
						<div id="profitLoss" style="top:5px;width:50%; height: 10%; display:inline-block;float:left;">
						<?php
						$vt->GetProfitLossData($comp_Name);
						$vt->GetManagementLeverageData($comp_Name);
						?> 
						</div>
						<div id="contLev" style="width:50%; height:10%; display:inline-block; float:right;">
						<?php
						$vt->GetContractorLeverageData($comp_Name);
						$vt->GetCostRatioData($comp_Name);
						?> 
						</div>
					</div>
				<!--3rd div content ends-->
				
				<!--4th div content starts-->
				   <div class = 'item'  id = 'item4'>
				        <div id="profitLoss" style="top:5px;width:50%; height: 10%;float:left;">
						<?php
						$vt->GetADRCData($comp_Name);
						
						?>
						</div>
						<div id="contLev" style="width:50%; height:10%; float:right;">
						<?php
						$vt->GetDorData($comp_Name);
						$vt->GetPaymentTermsData($comp_Name);
						?>
						 
						</div>
				  </div>
    		  <!--4th div content ends-->
			</div>
		
		
		
		     
			</div>	 </div>	
			<!-- <script type="text/javascript">'''''$vt->DisplayPyramid($comp_Name);
			 document.getElementById('heading').innerHTML = <?php echo $comp_Name ?> 
			 </script> -->
		 
	</div>


<!-- sidebar -->
<div id="sidebar" class="abs">
	<span id="nav_arrow"></span>
	<div class="abs header_upper chrome_dark">
		App Name
	</div>
	<form action="" class="abs header_lower chrome_dark">
		<input type="search" id="q" name="q" placeholder="Search..." />
	</form>
	<div id="sidebar_content" class="abs">
		<div id="sidebar_content_inner">
			<ul id="sidebar_menu">
				<li id="sidebar_menu_home" class="active">
					<a onclick="location.href='./home.php'"><span class="abs"></span>Home</a>
				</li>
				

				<li>
					<a onclick="alert('Data not available')">Commercial</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">West</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">East</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">Canada</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">Communication</a>
				</li>
				<li>
					<a onclick="alert('Data not available')">Government</a>
				</li>
				<li>
					<a onclick="location.href='./settings.php'">Settings</a>
				</li>


				
					
			</ul>
		</div>
	</div>
	<div class="abs footer_lower chrome_dark">
		<a href="#" class="icon icon_gear2 float_left"></a>
		<span class="float_right gutter_right">Some descriptive text here</span>
	</div>
</div>

<script>
 
	var wid = $(window).width();
	var chart_but=0;
	 

	function updateOrientation()
	{
		 var wid = $(window).width();
            if(wid>1000)
            {
                 document.getElementById("column_Header").style.top= "25px" ;
		         document.getElementById("actuals").style.top= "70px" ;
                 document.getElementById("shore").style.top= "180px" ;
				 
				  document.getElementById("column_Header1").style.top= "25px" ;
			     document.getElementById("actuals1").style.top= "70px" ;
				 document.getElementById("blended").style.top= "180px" ;
				 
				  document.getElementById("adrc_ch").style.top= "2px" ;
			     document.getElementById("adrc_ch2").style.top= "26px" ;
				 document.getElementById("adrc_ch3").style.top= "26px" ;
				 
				 document.getElementById("cl_ch").style.top= "10px" ;
				 document.getElementById("cl_ch1").style.top= "32px" ;
				 document.getElementById("cl_ch2").style.top= "62px" ;
				 document.getElementById("cl_ch3").style.top= "96px" ;
				 
				 document.getElementById("pl_ch").style.top= "10px" ;
				 document.getElementById("pl_ch1").style.top= "35px" ;
				 document.getElementById("pl_ch2").style.top= "64px" ;
				 
				 document.getElementById("ml_ch").style.top= "35px" ;
				  document.getElementById("ml_ch1").style.top= "65px" ;
				 document.getElementById("ml_ch2").style.top= "110px" ;

				  document.getElementById("cr_ch").style.top= "20px" ;
				  document.getElementById("cr_ch1").style.top= "50px" ;
				  document.getElementById("cr_ch2").style.top= "80px" ;
				 
            }
	    else
            {
			 
                 document.getElementById("column_Header").style.top= "45px" ;
				 document.getElementById("actuals").style.top= "90px" ;
				 document.getElementById("shore").style.top= "192px" ;
				 
				 document.getElementById("column_Header1").style.top= "40px" ;
				 document.getElementById("actuals1").style.top= "85px" ;
				 
				 
				 document.getElementById("adrc_ch").style.top= "10px" ;
				 document.getElementById("adrc_ch2").style.top= "37px" ;
				 document.getElementById("adrc_ch3").style.top= "37px" ;
			 
				 
				 document.getElementById("cl_ch").style.top= "20px" ;
				 document.getElementById("cl_ch1").style.top= "46px" ;
				 document.getElementById("cl_ch2").style.top= "76px" ;
				 document.getElementById("cl_ch3").style.top= "112px" ;

				 document.getElementById("pl_ch").style.top= "20px" ;
				 document.getElementById("pl_ch1").style.top= "45px" ;
                 document.getElementById("pl_ch2").style.top= "75px" ;
				 
				  document.getElementById("ml_ch").style.top= "80px" ;
				 document.getElementById("ml_ch1").style.top= "105px" ;
				 document.getElementById("ml_ch2").style.top= "150px" ;
				 
				  document.getElementById("cr_ch").style.top= "67px" ;
				  document.getElementById("cr_ch1").style.top= "95px" ;
				  document.getElementById("cr_ch2").style.top= "124px" ;

            }
		
	 

	}

	function chart_hide_show()
	{
		if(chart_but % 2==0)
		{
			document.getElementById('chart_button').innerHTML = 'Show Chart';
			$("#chartHolder").hide();
			 
					
		}
		else
		{
			document.getElementById('chart_button').innerHTML = 'Hide Chart';
			$("#chartHolder").show();
			 
					
		}
		
		chart_but++;
	}


</script>



 