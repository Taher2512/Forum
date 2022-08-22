<?php

session_start();

echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu">';

            $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
              
              echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';

            }
         

          echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>

      <div class="d-flex">';

      if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true") {
  
        echo '<form class="d-flex" role="search" method="get" action="search.php">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                <p class="text-light my-0 mx-2 pt-2">Welcome<p class="text-light mr-2 my-0 pt-2">'.$_SESSION["useremail"].'</p></p>
                <a href="partials/_logout.php" class="btn btn-outline-success mx-2">Logout</a>
              </form>';

      } else {
        echo '<form class="d-flex" role="search">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                </form>
                <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
      }

        

        

    echo'</div>
    </div>
  </div>
</nav>';

include 'partials/_signupModal.php';
include 'partials/_loginModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {

  echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You can now login.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

} elseif (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {

  echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Signup Failed.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

} elseif (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
  echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You are now logged in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
} elseif (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
  echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Login failed.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
} elseif (isset($_GET['logout']) && $_GET['logout'] == "true") {
  echo '<div class="my-0 alert alert-warning alert-dismissible fade show" role="alert">
          You are now logged out.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
  


?>