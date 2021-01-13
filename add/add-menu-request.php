<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include"../connection.php";
if (isset($_GET["id"])){
    // echo $_POST["pic"];
    $id = $_GET["id"];
    if (isset($_POST["pic"])) {
        $sql = "UPDATE `menu` SET `menuName` = '$_POST[menu]', `typeName` = '$_POST[mtype]' WHERE menuID = '$id';" ;
        if (!mysqli_query($conn, $sql)) {
          echo '<script type="text/javascript">';
          echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Error','','".mysqli_error($conn)."').then((value) => {
                  window.location = '../welcome/?test=15'
                })});";
          echo '</script>';
        } 
        else{
          echo '<script type="text/javascript">';
          echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Edit  Success','','success').then((value) => {
                  window.location = '../welcome/?test=15'
                })});";
          echo '</script>';
        }
    }
    else{
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $error = "";
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
               $error = $error." File is not an image. ";
               $uploadOk = 0;
           }
       }
        // Check if file already exists
       if (file_exists($target_file)) {
           $error = $error." File already exists. ";
           $uploadOk = 0;
       }
        // Check file size
       if ($_FILES["fileToUpload"]["size"] > 10000000) {
            $error = $error." File is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $error = $error." Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<script type="text/javascript">';
            echo "document.addEventListener('DOMContentLoaded', function(event) {swal(Something went wrong.','".$error."','error').then((value) => {
                  window.location = '../welcome/?test=15'
                })});";
            echo '</script>';

        // if everything is ok, try to upload file
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $sql = "UPDATE `menu` SET `menuName` = '$_POST[menu]', `typeName` = '$_POST[mtype]', `menuPicture` = '$target_file' WHERE menuID = '$id';" ;
            if (mysqli_query($conn, $sql)) {
              echo '<script type="text/javascript">';
              echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Edit  Success','','success').then((value) => {
                      window.location = '../welcome/?test=15'
                    })});";
              echo '</script>';
            } 
            else {
              echo '<script type="text/javascript">';
              echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Edit  Success','','success').then((value) => {
                      window.location = '../welcome/?test=15'
                    })});";
              echo '</script>';
            }
            
        }
        else {
            echo '<script type="text/javascript">';
            echo "document.addEventListener('DOMContentLoaded', function(event) {swal(There was an error uploading your file.','".mysqli_error($conn)."','error').then((value) => {
                  window.location = '../welcome/?test=15'
                })});";
            echo '</script>';
        }
    }

   
    




}

else{
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $error = "";
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
           $error = $error." File is not an image. ";
           $uploadOk = 0;
       }
   }
    // Check if file already exists
   if (file_exists($target_file)) {
       $error = $error." File already exists. ";
       $uploadOk = 0;
   }
    // Check file size
   if ($_FILES["fileToUpload"]["size"] > 10000000) {
    $error = $error." File is too large.";
    $uploadOk = 0;
}
    // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $error = $error." Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
    // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo '<script type="text/javascript">';
    echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Sorry, there was an error uploading your file.','".$error."','error').then((value) => {
            window.location = '../welcome/?test=15'
          })});";
    echo '</script>';
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $sql = "INSERT INTO `menu`(`menuName`, `typeName`, `menuPicture`) VALUES ('$_POST[menu]','$_POST[mtype]','$target_file');" ;
        if (!mysqli_query($conn, $sql)) {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       } 
       $sql = "SELECT MAX(menuID) AS id FROM menu";
       $result = mysqli_query($conn, $sql);
       $row = mysqli_fetch_assoc($result);
       $id = $row['id'];

       $sql = "SELECT ingredientID FROM ingredient";
       $result = mysqli_query($conn, $sql);
       if (mysqli_num_rows($result) > 0) {
           while ( $row = mysqli_fetch_assoc($result)) {
               $ingredientID = $row['ingredientID'];
               if (isset($_POST[$ingredientID])) {
                     // echo $ingredientID." ->>>".$_POST["amount".$ingredientID];
                   $amount = $_POST["amount".$ingredientID];
                   $sql = "INSERT INTO `menuStock`(`menuID`, `ingredientID`, `amount`) VALUES ('$id','$ingredientID','$amount');" ;
                   if (!mysqli_query($conn, $sql)) {
                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  } 

              }
          }
      }

      if (isset($_POST['price']) && $_POST['price'] != NULL) {
       $price = $_POST['price'];
       $sql = "INSERT INTO `price`(`menuID`, `size`, `price`) VALUES ('$id','NA','$price')";
       if (!mysqli_query($conn, $sql)) {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       } 
   }
   else{
       if (isset($_POST['priceS']) && $_POST['priceS'] != NULL) {
           $price = $_POST['priceS'];
           $sql = "INSERT INTO `price`(`menuID`, `size`, `price`) VALUES ('$id','S','$price')";
           if (!mysqli_query($conn, $sql)) {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           }
       }
       if (isset($_POST['priceM']) && $_POST['priceM'] != NULL) {
           $price = $_POST['priceM'];
           $sql = "INSERT INTO `price`(`menuID`, `size`, `price`) VALUES ('$id','M','$price')";
           if (!mysqli_query($conn, $sql)) {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           }
       }
       if (isset($_POST['priceL']) && $_POST['priceL'] != NULL) {
           $price = $_POST['priceL'];
           $sql = "INSERT INTO `price`(`menuID`, `size`, `price`) VALUES ('$id','L','$price')";
           if (!mysqli_query($conn, $sql)) {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           }
       }
       echo '<script type="text/javascript">';
       echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Add Menu  Success','','success').then((value) => {
               window.location = '../welcome/?test=15'
             })});";
       echo '</script>';
   }

} else {
    echo '<script type="text/javascript">';
    echo "document.addEventListener('DOMContentLoaded', function(event) {swal('','Something went wrong.','error').then((value) => {
            window.location = '../welcome/?test=15'
          })});";
    echo '</script>';

}
}
}
?>


