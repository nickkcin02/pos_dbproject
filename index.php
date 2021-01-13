
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <title>Koffie House </title>
    <link rel="icon" type = "pic"href="../pic/icon.ico">
  </head>
  <body>
    
      
    
    <?php  
      include 'nav-bar.php';
      if ($_SESSION["username"] != NULL) {
         header("Location:./welcome");
      }
    ?>
    <div align="center">
      <img src="../pic/logo.png">
    </div>
    <div class="container">
       <div class="row">
         <div class="col-sm-3">
            
         </div>
         <div class="col-sm-6">
          
            <form method="post" action="../submit-form/check-login.php">
             <div class="form-group">
              <i class="fa fa-user"></i>
               <label for="username">Username </label>
               <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" placeholder="Username" required>
               <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
             </div>
             <div class="form-group">
                <i class="fa fa-lock"></i>
               <label for="password">Password</label>
               <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
             </div>
             <div class="col-sm-12 " align="center">
          <button type = "btn" class="btn btn-primary btn-lg" style="width:30%" ><i class="fa fa-sign-in"></i> Log in</button>
             </div>
             
           </form>
         </div>
       </div>
    </div>
    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
        $('[data-rel=popover]').popover({
          html: true,
          trigger: "hover"
        });
    });
    </script>


    <!-- <script src="../snowball.js"></script> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>


