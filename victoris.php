<?php
require("header.php");
require("head.php");
$victoin_id =$_GET['v_id'];
$res = $db->query("SELECT * FROM `questions` WHERE `vict_id`= $victoin_id");
$questions = $res->fetchAll();

if(!isset($_SESSION['click'])){
    $_SESSION['click'] = 0;
    $_SESSION['score']= 0;
}

$id = $_SESSION['click'];
$q = $questions[$id];
if($id >= count($questions)){
?>
<div class="vict_end">
 <h3 class="vict_title">Поздравляю, вы прошли викторину!</h3>
 <h4 class="vict_res">Ваш результат: </h4>
<p class="vict_score" style="margin-bottom: 30px"><span class="user_score"><?=$_SESSION['score']?></span> из <span class="all_q"><?=count($questions)?></span></p>
<a href="study.php" class="btn" > Вернуться к викторинам</a>

</div>
<h3 style="margin:30px 0">Правильные ответы: </h3>
<?php
 foreach($questions as $q){
    $r_a = $q['right_ans'];
    $q_id = $q['id'];
    $user_ans = $_SESSION['user_ans'][$q_id];  
    $right_ans_text_id = $r_a.'_ans';
    $right_ans_text = $q[ $right_ans_text_id];
?>
<div class="ques_block_wrap"  style="background:<?= ($user_ans == $r_a) ? '#79eeb6c9' : '#f38282c9' ?>">
<h4><?=$q["question_text"]?></h4>
<div class="ques_block">
    <?php
     if(isset($q['img'])){
    ?>
    <img src="<?=$q['img']?>" alt="" class="ques_img">
    <?php
     }
    ?>
    <div class="ques_options">
        
        <p class="quest_op op_1 <?=($user_ans == 1) ? 'chozen_1' : ''?>"><?=$q['1_ans']?></p>
        <?php
         if(isset($q['2_ans'])){
        ?>
        <p class="quest_op op_2 <?=($user_ans == 2) ? 'chozen_2' : ''?>"><?=$q['2_ans']?></p>
        <?php
         }
         if(isset($q['3_ans'])){
        ?>
        <p class="quest_op op_3 <?=($user_ans == 3) ? 'chozen_3' : ''?>"><?=$q['3_ans']?></p>
        <?php
         }
         if(isset($q['4_ans'])){
        ?>
        <p class="quest_op op_4 <?=($user_ans == 4) ? 'chozen_4' : ''?>"><?=$q['4_ans']?></p>
        <?php
         }
         ?>
    </div>
    
</div>
<?php
     if($r_a !=  $user_ans){
       echo "<p class='rigth_ans'> Правильный ответ: <span>".$right_ans_text."</span></p>";
     }
    ?>
</div>
<?php
}
?>
<?php
 unset( $_SESSION['score']);
 unset($_SESSION['click']);

}
else{
?>
<form action="victorin_action.php?v_id=<?=$victoin_id?>" method="post">

<div class="ques_block_wrap">
<p>Вопрос: <span style="color: #ffb440"><?=$_SESSION['click'] + 1?></span> из <?=count($questions)?></p>
<h4><?=$q["question_text"]?></h4>
<div class="ques_block">
    <?php
     if(isset($q['img'])){
    ?>
    <img src="<?=$q['img']?>" alt="" class="ques_img">
    <?php
     }
    ?>
    <div class="ques_options">
        <input type="submit" name="1" value="<?=$q['1_ans']?>" id="rop1" class="quest_op op_1">
         
       <?php
        if (isset($q['2_ans'])){
       ?>
            <input type="submit" name="2"  id="rop2" value="<?=$q['2_ans']?>" class="quest_op op_2">
       <?php
        }
       ?>
       <?php
       if (isset($q['3_ans'])){
       ?>
            <input type="submit" name="3" value="<?=$q['3_ans']?>" id="rop3" class="quest_op op_3">
        <?php
        }
       ?>
       <?php
       if (isset($q['4_ans'])){
       ?>
            <input type="submit" name="4" value="<?=$q['4_ans']?>" id="rop4" class="quest_op op_4">
        <?php
        }
       ?>
    </div>
</div>
</div>
<?php

?>



<?php
}

unset($_POST['subm_btn']);

?>
</form>
</div>
</section>
<?php 
 require('footer.php');
 ?>