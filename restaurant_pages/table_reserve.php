<?php
$db_connec=require 'C:/xampp/htdocs/food_ordering/other_files/_db_connect.php';//CONNECTING TO DB//
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{ 
    session_start(); 
}
//INSERT INTO `table_details` (`table_id`, `table_location`, `table_status`, `res_id`) VALUES ('1', 'corner', 'available', '1');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $table_id=$_POST['table_id'];
    $table_location=$_POST['table_location'];
    $table_status=$_POST['table_status'];
    $user_id=$_SESSION['user_id'];
    $sql="UPDATE `table_details` SET `table_status` = '$table_status', `user_id` = '$user_id' WHERE `table_details`.`table_id` = '$table_id'";
    $result=mysqli_query($conn,$sql);
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

    <title>Table Reservation</title>
</head>

<body>
    <?php
      require 'C:/xampp/htdocs/food_ordering/other_files/head.php';
      ?>

    <!-- ORDER DETAILS -->
    <div class="text-center mt-3">
        <h3>Table Reservation</h3>
    </div>
    <div class="container my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Table_Id</th>
                    <th scope="col">Table_Location</th>
                    <th scope="col">Table_Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
          $sno=1;
          $sql="SELECT * FROM `table_details` where res_id=1 AND table_status='available'";
          $result=mysqli_query($conn,$sql);//RESULT holding whole table//
          $num=mysqli_num_rows($result);//TELL NUMBER OF ROWS FETCHED//
          if($num>=1)
          {
          while($row=mysqli_fetch_assoc($result))//RUN UNTILL ROW!=NULL OR FALSE//
          {
            echo"<tr>
            <th scope='row'>".$row['table_id']."</th>
            <td>".$row['table_location']."</td>
            <td>".$row['table_status']."</td>
          </tr>";
          }
        }
        else
        {
            echo '
            <div class="alert alert-info" role="alert">Sorry! Currently All Tables Are Occupied</div>
            ';
        }
          ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-5 w-50">
        <h3 class="text-center">Fill Out Form For Reservation</h3>
        <form action="/food_ordering/restaurant_pages/table_reserve.php" method="POST">
            <div class="mb-3">
                <label for="table_id" class="form-label">Table_Id</label>
                <input type="text" class="form-control" id="table_id" name="table_id" aria-describedby="emailHelp"
                    required>
                <div class="mb-3">
                    <label for="table_location" class="form-label">Table_Location</label>
                    <input type="text" class="form-control" id="table_location" name="table_location" required>
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="table_status" value="occupied" name="table_status">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


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