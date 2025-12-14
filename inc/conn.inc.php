<?php

// For me on latest MacOS I couldn't get it to work with using locahost;
// I had to use 127.0.0.1, I found the answer on this link:
// https://stackoverflow.com/a/58234430/6174268
$host = "127.0.0.1"; // localhost: 127.0.0.1; 
$user = "root";
$pass = "toor";
$db = "comp2002";
$dsn = "mysql:host=$host;dbname=$db";


try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected with success";

} catch (PDOException $error) {
    echo "Connection failed" . $error->getMessage();
}

