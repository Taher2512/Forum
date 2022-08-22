<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>

        #ques {
            min-height: 433px;
        }

    </style>

</head>

<body>

    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>



    <!-- Slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?apple,code" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?programmers,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coding,apple" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Category container starts here -->
    <div class="container my-5" id="ques">
        <h2 class="text-center mb-5">iDiscuss - Browse Categories</h2>
        <div class="row">

          <!-- Fetch all the categories -->

          <?php

          $sql = "SELECT * FROM `categories`";
          $result = mysqli_query($conn, $sql);

          // Using a loop to iterate through categories
          
          while ($row = mysqli_fetch_assoc($result)) {

            $id = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];

            echo '
            <div class="col-md-3 my-3">
              <div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/500x400/?'.$cat.',coding" class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                    <p class="card-text">'.substr($desc, 0, 90).'...</p>
                    <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                </div>
              </div>
            </div>';
          }

          ?>


        </div>
    </div>


    <?php include 'partials/_footer.php';?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>