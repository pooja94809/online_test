<?php

session_start();
require "config.php";
if (isset($_POST['add'])) {
    $tname = isset($_POST['tname'])?$_POST['tname']:'';
    $question = isset($_POST['question'])?$_POST['question']:'';
    $ans1 = isset($_POST['ans1'])?$_POST['ans1']:'';
    $ans2 = isset($_POST['ans2'])?$_POST['ans2']:'';
    $ans3 = isset($_POST['ans3'])?$_POST['ans3']:'';
    $ans4 = isset($_POST['ans4'])?$_POST['ans4']:'';
    $correct = isset($_POST['correct'])?$_POST['correct']:'';
    $sql = "INSERT INTO admin(`test-name`,  `question`,`answer1`,`answer2`,`answer3`,`answer4`,`right-answer`) VALUES('".$tname."','".$question."','".$ans1."','".$ans2."','".$ans3."','".$ans4."','".$correct."')";
    

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[] = array('input'=>'form','msg'=>$conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }


?>
<?php
if (isset($_POST['adminpanel'])){
?>
<form class="add1" action="" method="POST">
<div class="add">
    <input type="text"  name="username" placeholder="Username"/>
    <input type="password" name="password" placeholder="password"/>
    <button name="login1">Login</button>
<?php
}
?>
<?php
if (isset($_POST['login1'])){
    add();
?>
<?php
}
?>
<?php
if (isset($_POST['test'])){
    add();
}
?>
<?php
function add(){
?>
<form class="add1" action="" method="POST">
<div class="add">
Test Name : <input type="text" name="tname" placeholder="Test name"/><br>
Question : <input type="text" name="question" placeholder="Question"/><br>
Answer 1 : <input type="text" name="ans1" placeholder="Answer 1"/><br>
Answer 2 : <input type="text" name="ans2" placeholder="Answer 2"/><br>
Answer 3 : <input type="text" name="ans3" placeholder="Answer 3"/><br>
Answer 4 : <input type="text" name="ans4" placeholder="Answer 4"/><br>
Correct Answer : <input type="text" name="correct" placeholder="Correct Answer"/><br>
<button name="add" id="ad">ADD</button>
<div>
</form>
<?php
}
?>
<?php
if (isset($_POST['add'])){
    echo "<script>alert('Test added successfully!');</script>"; 
    addmore();
?>
<?php
}
?>
<?php
function addmore(){
?>
<form action="" method="POST">
<button class="h2" name="addmore">ADD MORE</button>
<?php
}
?>
<?php
if (isset($_POST['addmore'])){
    add();
}
?>
<?php
if (isset($_POST['add'])){
    test_panel();
}
?>

<?php
if (isset($_POST['tpanel'])){
    test_panel();
    result();
}
?>





<?php 
global $tname;
global $question;
global $ans1;
global $ans2;
global $ans3;
global $ans4;
global $correct;
function test_panel(){
if (isset($_POST['add'])){
    $tname = isset($_POST['tname'])?$_POST['tname']:'';
    $question = isset($_POST['question'])?$_POST['question']:'';
    $ans1 = isset($_POST['ans1'])?$_POST['ans1']:'';
    $ans2 = isset($_POST['ans2'])?$_POST['ans2']:'';
    $ans3 = isset($_POST['ans3'])?$_POST['ans3']:'';
    $ans4 = isset($_POST['ans4'])?$_POST['ans4']:'';
    $correct = isset($_POST['correct'])?$_POST['correct']:'';
$sql = "SELECT * FROM admin WHERE 
`test-name`='".$tname."' AND `question`='".$question."'AND `answer1`='".$ans1."'AND `answer2`='".$ans2."'AND `answer3`='".$ans3."'AND `answer4`='".$ans4."'AND `right-answer`='".$correct."'";
}
?>
<?php 
echo "<h1>$tname</h1><br>";
echo "<h2>$question</h2><br>";
echo "<h3>$ans1</h3><br>";
echo "<h3>$ans2</h3><br>";
echo "<h3>$ans3</h3><br>";
echo "<h3>$ans4</h3><br>";
echo "<h3>$correct</h3><br>";
?>
<?php
}
?>
<?php
function result(){
?>
<form action="" method="POST">
    <h1><?php $tname?></h1>
    <h2><?php $question ?></h1>
    <!--<input type="radio"><?php $ans1?>
    <input type="radio"><?php $ans2?>
    <input type="radio"><?php $ans3?>
    <input type="radio"><?php $ans4?>-->
<?php   
}
?>



<!doctype html>
<head>
<link rel="stylesheet" href="style.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$('#ad').click(function(){
    $('#tpanel').show();
    $('#adpanel').hide();
})
</script>
</head>
<body>
<form action="" method="POST">
<button class="h2" name="tpanel" id="tpanel">Test_Panel</button>
<button class="h2" name="adminpanel" id="adpanel">Admin_Panel</button>
</form>
</body>
</html>

<!--<html>
<head>
<title>Test_platform</title>
<link rel="stylesheet" href="style.css">  
</head>
<body>
<?php
if($_SESSION['userdata']['username']) {
?>
<h1 class="h1">Test_Platform<h1>
Welcome <?php echo $_SESSION['userdata']['username']; ?> you can select only one out of 4.

<?php
}else echo "<h1>Please login first .</h1>";
?>
</body>
</html>-->
