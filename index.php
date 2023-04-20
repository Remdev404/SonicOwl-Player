<?php
session_start();
require_once("PHP/user_login.php");
require_once("PHP/tracks_prepare.php");
require_once("PHP/headpage.php");
?>

<?php
require_once("PHP/config.php");

$requery = $dataBase->prepare("
    SELECT * FROM tracks 
    WHERE title LIKE CONCAT('%', :keyword, '%')
    OR album LIKE CONCAT('%', :keyword, '%')
    OR author LIKE CONCAT('%', :keyword, '%')
    LIMIT 6
");

if(isset($_GET['keyword'])) {
  $requery->execute(['keyword' => $_GET['keyword']]);
  $searchedTracks = $requery->fetchAll(PDO::FETCH_ASSOC);
}

global $searchedTracks;

if (isset($userId)) {
  // Prepare the SQL statement for insertion
  $sql = "INSERT INTO playlist (user_id, track_id) VALUES (:userId, :trackId)";
  $statement = $dataBase->prepare($sql);

  // Bind the values to the prepared statement
  if(isset($_GET['userid']) && isset($_GET['trackid']) && $userId) {
    $statement->bindParam(':userId', $_GET['userid']);
    $statement->bindParam(':trackId', $_GET['trackid']);
    $statement->execute();
  }
};

?>



  <body>
    <!-- NAVBAR START -->
    <nav class="navbar">
      <div class="container-fluid d-flex">
        <div id="homelogo" class="col col-lg-1 col-md-1 ps-2">
          <a href="index.php"><img
            id="logo"
            src="LOGO\FullLogo_Transparent_NoBuffer.png"
            alt="logo"
            height="55"
            width="55"
          /></a>
          
        </div>
        <div id="searchinput">
          <form action="index.php" method="get">
          <div class="input-group rounded" style="width: 50vw">
            <input
              type="search"
              name="keyword"
              class="form-control rounded"
              placeholder="Title, artist or album name ..."
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
           echo ' <a href="userprofile.php" >
                  <img id="loggedusericon" class="mx-3" src="' . $imageURL . '" alt="userimage"/>
                  </a>
                  ';
          } else {
            echo '<a class="me-5" href="login.php">
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
    <!-- NAVBAR END -->
    <!-- SECTION MAIN START -->
    <div id="main" class="">
      <div class="container d-flex my-3">
        
        <button id="rapsection" type="button" class="btn btn-primary-outline text-white mx-2 my-5"> <span>Rap 'n R&B</span></button>
        <button id="hiphopsection" type="button" class="btn btn-primary-outline text-white mx-2 my-5"> <span>Hip & Hop</span></button>
        <button id="oldschoolsection" type="button" class="btn btn-primary-outline text-white mx-2 my-5"> <span>80's & 90's</span> </button>
        <button id="countrysection" type="button" class="btn btn-primary-outline text-white mx-2 my-5"> <span>Country</span> </button>

      </div>


    <!-- SEARCH SECTION START -->

      <p id="noresult" class="mx-5">No result found.</p>

    <section id="search" class="container-fluid my-4">
        <h3>Search results...</h3>
      </div>

      <div class="container-fluid d-flex my-4">

      <?php
      if($searchedTracks){
        foreach ($searchedTracks as $searchedTrack) {
          $searchedAlbumImg = 'COVER/'. $searchedTrack['album_cover'];
          echo '
          <form action="index.php" method="get">
          <input type="text" name="userid" value="'.$userId.'" hidden>
          <input type="text" name="trackid" value="'.$searchedTrack['id'].'" hidden>
            <button id="likebutton" type="submit">
                <img src="ICON/fvbtn.png" alt="" width="24" height="22">
            </button>
          </form>
          <div id="albumcard" class="card rounded-0 mx-3 d-flex align-items-center justify-content-center">
          <img src="'. $searchedAlbumImg .'" alt="">
          <img id="albumplaybtn" class="playbutton" src="ICON/play-48.png" alt="">
          <img id="albumpausebtn" class="pausebutton" src="ICON/pause-48.png" alt="">
          </div>
          ';
        }
      }
      ?>

      </div>

      <div class="container-fluid d-flex my-2">

      <?php
      if($searchedTracks){
        foreach ($searchedTracks as $searchedTrack) {
          $searchedPureTrackname = substr($searchedTrack['title'], 0, -4);
          echo '
          <div id="tracktitle" class="d-flex justify-content-center mx-3">
          <h4>'. $searchedPureTrackname .'</h4>
        </div>
          ';
        }
      }
      ?>

      </div>


      <div class="container-fluid d-flex my-2">

      <?php
      if($searchedTracks){
        foreach ($searchedTracks as $searchedTrack) {
          echo '
          <div id="tracksinger" class="d-flex justify-content-center mx-3">
            <h5>' . $searchedTrack['author'] . '</h5>
          </div>
          ';
        }
      } 
      ?>

      </div>

    <!-- SEARCH MIX AUDIO START -->

      <?php
      if($searchedTracks) {
        foreach ($searchedTracks as $searchedTrack) {
          $searchedMp3Name = 'TRACKS/'.$searchedTrack['title'];
          echo '<audio id="title" src="'. $searchedMp3Name .'"></audio>';
        }
      } 
    ?>

    <!-- SEARCH MIX AUDIO END -->


    
  </section>

    <!-- SEARCH SECTION END -->



      <!-- RANDOM MIX START -->

      <section id="randommix" class="container-fluid py-4 my-4">
        <h3 class="mb-4">Random mix</h3>
      </div>

      <div class="container-fluid d-flex py-4 my-4">

      <?php
        foreach ($randomTracks as $randomTrack) {
          $albumImg = 'COVER/'. $randomTrack['album_cover'];
          echo '
          <form action="index.php" method="get">
          <input type="text" name="userid" value="'. $userId .'" hidden>
          <input type="text" name="trackid" value="'. $randomTrack['id'] .'" hidden>
            <button id="likebutton" type="submit">
                <img src="ICON/fvbtn.png" alt="" width="24" height="22">
            </button>
          </form>
          <div id="albumcard" class="card rounded-0 mx-3 d-flex align-items-center justify-content-center">
          <img src="'. $albumImg .'" alt="">
          <img id="albumplaybtn" class="playbutton" src="ICON/play-48.png" alt="">
          <img id="albumpausebtn" class="pausebutton" src="ICON/pause-48.png" alt="">
          </div>
          ';
        }
      ?>

      </div>

      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($randomTracks as $randomTrack) {
          $pureTrackname = substr($randomTrack['title'], 0, -4);
          echo '
          <div id="tracktitle" class="d-flex justify-content-center mx-3">
          <h4>'. $pureTrackname .'</h4>
        </div>
          ';
        }
      ?>

      </div>


      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($randomTracks as $randomTrack) {
          echo '
          <div id="tracksinger" class="d-flex justify-content-center mx-3">
            <h5>' . $randomTrack['author'] . '</h5>
          </div>
          ';
        }
      ?>

      </div>

    <!-- RANDOM MIX AUDIO START -->

      <?php
      foreach ($randomTracks as $randomTrack) {
        $randomMp3Name = 'TRACKS/'.$randomTrack['title'];
        echo '<audio id="title" src="'. $randomMp3Name .'"></audio>';
      }
    ?>

    <!-- RANDOM MIX AUDIO END -->


      <!-- RANDOM MIX END -->

    </section>
  
    <!-- ////////////////////////////////////////////////////////////////////////// -->
    
    
    <!-- RAP SECTION START -->

    <section id="rap" class="genre" class="mt-5 pt-5 mb-4">
    <div class="container-fluid mt-5 pt-5 mb-5">
        <h3>Rap 'n R&B</h3>
      </div>

      <div class="container-fluid d-flex my-4">

      <?php
        foreach ($rapTracks as $rapTrack) {
          $rapAlbumImg = 'COVER/'. $rapTrack['album_cover'];
          echo '
          <form action="index.php" method="get">
          <input type="text" name="userid" value="'. $userId .'" hidden>
          <input type="text" name="trackid" value="'. $rapTrack['id'] .'" hidden>
            <button id="likebutton" type="submit">
                <img src="ICON/fvbtn.png" alt="" width="24" height="22">
            </button>
          </form>
          <div id="albumcard" class="card rounded-0 mx-3 d-flex align-items-center justify-content-center">
          <img src="'. $rapAlbumImg .'" alt="">
          <img id="albumplaybtn" class="playbutton" src="ICON/play-48.png" alt="">
          <img id="albumpausebtn" class="pausebutton" src="ICON/pause-48.png" alt="">
        </div>
          ';
        }
      ?>

      </div>

      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($rapTracks as $rapTrack) {
          $pureRapTrackname = substr($rapTrack['title'], 0, -4);
          echo '
          <div id="tracktitle" class="d-flex justify-content-center mx-3">
          <h4>'. $pureRapTrackname .'</h4>
        </div>
          ';
        }
      ?>

      </div>


      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($rapTracks as $rapTrack) {
          echo '
          <div id="tracksinger" class="d-flex justify-content-center mx-3">
            <h5>' . $rapTrack['author'] . '</h5>
          </div>
          ';
        }
      ?>

      </div>

    <!-- RAP MIX AUDIO START -->

      <?php

        foreach ($rapTracks as $rapTrack) {
        $rapMp3Name = 'TRACKS/'.$rapTrack['title'];
        echo '<audio id="title" src="'. $rapMp3Name .'"></audio>';
        }
      
      ?>

    <!-- RAP MIX AUDIO START -->



    </section>

    <!-- RAP SECTION END -->


    <!-- ////////////////////////////////////////////////////////////////////////// -->


    <!-- HIP & HOP SECTION START -->

    <section id="hiphop" class="genre" class="mt-5 pt-5 mb-4">
    <div class="container-fluid mt-5 pt-5 mb-5">
        <h3>Hip & Hop</h3>
      </div>

      <div class="container-fluid d-flex my-4">

      <?php
        foreach ($hiphopTracks as $hiphopTrack) {
          $hiphopAlbumImg = 'COVER/'. $hiphopTrack['album_cover'];
          echo '
          <form action="index.php" method="get">
          <input type="text" name="userid" value="'. $userId .'" hidden>
          <input type="text" name="trackid" value="'. $hiphopTrack['id'] .'" hidden>
            <button id="likebutton" type="submit">
                <img src="ICON/fvbtn.png" alt="" width="24" height="22">
            </button>
          </form>
          <div id="albumcard" class="card rounded-0 mx-3 d-flex align-items-center justify-content-center">
          <img src="'. $hiphopAlbumImg .'" alt="">
          <img id="albumplaybtn" class="playbutton" src="ICON/play-48.png" alt="">
          <img id="albumpausebtn" class="pausebutton" src="ICON/pause-48.png" alt="">
        </div>
          ';
        }
      ?>

      </div>

      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($hiphopTracks as $hiphopTrack) {
          $pureHiphopTrackname = substr($hiphopTrack['title'], 0, -4);
          echo '
          <div id="tracktitle" class="d-flex justify-content-center mx-3">
          <h4>'. $pureHiphopTrackname .'</h4>
        </div>
          ';
        }
      ?>

      </div>


      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($hiphopTracks as $hiphopTrack) {
          echo '
          <div id="tracksinger" class="d-flex justify-content-center mx-3">
            <h5>' . $hiphopTrack['author'] . '</h5>
          </div>
          ';
        }
      ?>

      </div>

    <!-- HIP&HOP MIX AUDIO START -->

    <?php

      foreach ($hiphopTracks as $hiphopTrack) {
      $hiphopMp3Name = 'TRACKS/'.$hiphopTrack['title'];
      echo '<audio id="title" src="'. $hiphopMp3Name .'"></audio>';
      }

    ?>

    <!-- HIP&HOP MIX AUDIO END -->



    </section>

    <!-- HIP & HOP SECTION END -->

    <!-- ///////////////////////////////////////////////////////////// -->
    
    <!-- 80's & 90's SECTION START -->

    <section id="oldschool" class="genre" class="mt-5 pt-5 mb-4">
    <div class="container-fluid mt-5 pt-5 mb-5">
        <h3>80's & 90's</h3>
      </div>

      <div class="container-fluid d-flex my-4">

      <?php
        foreach ($oldschoolTracks as $oldschoolTrack) {
          $oldschoolAlbumImg = 'COVER/'. $oldschoolTrack['album_cover'];
          echo '
          <form action="index.php" method="get">
          <input type="text" name="userid" value="'. $userId .'" hidden>
          <input type="text" name="trackid" value="'. $oldschoolTrack['id'] .'" hidden>
            <button id="likebutton" type="submit">
                <img src="ICON/fvbtn.png" alt="" width="24" height="22">
            </button>
          </form>
          <div id="albumcard" class="card rounded-0 mx-3 d-flex align-items-center justify-content-center">
          <img src="'. $oldschoolAlbumImg .'" alt="">
          <img id="albumplaybtn" class="playbutton" src="ICON/play-48.png" alt="">
          <img id="albumpausebtn" class="pausebutton" src="ICON/pause-48.png" alt="">
        </div>
          ';
        }
      ?>

      </div>

      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($oldschoolTracks as $oldschoolTrack) {
          $pureOldschoolTrackname = substr($oldschoolTrack['title'], 0, -4);
          echo '
          <div id="tracktitle" class="d-flex justify-content-center mx-3">
          <h4>'. $pureOldschoolTrackname .'</h4>
        </div>
          ';
        }
      ?>

      </div>


      <div class="container-fluid d-flex my-2">

      <?php
        foreach ($oldschoolTracks as $oldschoolTrack) {
          echo '
          <div id="tracksinger" class="d-flex justify-content-center mx-3">
            <h5>' . $oldschoolTrack['author'] . '</h5>
          </div>
          ';
        }
      ?>

      </div>

    <!-- 80's & 90's MIX AUDIO START -->

    <?php

      foreach ($oldschoolTracks as $oldschoolTrack) {
      $oldschoolMp3Name = 'TRACKS/'.$oldschoolTrack['title'];
      echo '<audio id="title" src="'. $oldschoolMp3Name .'"></audio>';
      }

    ?>

    <!-- 80's & 90's MIX AUDIO END -->



    </section>


    <!-- 80's & 90's SECTION END -->

    </section>

<!-- HIP & HOP SECTION END -->

<!-- ///////////////////////////////////////////////////////////// -->

<!-- COUNTRY SECTION START -->

<section id="country" class="genre" class="my-5 py-5">
<div class="container-fluid my-5 py-5">
    <h3>Country</h3>
  </div>

  <div class="container-fluid d-flex my-4">

  <?php
    foreach ($countryTracks as $countryTrack) {
      $countryAlbumImg = 'COVER/'. $countryTrack['album_cover'];
      echo '
      <form action="index.php" method="get">
      <input type="text" name="userid" value="'. $userId .'" hidden>
      <input type="text" name="trackid" value="'. $countryTrack['id'] .'" hidden>
            <button id="likebutton" type="submit">
                <img src="ICON/fvbtn.png" alt="" width="24" height="22">
            </button>
          </form>
      <div id="albumcard" class="card rounded-0 mx-3 d-flex align-items-center justify-content-center">
      <img src="'. $countryAlbumImg .'" alt="">
      <img id="albumplaybtn" class="playbutton" src="ICON/play-48.png" alt="">
      <img id="albumpausebtn" class="pausebutton" src="ICON/pause-48.png" alt="">
    </div>
      ';
    }
  ?>

  </div>

  <div class="container-fluid d-flex my-2">

  <?php
    foreach ($countryTracks as $countryTrack) {
      $pureCountryTrackname = substr($countryTrack['title'], 0, -4);
      echo '
      <div id="tracktitle" class="d-flex justify-content-center mx-3">
      <h4>'. $pureCountryTrackname .'</h4>
    </div>
      ';
    }
  ?>

  </div>


  <div class="container-fluid d-flex my-2">

  <?php
    foreach ($countryTracks as $countryTrack) {
      echo '
      <div id="tracksinger" class="d-flex justify-content-center mx-3">
        <h5>' . $countryTrack['author'] . '</h5>
      </div>
      ';
    }
  ?>

  </div>

<!-- COUNTRY MIX AUDIO START -->

<?php

  foreach ($countryTracks as $countryTrack) {
  $countryMp3Name = 'TRACKS/'.$countryTrack['title'];
  echo '<audio id="title" src="'. $countryMp3Name .'"></audio>';
  }

?>

<!-- COUNTRY MIX AUDIO END -->



</section>
<br>
<br>
<br>
<br>

<!-- COUNTRY SECTION END -->

   

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

    <!-- LIKE SUCCESS -->

    <div id="likesuccess" class="d-flex justify-content-center align-items-center text-center pt-3">
      <p class="text-success">Track added to favorites</p>
    </div>

    <img id="totop" src="ICON/up.png" alt="" heigth="35" width="35">


    <footer>
      <div class="container-fluid mt-5">
        <hr class="mt-5 pt-5">
        <div class="row d-flex justify-content-center align-items-center text-center">
          <h4>Gueram & Remy creation ©</h4> <br> <p>2023</p>
        </div>
      </div>
    </footer>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
      <script src="JS/lightmode.js"></script>
      <script src="JS/searchbar.js"></script>
      <script src="JS/play.js"></script>
      <script src="JS/like.js"></script>
      <script src="JS/scroll.js"></script>

    <script>

    const searchSection = document.getElementById("search");
    const noResult = document.getElementById("noresult");
    const searchedTracks = <?php echo json_encode($searchedTracks); ?>;

    if(searchedTracks.length > 0) {
    searchSection.style.display = "block";
    } else {
      noResult.style.display = "block";
    }

</script>

  </body>
</html>