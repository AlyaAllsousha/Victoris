<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/dcaaef838d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
 <section class="fill">
    <div class="container">
   <div class="header">
            <?php
              require("head.php");
              if(isset($_POST['search_btn'])){
                $search = trim($_POST['search']);
                $res = $db->query("SELECT * FROM `victorins` WHERE `name` LIKE '%$search%' OR `category` LIKE '%$search%'  ORDER BY `id` DESC");
                $_SESSION['flag'] = True;
                if($res -> rowCount() > 0){
                  $_SESSION['victs'] = $res -> fetchAll();
                }
                else{
                  unset($_SESSION['victs']);
                }
                header("Location:study.php");
              }
            ?>
                <div class="header_inner">
                <div class="logo">
                    <a href="index.php"><img src="img/logo.svg" alt="sd"></a>
                </div>
                <div class="header_item">
                <form action="" method="POST" class="vict_search_block">
                    <input name="search" type="text" class="search_category" placeholder="название викторины" >
                    <button name="search_btn" type="submit" class="search_vict_btn"></button>
                  </form>
                <?php
                 if(!isset($_SESSION['user_id'])){
                ?>
                <div class="btn_wrap">
                <a href="login.php" class="btn wh">
                    Регистрация
                </a>
                <a href="enter.php" class="btn">
                    Войти
                </a>
                </div> <!--btn_wrap-->
                <?php
                 }
                 else{
                ?>
                <a href="personal_cab.php" class="user_name" id="user_name">
                <i class="fa-regular fa-user"></i>
      
                    <?php
                   $id = $_SESSION['user_id'];
                   $res = $db->prepare("SELECT * FROM `users` WHERE `id` =:id");
                   $res->bindParam('id', $id, PDO::PARAM_STR);
                   $res ->execute();
                   $user = $res -> fetch();
                   echo $user['name'];
                  ?>
                  </a>
                  <div class="enter_mode " id ='enter_mode'>
                    <a href="personal_cab.php" class="btn"> Личный кабинет</a>
                    <a href="out.php" class="btn wh"> выход</a>
                 </div>
                <?php
                 }
                ?>
                </div>
                  </div><!--header_inner-->
                </div>
      