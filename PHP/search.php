<?php
session_start();

// Retrieve the search keyword from the GET request
$keyword = $_GET['keyword'];

// Prepare and execute the database query
$stmt = $pdo->prepare("
    SELECT * FROM tracks 
    WHERE title LIKE CONCAT('%', :keyword, '%')
    OR album LIKE CONCAT('%', :keyword, '%')
    OR author LIKE CONCAT('%', :keyword, '%')
");
$stmt->execute(['keyword' => $keyword]);
$tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Store the search results in a session variable
$_SESSION['search_results'] = $tracks;

// Redirect back to the index.php page
header('Location: index.php');
exit;
?>