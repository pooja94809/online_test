<?php 
session_start();
require "config.php";
$errors = array();
$message = '';

if (isset($_POST['login'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';

    if(sizeof($errors)==0) {
        $sql = "SELECT * FROM data WHERE 
        `username`='".$username."' AND `password`='".$password."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $_SESSION['userdata'] = array('username'=>$row['username']);
                header('Location: admin.php');
            }
        } else {
            $errors[] = array('input'=>'form','msg'=>'Invalid login details');
            echo "<script>alert('Invalid login details!!');</script>"; 
        }

        $conn->close();
    }
}
if (isset($_POST['register'])) {
    $username = isset($_POST['name'])?$_POST['name']:'';
    $email = isset($_POST['id'])?$_POST['id']:'';
    $password = isset($_POST['pass'])?$_POST['pass']:'';
    $repassword = isset($_POST['repass'])?$_POST['repass']:'';
    if ($password != $repassword) {
        $errors[] = array('input'=>'password','msg'=>'password doesnt match');
        echo "<script>alert('re-password does not match !');</script>"; 
    }

    if(sizeof($errors)==0) {
        $sql = "INSERT INTO data(`username`,  `email_id`,`password`) VALUES('".$username."','".$email."','".$password."')";
        //echo $sql;
    

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[] = array('input'=>'form','msg'=>$conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Online_test_platform</title>
        <link rel="stylesheet" href="style.css">  
    </head>
    <body>
        <h1 class="h1">Online Test Platform</h1>
        <div class="login-page">
            <div class="form">
                <form  class="login-form" action="" method="POST">
                    <input type="text"  name="username" placeholder="Username"/>
                    <input type="password" name="password" placeholder="password"/>
                    <button name="login">Login</button>
                    <p class="msg"><a href="#" class="msg" id="register">Register</a></p>
                </form>
                <form class="register-form" action="" method="POST">
                    <input type="text" name="name" placeholder="Username"/>
                    <input type="text" name="id" placeholder="Email_id"/>
                    <input type="password" name="pass" placeholder="password"/>
                    <input type="password" name="repass" placeholder="re-enter password"/>
                    <button name="register">Register</button>
                    <p class="msg"><a href="#" class="msg" id="login">Login</a></p>
                </form>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>
                $('#register').click(function(){
                    $('.register-form').show();
                    $('.login-form').hide();
                    })
                </script>
                <script>
                $('#login').click(function(){
                    $('.register-form').hide();
                    $('.login-form').show();
                    })
                </script>
            </div>
        </div>
    </body>
</html>