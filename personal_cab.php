<?php
 require('header.php');
 $res  =$db ->prepare('SELECT * FROM `victorins`  WHERE `author_id`= :id  ORDER BY `id` DESC');
 $res -> bindParam("id", $_SESSION['user_id'], PDO::PARAM_STR);
 $res ->execute();
 $victs = $res -> fetchAll();
?>

<?php
 if($victs){
foreach($victs as $vict){
  $id = $vict['id'];
  $res= $db->prepare('SELECT * FROM `questions` WHERE `vict_id`=:id');
  $res->bindParam('id', $id, PDO::PARAM_STR);
  $res->execute();
  if($res -> rowCount() > 0){
  $res= $db->prepare('SELECT * FROM `questions` WHERE `vict_id`=:id');
  $res->bindParam('id', $id, PDO::PARAM_STR);
  $res->execute();
  $ques = $res ->fetch();
  $img = $ques['img'];
    $name = $vict['name'];
    $category =  $vict['category'];
?>

   <div class="ques_block_wrap personal">
    <img src="<?=$img?>" alt="" class="personal_img">
    <div class="personal_text">
    <h3 class="personal_name"><?=$name?></h3>
    <h4 class="personal_cat"><span> Категория: </span><?=$category?></h4>
    <a href="personal_results.php?v_id=<?=$id?>" class="btn wh" style="margin-left:0">Результаты</a>
    </div>
    <div class="btn_personal_wrap">
     <a href="delete.php?id=<?=$id?>" class="btn">Удалить</a>
     <a href="change.php?id=<?=$id?>" class="btn"> Изменить</a>      
    </div>
   </div> 
  <?php
 }
}
 }
else{
?>
 <div class="form_personal">
  <h4 >У вас ещё нет викторин</h4>
  
  <?php
  }?>
  <form   action="fill.php" method="post">
  <input class="subm_category" type="submit" value="Cоздать новую викторину">
  </form>
  </div>
 </div>
</section>
<?php
require('footer.php');
?>