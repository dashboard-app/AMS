<?php

include "BLL/AccountsScorecardBLL.php";
class View  
{
public $compName;

//
function GetPaymentTermsData($comp_Name)
{
 
$bl =new BusinessLayer;
 
//Dynamically generating ContractorLeverage Table
echo "<div  class=\"item \" style=\"background-color:#FFFFFF;width:95%; height: 15%;float:right;  \" id=\"pt\" >";
 
echo "<table border='1' class=\"abs\" id=\"pt_ch1\" style=\"top:360px;width:95%;font-size:12px;\">";
echo "<tbody style=\"overflow-y: auto\">";	
			  
		// <!--Actuals table-->
		$value=null; 
		 $bl->PaymentTermsSelectQuery($comp_Name);
		
				while($row = mysql_fetch_array($bl->resultSetpayment))
					{
						// 1st column spacing
						print("<tr>");
						// Column Loop
						for($column_num = 1; $column_num < $bl->columnCountpayment; $column_num++) 
						{
						 
							$fieldname = mysql_field_name($bl->resultSetpayment, $column_num);
							echo "<thead> ";
							echo "<tr> ";
							echo "<th style=\"width:8%\"> ";
							echo "<b>        </b>";
							echo "</th>";
							echo "<th > ";
							$value=$row[$column_num];
						}
					}
						   if($value != null)
							echo "AM Payment Terms - ".$value;
							else
							echo "AM Payment Terms - Not Available";
							echo "</th>";
							echo "</tr>"; 
							echo "</thead>";
						   print("</tr>\n");
echo "</tbody>";	
echo "</table>"; 
echo "</div>";

 
}


//function to dynamically  get ADRC data and display in a table form in UI
function GetADRCData($comp_Name)
{
 
$bl =new BusinessLayer;
 
$headerArray= array("Dec","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec","Target","Target %","Actual","Delta","Delta %");
//Dynamically generating ProfitLoss Table
echo "<div  class=\"item abs\" style=\"margin-left:100px;background-color:#FFFFFF;width:100%; height: 40%;float:right;  \" id=\"adrc\" >";
echo "<table border=\"1\" class=\"abs\" id=\"adrc_ch\" style=\"top:2px;margin-left:52px;text-align: left;width:90%;height:5%;font-size:15px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<th > ";
echo "<b>Onshore ADRC</b>";
echo "</th>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>"; 
   
echo "<table border='1' class=\"data abs\" id=\"adrc_ch2\" style=\"margin-left:55px;top:26px;width:30%;font-size:11px;\">";
echo "<tbody >";	
			  
		// <!--Actuals table-->
		 
		 $bl->ADRCSelectQuery($comp_Name);
		$temp=1;
				 	// 1st column spacing
						print("<tr>");
						// Column Loop 	
						for ($i = 0; $i <sizeof($headerArray); $i++)
									{
									print("<TD style='text-align:center;' >" .$headerArray[$i] . "</TD>\n");
								print("</tr>");
									}
						
echo "</tbody>";	
echo "</table>"; 
echo "<table border='1' class=\"data abs\" id=\"adrc_ch3\" style=\"margin-left:163px;top:26px;width:30%;font-size:11px;\">";
echo "<tbody >";	
			  
		// <!--Actuals table-->
		 
		 $bl->ADRCSelectQuery($comp_Name);
		$temp=1;
				 
					 				 
				while($row = mysql_fetch_array($bl->resultSetAdrc))
					{
						// 1st column spacing
						print("<tr>");
						// Column Loop 	
						for($column_num = 1; $column_num < $bl->columnCountAdrc; $column_num++) 
						{
						  
						  $monthArray = $row[1]; 
						  $month = explode(",", $monthArray);
						  $monthCount=(sizeof($month)-1) ;
						   
						   $adrcArray = $row[2]; 
						   $adrc = explode(",", $adrcArray);
						  
							 if($column_num==1)
							 {
									for ($i = 0; $i <$monthCount; $i++)
									{
									print("<TD style='text-align:center;' >" .$adrc[$i] . "</TD>\n");
								print("</tr>");
									}
									
									if($monthCount<13)
									{
									   	for ($i = $monthCount; $i <13; $i++)
										{
										print("<TD style='text-align:center;' >"."-"."</TD>\n");
										print("</tr>");
							          	}
									}
							 }
							 
							 if($column_num >= 3  && $column_num <= 6 )
							 {
							   print("<TD style='text-align:center;' >" .$row[$column_num] . "</TD>\n");
							   print("</tr>");
						 	 }
							 
							 if($column_num > 6)
							 {
							   print("<TD style='text-align:center;' >" .$row[$column_num] . "</TD>\n");
							   print("</tr>");
							 }
						
						}
							 						
						print("</tr>\n");
						$temp++;
						} 
						 
						
echo "</tbody>";	
echo "</table>"; 
echo "</div>";

 
}


//function to dynamically  get CostRatio data and display in a table form in UI
function GetCostRatioData($comp_Name)
{
 
$bl =new BusinessLayer;
 
//Dynamically generating CostRatio Table
echo "<div  class=\"item\" style=\"margin-right:40px;top:165px;background-color:#FFFFFF;width:90%; height: 40%;display:inline-block;float:right;  \" id=\"costRatio\" >";
echo "<table border=\"1\" class=\"abs\" id=\"cr_ch\" style=\"text-align: left;width:96%;height:20%;font-size:15px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<th > ";
echo "<b>On/Off Cost Ratio</b>";
echo "</th>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>";
echo "<table border=\"1\" class=\"data abs\" id=\"cr_ch1\" style=\"top:28px;width:98%;height:10%;font-size:11px;\">";
echo "<thead>";
echo "<tr>";
echo "<th style=\"width:26%\">";
echo "<span><b> </b></span>";
echo "</th>";
echo "<th   style=\"width:26%\" >";
echo "<b>    </b>";
echo "</th>";
echo "</th>";
echo "<th   style=\"width:18%\" >";
echo "<b>Costs</b>";
echo "</th>";
echo "<th   style=\"width:10%\" >";
echo "<b> %</b>";
echo "</th>";
echo "<th  style=\"width:10%\" >";
echo "<b>Actuals</b>";
echo "</th>"; 
echo "</tr>";
echo "</thead>";
echo "</table>";

   
echo "<table border='1' class=\"data abs\" id=\"cr_ch2\" style=\"top:57px;width:98%;font-size:12px;\">";
echo "<tbody style=\"overflow-y: auto\">";	
			  
		// <!--Actuals table-->
		 
		 $bl->CostRatioSelectQuery($comp_Name);
		$temp=0;
		$prev=0;
		$percent=0;
				while($row = mysql_fetch_array($bl->resultSetCostRatio))
					{
						// 1st column spacing
						print("<tr>");
						// Column Loop
						if($temp==2)
						print("<TH style='text-align:right;width:12%;background-color:white' id='" . $row[0] ."'>Onshore</TH>\n");
						else if($temp==4)
						print("<TH style='text-align:center;width:12%;background-color:white' id='" . $row[0] ."'></TH>\n");
						else if($temp==5)
						print("<TH style='text-align:right;width:12%' id='" . $row[0] ."'></TH>\n");
						else
						print("<TH style='text-align:center;width:12%;background-color:white' id='" . $row[0] ."'></TH>\n");
						
						for($column_num = 1; $column_num < $bl->columnCountCostRatio; $column_num++) 
						{
						
						  if($temp==0)
						  $prev=$row[4];
						  
						  if($temp==4)
						  $percent=$row[3];
						  
							$fieldname = mysql_field_name($bl->resultSetCostRatio, $column_num);
							if($column_num == 1)
								print("<TD style='text-align:right;width:12%' id='" . $row[0] ."'>" . $row[$column_num] . "</TD>\n");
							else  if($column_num == 4 && $temp<5)
							{
								if($temp==2)
									print("<TD  style='text-align:right;width:12.5%;background-color:red' id='" . $fieldname . "_" . $row[0] . "' >" . $prev . "</TD>\n");
								else if($temp==4)
								{
									print("<TD   style='text-align:right;width:12.5%;background-color:white' id='" . $fieldname . "_" . $row[0] . "' >".$percent."</TD>\n");
								}
							else  
								print("<TD  style='text-align:right;width:12.5%;background-color:red' id='" . $fieldname . "_" . $row[0] . "' ></TD>\n");
							}
							else
							print("<TD  style='text-align:right;width:12.5%' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
						}
							 						
						print("</tr>\n");
						$temp++;
						}
						 
						
echo "</tbody>";	
echo "</table>";  
echo "</div>";

 
}

//function to dynamically  get Dor data and display in a table form in UI
function GetDorData($comp_Name)
{
 $month=array("Jan-12","Feb-12","Mar-12","Apr-12","May-12","Jun-12","Jul-12","Aug-12","Sep-12","Oct-12","Nov-12","Dec-12");
$bl =new BusinessLayer;
 
//Dynamically generating Dor Table
echo "<div  class=\"item\" style=\"margin-right:100px;top:15px;background-color:#FFFFFF;width:60%; height: 30%;display:inline-block;float:left;  \" id=\"pl\" >";
echo "<table border=\"1\" class=\"abs\" id=\"dor_ch\" style=\"text-align: left;width:95%;height:30%;font-size:15px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<th > ";
echo "<b>DOR</b>";
echo "</th>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>"; 
echo "<table border=\"0\" class=\"data abs\" id=\"ml_ch2\" style=\"top:34px;width:92.5%;font-size:12px;\">";
echo "<tbody style=\"overflow-y: auto\">";	
			  
		// <!--Actuals table-->
		 
		 $bl->DORSelectQuery($comp_Name);
		 $count=0;
		
			while($row = mysql_fetch_array($bl->resultSetDor))
					{
						// 1st column spacing
						print("<tr>");
						// Column Loop
						for($column_num = 1; $column_num < $bl->columnCountDor; $column_num++) 
						{
						 
							$fieldname = mysql_field_name($bl->resultSetDor, $column_num);
							if($column_num ==1)
								print("<TD style='text-align:right;width:12%' >" . $month[$count] . "</TD>\n");
							else  
								print("<TD  style='text-align:center;width:12.5%'  >" . $row[$column_num] . "</TD>\n");
						}
							 						
						print("</tr>\n");
						 $count=$count+1 ;
						}
						if($count==$bl->rowCountDor)
						{
							for($rnum = $count; $rnum < 12; $rnum++) 
							{
						print("<tr>");
							print("<TD style='text-align:right;width:12%' >" . $month[$rnum] . "</TD>\n");
							print("<TD  style='text-align:center;width:12.5%' >"."-"."</TD>\n");
							
						print("</tr>\n");
						 
						} 
		                }
						
						 
						
echo "</tbody>";	
echo "</table>";  
echo "</div>";

 
}


//function to dynamically  get ManagementLeverage data and display in a table form in UI
function GetManagementLeverageData($comp_Name)
{
 
$bl =new BusinessLayer;
 
//Dynamically generating ProfitLoss Table
echo "<div  class=\"item\" style=\"margin-right:30px;top:150px;background-color:#FFFFFF;width:95%; height: 40%;display:inline-block;float:right;  \" id=\"pl\" >";
echo "<table border=\"1\" class=\"abs\" id=\"ml_ch\" style=\"top:20px;text-align: left;width:95%;height:20%;font-size:15px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<th > ";
echo "<b>Management Leverage (OS8 - VP)</b>";
echo "</th>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>"; 
echo "<table border=\"1\" class=\"data abs\" id=\"ml_ch1\" style=\"top:46px;width:90%;height:5%;font-size:11px;\">";
echo "<thead>";
echo "<tr>";
echo "<th >";
echo "<span><b></b></span>";
echo "</th>";
echo "<th   style=\"width:20.5%\" >";
echo "<b>Staff</b>";
echo "</th>";
echo "<th   style=\"width:15.5%\" >";
echo "<b>Revenue (M$)</b>";
echo "</th>";
echo "</tr>";
echo "</thead>";
echo "</table>";

  
echo "<table border='1' class=\"data abs\" id=\"ml_ch2\" style=\"top:92px;width:90%;font-size:12px;\">";
echo "<tbody style=\"overflow-y: auto\">";	
			  
		// <!--Actuals table-->
		 
		 $bl->ManagementLeverageSelectQuery($comp_Name);
		
				while($row = mysql_fetch_array($bl->resultSetMgtLev))
					{
						// 1st column spacing
						print("<tr>");
						// Column Loop
						for($column_num = 1; $column_num < $bl->columnCountMgtLev; $column_num++) 
						{
						 
							$fieldname = mysql_field_name($bl->resultSetMgtLev, $column_num);
							if($column_num ==1)
								print("<TD style='text-align:right;width:12%' id='" . $row[0] ."'>" . $row[$column_num] . "</TD>\n");
							else  
								print("<TD  style='text-align:right;width:12.5%' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
						}
							 						
						print("</tr>\n");
						}
						 
						
echo "</tbody>";	
echo "</table>";  
echo "</div>";

 
}





//function to dynamically  get ContractorLeverage data and display in a table form in UI
function GetContractorLeverageData($comp_Name)
{
 
$bl =new BusinessLayer;
 
//Dynamically generating ContractorLeverage Table
echo "<div  class=\"item\" style=\"margin-right:30px;background-color:#FFFFFF;width:95%; height: 15%;display:inline-block;float:right;  \" id=\"pl\" >";
echo "<table border=\"1\" class=\"abs\" id=\"cl_ch\" style=\"text-align: left;width:95%;height:15%;font-size:15px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<th > ";
echo "<b>Contractor Leverage </b>";
echo "</th>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>";
echo "<table border=\"1\" class=\"data abs\" id=\"cl_ch1\" style=\"top:25px;width:95%;height:15%;font-size:11px;\">";
echo "<thead>";
echo "<tr>";
echo "<th   style=\"width:20%\" >";
echo "<b>Total HC</b>";
echo "</th>";
echo "</th>";
echo "<th   style=\"width:15.5%\" >";
echo "<b>Internal</b>";
echo "</th>";
echo "<th   style=\"width:10.5%\" >";
echo "<b>External</b>";
echo "</th>";
echo "<th  style=\"width:10.5%\" >";
echo "<b>External  %</b>";
echo "</th>"; 
echo "</tr>";
echo "</thead>";
echo "</table>";

 
echo "<table border='1' class=\"data abs\" id=\"cl_ch2\" style=\"top:54px;width:95%;font-size:12px;\">";
echo "<tbody style=\"overflow-y: auto\">";	
			  
		// <!--Actuals table-->
		 
		 $bl->ContractorLeverageSelectQuery($comp_Name);
		
				while($row = mysql_fetch_array($bl->resultSetContLev))
					{
						// 1st column spacing
						print("<tr>");
						// Column Loop
						for($column_num = 1; $column_num < $bl->columnCountContLev; $column_num++) 
						{
						 
							$fieldname = mysql_field_name($bl->resultSetContLev, $column_num);
							if($column_num ==1)
								print("<TD style='text-align:right;width:8%' id='" . $row[0] ."'>" . $row[$column_num] . "</TD>\n");
							else  
								print("<TD  style='text-align:right;width:14.5%' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
						}
							 						
						print("</tr>\n");
						

						}
						 
echo "</tbody>";	
echo "</table>"; 
echo "<table border=\"0\" class=\"abs\" id=\"cl_ch3\" style=\"text-align: left;top:90px;width:95%;height:10%;font-size:12px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<td > ";
echo "<i>Target External Contractor % = 12 </i>";
echo "</td>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>";  
echo "</div>";

 
}



// function to dynamically  get ProfitLoss data and display in a table form in UI
function GetProfitLossData($comp_Name)
{
 
$bl =new BusinessLayer;
 
//Dynamically generating ProfitLoss Table
echo "<div  class=\"item\" style=\"margin-right:80px;background-color:#FFFFFF;width:80%; height: 25%;float:right;  \" id=\"pl\" >";
echo "<table border=\"1\" class=\"abs\" id=\"pl_ch\" style=\"text-align: left;width:95%;height:25%;font-size:15px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<th > ";
echo "<b>P&L </b>";
echo "</th>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>";
echo "<table border=\"1\" class=\"data abs\" id=\"pl_ch1\" style=\"top:25px;width:98%;height:15%;font-size:11px;\">";
echo "<thead>";
echo "<tr>";
echo "<th style=\"width:24.5%\">";
echo "<span><b></b></span>";
echo "</th>";
echo "<th style=\"width:24.5%\">";
echo "<span><b></b></span>";
echo "</th>";
echo "<th style=\"width:24.5%\">";
echo "<span><b></b></span>";
echo "</th>";
echo "<th   style=\"width:28.5%\" >";
echo "<b>    </b>";
echo "</th>";
echo "</th>";
echo "<th   style=\"width:18.5%\" >";
echo "<b>Budget</b>";
echo "</th>";
echo "<th   style=\"width:8.5%\" >";
echo "<b>Forecast</b>";
echo "</th>";
echo "<th  style=\"width:5.5%\" >";
echo "<b>Variance</b>";
echo "</th>"; 
echo "</tr>";
echo "</thead>";
echo "</table>";

 
echo "<table border='1' class=\"data abs\" id=\"pl_ch2\" style=\"top:54px;width:98%;font-size:12px;\">";
echo "<tbody style=\"overflow-y: auto\">";	
			  
		// <!--Actuals table-->
		 
		 $bl->ProfitLossSelectQuery($comp_Name);
		
				while($row = mysql_fetch_array($bl->resultSetProfitLoss))
					{
						// 1st column spacing
						print("<tr>");
						// Column Loop
						for($column_num = 1; $column_num < $bl->columnCountProfitLoss; $column_num++) 
						{
						 
							$fieldname = mysql_field_name($bl->resultSetProfitLoss, $column_num);
							if($column_num ==1)
								print("<TD style='text-align:right;width:12%' id='" . $row[0] ."'>" . $row[$column_num] . "</TD>\n");
							else  
								print("<TD  style='text-align:right;width:12.5%' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
						}
							 						
						print("</tr>\n");
						}
						 
						
echo "</tbody>";	
echo "</table>"; 
echo "</div>";

 
}







//function to get Rightshore Pie chart data in an array
function GetRightshorePieChartData()
{
$bl =new BusinessLayer;
          $result_pie =  $bl->RightshorePiechartSelectQuery();
    			$pie_colcount = mysql_num_fields( $bl->resultSetRightShorePie ) or die("display_db_query:" . mysql_error());
			$pie_rowcount=  mysql_num_rows( $bl->resultSetRightShorePie  ) or die("display_db_query:" . mysql_error());
			
                        //Array within an array declared based on the number of rows returned
			echo "<script type='text/javascript'>\n"; 
			echo "var rsCountPyramid=".$pie_rowcount.";\n";
			echo "var itemRSArrayPchart= new Array(".$pie_rowcount.");\n"; 
			echo "for (i=0; i <".$pie_rowcount."; i++)\n"; 
			echo "itemRSArrayPchart[i]=new Array(".$pie_rowcount.");\n"; 
			$rwCount=0;
			//Array formed out of the query result fetching sum and avg. of all company details from the table 'operationalmetrics'
			while($row = mysql_fetch_array($bl->resultSetRightShorePie))
			{
                            for($column_no = 0; $column_no < $pie_colcount; $column_no++) 
                            	echo "itemRSArrayPchart[".$rwCount."][".$column_no."]= '".$row[$column_no]."';\n";
                            $rwCount++;
			}
			
			echo "</script>";
}




//function to get Pyramid Pie chart data in an array
function GetPieChartData()
{
$bl =new BusinessLayer;
          $result_pie =  $bl->PyramidPiechartSelectQuery();
    			$pie_colcount = mysql_num_fields( $bl->resultSetPie ) or die("display_db_query:" . mysql_error());
			$pie_rowcount=  mysql_num_rows( $bl->resultSetPie  ) or die("display_db_query:" . mysql_error());
			
                        //Array within an array declared based on the number of rows returned
			echo "<script type='text/javascript'>\n"; 
			echo "var rCountPyramid=".$pie_rowcount.";\n";
			echo "var itemArrayPchart= new Array(".$pie_rowcount.");\n"; 
			echo "for (i=0; i <".$pie_rowcount."; i++)\n"; 
			echo "itemArrayPchart[i]=new Array(".$pie_rowcount.");\n"; 
			$rwCount=0;
			//Array formed out of the query result fetching sum and avg. of all company details from the table 'operationalmetrics'
			while($row = mysql_fetch_array($bl->resultSetPie))
			{
                            for($column_no = 0; $column_no < $pie_colcount; $column_no++) 
                            	echo "itemArrayPchart[".$rwCount."][".$column_no."]= '".$row[$column_no]."';\n";
                            $rwCount++;
			}
			
			echo "</script>";
}
    //
function DisplayRightShore($comp_Name)
{
 
$bl =new BusinessLayer;
$bl->RightShoreSelectQuery($comp_Name);

$rowCount=  mysql_num_rows($bl->resultSet)
				or die("Data not available" . mysql_error());
				
//Dynamically generating Rightshore Table
if($rowCount>0)
{
echo "<div  class=\"item\" style=\"margin-right:60px;background-color:#FFFFFF;width:80%; height:15%;display:inline-block;float:right;  \" id=\"table_div1\" >";
echo "<table border=\"1\" class=\"abs\" id=\"column_Header2\" style=\"text-align: left;width:95%;height:20%;font-size:15px;\">"; 
echo "<thead> ";
echo "<tr> ";
echo "<th > ";
echo "<b>Rightshore </b>";
echo "</th>";
echo "</tr>"; 
echo "</thead>"; 
echo "</table>";
echo "<table border=\"1\" class=\"data abs\" id=\"column_Header1\" style=\"top:25px;width:92.5%;height:20%;font-size:11px;\">";
echo "<thead>";
echo "<tr>";
echo "<th >";
echo "<span><b></b></span>";
echo "</th>";
echo "<th   style=\"width:16.5%\" >";
echo "<b>    </b>";
echo "</th>";
echo "</th>";
echo "<th   style=\"width:16.5%\" >";
echo "<b>Target</b>";
echo "</th>";
echo "<th   style=\"width:15.5%\" >";
echo "<b>Onshore</b>";
echo "</th>";
echo "<th  style=\"width:12.5%\" >";
echo "<b>L1</b>";
echo "</th>";
echo "<th   style=\"width:14.5%\"  >";
echo "<b>Contractor</b>";
echo "</th>";
echo "<th   style=\"width:15%\" >";
echo "<b>Offshore</b>";
echo "</th>";
echo "<th   style=\"width:18%\" >";
echo "<b>R/S %</b>";
echo "</th>"; 
 
echo "</tr>";
echo "</thead>";
echo "</table>";
echo "<table border='1' class=\"data abs\" id=\"actuals1\" style=\"top:70px;width:92.5%;font-size:12px;\">";
echo "<tbody style=\"overflow-y: auto\">";	

			  
		// <!--Actuals table-->
		 
		 
		
				$tempTarget=0;
				$tempRS=0;
				$count=0;
				$temp=0;
				while($row = mysql_fetch_array($bl->resultSet))
					{
						
						// 1st column spacing
						print("<tr>");
						// Column Loop
						for($column_num = 0; $column_num < $bl->columnCount; $column_num++) 
						{
						 
						if($temp==0 || $temp==3)
						{//echo $temp;
						$tempTarget=$row[1];
						$tempRS=$row[6];
						//echo $tempTarget;
						}
							$fieldname = mysql_field_name($bl->resultSet, $column_num);
							if($column_num ==0)
							{
								print("<TD style='text-align:right;width:12%' id='" . $row[0] ."'>" . $row[$column_num] . "</TD>\n");
							}
							else if($column_num != 1 && $column_num != 6)
							{
							print("<TD  style='text-align:right;width:12.5%' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
														 
							}
							else if ($column_num == 1)
							{
							if($temp==0 || $temp ==2 || $temp==3 || $temp ==5)
							print("<TD  style='text-align:right;width:12.5%' id='" . $fieldname . "_" . $row[0] . "' >&nbsp;&nbsp;</TD>\n");
							else
							print("<TD  style='text-align:right;width:12.5%' id='" . $fieldname . "_" . $row[0] . "' >" . $tempTarget . "</TD>\n");
							 
							}
							else if ($column_num == 6)
							{
							if($temp==0 || $temp ==2) 
							print("<TD  style='text-align:right;width:12.5%;background-color:yellow' id='" . $fieldname . "_" . $row[0] . "' >&nbsp;&nbsp;</TD>\n");
							else if($temp==1 )
							print("<TD  style='text-align:right;width:12.5%;background-color:yellow' id='" . $fieldname . "_" . $row[0] . "' >" . $tempRS . "</TD>\n");
							else if( $temp==3 || $temp ==5)
							print("<TD  style='text-align:right;width:12.5%;background-color:red' id='" . $fieldname . "_" . $row[0] . "' >&nbsp;&nbsp;</TD>\n");
							else if($temp==4 )
							print("<TD  style='text-align:right;width:12.5%;background-color:red' id='" . $fieldname . "_" . $row[0] . "' >" . $tempRS . "</TD>\n");
							}
						  
						  // print("<TD  style='text-align:right' id='" . $fieldname . "_" . $row[0] . "' >&nbsp;</TD>\n");
							
						}
						
						$temp=$temp+1; 
						
						 
								 						
						print("</tr>\n");
						}
						 
						
echo "</tbody>";	
echo "</table>";
echo "</div>";
}

 
}
  
  
  
  
  
  
  
  
  
  
  
 //function to create table header nad dynamically generate  table data
function DisplayPyramid($comp_Name)
{
$bl =new BusinessLayer;

//Dynamically generating pyramid Table
echo "<div  class=\"item abs\" style=\"background-color:#FFFFFF;width:75%; height: 15%;float:left;  \" id=\"table_div\" >";
echo "<table border=\"1\" class=\"abs\" id=\"column_Header2\" style=\"text-align: left;width:95%;height:20%;font-size:15px;\" >"; 
echo "<thead> ";
echo "<tr>"; 
echo "<th >"; 
echo "<b>HC & Pyramid % </b>";
echo "</th>";
echo "</tr> ";
echo "</thead> ";
echo "</table>";
echo "<table border=\"1\" class=\"data abs\" id=\"column_Header\" style=\"top:25px;width:100%;font-size:11px;\">";
echo "<thead>";
echo "<tr>";
echo "<th >";
echo "<span><b></b></span>";
echo "</th>";
echo "<th   style=\"width:11.5%\" >";
echo "<b>Target</b>";
echo "</th>";
echo "<th   style=\"width:11.5%\" >";
echo "<b>Onshore</b>";
echo "</th>";
echo "<th  style=\"width:12.5%\" >";
echo "<b>Offshore</b>";
echo "</th>";
echo "<th   style=\"width:13.5%\"  >";
echo "<b>Blended</b>";
echo "</th>";
echo "<th   style=\"width:12%\" >";
echo "<b>Onshore %</b>";
echo "</th>";
echo "<th   style=\"width:11%\" >";
echo "<b>Offshore %</b>";
echo "</th>";
echo "<th   style=\"width:12.5%\" >";
echo "<b>Blended Ratio</b>";
echo "</th>";
echo "</tr>";
echo "</thead>";
echo "</table>";
echo "<table border='1' class=\"data abs\" id=\"actuals\" style=\"top:70px;width:100%;height:100%;font-size:11px;\">";
echo "<tbody style=\"overflow-y: auto\">";	
			   
		// <!--Actuals table-->
		 
		  $bl->PyramidSelectQuery($comp_Name);
 
		
				$prev=0;
				$count=0;
				$temp=0;
				while($row = mysql_fetch_array($bl->resultSetPyramid))
					{
						
						// 1st column spacing
						print("<tr>");
						// Column Loop
						for($column_num = 0; $column_num < $bl->columnCountPyramid; $column_num++) 
						{
							$fieldname = mysql_field_name($bl->resultSetPyramid, $column_num);
							if($column_num ==0)
							{
								print("<TD style='text-align:right;width:8.5%' id='" . $row[0] ."'>" . $row[$column_num] . "</TD>\n");
							}
							else if($column_num !=7)
							{
							print("<TD  style='text-align:right;width:9.5%' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
											 
							}
							else  
							{
							if($temp==0 || $temp ==2)
							{
							$prev=$row[$column_num];
							print("<TD  style='text-align:right;width:9.5%;background-color:green' id='" . $fieldname . "_" . $row[0] . "' >&nbsp;&nbsp;</TD>\n");
							}
							else if($temp == 1)
							{
							print("<TD  style='text-align:right;width:9.5%;background-color:green' id='" . $fieldname . "_" . $row[0] . "' >" . $prev . "</TD>\n");
							echo "<script type='text/javascript'>\n"; 
			                echo "var rc=".$prev.";\n";
			                echo "</script>";
							}
							else
							print("<TD  style='text-align:right;width:9.5%;background-color:green' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n");
							
							}
							  
						}
							 
						
						$temp=$temp+1;
							 //	 print("<TD  style='text-align:right;width:0.5%' id='" . $fieldname . "_" . $row[0] . "' ></TD>\n");						
						print("</tr>\n");
						}
						 
						
echo "</tbody>";	
echo "</table>";
echo "</div>";

echo "<div id=\"shore\" class='item' style=\"top:180px;width:80%; height: 45%;display:inline-block;float:left;\" >";
echo " </div>"; 
}


}
?>