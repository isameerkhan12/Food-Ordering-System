<?php
$error_sms;
$show_error=false;
$insert=false;
//$sql="INSERT INTO `user_data` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password');"
// echo $_SERVER['REQUEST_METHOD']; 
if($_SERVER['REQUEST_METHOD']=='POST')
{
    // echo"ENTER INTO POST";
    $db_connected=require "C:/xampp/htdocs/food_ordering/other_files/_db_connect.php";
    if($db_connected)
    {
        // echo"ENTER INTO TO DB";
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm_password'];

        $sql="SELECT * FROM `user_data` where username='$username' OR email='$email' ";//SQL QUERY TO CHECK IF USERNAME ALREADY EXSIST OR NOT//
        $result_exist=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result_exist);//TELL NUMBER OF ROWS FETCHED//
        // echo"HERE I AM:$num";
        if($num==1)
        {
            // echo"ENTER INTO TO num=1";
            $show_error=true;
            $error_sms="Username or Email Already Exsist";
        }
        else
        {
            // echo"ENTER INTO TO CHECK PASS";
            if($password==$confirm_password)
            {
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $sql="INSERT INTO `user_data` (`username`, `email`, `password`) VALUES ('$username', '$email', '$hash')";
                $query_run2=mysqli_query($conn,$sql);
                if($query_run2)
                {
                    $insert=true;
                }
            }
            else
            {
                // echo"WHAT HAPEENED";
                $show_error=true;
                $error_sms="Password Hasnot Matched";
            }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/food_ordering/css_files/back_img.css">

    <title>LogIn</title>
</head>

<body>
    <?php
    include"C:/xampp/htdocs/food_ordering/other_files/head.php";
    if($insert)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Account Created Successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        if($show_error)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Opps!</strong>$error_sms 
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";   
        }
    ?>
    <div class="mt-2 text-primary">
    <h2 class="text-center mt-2">SSF Ordering SignUp</h2>
    <div class="container d-flex justify-content-center">
        <form action="/food_ordering/other_files/_signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                    aria-describedby="pass_Help" required>
                <div id="pass_Help" class="form-text">Password Should Match</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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