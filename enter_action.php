<?php
require('head.php');
$email = $_POST['email'];
$password = $_POST['password'];
$query = $db->prepare('SELECT * FROM `users` WHERE `email` = :email');
$query ->bindParam('email', $email, PDO::PARAM_STR);
$query->execute();
$log_in = false;
$res = $query->fetch();
if (!$res){
    echo '<p>Неверные пароль или имя пользователя</p>';
}
else{
    if (password_verify($password, $res['password'])){
        $_SESSION['user_id'] = $res['id'];
        echo '<pre>Поздравляю, вы прошли авторизацию</pre>';
        if($_GET['from'] == "fill"){
            header("Location:fill.php");
        }
        else{
            header("Location: index.php");
        }
    }
    else{
        echo '<p>Неверные пароль или имя пользователя</p>';
    }
}

