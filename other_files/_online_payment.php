<?php
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{ 
    session_start(); 
}
$db_connec=require 'C:/xampp/htdocs/food_ordering/other_files/_db_connect.php';//CONNECTING TO DB/

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $user_id=$_SESSION['user_id'];
    $payment_method=$_POST['online_payment'];
    $payment_received=$_SESSION['total_bill'];
    $sql="INSERT INTO `payment_details` (`user_id`,`payment_received`,`payment_method`) VALUES ('$user_id','$payment_received','$payment_method')";
    $run_query=mysqli_query($conn,$sql);
    if($run_query)
    {
      header("location:/food_ordering/other_files/_order_confirm.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Online Payment</title>
  </head>
  <body>
  <?php
      require 'C:/xampp/htdocs/food_ordering/other_files/head.php';
      ?>
    <div class="container mt-3">
    <form action="/food_ordering/other_files/_online_payment.php" method="POST">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="code" class="form-label">Code</label>
    <input type="password" class="form-control" id="code" name="code" required>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="online_payment" id="skrill" value="skrill" checked>
  <label class="form-check-label" for="skrill">
    Skrill
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="online_payment" id="paypal" value="paypal">
  <label class="form-check-label" for="paypal">
    Paypal
  </label>
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>