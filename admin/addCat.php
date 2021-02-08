<?php 
include("../category.php");
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../logout.php");
}
if(isset($_POST['add'])){
    $catagory=test_input($_POST['category']);
    // $no=test_input($_POST['no']);
    $obj=new Category;
    $status=$obj->insertCat($catagory);
    if($status==true){
        echo "<script>alert('Category Added Successfully');</script>";
    }else{
        echo "<script>alert('Failed to add Category');</script>"; 
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
    <h1 class="text-center my-4">Create New Category</h1>

    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-group">
                        <label for="">Enter Category</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Enter No. of question</label>
                        <input type="number" class="form-control" name="no">
                    </div> -->
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" name="add" value="Add category">
                    </div>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>


</body>

</html>