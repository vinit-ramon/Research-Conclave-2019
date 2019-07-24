<?php
   
   $dbhost = 'localhost'; //skip-grant-tables
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'login';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   
   $db = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
   
   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
   
   //echo 'Connected successfully';
   //mysqli_select_db($conn,'student');
   //$db = new mysqli($dbhost, $dbuser, $dbpass,$);
   //mysqli_close($conn);
?>