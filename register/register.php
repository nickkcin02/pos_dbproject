<?php
require_once("../connection.php");
$sql = "SELECT staffID, staffName FROM staff WHERE user_id IS NULL";
$result = mysqli_query($conn,$sql);
$staff = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
    array_push($staff, array($row['staffID'],$row['staffName']));
  }
}
?> 
<div class="container">
  <div align="center">
    <h2><br>Create your account</h2>
  </div>
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6" style="margin-top: 20px">
      <form method="post" action="register-request.php">
        <div class="dropdown" id="ddout" align="center" style="width: 100%; margin-bottom: 30px">
    <label for="staff"> Who are you ?</label><br>
          <select class="btn btn-outline-primary dropdown-toggle" id="dd" type="button" data-toggle="dropdown" name="staff">
            <script>
              var row = <?php echo(json_encode($staff)); ?>;
              var i;
              for (i = 0; i <= row.length ;i++) {
                document.getElementById("dd").innerHTML += "<option value='" + row[i][0] + "'>" + row[i][1] + "</option>";
              }
            </script>
          </select>
        </div>
        <div class="form-group">
          <i class="fa fa-user"></i>
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
        </div>
        <div class="form-group">
          <i class="fa fa-lock"></i>
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
          <i class="fa fa-lock"></i>
          <label for="con-password">Confirm Your Password</label>
          <input type="password" class="form-control" id="con-password" placeholder="Confirm password" name="con-password" required>
        </div>
        <div class="col-sm-12 " align="center">
          <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>