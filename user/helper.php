<?php
include("../ques.php");
$cat=$_POST['cat'];
// echo $cat;

$obj=new Quest;
$result=$obj->getQues($cat);
$n=$result->num_rows;
if($n==0){
  echo "No Questions found";
}else{
    for($i=0;$i<$n;$i++){
        $row=$result->fetch_assoc();
        echo $row['ques']."<br>";
        echo "<input type='radio' name='ans'>".$row['opt1']."<br>";
        echo "<input type='radio' name='ans'>".$row['opt2']."<br>";
        echo "<input type='radio' name='ans'>".$row['opt3']."<br>";
        echo "<input type='radio' name='ans'>".$row['opt4']."<br>";
    }
}
?>
