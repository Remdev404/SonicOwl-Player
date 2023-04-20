<?php

if(isset($_FILES['file']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
  $tmpName = $_FILES['file']['tmp_name'];
  $name = $_FILES['file']['name'];
  $type = $_FILES['file']['type'];
  $size = $_FILES['file']['size'];
  $error = $_FILES['file']['error'];
  $userName = strtolower($_POST['username']);
  $email = strtolower($_POST['email']);
  $password = $_POST['password'];

  $tabExtension = explode('.', $name);
  $extension = strtolower(end($tabExtension));
  $extensionsAllowed = ['jpg', 'jpeg', 'png', 'gif'];

  if(in_array($extension,$extensionsAllowed)) {
    $uniqueName = uniqid('', true);
    $fileName = $uniqueName.'.'.$extension;

    move_uploaded_file($tmpName, './USER_IMAGES/'.$fileName);

    $req = $dataBase->prepare('INSERT INTO users (username, email, password, image) VALUES (?, ?, ?, ?)');
    $req->execute([$userName, $email, $password, $fileName]);
    
    if($req) {
      $success = "You've successfully joined our community!";
    }

  }
}

?>