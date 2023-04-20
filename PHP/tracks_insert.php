<?php

    if(isset($_FILES['imgfile']) && isset($_FILES['mp3file']) && isset($_POST['author']) && isset($_POST['album'])) {
        $trackName = $_FILES['mp3file']['name'];
        $coverImageName = $_FILES['imgfile']['name'];
        $author = $_POST['author'];
        $album = $_POST['album'];
        $genre = $_POST['genre'];
  
        move_uploaded_file($_FILES['mp3file']['tmp_name'], 'TRACKS/' . $trackName);
        move_uploaded_file($_FILES['imgfile']['tmp_name'], 'COVER/' . $coverImageName);
      
        $req = $dataBase->prepare('INSERT INTO tracks (title, author, album, genre, album_cover) VALUES (?, ?, ?, ?, ?)');
        $req->execute([$trackName, $author, $album, $genre, $coverImageName]);
          
          if($req) {
            $success = "Upload successfully done!";
          }
  
      }
      
?>