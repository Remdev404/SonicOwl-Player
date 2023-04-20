<?php
session_start();
require_once("PHP/headpage.php");
require_once("PHP/user_login.php");
require_once("PHP/config.php");


$req = $dataBase->prepare("SELECT * FROM users");
$req->execute();
$users = $req->fetchAll();

$query = $dataBase->prepare("
    SELECT * FROM users 
    WHERE username LIKE CONCAT('%', :keyword, '%')
    OR email LIKE CONCAT('%', :keyword, '%')
");

if(isset($_GET['keyword'])) {
  $query->execute(['keyword' => $_GET['keyword']]);
  $searchedUsers = $query->fetchAll(PDO::FETCH_ASSOC);
}

global $searchedUsers;

?>
  <body>
    <nav class="navbar">
      <div class="container-fluid d-flex">
        <div id="homelogo" class="col col-lg-1 col-md-1 ps-2">
          <a href="index.html"><img
            id="logo"
            src="LOGO/FullLogo_Transparent_NoBuffer.png"
            alt="logo"
            height="55"
            width="55"
          /></a>
          
        </div>
        <div id="searchinput">
          <form action="community.php" method="get">
          <div class="input-group rounded" style="width: 50vw">
            <input
              type="search"
              name="keyword"
              class="form-control rounded"
              placeholder="Username or e-mail address..."
              aria-label="Search"
              aria-describedby="search-addon"
            />
            <button id="btnsearch">
            <span
              class="input-group-text bg-dark"
              id="search-addon"
              type="submit"
            >
              <i class="mb-1 gg-search" id="iconsearch" style="color: #fbfbfb"></i>
            </span>
            </button>
          </div>
        </form>
        </div>
        <div
          class="col col-lg-9 col-md-8 col-sm-10 text-center d-flex justify-content-center"
        >
          <a id="home" class="px-4" href="index.php">
            <h5 id="homebutton">Home</h5>
          </a>
          <a id="library" class="px-4" href="library.php">
            <h5>Library</h5>
          </a>
          <a id="community" class="px-4" href="community.php">
            <h5 id="communitybutton" class="text-white">Community</h5>
          </a>
          <a
            id="searchbutton"
            href="#"
            class="px-4 d-flex align-items-center justify-content-center"
          >
          <img id="searchbuttonicon" class="mb-1" src="ICON/search.png" alt="" height="18" width="18">
            <h5 id="searchbox" class="ps-3">Search</h5>
          </a>
        </div>
        <div class="col col-lg-2 col-md-3 d-flex justify-content-end">
          <div class="dropdown pe-3">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            </a>
            <ul class="dropdown-menu">
              <a id="theme" class="dropdown-item" href="#">Switch theme</a>
            </ul>
          </div>
          <?php
          if(isset($_SESSION['user'])){
           echo  '<a href="userprofile.php" >
                   <img id="loggedusericon" class="mx-3" src="' . $imageURL . '" alt="userimage"/>
                  </a>';
          } else {
            echo '<a href="login.php">
                   <img id="usericon" class="me-5" src="ICON/user (1).png" alt="" height=22 width=22/>
                  </a>';
          }
          ?>
          <a href="userprofile.php">
            <span id="username" class="me-1">
              <?php
                if(isset($_SESSION['user'])){
                  echo ucfirst($_SESSION['user']['username']);
                 } else {
                   echo '';
                 }
              ?>
            </span>
          </a>
        </div>
      </div>
    </nav>
    <section id="main">
      <div class="container my-5">
          <h2>Our Community</h2>
        </div>
      <p id="noresult" class="mx-5">No result found.</p>
      <div id="usersearch" class="container d-flex flex-wrap my-5">
        <?php
        if($searchedUsers){
          foreach ($searchedUsers as $searchedUser) {
            $searchedImageUrl = 'USER_IMAGES/' . $searchedUser['image'];
            echo '
            <div class="container my-5">
              <h3>Search result(s)...</h3>
            </div>
            <div class="row d-flex flex-column mx-4">
              <div class="col d-flex flex-column justify-content-center align-items-center">
                <img src="'. $searchedImageUrl .'" alt="" height=160 width=160 style="border-radius: 50%; border: 1px solid #332d2d">
                <h3 class="my-3">'. ucfirst($searchedUser['username']) .'</h3>
              </div>
            </div>
            ';
          }
        }
        ?>
       </div>

       <div class="container my-5">
        <h3>All users</h3>
      </div>
    <div class="container d-flex flex-wrap my-5">
      <?php
        foreach ($users as $user) {
          $imageUrl = 'USER_IMAGES/' . $user['image'];
          echo '
          <div class="row d-flex flex-column mx-4">
            <div class="col d-flex flex-column justify-content-center align-items-center">
              <img src="'. $imageUrl .'" alt="" height=160 width=160 style="border-radius: 50%; border: 1px solid #332d2d">
              <h3 class="my-3">'. ucfirst($user['username']) .'</h3>
            </div>
          </div>
          ';
        }
      ?>

    </div>
    </section>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="JS/lightmode-community.js"></script>
    <script src="JS/searchbar.js"></script>
    <script>

    const searchDiv = document.getElementById("usersearch");
    const noResult = document.getElementById("noresult");
    const searchedUsers = <?php echo json_encode($searchedUsers); ?>;

    if(searchedUsers.length > 0) {
      searchDiv.style.display = "block";
    } else {
      noResult.style.display = "block";
    }

  </script>
  </body>
</html>
