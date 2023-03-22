<?php
 require('header.php');
 $id = $_GET['id'];
 $res  =$db ->prepare('SELECT * FROM `questions` WHERE `vict_id`= :id');
 $res -> bindParam("id", $id, PDO::PARAM_STR);
 $res ->execute();
 $questions = $res -> fetchAll();

if(!isset($_SESSION['array'])){
    $_SESSION['array']=[];
}
else{
    foreach($questions as $k => $q)
    $a1 = $_SESSION['array'][$k]['a1'];

}
?>
   <form action="" method="post">

<?php
 foreach($questions as $q){
    $_SESSION['array']=[];
    $id = $q['id'];
    $quest = $q['question_text'];
    $a1 = $q ['1_ans'];
    $a2 = $q ['2_ans'];
    $a3 = $q ['3_ans'];
    $a4 = $q ['4_ans'];
    $right_ans = $q ['right_ans'];
    $img = $q['img'];
?>

<div class="ques_block_wrap" style="display: flex; flex-direction:column;">
    <img src="<?=$img?>" alt="" class="personal_img" style="margin-bottom:20px">
    <input style="margin-bottom: 20px; max-width:500px" class="option" type="text" name="quest" id="" value="<?=$quest?>">

        <label class="change_label"><input type="radio" <?= ($right_ans == 1) ? 'checked' : ''?> value="1" name="<?=$id?>"><input class=" option" type="text" name="ans[]" id="" value="<?=$a1?>"></label>
        <label class="change_label"><input type="radio" <?= ($right_ans == 2) ? 'checked' : ''?> value="2" name="<?=$id?>"><input class=" option" type="text" name="ans[]" id="" value="<?=$a2?>"></label>
        <label class="change_label"><input type="radio" <?= ($right_ans == 3) ? 'checked' : ''?> value="3" name="<?=$id?>"><input class=" option" type="text" name="ans[]" id="" value="<?=$a3?>"></label>
        <label class="change_label"><input type="radio" <?= ($right_ans == 4) ? 'checked' : ''?> value="4" name="<?=$id?>"><input class=" option" type="text" name="ans[]" id="" value="<?=$a4?>"></label>
     <?php
      if(isset($_POST[$id]) && ($_POST[$id]) != $right_ans){
        $new_right_ans = $_POST[$id];
        $right_ans = $new_right_ans;
      }
      $a1_new = $_POST['ans'][0];
      $a2_new = $_POST['ans'][1];
      $a3_new = $_POST['ans'][2];
      $a4_new = $_POST['ans'][3];
      $new_quest = $_POST['quest'];
    $_SESSION['array'][$id] = [
        'a1' => $a1_new,
        'a2' => $a2_new,
        'a3' => $a3_new,
        'a4' => $a4_new,
        'r_a' => $right_ans,
        'quest' =>$new_quest
    ];
   
    foreach($_SESSION['array'][$id] as $q){
  
       echo $q;
       echo "<br>";
      
   }
 
    ?>
   
  </div>
  <?php
 }

  ?>
 <input class="subm_category" type="submit" value="Сохранить">

  </form>
  </section>
<?php

require("footer.php");
?>