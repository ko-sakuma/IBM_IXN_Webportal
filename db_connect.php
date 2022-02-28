<?php

$server = "localhost";
$username = "root";
$password = "root";
$database = "ixnportal";




// Attempt MySQL server connection
$link = mysqli_connect($server, $username, $password);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// // Confirm connection
// if ($link) {
//   echo 'Connected to MySQL. <br>';
// }


// Look for ixnportal database
$exists = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'ixnportal'";
$exist_result = $link->query($exists);

if ($exist_result->num_rows == 1) {
  // confirm database exists
  while($row = $exist_result->fetch_assoc()) {
    // echo "Successfully found " . $row["SCHEMA_NAME"] . ".<br>";
  }
} else {
  // Create the database
  // echo "Creating database. <br>";
  $create_sql = "
  CREATE DATABASE IF NOT EXISTS ixnportal;

  USE ixnportal;

  DROP TABLE IF EXISTS projects;
  DROP TABLE IF EXISTS admins;
  DROP TABLE IF EXISTS regionaladmins;
  DROP TABLE IF EXISTS events;

  CREATE TABLE admins (
      adminID INT NOT NULL AUTO_INCREMENT,
      adminName VARCHAR(255) NOT NULL,
      email VARCHAR(255) NOT NULL,
      password VARCHAR(255) NOT NULL,
      PRIMARY KEY (adminID),
      UNIQUE (email)
  );

  CREATE TABLE regionaladmins (
      regionalAdminID INT NOT NULL AUTO_INCREMENT,
      fName VARCHAR(50) NOT NULL,
      lName VARCHAR(50) NOT NULL,
      email VARCHAR(255) NOT NULL,
      postcode VARCHAR(20) NOT NULL,
      city VARCHAR(50) NOT NULL,
      country VARCHAR(50) NOT NULL,
      PRIMARY KEY (regionalAdminID),
      UNIQUE (email)
  );

  CREATE TABLE projects (
      projectID INT NOT NULL AUTO_INCREMENT,
      startTime TIMESTAMP NOT NULL,
      completionTime TIMESTAMP NOT NULL DEFAULT NOW(),
      name VARCHAR(100) NOT NULL,
      email VARCHAR(255) NOT NULL,
      projectTitle VARCHAR(255) NOT NULL,
      projectAuthors VARCHAR(255) NOT NULL,
      universityEmails VARCHAR(255) NOT NULL,
      moduleCode VARCHAR(50) NOT NULL,
      teamNumber INT NOT NULL,
      academicsupervisor VARCHAR(255) NOT NULL,
      clientName VARCHAR(255) NOT NULL,
      clientOrganisation VARCHAR(255) NOT NULL,
      techUsed VARCHAR(255) NOT NULL,
      projectKeywords VARCHAR(255) NOT NULL,
      abstract TEXT,
      githubLink TEXT,
      youtubeLink TEXT,
      websiteLink TEXT,
      externalEmails VARCHAR(255) NOT NULL,
      university varchar(100) NOT NULL,
      popularity INT DEFAULT 0,
      workingGroup INT DEFAULT NULL,
      PRIMARY KEY (projectID),
      UNIQUE (projectTitle)
  );

  CREATE TABLE events (
      eventID INT NOT NULL AUTO_INCREMENT,
      eventTitle VARCHAR(255) NOT NULL,
      authorName VARCHAR(255) NOT NULL,
      publishDate DATE NOT NULL,
      eventDate DATE NOT NULL,
      description TEXT NOT NULL,
      link TEXT NOT NULL,
      PRIMARY KEY (eventID)
  );
  
";
  if (mysqli_multi_query($link, $create_sql)){
      echo "Database created successfully. <br>";
  } else{
      echo "ERROR: Could not execute $create_sql. " . mysqli_error($link);
  }

}

// General connection to ixnportal db
$conn = mysqli_connect('localhost','root','root','ixnportal');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  // echo "Connected successfully. <br>";
}


?>
