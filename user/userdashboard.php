<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: ../logout.php");
}

include_once("../category.php");
// include_once("../ques.php");
$obj = new Category;
$result = $obj->getData();
if ($result == false) {
    echo "<script>alert('failed to fetch');</script>";
} else {
    $n = $result->num_rows;
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
  <?php include("header.php") ?>
  <h1 class="text-center my-3">Start Quiz</h1>

  <div class="container text-center" style="margin-top: 50px;" id="cont">
  
  <?php
  for($i=0;$i<$n;$i++){
    $row=$result->fetch_assoc();
    ?>
    <a class="btn btn-outline-info my-2" href="showques.php?id=<?php echo $row['category'];?>"  id="<?php echo $row['category']; ?>"  style="width: 20%;padding:10px;"><?php echo $row['category'];?></a><br>
    <?php
  }

  ?>
  </div>

  <div class="container">
  <div class="ques"></div>
  </div>


  <script>
  // $(document).ready(function(){
  //   $('#cont').on('click', '.btn', function(e) {
  //           var element = $(this);
  //           var cat = element.attr("id");
  //           console.log(cat);
  //           $.ajax({
  //               type: "POST",
  //               url: "helper.php",
  //               data: {
  //                 cat: cat,
  //               },
  //               success: function(data, status) {
  //                 // alert(data);
  //                 $(".ques").html(data);
  //               }
  //             })
            
  //         })

  // })
  </script>
</body>

</html>