<?php
    try {
      $dataBase = new PDO('mysql:host=127.0.0.1; dbname=player', 'root', '');
    }
    catch (PDOException $e) {
      die('An error occured while connecting to the database: ' . $e->getMessage());
   }

  if(isset($_GET['id']) && isset($_GET['userid']) && isset($_GET['trackid'])) {
    $id = $_GET['id'];
    $userid = $_GET['userid'];
    $trackid = $_GET['trackid'];
    
    // prepare the SQL statement
    $statement = $dataBase->prepare("DELETE FROM playlist WHERE id =:id AND user_id = :user_id AND track_id = :track_id");
    
    // bind the parameters
    $statement->bindParam(':id', $id);
    $statement->bindParam(':user_id', $userid);
    $statement->bindParam(':track_id', $trackid);
    
    // execute the statement
    $statement->execute();
  }
  header("Location: ../userprofile.php");
?>