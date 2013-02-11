<?php
/*************************************************************************************      
Name			:  PipelineMetricsDAL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Pipeline metrics page dal file
Modified Date   :
Reason          :               
*************************************************************************************/

$ini_array = parse_ini_file("Config.ini");
$dbhost = $ini_array['host'];
$dbuser = $ini_array['user'];
$dbpass = $ini_array['password'];
				
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];
mysql_select_db($dbname , $conn)or die("Could not select database");

function sum_tcv_wtcv_37_bymonth_DAL($sector_name,$top25)
{
    global $conn;
    $result37 = mysql_query ("select month(month),sum(wtcv),sum(tcv) from pipelinemetrics 
                            where year(month)=YEAR(CURDATE()) and bu like ('%$sector_name%')
                            and companyname in 
                            (SELECT distinct companyname  FROM pipelinemetrics where top25 like '%$top25%')
                            group by month(month)",$conn);
    
    return $result37;
}

function sum_tcv_wtcv_47_bymonth_DAL($sector_name,$top25)
{
    global $conn;
    $result47 = mysql_query ("select month(month),sum(wtcv),sum(tcv) from pipelinemetrics
                            where year(month)=YEAR(CURDATE()) and bu like ('%".$sector_name."%') 
                            and stage>=4 and companyname in 
                            (SELECT distinct companyname  FROM pipelinemetrics where top25 like '%$top25%')
                            group by month(month)",$conn);
    return $result47;
}

function sum_sold_bymonth_DAL($sector_name,$top25)
{
    global $conn;
    $total_bookings = mysql_query ("SELECT sum(total_bookings) FROM sales where bu like ('%".$sector_name."%')     
                                    and company in (SELECT distinct company  FROM sales where top25 like '%$top25%')  
                                    and year(sold_month)=YEAR(CURDATE())
                                    group by month(sold_month)",$conn);
    
    return $total_bookings;
}

function sum_tcv_wtcv_37_company_DAL($sector_name,$top25)
{
    global $conn;
    $company37 = mysql_query ("select companyname,month(month),'stage3',sum(wtcv),sum(tcv) from pipelinemetrics 
                            where year(month)=YEAR(CURDATE()) and bu like ('%$sector_name%')
                            and companyname in 
                            (SELECT distinct companyname  FROM pipelinemetrics where top25 like '%$top25%')
                            group by companyname,month(month)",$conn);
    return $company37;
}

function sum_tcv_wtcv_47_company_DAL($sector_name,$top25)
{
    global $conn;
    $company47 = mysql_query ("select companyname,month(month),'stage4',sum(wtcv),sum(tcv) from pipelinemetrics 
                                where year(month)=YEAR(CURDATE()) and bu like ('%$sector_name%')
                                and companyname in 
                                (SELECT distinct companyname  FROM pipelinemetrics where top25 like '%$top25%')
                                and stage>=4
                                group by companyname,month(month)",$conn);
    return $company47;
}

function sum_sold_company_DAL($sector_name,$top25)
{
    global $conn;
    $sold = mysql_query ("select company,month(sold_month),'bookings',sum(total_bookings) from sales 
                        where year(sold_month)=YEAR(CURDATE()) and bu like ('%$sector_name%')
                        and company in (SELECT distinct company  FROM sales where top25 like '%$top25%')
                        group by company,month(sold_month)",$conn);
    return $sold;
}

function pipeline_metrics_table_data_DAL($sector_name,$top25)
{
    global $conn;
    $pipeline_table_data = mysql_query("SELECT p2.companyname,sum(tcv),sum(wtcv)
                            FROM pipelinemetrics p2 
                            where p2.BU like ('%".$sector_name."%') and top25 like ('%".$top25."%')
                            group by  companyname order by COMPANYNAME ",$conn); 
    return $pipeline_table_data;
}
?>
