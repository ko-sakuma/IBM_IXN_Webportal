<?php

require('mysql_connect.php');

// define filename
$filename = 'Regional_Admins.csv';

// get column headers query
$DbHeaders = "SELECT `COLUMN_NAME` 
              FROM `INFORMATION_SCHEMA`.`COLUMNS` 
              WHERE `TABLE_SCHEMA`='ixnportal' 
              AND `TABLE_NAME`='regionaladmins'";

// retrieve events query 
$DbToCsv ="SELECT fName, lName, email, postcode, city, country
           FROM regionaladmins";

// open database connection 
$conn = OpenDbconnection();

$columnNames = array('First Name', 'Last Name', 
                     'Email', 'Postcode', 
                     'City', 'Country');

// fetch RAs
$events = $conn->query($DbToCsv);

// prepare csv
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Regional_Admins.csv');

// open file
$output = fopen('php://output', 'w');

// // insert header row into csv 
fputcsv($output, $columnNames);

// insert events into csv
while ($row = $events->fetch_assoc()) {
    fputcsv($output, $row);
}

// close file 
fclose($output);
CloseDbConnection($conn);
exit;


?>

