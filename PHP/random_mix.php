<?php

$statement = $dataBase->prepare("SELECT * FROM tracks ORDER BY RAND() LIMIT 6;
");
$statement->execute();

// Fetch all data from query result
$randomTracks = $statement->fetchAll(PDO::FETCH_ASSOC);

$randomTracks = $_SESSION['randomTracks'];

?>