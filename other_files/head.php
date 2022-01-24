<?php
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{
    session_start();
    $_SESSION['loggedin']=false;
}
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
    {
    echo'
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="/food_ordering/other_files/_food_welcome.php">SSF System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">About</a>
        </li>
      </ul>
      <div class="d-flex">
      <a class="btn btn-primary ms-2" aria-current="page" href="/food_ordering/other_files/_logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>';
      }
      else
      {
          echo'
          <nav class="navbar navbar-expand-lg navbar-transparent bg-transparent">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SSFSystem</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
      </ul>
      <div class="d-flex">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li><a class="btn btn-primary ms-2" aria-current="page" href="/food_ordering/other_files/_login.php">LogIn</a></li>
      <li><a class="btn btn-primary ms-2" aria-current="page" href="/food_ordering/other_files/_signup.php">SignUp</a></li>  
      </ul>
      </div>
    </div>
  </div>
</nav>';
}
?>