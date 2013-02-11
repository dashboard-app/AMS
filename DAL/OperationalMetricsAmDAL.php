<?php
/*************************************************************************************      
Name			:  OperationalMetricsAmDAL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  3rd-July-2012 
Description     :  operational metrics AM page dal file
Modified Date   :  5th-July-2012 
Reason          :  Added a function for plotting account scorecard graphs             
*************************************************************************************/

//Parsing the 'config.ini' file to get the database configuration details
$ini_array = parse_ini_file("Config.ini");

//Retrieving the below database information from the array returned from the 'config.ini' 
$dbhost = $ini_array['host'];
$dbuser = $ini_array['user'];
$dbpass = $ini_array['password'];

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];
mysql_select_db($dbname , $conn)
or die("Could not select database-".$dbname);

function calendar_months_DAL()
{
    global $conn; 
    $calendar_months = mysql_query ("SELECT distinct month(month) FROM operationalmetrics order by month desc",$conn);
    return $calendar_months;
}

function table_data_DAL($mnt)
{
    global $conn;
    $opResult = mysql_query("SELECT CompanyName,Rightshore,Offshore_Headcount,Onshore_Headcount,AET_Hrs,Ticket_Volume_Hrs,
                            Attrition_Offshore ,Attrition_Onshore,ITIL_Offshore,ITIL_Onshore  
                            FROM operationalmetrics where month='2012-0".$mnt."-01' order by companyname asc",$conn); 
    return $opResult;			    
}

function graph_data_DAL()
{
    global $conn;
    $query="SELECT `CompanyName`,`Rightshore`,`Offshore_Headcount`,`Onshore_Headcount`,`AET_Hrs`,`Ticket_Volume_Hrs`,`Attrition_Offshore`,
        `Attrition_Onshore`,`ITIL_Offshore`,`ITIL_Onshore`,`SECTOR`,`Month`  
        FROM operationalmetrics order by companyname,month asc";    
    $graph_result = mysql_query($query,$conn); 
    return $graph_result;
}

function graph_data_gt_DAL()
{
    global $conn;
    $opResult_gt="SELECT Month ,ROUND(avg(Rightshore),1),ROUND(sum(Offshore_Headcount),1),ROUND(sum(Onshore_Headcount),1),
                ROUND(avg(AET_Hrs),1),ROUND(sum(Ticket_Volume_Hrs),1),ROUND(avg(Attrition_Offshore),1),ROUND(avg(Attrition_Onshore),1),
                ROUND(avg(ITIL_Offshore),1),ROUND(avg(ITIL_Onshore),1)
		FROM operationalmetrics group by month ";
    $result_gt = mysql_query($opResult_gt,$conn);
    return $result_gt;
}
function graph_data_pyramid_DAL()
{
global $conn;
return mysql_query("(SELECT companyname,'D/E/F' as Flag,sum(OnShorePercentage),sum(OffShorePercentage),Target,round(blendedratio,0)  FROM pyramid where flag in ('D','E','F') group by companyname asc )
union all
(SELECT companyname,Flag,OnShorePercentage,OffShorePercentage,Target,round(blendedratio,0)  FROM pyramid where flag not in  ('D','E','F','Total') ) order by companyname,flag asc;",$conn);
}
?>
