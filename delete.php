<?php

    include 'config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $sql = "DELETE FROM $tablename WHERE id = '$id'";

        $result = $conn->query($sql);

        if (!$result) {
            echo 'Error:' . $sql . '<br>' . $conn->error;
        }
        
        header('Location: view.php');
    }

?>