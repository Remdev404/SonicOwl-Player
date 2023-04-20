<?php
session_start();
require_once("PHP/config.php");
require_once("PHP/user_signup.php");
require_once("PHP/headpage.php");
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
    <section class="vh-75 gradient-custom">
      <div id="loginbox" class="container py-0 h-100">
        <div class="row d-flex justify-content-center align-items-center h-75 mb-1">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem">
              <div class="card-body px-5 text-center">
                <div class="mb-md-5 mt-md-4 pb-1">
                  <img
                    src="LOGO\FullLogo_Transparent_NoBuffer.png"
                    alt="mainlogo"
                    width="90"
                    height="105"
                  />
                  <h2 class="text-light my-4">SignUp</h2>

                  <form action="signup.php" method="post" enctype="multipart/form-data"> 
                  <div class="form-outline form-white mb-4">
                    <input
                      type="username"
                      id="typeUsername"
                      class="form-control form-control-lg"
                      name="username"
                    />
                    <label class="form-label" for="typeUsername"
                      >Username</label
                    >
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input
                      type="email"
                      id="typeEmail"
                      class="form-control form-control-lg"
                      name="email"
                    />
                    <label class="form-label" for="typeEmail">E-mail</label>
                  </div>

                  <div class="form-outline form-white mb-2">
                    <input
                      type="password"
                      id="typePassword"
                      class="form-control form-control-lg"
                      name="password"
                    />
                    <label class="form-label" for="typePassword"
                      >Password</label
                    >
                  </div>

                  <div class="text-center">
                    <label class="my-2" for="file">Choose a profile picture:</label>
                  </div>
                  <div class="text-center d-flex justify-content-end">
                    <input type="file"
                    id="avatar" name="file"
                    accept="image/png, image/jpeg" required>
                  </div>
                  <div class="d-flex text-center text-success justify-content-center my-3">
                  <?php
                  global $success; 
                  echo $success;
                  ?>
                  </div>

                  <button
                    class="btn btn-outline-light btn-lg px-5 my-5"
                    type="submit"
                  >
                    Signup
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="JS/lightmode.js"></script>
  </body>
</html>
