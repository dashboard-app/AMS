<?php 
/*************************************************************************************      
Name			:  FinancialMetricsAmBLL.php 
Author			:  A, Mohammed Khadar Khan
Created Date	:  7th-July-2012 
Description     :  Financial metrics AM page bll layer
Modified Date   :  7th-July-2012 
Reason          :  added  convert_month_digit_BLL() to convert month to digit       
*************************************************************************************/
include("DAL/FinancialMetricsAmDAL.php");
// to get query string for $revenue_ytd,$revenue_yel,$cmd_ytd,$cmd_yel,$bk_ytd,$bk_yel 
function ytd_yel_query_string_BLL($mnt,$category)
{
     switch($mnt)
        {
           case "JAN": 
               //Actuals YTD,YEL
                $ytd_act = "`JAN-A` "; 
                $yel_act="`JAN-A`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                                          
                
                //Forecast YTD,YEL
                
                $ytd_for = "`JAN-F` "; 
                $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                
                //Budget YTD,YEL
                $ytd_bud = "`JAN-B` "; 
                $yel_bud="`JAN-B`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                
                
            break;
            case "FEB": 
                 $ytd_act = "`JAN-A`+`FEB-A` "; 
                 $yel_act ="`JAN-A`+`FEB-A`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                 
                 
                 $ytd_for = "`JAN-F`+`FEB-F` "; 
                 $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                 
                 
                 $ytd_bud = "`JAN-B`+`FEB-B` "; 
                 $yel_bud="`JAN-B`+`FEB-B`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                
                 
            break;
            case "MAR": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A` "; 
                $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
              
                 
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F` "; 
                $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B` "; 
                $yel_bud="`JAN-B`+`FEB-B`+`MAR-B`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
            break;                         
            case "APR": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A` "; 
                $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F` "; 
                $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B` "; 
                $yel_bud ="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
              
           break;                         
           case "MAY": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A` "; 
                $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F` "; 
                $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
              
               
               $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B` "; 
               $yel_bud ="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
              
          break;
          case "JUN": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A` "; 
                $yel_act ="`JAN-A`+`FEB-A`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                 
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F` "; 
                $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B` "; 
                $yel_bud ="`JAN-B`+`FEB-B`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
              
          break;
          case "JUL": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+`JUL-A` "; 
                $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+ 
                                            `JUL-A`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+`JUL-F` "; 
                $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+`JUL-B` "; 
                $yel_bud ="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+ 
                                            `JUL-B`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
          break;
          case "AUG": 
                 $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+`JUL-A`+`AUG-A` "; 
                 $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+ 
                                            `JUL-A`+`AUG-A`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                 
                 $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+`JUL-F`+`AUG-F` "; 
                 $yel_for="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                 
                 $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+`JUL-B`+`AUG-B` "; 
                 $yel_bud="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+ 
                                            `JUL-B`+`AUG-B`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                
         break;
         case "SEP": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+`JUL-A`+`AUG-A`+`SEP-A` "; 
                $yel_act="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+ 
                                            `JUL-A`+`AUG-A`+`SEP-A`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                
                
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+`JUL-F`+`AUG-F`+`SEP-F` "; 
                $yel_for ="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
               
                
                $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+`JUL-B`+`AUG-B`+`SEP-B` "; 
                $yel_bud ="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+ 
                                            `JUL-B`+`AUG-B`+`SEP-B`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                
         break;
         case "OCT": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+`JUL-A`+`AUG-A`+`SEP-A`+`OCT-A` "; 
                $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+ 
                                           `JUL-A`+`AUG-A`+`SEP-A`+`OCT-A`+`NOV-F`+`DEC-F` ";
                             
              
                
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+`JUL-F`+`AUG-F`+`SEP-F`+`OCT-F` "; 
                $yel_for ="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
                
                
                $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+`JUL-B`+`AUG-B`+`SEP-B`+`OCT-B` "; 
                $yel_bud ="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+ 
                                            `JUL-B`+`AUG-B`+`SEP-B`+`OCT-B`+`NOV-F`+`DEC-F` ";
                             
                
                             
        break;
        case "NOV": 
               $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+`JUL-A`+`AUG-A`+`SEP-A`+`OCT-A`+`NOV-A` "; 
               $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+ 
                                            `JUL-A`+`AUG-A`+`SEP-A`+`OCT-A`+`NOV-A`+`DEC-F` ";
                             
              
               
               $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+`JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F` "; 
               $yel_for ="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
               
               $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+`JUL-B`+`AUG-B`+`SEP-B`+`OCT-B`+`NOV-B` "; 
               $yel_bud ="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+ 
                                            `JUL-B`+`AUG-B`+`SEP-B`+`OCT-B`+`NOV-B`+`DEC-F` ";
                             
               
                             
     
       case "DEC": 
                $ytd_act = "`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+`JUL-A`+`AUG-A`+`SEP-A`+`OCT-A`+`NOV-A`+`DEC-A` "; 
                $yel_act ="`JAN-A`+`FEB-A`+`MAR-A`+`APR-A`+`MAY-A`+`JUN-A`+ 
                                            `JUL-A`+`AUG-A`+`SEP-A`+`OCT-A`+`NOV-A`+`DEC-A` ";
                             
               
                
                $ytd_for = "`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+`JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` "; 
                $yel_for ="`JAN-F`+`FEB-F`+`MAR-F`+`APR-F`+`MAY-F`+`JUN-F`+ 
                                            `JUL-F`+`AUG-F`+`SEP-F`+`OCT-F`+`NOV-F`+`DEC-F` ";
                             
               
                
                $ytd_bud = "`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+`JUL-B`+`AUG-B`+`SEP-B`+`OCT-B`+`NOV-B`+`DEC-B` "; 
                $yel_bud="`JAN-B`+`FEB-B`+`MAR-B`+`APR-B`+`MAY-B`+`JUN-B`+ 
                                            `JUL-B`+`AUG-B`+`SEP-B`+`OCT-B`+`NOV-B`+`DEC-B` ";
                             
            
        }
        
   $return_array = array($ytd_act, $yel_act, $ytd_for, $yel_for, $ytd_bud, $yel_bud);
   return $return_array;
}        
// latest month
$latest_month  = latest_month($tableSuffix);

