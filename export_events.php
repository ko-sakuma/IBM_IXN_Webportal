<?php

// uncomment for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('mysql_connect.php');

// dateTime conversion function to conform to MySQL format
// https://www.php.net/manual/en/datetime.createfromformat.php
function ConvertTocsvFormat($csvDate) {
    return date('n/j/Y',strtotime($csvDate));
}

// define filename
$filename = 'Events.csv';

// get column headers query
$DbHeaders = "SELECT `COLUMN_NAME` 
              FROM `INFORMATION_SCHEMA`.`COLUMNS` 
              WHERE `TABLE_SCHEMA`='ixnportal' 
              AND `TABLE_NAME`='events'";

// retrieve events query 
$DbToCsv ="SELECT eventTitle, authorName, publishDate, 
           eventDate, description, link
           FROM events";

// open database connection 
$conn = OpenDbconnection();

$columnNames = array('Event title', 'Author Name', 
                     'Publish date ("DD/MM/YYYY")', 'Event date ("DD/MM/YYYY")', 
                     'Description (max 600 characters)', 'External link');

// fetch events
$events = $conn->query($DbToCsv);

// foreach ($events as $event) {
//     echo print_r($event). "<br>";
//     echo "<br>";
// }

// prepare csv
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=events.csv');

// open file
$output = fopen('php://output', 'w');

// // insert header row into csv 
fputcsv($output, $columnNames);

// // insert events into csv
while ($row = $events->fetch_assoc()) {
    // echo "1 <pre>"; var_dump($row); echo "<post>";
    $row['publishDate'] = ConvertTocsvFormat($row['publishDate']);
    $row['eventDate'] = ConvertTocsvFormat($row['eventDate']);
    // echo "2 <pre>"; var_dump($row); echo "<post>";
    fputcsv($output, $row);
}

// close file 
fclose($output);
CloseDbConnection($conn);
exit;


?>

