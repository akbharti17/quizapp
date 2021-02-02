<?php
session_start();
include("../ques.php");
if (isset($_POST['submit'])) {
    $userans = $_POST['ans'];
    $obj = new Quest;
    $sc = 0;
    $resultar = $obj->getAll();
    while ($row = $resultar->fetch_assoc()) {
        foreach ($userans as $key => $val) {
            if ($row['ans'] == $val) {
                $sc++;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<?php include("header.php"); ?>

<div class="container my-5 text-center">
  <div class="jumbotron">
    <h1>Result</h1>      
    <p>Your Score is : <?php echo $sc; ?></p>
  </div>   
</div>

</body>

</html>