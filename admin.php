<?php
    session_start();
    require_once("PHP/headpage.php");
    require_once('PHP/config.php');
    require_once('PHP/tracks_insert.php');
?>
<body>
<section class="vh-75 gradient-custom">
      <div id="loginbox" class="container py-0 h-100 my-5">
        <div class="row d-flex justify-content-center align-items-center h-75 mb-1">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem">
              <div class="card-body px-5 text-center">
                <div class="mb-md-5 mt-md-4 pb-1">
                  <h4 class="text-light my-4">Add Track</h4>

                  <form action="admin.php" method="post" enctype="multipart/form-data"> 
                  <div class="form-outline form-white mb-4">
                    <input
                      type="author"
                      id="typeAuthor"
                      class="form-control form-control-lg"
                      name="author"
                    />
                    <label class="form-label" for="typeAuthor"
                      >Author</label
                    >
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input
                      type="album"
                      id="typeAlbum"
                      class="form-control form-control-lg"
                      name="album"
                    />
                    <label class="form-label" for="typeAlbum">Album</label>
                  </div>

                  <select name="genre" class="form-select" aria-label="Default select example">
                   <option selected>Select a genre</option>
                   <option value="1">Rap 'n R&B</option>
                   <option value="2">Hip & Hop</option>
                   <option value="3">80's & 90's</option>
                   <option value="4">Country</option>
                  </select>

                  <div class="text-center mt-4">
                    <label class="my-2" for="imgfile">Choose a album cover photo:</label>
                  </div>
                  <div class="text-center d-flex justify-content-center">
                  <input type="file"
                    id="albumcoverimage" name="imgfile"
                    accept="image/png, image/jpeg" required>
                  </div>

                  <div class="text-center mt-5">
                    <label class="my-2" for="file">Choose a MP3 track to add:</label>
                  </div>
                  <div class="text-center d-flex justify-content-center">
                    <input type="file"
                    id="trackadd" name="mp3file"
                    accept=".mp3" required>
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
                    Add
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</body>
</html>