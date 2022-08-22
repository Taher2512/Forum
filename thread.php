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

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php

    $id = $_GET['threadid'];

    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);

          
    while ($row = mysqli_fetch_assoc($result)) {

        $catname = $row['category_name'];
        $catdesc = $row['category_description'];

    }


    ?>



    <div class="container">

        <?php

        $id = $_GET['threadid'];

        $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
            
        while ($row = mysqli_fetch_assoc($result)) {

            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];

            $sql2 = "SELECT * FROM `users` WHERE sno=$thread_user_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];

        }

        ?>


    <?php
    
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {

        // Insert comment into db
        $comment = $_POST['comment'];
        $comment = str_replace("'", "&apos;", $comment);
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);
        $sno = $_POST['sno'];

        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;

        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been added!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

    }


    ?>


        <div class="container my-5">
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold"><?php echo $title ?></h1>
                    <p class="col-md-8 fs-4"><?php echo $desc ?></p>
                    <hr class="my-4">
                    <p>No Spam / Advertising / Self-promote in the forums is not allowed. Do not post
                        copyright-infringing
                        material. Do not post “offensive” posts, links or images. Do not cross post questions. Do not PM
                        users asking for help. Remain respectful of other members at all times.</p>
                    <p>Posted by: <em><?php echo $posted_by; ?></em></p>
                </div>
            </div>
        </div>


        <?php


        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true") {
        
            echo '<div class="container">

                <h1 class="py-2">Post A Comment</h1>

                <form action="'.$_SERVER["REQUEST_URI"].'" method="post">

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                    </div>

                    <button type="submit" class="btn btn-success mb-5">Post Comment</button>

                </form>

            </div>';

        } else {
            echo '<div class="container">           
                    <h1 class="py-2">Post A Comment</h1>
                    <p class="col-md-8 fs-4 mb-5">You are not logged in. Please login to start posting comments.</p>
                </div>';
        }

        ?>


        <div class="container mb-5" id="ques">

            <h1 class="py-2">Discussions</h1>


            <?php

            $id = $_GET['threadid'];

            $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);

            $noResult = true;
                
            while ($row = mysqli_fetch_assoc($result)) {

                $noResult = false;              
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $thread_user_id = $row['comment_by'];

                $sql2 = "SELECT * FROM `users` WHERE sno=$thread_user_id";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo '<div class="d-flex my-5">
                <div class="flex-shrink-0">
                    <img src="img/userdefault.png" width="54px">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="fw-bold my-0">'.$row2['user_email'].' at '.$comment_time.'</p>
                    '.$content.'
                </div>
            </div>';

            }

            if($noResult) {

                echo '<div class="p-5 mb-4 bg-light rounded-3">
                    <div class="container-fluid py-5">
                        <p class="display-3">No Comments Found</p>
                        <p class="col-md-8 fs-4">Be the first person to ask a question</p>
                    </div>
                </div>';
        
            }

            ?>

        </div>


    </div>


    <?php include 'partials/_footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>