<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../logout.php");
}
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
    <style>
    </style>

</head>

<body>
    <?php include("header.php"); ?>


    <div class="container my-4" id="divs">
        <form action="result.php" method="post" id="frm">

            <h1><?php echo $_GET['id']; ?> Quiz<span class="float-right">
                    <h1 id="timer">00:00</h1>
                </span></h1>

            <hr>
            <?php
            include("../ques.php");
            $cat = $_GET['id'];

            $obj = new Quest;
            $result = $obj->getQues($cat);
            $n = $result->num_rows;
            if ($n == 0) {
                echo "No Questions found";
            } else {
                $j = 1;
                echo "<div class='divs'>";
                for ($i = 0; $i < $n; $i++) {
                    $row = $result->fetch_array();
            ?> <div class="question">
                        <h4><?php echo $j . " .  ";
                            echo $row['ques'];
                            $j++; ?></h4>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt1']; ?>"> <?php echo $row['opt1']; ?></p>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt2']; ?>"> <?php echo $row['opt2']; ?></p>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt3']; ?>"> <?php echo $row['opt3']; ?></p>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt4']; ?>"> <?php echo $row['opt4']; ?></p>
                    </div>
            <?php
                }
                echo "</div>";
            }
            ?>
            <a id="prev" class="prev btn btn-danger">Previous</a>
            <a id="next" class="next btn btn-primary">Next</a>
            <div class="text-center my-4"><input type="submit" name="submit" value="Submit Test" class="btn btn-success" id='sb'></div>

        </form>
    </div>

</body>
<script>
    $(document).ready(function() {
        // $('body').bind('copy paste', function(e) {
        //     e.preventDefault();
        //     return false;
        // });
        $(".divs .question").each(function(e) {
            if (e != 0)
                $(this).hide();
        });

        $("#next").click(function() {
            if ($(".divs .question:visible").next().length != 0)
                $(".divs .question:visible").next().show().prev().hide();

            if ($(".divs .question").is(":last")) {
                $('#next').attr("disabled", true);

            }
            return false;
        });

        $("#prev").click(function() {
            if ($(".divs .question:visible").prev().length != 0)
                $(".divs .question:visible").prev().show().next().hide();
            if ($(".divs .question:first")) {
                $('#prev').attr("disabled", true);
            }
            return false;
        });
        var min = 5;
        var sec = 0;
        var timer = setInterval(() => {
            if (min == 0 && sec == 0) {
                alert("Your Time Is Out");
                document.getElementById("sb").click();
                $("#timer").text(00 + ':' + 00);
                clearInterval(timer);
            }
            if (sec == 0) {
                min--;
                sec = 60;
            }


            sec--;
            $("#timer").text(min + ':' + sec);

        }, 1000);

        $('#next').click(function() {
            $(".question").siblings().each(function() {
                console.log('hello');
            });
        });


        if ($('.divs .question').is(':first')) {
            $("#prev").hide();
        } else {
            $("#prev").show();
        }




    })
</script>

</html>