<?php
$filename = "./dateFile.txt";
$lines = file($filename, FILE_IGNORE_NEW_LINES);



if($_GET['type'] == 'fm')
    $line_no = 0;

else if($_GET['type'] == 'om')
    $line_no = 1;

else if($_GET['type'] == 'pm')
    $line_no = 2;
    
else
{
    echo "Incorrect tpye. Try again.";
    exit();
}
    

$lines[$line_no] = $_GET['date'];
$success = file_put_contents( getcwd().$filename , implode( "\n", $lines ));
echo "Date updated successfully - $success".getcwd();

?>
