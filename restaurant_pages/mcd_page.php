<?php
$delete_var=false;
$db_connec=require 'C:/xampp/htdocs/food_ordering/other_files/_db_connect.php';//CONNECTING TO DB//
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{ 
    session_start(); 
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
  if($db_connec)
  {
    $order_item=$_POST['food_name'];
    $price=$_POST['price'];
    $bill=500;
    $_SESSION['total_bill']=$_SESSION['total_bill']+$price;
    $user_id=$_SESSION['user_id'];
    $sql="INSERT INTO `order_details` (`user_id`, `order_item`,`price`) VALUES ('$user_id', '$order_item','$price')";
    $query_run=mysqli_query($conn,$sql);
    if($query_run)
    {
      // echo"HURRAH";
      // echo $_SESSION['total_bill'];
    }
  }
}

if(isset($_GET['delete']))//CHECK "delete" is not null//
{
  if($db_connec)
  {
    $order_item1=$_GET['delete'];
    $price1=$_GET['price1'];
    $_SESSION['total_bill']=$_SESSION['total_bill']-$price1;
    $sql="DELETE FROM `order_details` WHERE order_item='$order_item1'";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
      $delete_var=true;
    }
  }
}

if(isset($_GET['payment_method']) && $_GET['payment_method']=='COD')
{
  if($db_connec)
  {
    //echo "HEY";
    //INSERT INTO `payment_details` (`user_id`, `transaction_id`, `payment_received`, `date`) VALUES ('2', '1', '0', current_timestamp());
    $user_id=$_SESSION['user_id'];
    $payment_method=$_GET['payment_method'];
    $sql="INSERT INTO `payment_details` (`user_id`,`payment_method`) VALUES ('$user_id','$payment_method')";
    $run_query=mysqli_query($conn,$sql);
    if($run_query)
    {
      header("location:/food_ordering/other_files/_order_confirm.php");
    }
    //echo "HEY";
  }
}

if(isset($_GET['payment_method']) && $_GET['payment_method']=='online')
{
  if($db_connec)
  {
    header("location:/food_ordering/other_files/_online_payment.php");
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

    <title>McDonald's</title>
</head>

<body>
    <?php 
    require "C:/xampp/htdocs/food_ordering/restaurant_pages/res_header.php";
    ?>
    <!-- ADDING MODAL TO PAGE -->
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_cart">
  Launch demo modal
</button> -->

    <!-- Modal FOR CART-->
    <div class="modal fade" id="add_cart" tabindex="-1" aria-labelledby="add_cart_ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_cart_ModalLabel">ADD TO CART</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container my-4">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">user_id</th>
                                    <th scope="col">Order_Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Actions</th>
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
            <td>
            <button type='button' class='delete btn btn-primary btn-sm' id=".$row['order_item'].">Delete</button>
            </td>
          </tr>";
          }
          ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
        echo '<p class="card-text fw-bold fs-4">TotalBill:'.$_SESSION['total_bill'].'</p>';
        ?>
                </div>
            </div>
        </div>
    </div>


    

    <div class="container mt-5">
        <div class="row">
            <!-- Fetch All Categories -->
            <?php
        $sql="SELECT * FROM `res_menu` where res_id=1";
        $result2=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result2))
        {
          $food_name=$row['food_name'];
          $food_type=$row['food_type'];
          $price=$row['food_price'];
          echo'
          <div class="col-md-4">
        <div class="card my-3" style="width: 18rem;">

               <!-- WIDTH PLAYS VITAL ROLE THE MORE THE WIDTH THE CLEAR PIC IS HERE HEIGHT IS ADJUSTED AUTOMATICALLY --> 
              <img src="https://source.unsplash.com/random/500x400/?'.$food_name.',food" class="card-img-top" alt="...">
              <div class="card-body">
              <form action="/food_ordering/restaurant_pages/mcd_page.php" method="POST">
                <h5 class="card-title">'.$food_name.'</h5>
                <input type="hidden" name="food_name" value='.$food_name.' id="food_name">
                <p class="card-text fw-bold">'.$food_type.'</p>
                <p class="card-text fw-bold fs-6">Rs'.$price.'</p>
                <input type="hidden" name="price" value='.$price.' id="price">
                <div class="d-flex justify-content-center"><button type="submit" class="btn btn-primary">Add To Cart</button></div>
                </form>
              </div>
            </div>
        </div>
          ';
        }
        //NOTE:For a description of equal number of words we use "substr"//
        ?>
        </div>
    </div>

    <!-- Modal FOR PAYMENT  -->
    <div class="modal fade" id="payment_method" tabindex="-1" aria-labelledby="payment_ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payment_ModalLabel">Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="/food_ordering/restaurant_pages/mcd_page.php">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="COD" id="COD" checked>
                                <label class="form-check-label" for="COD">
                                    Cash On Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="online" value="online">
                                <label class="form-check-label" for="online">
                                    Online Payment
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary ms-2">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
            </div>
        </div>
    </div>
    <script>
    dlt = document.getElementsByClassName("delete");
    for (let dlts of dlt) {
        dlts.addEventListener("click", (e) => {
            var order_item = e.target.id;
            if (confirm(
                    "Are You Sure You Want To Delete"
                    )) //JAVA FUNC FOR CONFIRMATION OF SOMETHING IF WE PRESS YES IT IS TRUE ELSE FALSE//
            {
                tr = e.target.parentNode.parentNode;
                var price = tr.getElementsByTagName("td")[1].innerText;
                //console.log("YES");
                window.location =
                    `/food_ordering/restaurant_pages/mcd_page.php?delete=${order_item}&price1=${price}`; //THIS FUNC HOLD THE INFO OF PAGE WHERE WE WANT TO SEND//
            } else {
                console.log("NO");
            }
        })
    }
    </script>
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