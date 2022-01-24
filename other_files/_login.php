<?php
$login=false;
$show_error=false;
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $db_connected=require 'C:/xampp/htdocs/food_ordering/other_files/_db_connect.php';//CONNECTING TO DB//
    if($db_connected)//IF TRUE THEN DB CONNECTED//
    {
        // echo"WELCOME1";
        $password=$_POST['password'];
        $email=$_POST['email'];
        $username=$_POST['username'];
        $sql="SELECT * FROM `user_data` where email='$email' ";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);//TELL NUMBER OF ROWS FETCHED//
        if($num==1)//IF THERE IS A RECORD/USER EXIST//
        {
            // echo"WELCOME2";
          while($row= mysqli_fetch_assoc($result))//fetch FUNC RETURNS A ROW AS AN ASSOCIATE ARRAY(KEY,VALUE) IF NO ROW AVAILABLE IT RETURN FALSE//
          {
            echo"WELCOME3";
              if(password_verify($password,$row['password']))//VERIFY FUNC COMPARE GIVEN PASSWORD WITH PASSWORD HASH IN DATABASE(ROW['PASSWORD']) THEN RETURN BOOLEAN//
              {
                //   echo"WELCOME4";
                $login=true;
                session_start();//HERE OUR SESSION START.INFO UNDER SESSION CAN BE ACCESSED ACCROSS FILES.IT STORE/MANAGES INFO//
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$username;
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['total_bill']=0;
                header("location:/food_ordering/other_files/_food_welcome.php");//THIS FUNCTION REDIRECT THE USER TO GIVEN LOCATION//
              }
              else
              {
              $show_error=true;
              }
          }
        }
        else
        {
        $show_error=true;
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/food_ordering/css_files/back_img.css">

    <title>LogIn</title>
  </head>
  <body>
  <?php
        require 'C:/xampp/htdocs/food_ordering/other_files/head.php';
        if($login)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong>LogIn Successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        if($show_error)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Invalid Credentials
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";   
        }
    ?>
    <div class="mt-2 text-primary">
    <h2 class="text-center mt-2 text-primary">SSF Ordering LogIn</h2>
    <div class="container d-flex justify-content-center">
    <form action="/food_ordering/other_files/_login.php" method="POST">
    <div class="mb-3">
    <label for="username" class="form-label">username</label>
    <input type="text" class="form-control w-100" id="username" name="username" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control w-100" id="email" name="email" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control w-100" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>