<?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'hotel';

    $tablename = 'booking_test';

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }
?>