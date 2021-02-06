<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../logout.php");
}
include("../ques.php");
$sc = 0;
if (!empty($_POST['ans'])) {
    $userans = $_POST['ans'];
    $n = count($userans);
    $obj = new Quest;
    $resultar = $obj->getAllques();
    while ($row = $resultar->fetch_assoc()) {
        foreach ($userans as $key => $val) {
            if ($row['ans'] == $val && $key == $row['id']) {
                $sc++;
            }
        }
    }
} else {
    $sc = 0;
    $n = 0;
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
            <h4>Result</h4>
            <!-- <h3></h3> -->
            <h5>Total Question : 10</h5>
            <h5>Attempt Question: <?php echo $n; ?></h5>
            <h5>Your Score is : <?php echo $sc; ?></h5>
            <h5><?php if ($sc < 3) {
                    echo "You Are Failed";
                } else {
                    echo "You are Passed";
                } ?></h5>

        </div>
        <div class="container"><a href="userdashboard.php" class="btn btn-info">Back to Dashboard</a></div>
    </div>


</body>

</html>