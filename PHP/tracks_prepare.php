<?php
require_once('PHP/config.php');


$statement = $dataBase->prepare("SELECT * FROM tracks");
$statement->execute();

// Fetch all data from query result
$tracks = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_SESSION['tracks'])){
    $tracks = $_SESSION['tracks'];
}

// Fetch random tracks

$req = $dataBase->prepare("SELECT * FROM tracks ORDER BY RAND() LIMIT 6");
$req->execute();

// Fetch all data from query result
$randomTracks = $req->fetchAll();

$_SESSION['randomTracks'] = $randomTracks;

// Fetch tracks by it's genre 'rap 'n R&B'

$req = $dataBase->prepare("SELECT * FROM tracks WHERE genre = '1' ORDER BY title ASC LIMIT 6");
$req->execute();

$rapTracks = $req->fetchAll();

$_SESSION['rap'] = $rapTracks;



// Fetch tracks by it's genre 'hip & hop'

$req = $dataBase->prepare("SELECT * FROM tracks WHERE genre = '2' ORDER BY title ASC LIMIT 6");
$req->execute();

$hiphopTracks = $req->fetchAll();

$_SESSION['hiphop'] = $hiphopTracks;




// Fetch tracks by it's genre '80s - 90s'

$req = $dataBase->prepare("SELECT * FROM tracks WHERE genre = '3' ORDER BY title ASC LIMIT 6");
$req->execute();

$oldschoolTracks = $req->fetchAll();

$_SESSION['oldschool'] = $oldschoolTracks;




// Fetch tracks by it's genre 'country'

$req = $dataBase->prepare("SELECT * FROM tracks WHERE genre = '4' ORDER BY title ASC LIMIT 6");
$req->execute();

$countryTracks = $req->fetchAll();

$_SESSION['country'] = $countryTracks;
?>