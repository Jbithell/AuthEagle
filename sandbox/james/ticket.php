<?php
$fd_domain = "https://autheagle.freshdesk.com";
$token = "3tIXgUeAsAceDyZp7df";
$password = "XxxX";//Can be anything! Uses API Key above instead

$data = array(
    "helpdesk_ticket" => array(
        "description" => "Test issue",
        "subject" => "Support needed",
        "email" => "james@jbithell.com",
        "priority" => 3, //Low = 1, Medium = 2, High = 3, Urgent = 4
        "status" => 5, //Open = 2, Pending = 3, Resolved = 4, Closed = 5
        "source" => 7 //Email = 1, Portal = 2, Phone = 3, Forum = 4, Twitter = 5, Facebook = 6, Chat = 7
    )
);

$json_body = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

$header[] = "Content-type: application/json";
$connection = curl_init("$fd_domain/helpdesk/tickets.json");
curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($connection, CURLOPT_HTTPHEADER, $header);
curl_setopt($connection, CURLOPT_HEADER, false);
curl_setopt($connection, CURLOPT_USERPWD, "$token:$password");
curl_setopt($connection, CURLOPT_POST, true);
curl_setopt($connection, CURLOPT_POSTFIELDS, $json_body);
curl_setopt($connection, CURLOPT_VERBOSE, 1);
curl_exec($connection);
?>