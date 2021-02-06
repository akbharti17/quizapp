<?php

include("user.php");
session_start();

if (isset($_POST['login'])) {
    $email = test_input($_POST['email']);
    $password = test_input($_POST['ps']);

    // echo $email, $password;

    $obj = new User();
    $data=$obj->login($email, $password);
    if($data==false){
         echo "<script>alert('Invalid UserId or Password');</script>";
    }else{
        if($email==$data['email_id'] && $password==$data['password'] && $data['is_admin']==0){
            $_SESSION['email']=$data['email_id'];
            $_SESSION['name']=$data['name'];
            echo 'login';
            header('location: user/userdashboard.php');
        }else if($email==$data['email_id'] && $password==$data['password'] && $data['is_admin']==1){
            $_SESSION['email']=$data['email_id'];
            echo 'login';
            header('location: admin/index.php');
        }
        else{
            echo "<script>failed to login</script>";
        }
    }

}

function test_input($data)
{
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
                <h1 class="text-center">Login Here</h1>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-group">
                        <label for="">Email_Id</label>
                        <input type="text" name="email" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="ps" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success form-control" value="Login" name="login">
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </div>

</body>

</html>