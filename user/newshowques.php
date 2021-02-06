<?php
include("../ques.php");
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../logout.php");
}

$cat = $_GET['id'];

$obj = new Quest;
$result = $obj->getQues($cat);
$n = $result->num_rows;
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f1f1f1;
    }

    #regForm {
        background-color: #ffffff;
        margin: 100px auto;
        font-family: Raleway;
        padding: 40px;
        width: 70%;
        min-width: 300px;
    }

    h1 {
        text-align: center;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    button {
        background-color: #4CAF50;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #4CAF50;
    }
</style>

<body>
    <?php include("header.php"); ?>
    <div class="container my-2">
        <h1><span class="float-left"><?php echo $_GET['id']; ?> Quiz</span><span class="float-right">
                Time: <span id="timer"> 00:00</span>
            </span></h1>
    </div>
    <div class="container my-3">
        <form id="regForm" action="result2.php" method="post">
            <?php
            if ($n == false) {
                echo "<script>alert('Quiz is not ready Please select other quiz.');</script>";
                echo "<script>window.location.href='userdashboard.php'</script>";
            } else if ($n < 10) {
                echo "<script>alert('Quiz is not ready Please select other quiz.');</script>";
                echo "<script>window.location.href='userdashboard.php'</script>";
            } else {
                $j = 1;
                for ($i = 0; $i < $n; $i++) {
                    $row = $result->fetch_array();
            ?>
                    <div class="tab">
                        <h4><?php echo 'Question ' . $j . " .  ";
                            echo $row['ques'];
                            $j++; ?></h4>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt1']; ?>"> <?php echo $row['opt1']; ?></p>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt2']; ?>"> <?php echo $row['opt2']; ?></p>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt3']; ?>"> <?php echo $row['opt3']; ?></p>
                        <p><input type="radio" name="ans[<?php echo $row['id']; ?>]" value="<?php echo $row['opt4']; ?>"> <?php echo $row['opt4']; ?></p>
                    </div>
            <?php
                }
            }
            ?>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <?php
                for ($i = 0; $i < $n; $i++) {
                ?>
                    <span class="step"></span>
                <?php
                }
                ?>
            </div>
        </form>
    </div>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit Test";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:

            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
        $(document).ready(function() {
            var min = 1;
            var sec = 0;
            var timer = setInterval(() => {
                if (min == 0 && sec == 0) {
                    alert("Your Time Is Out");
                    document.getElementById("regForm").submit();
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




        })
    </script>

</body>

</html>