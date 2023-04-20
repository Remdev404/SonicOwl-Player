<?php

    try {
        $dataBase = new PDO('mysql:host=127.0.0.1; dbname=player', 'root', '');
    }
    catch (PDOException $e) {
        die('An error occured while connecting to the database: ' . $e->getMessage());
    }

?>