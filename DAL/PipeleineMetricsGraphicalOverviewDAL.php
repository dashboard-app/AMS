<?php
$ini_array = parse_ini_file("Config.ini");
 
$dbhost = $ini_array['host'];
$dbuser = $ini_array['user'];
$dbpass = $ini_array['password'];
				
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];
mysql_select_db($dbname , $conn)or die("Could not select database");


function monthly_tcv_wtcv_stage37_DAL($company,$sector)
{
    global $conn;
    $tcv_wtcv_stage37= mysql_query ("select month(month),sum(wtcv),sum(tcv) from pipelinemetrics 
                                    where companyname like ('%$company%') and bu like('%$sector%')and
                                    year(month)=YEAR(CURDATE()) group by month(month)",$conn);
   
    return $tcv_wtcv_stage37;    
}

function monthly_tcv_wtcv_stage47_DAL($company,$sector)
{   
    global $conn;
    $tcv_wtcv_stage47 = mysql_query ("select month(month),sum(wtcv),sum(tcv) from pipelinemetrics 
                                        where companyname like ('%$company%') and bu like('%$sector%')
                                        and year(month)=YEAR(CURDATE()) 
                                        and stage>=4 group by month(month)",$conn);
   return $tcv_wtcv_stage47;
    
}

function monthly_sold_data_DAL($company,$sector)
{
    global $conn;
    $sold = mysql_query ("SELECT month(sold_month),sum(total_bookings) FROM sales 
                        where company like ('%$company%') 
                        and bu like('%$sector%')    
                        and year(month)=YEAR(CURDATE()) 
                        group by month(sold_month) ",$conn) ;
    return $sold;
}

function ytd_wtcv_stage37_DAL($company,$sector)
{
//Plot the bar graphs on graphical overview screen based on the last company selected on the main pipeline metrics page - added by Souvik

    $stage37Query="select month(month),ROUND(sum(wtcv/1000),2) from pipelinemetrics where companyname like('%$company%')
                and bu like('%$sector%')and year(month)=YEAR(CURDATE()) GROUP BY month"; 
    global $conn;
    $total_wtcv37 = mysql_query ($stage37Query,$conn);
    return $total_wtcv37;
}

function ytd_wtcv_stage47_DAL($company,$sector)
{
//Plot the bar graphs on graphical overview screen based on the last company selected on the main pipeline metrics page - added by Souvik

$stage47Query="select month(month),ROUND(sum(wtcv/1000),2) from pipelinemetrics where companyname like('%$company%') 
                and bu like('%$sector%') and year(month)=YEAR(CURDATE()) and stage>=4 GROUP BY month";
global $conn;
$total_wtcv47 = mysql_query ($stage47Query,$conn);
return $total_wtcv47;
}

function ytd_sold_DAL($company,$sector)
{
//Plot the bar graphs on graphical overview screen based on the last company selected on the main pipeline metrics page - added by Souvik

$soldQuery="select month(sold_month),ROUND(sum(total_bookings/1000),2) from sales where company like('%$company%')
            and bu like('%$sector%') and  year(sold_month)=year(CURRENT_TIMESTAMP)GROUP BY sold_month";
global $conn;
$total_sold = mysql_query ($soldQuery,$conn);
return $total_sold;
}

?>
