<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="owl.carousel.min.css">
 <link rel="stylesheet" href="owl.theme.default.min.css">
    <script src="https://kit.fontawesome.com/dcaaef838d.js" crossorigin="anonymous"></script>
    <title>Victoris</title>
</head>
<body>
  <div class="container">
    <div class="header">
    <?php
              require("head.php");
              unset($_SESSION['score']);
              unset($_SESSION['click']);
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
              <a href="" class="user_name" id='user_name'>
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
        <?php
        session_start();
        ?>
        <div class="main">
          <div class="main_item">
            <h1 class="main_text"><span class="main_orange">Создавай</span>,  играй,  обучайся!</h1>
            
            <a href="fill.php" class="btn btn_main">
                Создать
            </a>
            <div class="space"></div>
            <a href="study.php" class="btn wh btn_main">
                Учиться
            </a>
            </div>
            <div class="main_item">
              <img src="img/main.svg" alt="" class="main_img">
            </div>
        </div>
    </div>
    <section class="fill">
      <div class="container">
      <div class="owl-carousel owl-theme" id="slider">
    <!--Слайд 1-->
   <div class="slide">
    <h3>Создание викторин</h3>
    <div class="slide_sub">
      <p class="slide_item slide_item_1">1.Перейти в раздел <a href="fill.php" class="btn" style="font-size:24px">создать</a></p>
      <p class="slide_item slide_item_2">2.Скачать шаблон викторины</p>
      <p class="slide_item slide_item_3">3.Загрузить шаблон на сайт</p>
    </div>
   </div>

   <div class="slide">
    <h3>Участие в викторине режиме "Самоподготовка"</h3>
    <div class="slide_sub">
      <p class="slide_item slide_item_1">1.Перейти в раздел  <a href="study.php" class="btn wh" style="font-size:24px">Учиться</a></p>
      <p class="slide_item slide_item_2">2.Выбрать интересующую викторину</p>
      <p class="slide_item slide_item_3">3.Нажать на кнопку "Самоподготовка"</p>
    </div>
   </div>

   <div class="slide">
    <h3>Участие в режиме "Классная работа"</h3>
    <div class="slide_sub">
      <p class="slide_item slide_item_1">1.Перейти в раздел <a href="study.php" class="btn wh" style="font-size:24px">Учиться</a></p>
      <p class="slide_item slide_item_2">2.Выбрать интересующую викторину или ввести её название в поле "поиск"</p>
      <p class="slide_item slide_item_3">3.Нажать на кнопку "Классная работа"</p>
    </div>
   </div>

   <div class="slide">
    <h3>Результаты викторин</h3>
    <div class="slide_sub">
      <p class="slide_item ">1. <a href="enter.php" class="btn">Войти</a> в аккаунт</p>
      <p class="slide_item ">2.Перейти в <a href=<?=(isset($_SESSION['user_id'])) ? "personal_cab.php" : "enter.php"?> class="btn"> Личный кабинет</a></p>
      <p class="slide_item ">3.Выбрать интересующую викторину</p>
      <p class="slide_item ">4.Нажать на кнопку "результаты"</p>
    </div>
   </div>
    <!--Остальные слайды-->
  
</div>
      </div>

    </section>

<?php
require('footer.php')
?>