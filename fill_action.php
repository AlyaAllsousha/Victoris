
<?php
require("header.php");
require("vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\IOFactory;

$fn="";
if($_FILES["file"]["error"] == 0) {
$dir="uploads/";
$filename = basename($_FILES["file"]["name"]);
$ext = strtolower(explode(".", $filename)[1]);
$accept_ext = ["xls", "xml", "xlsx"];

if(in_array($ext, $accept_ext)) {
    $tmp = $_FILES["file"]["tmp_name"];
    $fn = strtolower($dir.uniqid().".".$ext);
    move_uploaded_file($tmp, $fn);

}
else{
    echo "<p>нверное расширение</p>";
}
}

$ques = $_POST['question'];
$author_id = $_SESSION['user_id'];
$vict_name = $_POST['name'];
$vict_cat=$_POST['category'];

$query = $db->prepare("SELECT * FROM `victorins` WHERE `name` =:email");
$query->bindParam("email", $vict_name, PDO::PARAM_STR);
$query->execute();
if ($query->rowCount() > 0){
    echo '<p>Этот имя уже существует</p>';
}
elseif(empty($vict_name) || empty($vict_cat)){
    echo "<p> У викорины должны быть имя, категория и вопросы</p>";
}
elseif(!isset($filename)){
   echo 'Нет файла';
}
else{
    $db->prepare('INSERT INTO `victorins`( `author_id`, `name`, `category`) VALUES (?, ?, ?)')
    -> execute([$author_id, $vict_name, $vict_cat]);
    if($ext == 'xlsx'){
    $reader = IOFactory::createReader('Xlsx');
    }
    elseif($ext == "xls"){
        $reader = IOFactory::createReader('Xls');
    }
    $spreadsheet = $reader->load($fn);
    $data = $spreadsheet->getActiveSheet()->toArray();
    $query = $db->prepare("SELECT * FROM `victorins` WHERE `name` =:email");
    $query->bindParam("email", $vict_name, PDO::PARAM_STR);
    $query->execute();   
    $vict_id = $query->fetch();
    $vict_id = $vict_id['id'];
    echo $vict_id;
    echo "<br>";
    for($i = 1; $i < count($data); $i ++){
       $q = $data[$i][0];
       $a1 = $data[$i][1];
       $a2 = $data[$i][2];
       $a3 = $data[$i][3];
       $a4 = $data[$i][4];
       $right_ans = $data[$i][5];
       $img = $data[$i][6];
       if(empty($img)){
        $img ="img/replace_img.png";
       }

       $db -> prepare('INSERT INTO `questions`(`vict_id`, `1_ans`, `2_ans`, `3_ans`, `4_ans`, `right_ans`, `question_text`, `img`) VALUES (?, ?, ?, ?,?, ?,?, ?)')
           -> execute([$vict_id, $a1, $a2, $a3, $a4, $right_ans,$q, $img ]);
       }
    
   unlink($fn);
   header("Location:index.php");
}


?>
<a href="fill.php" class="btn"> Переименовать</a>

