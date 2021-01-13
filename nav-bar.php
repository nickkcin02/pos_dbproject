
<?php  
session_start();
if (isset($_SESSION['username'])) {
  require_once "../connection.php";
  $sql = "SELECT s.staffName FROM staff s, tbl_user t WHERE t.username = '$_SESSION[username]' AND t.user_id = s.user_id";
  $query = mysqli_query($conn, $sql);
  $staff = mysqli_fetch_assoc($query);
}
error_reporting(E_ERROR | E_PARSE);

if ($_SESSION["username"] == NULL) {
  ?>
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../welcome">POS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
      <form class="navbar-inline my-2 my-lg-0">
        <a href="../register" class="btn bg-success text-white my-2 my-sm-0"><b>Register</b></a>
        <a href="../" class="btn btn-outline-primary my-2 my-sm-0"><b>Login</b></a>
      </form>
    </div>
  </nav>
  <?php  
}
else if($_SESSION["userRole"] == 'Waiter'){

  ?>

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../welcome"><i class="fa fa-home fa-lg"></i> Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">


        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=5"><i class="fa fa-file-text-o fa-lg"></i> Queues</a> </li>

      </ul>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="margin-left: 55px"></ul>
      <form class="navbar-inline my-2 my-lg-0">
        <a href="../logout.php" class="btn btn-danger"><i class="fa fa-sign-out"></i><b> Log off from <?php echo $staff['staffName'];?></b></a>
      </form>
    </div>
  </nav>

<?php }
else if($_SESSION["userRole"] == 'Storage Manager'){
  ?>

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../welcome/?test=4"><i class="fa fa-home fa-lg"></i> Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

       
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=2"><i class="fa fa-truck fa-lg"></i> Buy History</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=10"><i class="fa fa-cubes fa-lg"></i> Supplier</a> </li>

      </ul>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="margin-left: 55px"></ul>
      <form class="navbar-inline my-2 my-lg-0">
        <a href="../logout.php" class="btn btn-danger"><i class="fa fa-sign-out  "></i><b> Log off from <?php echo $staff['staffName'];?></b></a>
      </form>
    </div>
  </nav>


<?php }
else if($_SESSION["userRole"] == 'Cashier'){
  ?>

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../welcome"><i class="fa fa-home fa-lg"></i> Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=5"><i class="fa fa-file-text-o fa-lg"></i> Queues</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=9"><i class="fa fa-shopping-cart fa-lg"></i> Bill</a> </li>
      </ul>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="margin-left: 55px"></ul>
      <form class="navbar-inline my-2 my-lg-0">
        <a href="../logout.php" class="btn btn-danger"><i class="fa fa-sign-out  "></i><b> Log off from <?php echo $staff['staffName'];?></b></a>
      </form>
    </div>
  </nav>

<?php }
else if($_SESSION["userRole"] == 'Manager'){
  ?>

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../welcome"><i class="fa fa-home fa-lg"></i> Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=7"><i class="fa fa-line-chart fa-lg"></i> Summary</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=5"><i class="fa fa-file-text-o fa-lg"></i> Queues</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=9"><i class="fa fa-shopping-cart fa-lg"></i> Bill</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=4"><i class="fa fa-cube fa-lg"></i> Stock</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=2"><i class="fa fa-truck fa-lg"></i> Buy History</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=15"><i class="fa fa-pencil-square-o fa-lg"></i> Edit Menu</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=8"><i class="fa fa-percent fa-lg"></i> Discount</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=14"><i class="fa fa-cutlery fa-lg"></i> Promotion</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=1"><i class="fa fa-users fa-lg"></i> Staff</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../welcome/?test=10"><i class="fa fa-cubes fa-lg"></i> Supplier</a> </li>
      </ul>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
      <form class="navbar-inline my-2 my-lg-0">
        <a href="../logout.php" class="btn btn-danger"><i class="fa fa-sign-out"></i><b> Log off from <?php echo $staff['staffName'];?></b></a>
      </form>
    </div>
  </nav>


<?php }
?>
