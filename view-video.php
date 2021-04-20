<?php
$video = $_GET['video'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OIC SHARE</title>
    <link rel="stylesheet" href="bootsrap/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="images/oic.png">
    <style>
      .container img{
        width: 40%;
        color: #ffa500;
      }
      @media screen and (max-width: 768px) {
        h1{
          font-size: 21px;
        }
        .container img{
            width: 40%;
            margin-left: 30%;
            margin-right: 30%;
           
        }

      }
    </style>
</head>
<body>
    <div class="jumbotron bg-light text-dark">
        <a href="index.php" class="btn btn-success text-uppercase btn-rounded my-2" >go back <span class="font-weight-bold a fa-angle-double-left">  </span></a>
          <div class="container-fluid">
          <video   controls class="w-100" autoplay>
            <source src="uploads/<?php echo $video ?>" type="video/mp4">
            Your browser does not support the video tag.
            </video>
          </div>
          </div>
    <!-- /jumbron end -->

    <!-- footer -->
    <footer>
        <div class="jumbotron-fluid bg-dark text-light p-4 text-center text-light ">
            <p class="text-light">Copyright &copy;2020  . All Rights Reserved | Designed by <b><a href="https://github.com/oluokunkabiru" 
                 class="text-light"> Oluokun Kabiru Adesina</a> and <a href="#" class="text-light">Ibikunle Johnson</a></b></p>

        </div>
    </footer>
</body>
</html>
<script src="bootsrap/jquery.js"></script>
<script src="bootsrap/popper.js"></script>
<script src="bootsrap/bootstrap.min.js"></script>
<script src="app.js"></script>
