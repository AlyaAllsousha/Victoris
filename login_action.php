<?php

require('head.php');
$email=$_POST['email'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$name = $_POST['name'];
$query = $db->prepare("SELECT * FROM `users` WHERE `email` =:email");
$query->bindParam("email", $email, PDO::PARAM_STR);
$query->execute();
if ($query->rowCount() > 0){
    echo '<p>Этот адрес уже зарегестрирован</p>';
}
if ($password1 == $password2 && !empty($email) && !empty($password1) && !empty($name)){
    $db -> prepare('INSERT INTO `users`(`name`,`email`, `password`) VALUES (?, ?, ?)')
    ->execute([$name, $email, password_hash($password1, PASSWORD_BCRYPT),]);
    $query = $db->prepare("SELECT * FROM `users` WHERE `email` =:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();  
    $_SESSION['user_id'] = $user['id'];
    header("Location: index.php");
}
else{
    echo '<p>пароль не совпал или не все поля заполнены</p>';
}
