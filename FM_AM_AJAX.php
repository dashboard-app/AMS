<?php
$act_total = 0.0; $for_total = 0.0;$bud_total = 0.0;
include("BLL/FinancialMetricsAmBLL.php");
$month    = $_GET['mnt'];
$category = $_GET['category'];
$yr = $_GET['yr'];
if($yr == "2012") { $tableSuffix = "";}
else if($yr == "2013") { $tableSuffix = "_2013"; }

$ini_array = parse_ini_file("Config.ini");
$dbhost = $ini_array['host'];
$dbuser = $ini_array['user'];
$dbpass = $ini_array['password'];
                              
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = $ini_array['database'];
mysql_select_db($dbname , $conn) or die("Could not select database");
           
				
$query = table_data_BLL($month,$category,$tableSuffix);
$col_count = mysql_num_fields($query) or die("display_db_query:1" . mysql_error());        
$row_count=  mysql_num_rows($query) or die("No Data Available" . mysql_error());


$display = "";

while($row = mysql_fetch_array($query))
{
    $display = $display . "<tr>";
    for($column_num = 0; $column_num < $col_count; $column_num++) 
    {
        if($column_num ==0)
            $display = $display . "<TD  onclick='cellclick(\"".$row[0]."\",last_category);' style='width:19%'  id='" . $row[0] ."'>" . strtoupper($row[$column_num]) . "</TD>";
							
        else if($column_num == 1)
            $display = $display . "<TD   onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>";
                                                        
        else if($column_num == 2)
           $display = $display . "<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>";
                                                        
        else if($column_num == 3)
           $display = $display . "<TD onclick='cellclick(\"".$row[0]."\",category);' style='border-right:1px solid gray;text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>";
                                                        
        else if($column_num == 4)
           $display = $display . "<TD   onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n";
                                                        
        else if($column_num == 5)
            $display = $display . "<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>\n";
                                                        
        else if($column_num == 6)
            $display = $display . "<TD onclick='cellclick(\"".$row[0]."\",category);' style='border-right:1px solid gray;text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>";
                                                        
        else if($column_num == 7)
            $display = $display . "<TD   onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>";
                                                        
        else if($column_num == 8)
            $display = $display . "<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>";
                                                        
        else if($column_num == 9)
            $display = $display . "<TD onclick='cellclick(\"".$row[0]."\",category);' style='text-align:right;width:9%;align:left'> ".number_format($row[$column_num], 1, '.', ',') . "</TD>";
    }
    $act_total=$act_total+$row[1];
    $for_total=$for_total+$row[4];
    $bud_total=$bud_total+$row[7];
    
    $display = $display . "</tr>";
}

$display = $display  . "|" . $act_total . "|" . $for_total . "|" . $bud_total;

echo $display;
?>
