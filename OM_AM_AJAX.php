<?php
include("BLL/OperationalMetricsAmBLL.php");
$month = $_GET['mnt'];

$display = "";
$rightShore = 0.0;$offHeadCount = 0.0;$onHeadCount = 0.0;$aetHours = 0.0;$tktVolHours = 0.0;$attOff= 0.0;$attOn = 0.0;$itOff = 0.0;$itOn = 0.0;
//Query to retreive all the column details with respect to the month in the query string and form the table dynamically on display
$opResult = table_data_BLL($month);
$colCount=  mysql_num_fields($opResult) or die("display_db_query:" . mysql_error());
$roCount=  mysql_num_rows($opResult) or die("display_db_query:" . mysql_error());
			
while($row = mysql_fetch_array($opResult))
{
    $display = $display . "<tr>";
    for($column_num = 0; $column_num < $colCount; $column_num++) 
    {
        $fieldname = mysql_field_name($opResult, $column_num);
	if($column_num ==0)
	{
            /* 'onClick' event- added by Souvik on 3rd July 2012  onClick='accScoreCard(\"".$row[$column_num] ."\");'*/
            $display = $display . "<TD style='width:19%' onclick=\"javascript:GetCompanyPyramidGraphs('".$row[$column_num]."');\" id='" . $row[0] ."'>" .strtoupper($row[$column_num]) . "</TD>\n";
	}
	else
	{
            $display = $display . "<TD onclick=\"category='$fieldname';last_company='$row[0]';javascript:cellclick('" . $row[0]."', '" . $fieldname . "',".$colCount.");\" style='width:9%;text-align:center' id='" . $fieldname . "_" . $row[0] . "' >" . $row[$column_num] . "</TD>\n";
	}
							
    }
        $display = $display . "</tr>\n";
        
        $rightShore = $rightShore+$row[1]; 
        $offHeadCount =$offHeadCount+$row[2];
	$onHeadCount =$onHeadCount+$row[3];
	$aetHours =$aetHours+$row[4];
	$tktVolHours =$tktVolHours+$row[5];
	$attOff= $attOff+$row[6];
	$attOn = $attOn+$row[7];
	$itOff =$itOff+$row[8];
	$itOn =$itOn+$row[9];
        
}
$rightShore =number_format(($rightShore/$roCount), 1, '.', ''); 
$aetHours =number_format(($aetHours/$roCount), 1, '.', '');  
$attOff=number_format(($attOff/$roCount), 1, '.', '');    
$attOn =number_format(($attOn/$roCount), 1, '.', '');    
$itOff =number_format(($itOff/$roCount), 1, '.', '');   
$itOn =number_format(($itOn/$roCount), 1, '.', ''); 

$display = $display  . "|" . $rightShore . "|" . $offHeadCount . "|" . $onHeadCount . "|" . $aetHours . "|" . $tktVolHours . "|" . $attOff
           . "|" . $attOn . "|" . $itOff . "|" . $itOn ;
echo $display;
?>
