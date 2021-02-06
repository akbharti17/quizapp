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

    <h1 class='text-center my-3'>Quiz Game</h1>
    <div class="container">
        <div class="jumbotron">
            <h3>Quiz Instructions</h3>
            <p>
            <ul>
                <li>
                    The quizzes consists of questions carefully designed to help you self-assess your comprehension of
                    the information presented on the topics covered in the module. No data will be collected on the website regarding your responses or how many times you take the quiz.
                </li>
                <li>There is no negative marking and each question carry 1 mark.</li>
                <li>Moreover, have a hit on the ‘Submit Test’ button arranged at the end of this page to submit the responses.</li>
                <li>First Time on QuizGame then signup and login to start test</li>
                <li>Otherwise login to start test</li>

            </ul>
            </p>
        </div>
       <a href="signup.php" class="btn btn-outline-success">Register Here</a>
       <a href="login.php" class="btn btn-outline-primary">login</a>
    </div>

</body>

</html>