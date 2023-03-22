<?php
 require('head.php');
$victoin_id =$_GET['v_id'];
$res = $db->query("SELECT * FROM `questions` WHERE `vict_id`= $victoin_id");
$questions = $res->fetchAll();

if(!isset($_SESSION['user_ans'])){
    $_SESSION['user_ans'] = [];
}
if((isset($_POST['1']) ||isset($_POST['2']) || isset($_POST['3']) || isset($_POST['4'])) &&  $_SESSION['click'] < count($questions)){
    
    $id_prev = $_SESSION['click'];
    $q_prev = $questions[$id_prev];
    $right_ans = $q_prev['right_ans'];
    if(isset($_POST['1']) ){
       if($right_ans == 1){
            $_SESSION['score'] +=1;
       }
       $_SESSION['user_ans'][$q_prev['id']] = 1;
    }
    elseif(isset($_POST['2']) ){
        if($right_ans == 2){
             $_SESSION['score'] +=1;
        }
        $_SESSION['user_ans'][$q_prev['id']] = 2;
     }
     elseif(isset($_POST['3']) ){
        if($right_ans == 3){
             $_SESSION['score'] +=3;
        }
        $_SESSION['user_ans'][$q_prev['id']] = 3;
     }
    elseif(isset($_POST['4']) ){
        if($right_ans == 4){
             $_SESSION['score'] +=4;
        }
        $_SESSION['user_ans'][$q_prev['id']] = 4;
     }
    
    $_SESSION['click'] += 1;
}
if($_SESSION['click'] >= count($questions) - 1){
    if(isset($_SESSION['user_id'])){
   $u_id = $_SESSION['user_id'];
   $res = $db -> query("SELECT * FROM `users` WHERE `id`=".$u_id);
   $user = $res->fetch();
   $name = $user['name'];
    }
    else{
        $name = $_SESSION['name'];
    }
   $right_ans = $_SESSION['score'];
   $wrong_ans = count($questions) - $right_ans;
   $db -> prepare('INSERT INTO `results`(`student_name`, `vict_id`, `right_ans`, `wrong_ans`) VALUES (?, ?, ?, ?)')
       -> execute([$name, $victoin_id, $right_ans,  $wrong_ans]);
    
}
unset($_POST['subm_btn']);
header("Location:victoris.php?v_id=".$victoin_id);
?>