<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>

</head>

<body>
    <?php include("header.php"); ?>


    <div class="container my-4">
    <form action="result.php" method="post">
        <h1><?php echo $_GET['id']; ?> Quiz</h1>
        <hr>
        <?php
        include("../ques.php");
        $cat = $_GET['id'];
        // echo $cat;

        $obj = new Quest;
        $result = $obj->getQues($cat);
        $n = $result->num_rows;
        if ($n == 0) {
            echo "No Questions found";
        } else {
            $j=1;
            for ($i = 0; $i < $n; $i++) {
                $row = $result->fetch_array();
        ?> <div class="question">
                    <h4><?php echo $j." .  "; echo $row['ques']; $j++;?></h4>
                    <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt1']; ?>"> <?php echo $row['opt1']; ?></p>
                    <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt2']; ?>"> <?php echo $row['opt2']; ?></p>
                    <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt3']; ?>"> <?php echo $row['opt3']; ?></p>
                    <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt4']; ?>"> <?php echo $row['opt4']; ?></p>
                </div>
        <?php
            }
        }
        ?>
        <a href="#" class="prev btn btn-danger">Previous</a>
        <a href="#" class="next btn btn-primary">Next</a>
        <input type="submit" name="submit" value="submit" class="btn btn-success">
        </form>
    </div>
    
</body>
<script>
    $(document).ready(function() {
        $('.question').hide()

        $question_shown = $('.question').first().show();
 
        $('.next').click(function() {
            $('.question').hide()
            $question_shown = $question_shown.next().show();

        });

        $('.prev').click(function() {
            $('.question').hide()
            $question_shown = $question_shown.prev().show();
        });
    })
</script>

</html>