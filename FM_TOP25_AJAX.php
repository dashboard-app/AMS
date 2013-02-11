<?php
include("BLL/FinancialMetricsTop25BLL.php");
$flag = $_GET['flag'];
$mnt = $_GET['mnt'];
$yr = $_GET['yr'];
if($yr == "2012") { $tableSuffix = "";}
else if($yr == "2013") { $tableSuffix = "_2013"; }

$revenue_sum =0.0; $cmd_sum =0.0;$cmp_sum=0.0;$book_sum=0.0;
$tsResult = table_data_ts_BLL($flag,$mnt,$tableSuffix);
$column_count = mysql_num_fields($tsResult) or die("display_db_query2:" . mysql_error());
$row_count=  mysql_num_rows($tsResult) or die("display_db_query3:" . mysql_error());

$display = "";
$row_count = 0;
while($row = mysql_fetch_array($tsResult))
{
    $display = $display . "<tr id='row_$row_count' >\n";
    $display = $display ."<td  style='width:6.6%'></td>\n";
    for($column_num = 0; $column_num < $column_count; $column_num++)
    {
        $fieldname = mysql_field_name($tsResult, $column_num);
        if($column_num ==0)
        {
            $display = $display ."<TD onclick='cellclick(\"$row[0]\",category);' style='width:30%'>" . strtoupper($row[$column_num]) . "</TD>\n";
        }
        if($column_num ==1)
        {
            $display = $display ."<TD onclick='category=\"Revenue\";cellclick(\"$row[0]\",category);' align=\"Right\" style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n";
            $revenue_sum = $revenue_sum + ($row[$column_num])/1000;
        }
        if($column_num ==2)
        {
            $display = $display ."<TD onclick='category=\"CM$\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n";
            $cmd_sum = $cmd_sum + ($row[$column_num])/1000;
        }
        if($column_num ==3)
        {
            $display = $display ."<TD onclick='category=\"CM%\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;;'>" . number_format($row[$column_num], 1, '.', ','). "</TD>\n";
            $cmp_sum = $cmp_sum + ($row[$column_num]);
        }
        if($column_num ==4)
        {
            $display = $display ."<TD onclick='category=\"Bookings\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num]/1000, 1, '.', ','). "</TD>\n";
            $book_sum = $book_sum + ($row[$column_num]/1000);
        }
    }
  $row_count ++;
  }
  $divide=$row_count;
                             
  //Query and data for AM companies
  $amResult = table_data_am_BLL($mnt,$tableSuffix);
                            
  $column_count = mysql_num_fields($amResult) or die("display_db_query2:" . mysql_error());
  $row_count=  mysql_num_rows($amResult) 	or die("display_db_query3:" . mysql_error());
                            
  $row_count = 0;
  while($row = mysql_fetch_array($amResult))
  {
      $display = $display ."<tr >\n";
      $display = $display ."<td  style='width:6.6%'></td>\n";
      for($column_num = 0; $column_num < $column_count; $column_num++)
      {
          $fieldname = mysql_field_name($amResult, $column_num);
          if($column_num ==0)
          {
              $display = $display ."<TD onclick='cellclick(\"$row[0]\",category);' style='width:30%'>" . strtoupper($row[$column_num]) . "</TD>\n";                                        
          }
          if(($column_num ==1) )
          {
              $display = $display ."<TD onclick='category=\"Revenue\";cellclick(\"$row[0]\",category);' align=\"Right\" style='text-align:right;width:13.36%;'>" . number_format($row[$column_num], 1, '.', ','). "</TD>\n";
              $revenue_sum = $revenue_sum + ($row[$column_num]);
          }
          if($column_num ==2)
          {
              $display = $display ."<TD onclick='category=\"CM$\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num], 1, '.', ','). "</TD>\n";
              $cmd_sum = $cmd_sum + ($row[$column_num]);
          }
          if($column_num ==3)
          {
              $display = $display ."<TD onclick='category=\"CM%\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;;'>" . number_format($row[$column_num], 1, '.', ','). "</TD>\n";
              $cmp_sum = $cmp_sum + ($row[$column_num]);
          }
          if($column_num ==4)
          {
              $display = $display ."<TD onclick='category=\"Bookings\";cellclick(\"$row[0]\",category);' align='right' style='text-align:right;width:13.36%;'>" . number_format($row[$column_num], 1, '.', ','). "</TD>\n";
              $book_sum = $book_sum + ($row[$column_num]);
          }
	} 
        $row_count ++; 
    }
    $divide=$divide+$row_count;

    $display = $display  . "|" . number_format($revenue_sum , 1, '.', ',') . "|" . number_format($cmd_sum , 1, '.', ',') . "|" 
             . number_format($cmp_sum , 1, '.', ',') . "|" .number_format($book_sum , 1, '.', ',') ;
    echo $display;
?>
		