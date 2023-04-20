<?php
session_start();
require_once("PHP/config.php");
require_once("PHP/user_login.php");
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
           echo ' <a href="userprofile.php" >
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
      <div id="loginbox" class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem">
              <div class="card-body px-5 text-center">
                <div class="mb-md-5 mt-md-4 pb-1">
                  <img
                    src="LOGO\FullLogo_Transparent_NoBuffer.png"
                    alt="mainlogo"
                    width="120"
                    height="135"
                  />
                  <p class="text-white-50 my-4">
                    Please enter your login and password!
                  </p>
                  <form action="login.php" method="post">
                  <div class="form-outline form-white mb-4">
                      <input
                      type="id"
                      id="typeEmailX"
                      class="form-control form-control-lg"
                      name="id"
                      hidden
                    />
                    <input
                      type="email"
                      id="typeEmailX"
                      class="form-control form-control-lg"
                      name="email"
                    />
                    <label class="form-label" for="typeEmailX">Email</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input
                      type="password"
                      id="typePasswordX"
                      class="form-control form-control-lg"
                      name="password"
                    />
                    <label class="form-label" for="typePasswordX"
                      >Password</label
                    >
                  </div>
                  <div class="d-flex justify-content-center text-center text-danger">
                   <?php
                   global $error;
                   echo $error;
                   ?>
                  </div>

                  <p class="small mb-2 pb-lg-2">
                    <a class="text-white-50" href="#!">Forgot password?</a>
                  </p>

                  <button
                    class="btn btn-outline-light btn-lg px-5"
                    type="submit"
                  >
                    Login
                  </button>
                  </form>

                  <div class="d-flex justify-content-center text-center pt-1">
                    <a href="#!" class="text-white"
                      ><i class="fab fa-facebook-f fa-lg"></i
                    ></a>
                    <a href="#!" class="text-white"
                      ><i class="fab fa-twitter fa-lg mx-4 px-2"></i
                    ></a>
                    <a href="#!" class="text-white"
                      ><i class="fab fa-google fa-lg"></i
                    ></a>
                  </div>
                </div>
                

                <div>
                  <p class="pb-0">
                    Don't have an account?
                    <a href="signup.php" class="text-white-50 fw-bold"
                      >Sign Up</a
                    >
                  </p>
                </div>
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
