<?php 
    try {
        $connection = new PDO("mysql:host=" . "localhost" . ";dbname=" . "technipackpfe" ."", "root", '');

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Successfully Connected to Database";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
?>