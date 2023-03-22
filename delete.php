<?php
require('head.php');
require('header.php');
if(isset($_POST['yes'])){

$id = $_GET['id'];
$res = $db -> prepare("DELETE FROM `victorins` WHERE `id` = ?")
           -> execute([$id]);
header("Location:personal_cab.php");
}
elseif(isset($_POST['no'])){
    header("Location:personal_cab.php");
}
?>
<h3>Вы уверены, что хотите удалить викторину?</h3>
<form action="" method="post">
    <input name="yes" style="margin-left:0;" type="submit" value="Да" class="btn">
    <input name="no" type="submit" value="Назад" class="btn wh">
</form>
</section>
<?php
require('footer.php');
?>