<?php
include("user.php");
 if(isset($_POST['b1'])){
     $name=test_input($_POST['name']);
     $email=test_input($_POST['email']);
     $pass=test_input($_POST['ps']);
     $cpass=test_input($_POST['cp']);

     if($pass==$cpass){
         $obj=new User;
         $datastatus=$obj->signup($name, $email, $pass);
         if($datastatus==true){
             echo "<script>alert('Register Successfully');</script>";
             header("Refresh:0; url=login.php");
         }else{
            echo "<script>alert('failed to register');</script>";
         }

     }else{
         echo "<script>alert('Mismatch Password');</script>";
     }
 }

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h1 class="text-center">Register Here</h1>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" id="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Email_Id</label>
                      <input type="text" name="email" id="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" name="ps" id="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Confirm Password</label>
                      <input type="password" name="cp" id="" class="form-control">
                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn btn-primary form-control" value="Register" name="b1">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </div>

</body>

</html>