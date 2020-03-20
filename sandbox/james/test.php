<?php
$db_hostname = 'autheagle-prod-main-1.c4cxwfpn3aub.eu-west-1.rds.amazonaws.com';
$db_username = 'autheagle';
$db_password = 'p{%E+(7Rbd\$diT';
$db_database = 'autheagle_1';
// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) {
     die("Connection failed, please contact support");
} 

$sql = "SELECT * FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         print_r($row);
     }
} else {
     echo "0 results";
}

$conn->close();
?>