<?php
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{ 
    session_start(); 
}
if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true)//IF SESSION IS EXPIRED OR NOT STARTED THEN SEND USER BACK TO LOGIN PAGE//
{
  header("location:/food_ordering/other_files/_login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Welcome-<?php echo $_SESSION['username'] ?></title>
</head>

<body>
    <?php  
    require 'C:/xampp/htdocs/food_ordering/other_files/head.php';
    require 'C:/xampp/htdocs/food_ordering/other_files/_db_connect.php';//CONNECTING TO DB/
    ?>
    <!-- Slider Start Here -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/random/2400x600/?fastfood" class="d-block w-100" alt="NOT FOUND">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/random/2400x600/?icecream" class="d-block w-100" alt="NOT FOUND">
            </div>
            <div class="carousel-item">

                <!-- WIDTH PLAYS VITAL ROLE THE MORE THE WIDTH THE CLEAR PIC IS HERE HEIGHT IS ADJUSTED AUTOMATICALLY -->
                <img src="https://source.unsplash.com/random/2400x600/?beverages,drinks" class="d-block w-100"
                    alt="NOT FOUND">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="row">
            <!-- Fetch All Categories -->
            <?php
        $sql="SELECT * FROM `restaurant`";
        $result2=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result2))
        {
          $res_name=$row['res_name'];
          $res_desc=$row['res_desc'];
          $link=$row['link'];
          echo'
          <div class="col-md-4">
        <div class="card my-3" style="width: 18rem;">

               <!-- WIDTH PLAYS VITAL ROLE THE MORE THE WIDTH THE CLEAR PIC IS HERE HEIGHT IS ADJUSTED AUTOMATICALLY --> 
              <img src="https://source.unsplash.com/random/500x400/?'.$res_name.',fastfood" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">'.$res_name.'</h5>
                <p class="card-text">'.substr($res_desc,0,110).'...</p>
                <a href="'.$link.'" class="btn btn-primary">Click To Visit</a>
              </div>
            </div>
        </div>
          ';
        }
        //NOTE:For a description of equal number of words we use "substr"//
        ?>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>