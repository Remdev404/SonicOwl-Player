<?php
session_start();
require_once("PHP/config.php");
require_once("PHP/user_logout.php");
require_once("PHP/user_login.php");
require_once("PHP/headpage.php");

$sql = "SELECT * FROM playlist";

// Execute the prepared statement and get the resulting PDOStatement object
$statement = $dataBase->query($sql);

$playlistResults = $statement->fetchAll();

?>

  <body>
    <nav class="navbar">
      <div class="container-fluid d-flex">
        <div id="homelogo" class="col col-lg-1 col-md-1 ps-2">
          <a href="index.php"><img
            id="logo"
            src="LOGO/FullLogo_Transparent_NoBuffer.png"
            alt="logo"
            height="55"
            width="55"
          /></a>
          
        </div>
        <div id="searchinput">
          <div class="input-group rounded" style="width: 50vw">
            <input
              type="search"
              class="form-control rounded"
              placeholder="Title, artist or album name ..."
              aria-label="Search"
              aria-describedby="search-addon"
            />
            <span
              class="input-group-text bg-dark"
              id="search-addon"
              type="submit"
            >
              <i class="mb-1 gg-search" style="color: #fbfbfb"></i>
            </span>
          </div>
        </div>
        <div
          class="col col-lg-9 col-md-8 col-sm-10 text-center d-flex justify-content-center"
        >
          <a id="home" class="px-4" href="index.php">
            <h5 id="homebutton" class="text-white">Home</h5>
          </a>
          <a id="library" class="px-4" href="library.php">
            <h5>Library</h5>
          </a>
          <a id="community" class="px-4" href="community.php">
            <h5>Community</h5>
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
           echo '<a href="userprofile.php" >
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
              ?></span>
          </a>
        </div>
      </div>
    </nav>
    <section id="main" class="my-5">
      <div class="container my-5">
        <div class="row">
          <div class="col col-lg-8 col-md-6 col-sm-6 d-flex align-items-center">
            <img
              id="profilephoto"
              src="
              <?php
              echo 'USER_IMAGES/'.$userPhoto = $_SESSION['user']['image']; 
              ?>"
              alt="userphoto"
            />
            <h1 id="profileuserfirstname" class="ps-4 pe-3">
              <?php
              echo $userName = ucfirst($_SESSION['user']['username']);
              ?>
            </h1><br>
            <form method="post">
            <button type="submit" name="logout" class="btn btn-primary-outline text-white mx-2 my-5"> <span>Log Out</span></button>
            </form>
          </div>
          <div class="col col-lg-4 col-md-6 col-sm-6"></div>
        </div>
      </div>
      <div class="container text-start my-5">
        <h4 class="my-5 py-4">My mix</h4>
      </div>
      <div class="container d-flex">
        <div class="col col-lg-6 col-md-6 col-sm-8">Title</div>
        <div
          id="album"
          class="col col-lg-6 col-md-6 col-sm-4 d-flex justify-content-start mx-2"
        >
          Album
        </div>
      </div>
    </section>
    <div class="container">
  <?php
    foreach ($playlistResults as $playlistResult) {
    $playlistTrack = $playlistResult['track_id'];
    $playlistUser = $playlistResult['user_id'];

    if ($playlistUser == $_SESSION['user']['id']) {
    $sql = "SELECT * FROM tracks WHERE id IN ($playlistTrack)";
    $statement = $dataBase->prepare($sql);
    $statement->execute();
    $tracks = $statement->fetchAll();

    foreach ($tracks as $track) {
      $urlCover = 'COVER/' . $track['album_cover'];
      $urlTrack = 'TRACKS/' . $track['title'];
      echo '
        <div class="row">
          <div class="col col-lg-5 col-md-5 col-sm-5 d-flex align-items-center">
            <i id="playbutton" class="gg-play-button-o playbutton"></i>
            <i id="pausebutton" class="gg-play-pause-o pausebutton"></i>
            <h4 class="mx-3 my-1">'. substr($track['title'], 0, -4) .'</h4>
          </div>
          <div class="col col-lg-5 col-md-5 col-sm-5 d-flex align-items-center">
            <img src="'. $urlCover .'" alt="album" width="40" height="40" />
            <h5 class="px-4">'. $track['album'] .'</h5>
          </div>
          <div class="col col-lg-2 col-md-2 col-sm-2 d-flex align-items-center">
            <form action="PHP/deletetrack.php" method="get">
              <input type="text" name="id" value="'. $playlistResult['id'] .'" hidden>
              <input type="text" name="userid" value="'. $userId .'" hidden>
              <input type="text" name="trackid" value="'. $track['id'] .'" hidden>
              <button id="trashbtn" type="submit">
              <i class="gg-trash"></i>
              </button>
            </form>
          </div>
      </div>
    <hr />
      ';
    }
    if(isset($tracks)){
      echo '
      <audio id="title1" src="'. $urlTrack .'"></audio>
      ';
    }
  }
}
      ?>

<!-- PLAYER START -->

    <div id="music-player" class="container-fluid">
      <div class="row">
        <div class="col d-flex justify-content-center align-items-center">
        <div class="timeline">
            <span class="text-light" id="timeline-min">00:00</span>
            <input type="range" min="0" max="100" value="0" id="musicbar">
            <span class="text-light" id="timeline-max">00:00</span>
        </div>
        </div>
        <div class="col d-flex justify-content-between my-3">
          <img id="repeat" src="ICON\repeat-24.png" alt="repeat" class="mx-3" width="24" height="24" />
          <img id="shuffle" src="ICON\shuffle-24.png" alt="shuffle" width="24" height="24" />
          <img
            id="backward"
            src="ICON\media-skip-backward-24.png"
            alt="backward"
            class="me-4 p-0"
            width="24"
            height="24"
          />
        </div>
        <div class="col d-flex justify-content-center align-items-center mb-1">
          <img id="play" src="ICON\play-48.png" alt="play" width="36" height="36"/>
          <img id="pause" src="ICON\pause-48.png" alt="pause" width="36" height="36"/>
        </div>
        <div class="col d-flex justify-content-start my-3">
          <img
            id="forward"
            src="ICON\arrow-44-24.png"
            alt="backward"
            class="ms-3 p-0"
            width="24"
            height="24"
          />
        </div>
        <div class="col d-flex justify-content-center align-items-center mb-1">
          <div id="volume-bar">
            <input
              type="range"
              min="0"
              max="1"
              step="0.1"
              value="1"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- PLAYER END -->

    <!-- AUDIO TAGS START -->


    <!-- AUDIO TAGS END -->
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="JS/lightmode.js"></script>
    <script src="JS/searchbar.js"></script>
    <script src="JS/play.js"></script>
  </body>
</html>
