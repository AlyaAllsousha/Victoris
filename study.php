
            <?php
             require("header.php");
             unset($_SESSION['click']);
             unset($_SESSION['name']);


            $res = $db->query("SELECT * FROM `victorins` ORDER BY `id` DESC");
            $victories = $res->fetchAll();
            $id = $_SESSION['user_id'];
            $res = $db->prepare("SELECT * FROM `users` WHERE `id` =:id");
            $res->bindParam('id', $id, PDO::PARAM_STR);
            $res ->execute();
            $user = $res -> fetch();
            $name = $user['name'];

            if(isset($_SESSION['victs'])){
                $victories = $_SESSION['victs'];
            }

            
            if($victories && !$_SESSION['flag'] || $_SESSION['flag'] && isset($_SESSION['victs'])){
              foreach($victories as $victory){

                $id = $victory['id'];
                $res= $db->prepare('SELECT * FROM `questions` WHERE `vict_id`=:id');
                $res->bindParam('id', $id, PDO::PARAM_STR);
                $res->execute();
                if($res -> rowCount() > 0){
                $res= $db->prepare('SELECT * FROM `questions` WHERE `vict_id`=:id');
                $res->bindParam('id', $id, PDO::PARAM_STR);
                $res->execute();
                $ques = $res ->fetch();
                $img = $ques['img'];

                $id_a = $victory['author_id'];
                $res = $db->prepare('SELECT * FROM `users` WHERE `id`=:id');
                $res ->bindParam('id', $id_a, PDO::PARAM_STR);
                $res->execute();
                $author = $res->fetch();
                if(isset($_SESSION['user_id'])){
                    
                    $href_self = 'victoris.php?v_id='.$id.'&&type=self';
                    $href_class = 'victoris_class.php?v_id='.$id.'&&type=class';
                }
                else{
                    $href_self = 'take_part.php?v_id='.$id.'&&type=self';
                    $href_class = 'take_part.php?v_id='.$id.'&&type=class';
                }
            ?>
           <h4 class="cat_name"><?=$victory['category']?></h4>
           <h2 class="vic_name"><?=$victory['name']?></h2>
           <div class="vic_item">
            <div class="img_wrap">
            <img src="<?=$img?>" alt="" class="vict_img">
            </div>
            <div class="vict_btns">
            <a href="<?=$href_class?>" class="btn btn_vic">Классная работа</a>
            <a href="<?=$href_self?>" class="btn wh btn_vic">Само-подготовка</a>
           </div>
        </div>
         <div class="vict_author">Автор: <?=$author['name']?></div>
         <?php
            }
        }
        }
        else{
            echo "Ничего не найдено";
        }
        ?>
        </div>
        
    </section>
    <?php 

require('footer.php');
 ?>