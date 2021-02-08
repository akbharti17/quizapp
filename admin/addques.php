<?php
include_once("../category.php");
include_once("../ques.php");
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../logout.php");
}
$obj = new Category;
$result = $obj->getCat();
if ($result == false) {
    echo "<script>alert('failed to fetch');</script>";
} else {
    $n = $result->num_rows;
}

if(isset($_POST['addques'])){
    $ques=test_input($_POST['ques']);
    $opt1=test_input(($_POST['opt1']));
    $opt2=test_input(($_POST['opt2']));
    $opt3=test_input(($_POST['opt3']));
    $opt4=test_input(($_POST['opt4']));
    $ans=test_input($_POST['ans']);
    $category=test_input($_POST['cat']);
    // echo $category,$ques,$opt1,$opt2,$opt3,$opt4,$ans;
    $qobj=new Quest;
    $status=$qobj->insertques($ques, $opt1, $opt2, $opt3, $opt4, $ans, $category);
    if($status==true){
        echo "<script>alert('Question Added Successfully');</script>";
    }else{
        echo "<script>alert('Failed to add Question');</script>";
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
    <h4 class="text-center my-4">Add Questions</h4>


    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-group">
                        <label for="">Select Question Category</label>
                        <select name="cat" id="" class="form-control" required>
                        <option value="">--select category--</option>
                            <?php
                            for ($i = 0; $i < $n; $i++) {
                               $arr= $result->fetch_assoc();
                            ?>
                            <option value="<?php echo $arr['category'];?>"><?php echo $arr['category'];?></option>
                            <?php
                            }
                            ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Question</label>
                        <input type="text" class="form-control" name="ques" required>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Option</label>
                        <input type="text" class="form-control" placeholder="option 1" name="opt1" id="p1" required>
                        <input type="text" class="form-control my-2" placeholder="option 2" name="opt2" id="p2" required>
                        <input type="text" class="form-control my-2" placeholder="option 3" name="opt3" id="p3" required>
                        <input type="text" class="form-control my-2" placeholder="option 4" name="opt4" id="p4" required>
                    </div>
                    <div class="form-group">
                        <!-- <label for="">Enter Answer</label>
                        <input type="text" class="form-control" name="ans" required> -->
                        <label for="">Select Answer</label>
                        <select name="ans" class="form-control" required>
                        <!-- <option value="">--select answer--</option> -->
                        <option value="" id="op1"></option>
                        <option value="" id="op2"></option>
                        <option value="" id="op3"></option>
                        <option value="" id="op4"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="Add Question" name="addques">
                    </div>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        $("#p1,#p2,#p3,#p4").focusout(function(){
            var op1=$("#p1").val();
            var op2=$("#p2").val();
            var op3=$("#p3").val();
            var op4=$("#p4").val();
            $('#op1').val(op1).text(op1);
            $('#op2').val(op2).text(op2);
            $('#op3').val(op3).text(op3);
            $('#op4').val(op1).text(op4);
        })

    })
    </script>
</body>

</html>