// query table data from DAL
function table_data_BLL($mnt,$category,$tableSuffix)
{
    $result = ytd_yel_query_string_BLL($mnt,$category);
    $result_table = data_table_query_DAL($result,$mnt,$category,$tableSuffix);
    return $result_table;
}

// query graph data from DAL
function graph_data_BLL($mnt,$flag,$category,$tableSuffix)
{
    $result = ytd_yel_query_string_BLL($mnt,$category);
    $result_graph = graph_data_query_DAL($result,$flag,$mnt,$category,$tableSuffix);
    return $result_graph;
}

// query grand total - graph data from DAL
function graph_data_grandtotal_BLL($mnt,$flag,$category,$tableSuffix)
{
    $result_graph_grandtotal = graph_grandtotal_query_DAL($mnt,$flag,$category,$tableSuffix);
    return $result_graph_grandtotal;
}

//Added by Mohammed on 7th July 2012
function convert_month_digit_BLL($mnt)
{
    if($mnt == 'JAN')       {return 1;}
    else if($mnt == 'FEB')  {return 2;}
    else if($mnt == 'MAR')  {return 3;}
    else if($mnt == 'APR')  {return 4;}
    else if($mnt == 'MAY')  {return 5;}
    else if($mnt == 'JUN')  {return 6;}
    else if($mnt == 'JUL')  {return 7;}
    else if($mnt == 'AUG')  {return 8;}
    else if($mnt == 'SEP')  {return 9;}
    else if($mnt == 'OCT')  {return 10;}
    else if($mnt == 'NOV')  {return 11;}
    else if($mnt == 'DEC')  {return 12;}
}



function cmp_total_numbers_BLL($mnt,$tableSuffix)
{
    $cmp_total_numbers = cmp_total_numbers_DAL($mnt,$tableSuffix);
    return $cmp_total_numbers;
}
                 
?>