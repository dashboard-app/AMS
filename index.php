<?php
            $sector_name=$_GET['sector'];
            $company = $_GET['companyname'];
            $company_id = $_GET['company_id'];
            $top25=$_GET['top25'];
            $sector_ID = 22;
            $ini_array = parse_ini_file("Config.ini");




                              $dbhost = $ini_array['host'];
                              $dbuser = $ini_array['user'];
                              $dbpass = $ini_array['password'];
                              
            $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	$dbname = $ini_array['database'];
	mysql_select_db($dbname , $conn) or die("Could not select database");
           
				
	
            
				
                        $opResult = mysql_query("SELECT distinct companyname,bu,projectname,stage,tcv,wtcv,prob,month  
                          FROM pipelinemetrics p2 where p2.BU like ('%".$sector_name."%') and top25 like ('%".$top25."%') ",$conn);
                           // where companyname like ('%".$company."'%)",$conn);
				//$roCount=  mysql_num_rows($opResult) or die("display_db_query:" . mysql_error());
				//echo "<script type='text/javascript'>\n"; 
				//echo "var rowsize=".$roCount.";\n";
				//echo "</script>\n";
                         
                         
                                $column_count = mysql_num_fields($opResult) or die("display_db_query:" . mysql_error());
				$row_count=  mysql_num_rows($opResult)	or die("display_db_query:" . mysql_error());
                                
				// Row Loop
                                        $display = "";
                                        //$row_count = 0;
                                      /*  $display = "<tr style = 'background:#ffffff'><th style=\"width:6.6%\"><b>BU</b></th>
                                                               <th style=\"width:26.6%\" ><span><b>Project Name</b></span></th>
                                                               <th  style=\"width:13.36%\" ><b>Stage</b></th>
                                                               <th style=\"width:13.36%\" ><b>TCV</b></th>
                                                               <th style=\"width:13.36%\"><b>W. TCV</b></th>
                                                               <th style=\"width:13.36%\"><b>Prob </b></th></tr> ";*/
                                        $display = "<tr class='company_$company_id' style = 'background:#ffffff'><td style=\"width:6.6%\"><b>BU</b></td><td style=\"width:26.6%\"><span><b>Project Name</b></span></td><td  style=\"width:13.36%\" ><b>Stage</b></td><td style=\"width:13.36%\" ><b>TCV</b></td> <td style=\"width:13.36%\"><b>W. TCV</b></td> <td style=\"width:11.36%\"><b>Prob </b></td><td style=\"width:15.36%\"><b>Close Month</b></td></tr> ";
                                        
                                        
					while($row = mysql_fetch_array($opResult))
					{
                                            
                                            $row[0]= str_replace("&","~",$row[0]);
                                          if(!strcmp($row[0],$company))
                                             {
                                                
                                                
                                                               $display = $display."<tr class='company_$company_id' style = 'background:#ffffff' class='pipe_$row_count'>";
                                                                for($column_num = 0; $column_num < $column_count ; $column_num++) 
                                                                    {							
                                                                      if($column_num != 0)
                                                                      {
                                                                      if($column_num ==1) 
                                                                        $display = $display."<TD style='width:6.6%'>" . $row[$column_num] . "</TD>\n";
                                                                    
                                                                        else if ($column_num ==2)
                                                                            $display = $display."<TD style='width:26.6%' >" . $row[$column_num] . "</TD>\n";
                                                                        
                                                                        else if (($column_num ==4) || ($column_num ==5) )
                                                                            $display = $display."<TD style='width:13.36%' >" . number_format($row[$column_num]/1000, 1, '.', ',') . "</TD>\n";
                                                                        
                                                                        else if ($column_num ==6)
                                                                            $display = $display."<TD style='width:13.36%' >" . number_format($row[$column_num], 1, '.', ',') . "</TD>\n";
                                                                        else if ($column_num ==7)
                                                                            $display = $display."<TD style='width:13.36%' >" . date("M  -  Y",strtotime($row[$column_num])) . "</TD>\n";
                                                                        else
                                                                            $display = $display."<TD style='width:13.36%' >" . $row[$column_num] . "</TD>\n";
                                                                      }
                                                                 
                                                                    }
                                                               $display = $display."</tr>";
                                                                  
                                                    
                                              } 
                                              //$row_count ++;    
					}
					
                                     echo $display;   
?>
		
			
