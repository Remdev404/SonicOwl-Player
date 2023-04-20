<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
      
      
          // Prepare a query to select the user with the given email and password
          $query = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
          $statement = $dataBase->prepare($query);
          $statement->execute(array(':email' => $email, ':password' => $password));
          $user = $statement->fetch(PDO::FETCH_ASSOC);
      
          if ($user) {
      
            // Add username and image to the user array
          $user['username'] = $user['username'];
          $user['image'] = $user['image'];
      
            // Save user data in the session
            $_SESSION['user'] = $user;
            header('Location: index.php'); // redirect to index or any page after successful login
            exit();
          } else {
            $error = "Invalid email or password";
          }
        }
    
    if (isset($_SESSION['user'])) {
        $userName = $_SESSION['user']['username'];
        $userPhoto = $_SESSION['user']['image'];
        $userId = $_SESSION['user']['id'];
        $imageURL = 'USER_IMAGES/' . $_SESSION['user']['image'];
      } else {
        $userId = "";
      }
?>