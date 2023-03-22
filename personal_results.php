<?php
require("header.php");
$id = $_GET['v_id'];
$res = $db -> query('SELECT * FROM `results` WHERE `vict_id` ='.$id);
$results = $res -> fetchAll();
$res = $db -> query('SELECT * FROM `victorins` WHERE `id` ='.$id);
$vict = $res -> fetch();
$name = $vict['name'];
$category = $vict['category'];
$res = $db -> query('SELECT * FROM `questions` WHERE `vict_id` = '.$id);
$quest = $res -> fetch();

?>
 <h3 class="personal_name"><?=$name?></h3>
 <h4 style="margin-bottom:20px" class="personal_cat"><span> Категория: </span><?=$category?></h4>
  <table >
    <thead>
        <tr>
      <th>Дата</th>
      <th>Ученик</th>
      <th>Правильно</th>
      <th>Неправильно</th>
      <th>Процент</th>
      </tr>
   </thead>
    <tbody>
        <?php
        foreach($results as $stud){
        $date = $stud['date'];
        $name = $stud['student_name'];
        $right_ans = $stud['right_ans'];
        $wrong_ans = $stud['wrong_ans'];
        ?>
        <tr>
            <td><?=date("H:i d/m/Y ", strtotime($date))?></td>
            <td><?=$name?></td>
            <td><?=$right_ans?></td>
            <td><?=$wrong_ans?></td>
            <td><?=round($right_ans/count($quest)*100)?>%</td>
        </tr>
        <?php
        }
        ?>
    </tbody>
  </table>
<a href="personal_cab.php" class="subm_category" style="max-width:200px">Назад</a>
</section>
<?php
require("footer.php");
?>