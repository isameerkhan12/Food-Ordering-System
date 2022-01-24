<?php
$db_connec=require 'C:/xampp/htdocs/food_ordering/other_files/_db_connect.php';//CONNECTING TO DB//
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{ 
    session_start(); 
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Payment Details</title>
</head>

<body>
    <?php
      require 'C:/xampp/htdocs/food_ordering/other_files/head.php';
      ?>

    <!-- ORDER DETAILS -->
    <div class="text-center mt-3"><h3>Order Confirmation</h3></div>
    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">user_id</th>
                    <th scope="col">Order_Item</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
          $sno=1;
          $user_id1=$_SESSION['user_id'];
          $sql="SELECT * FROM `order_details` where user_id='$user_id1'";
          $result=mysqli_query($conn,$sql);//RESULT holding whole table//
          while($row=mysqli_fetch_assoc($result))//RUN UNTILL ROW!=NULL OR FALSE//
          {
            echo"<tr>
            <th scope='row'>".$row['user_id']."</th>
            <td>".$row['order_item']."</td>
            <td>".$row['price']."</td>
          </tr>";
          }
          ?>
            </tbody>
        </table>
    </div>
    <div>
        <?php
        echo '<p class="d-flex flex-row-reverse bd-highlight fw-bold fs-4 mx-5">TotalBill:'.$_SESSION['total_bill'].'</p>';
        ?>
        <div class="d-flex justify-content-center"><button type="button" class="btn btn-primary btn-lg" id="done">Place Order</button></div>
    </div>

    <!-- RIDER DETAILS -->
    <div class="container mt-5">
        <div class="row">
            <!-- Fetch All Categories -->
            <?php
        $sql="SELECT * FROM `rider_details` where res_id=1 ";//HERE I HARDCODED RES_ID=1 WHILE IT WILL BE A SESSION VAR//
        $result2=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result2))
        {
          $rider_name=$row['rider_name'];
          $rider_rating=$row['rider_rating'];
          echo'
          <div class="col-md-4">
        <div class="card my-3" style="width: 18rem;">

               <!-- WIDTH PLAYS VITAL ROLE THE MORE THE WIDTH THE CLEAR PIC IS HERE HEIGHT IS ADJUSTED AUTOMATICALLY --> 
              <img src="/food_ordering/pics/pic6.jpg" width="700" height="200" class="card-img-top" alt="NOT FOUND">
              <div class="card-body">
              <h5 class="card-title">Rider Details</h5>
              <p class="card-text">Rider_Name : '.$rider_name.'</p>
                <p class="card-text">Rider_Rating : '.$rider_rating.'</p>
              </div>
            </div>
        </div>
          ';
        }
        //NOTE:For a description of equal number of words we use "substr"//
        ?>
        </div>
    </div>    


    <script>
      var done=document.getElementById("done");
      done.addEventListener("click", (e) => {
            if (confirm(
                    "Are You Sure You Want To Confirm"
                    )) //JAVA FUNC FOR CONFIRMATION OF SOMETHING IF WE PRESS YES IT IS TRUE ELSE FALSE//
            {
                console.log("YES");
                window.location =
                    "/food_ordering/other_files/_bye_page.php"; //THIS FUNC HOLD THE INFO OF PAGE WHERE WE WANT TO SEND//
            } else {
                console.log("NO");
            }
        })
    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>