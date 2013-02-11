<?php
/*************************************************************************************      
Name			:  OperationallMetricsAmBLL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  3rd-July-2012 
Description     :  Operational metrics AM page bll layer
Modified Date   :  5th-July-2012 
Reason          :  Added a function to plott pyramid graphs             
*************************************************************************************/
include("DAL/OperationalMetricsAmDAL.php");
function calendar_months_BLL()
{
    $calendar_months = calendar_months_DAL();
    return $calendar_months;
}

function table_data_BLL($mnt)
{
    $opResult = table_data_DAL($mnt);
    return $opResult;
}

function graph_data_BLL()
{
   $graph_result = graph_data_DAL();
   return $graph_result;
}

function graph_data_gt_BLL()
{
   $result_gt =  graph_data_gt_DAL();
   return $result_gt;
}
function graph_data_pyramid_BLL()
{
return graph_data_pyramid_DAL();
}
?>
