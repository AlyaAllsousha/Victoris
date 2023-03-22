
<?php
            require("header.php");

            if(isset($_POST['subm'])){
                $_SESSION['name'] = $_POST['name'];
                $id = $_GET['v_id'];
                if($_GET['type'] == 'self'){
                    header("Location: victoris.php?v_id=".$id);
                }
                elseif($_GET['type'] == 'class'){
                    header("Location: victoris_class.php?v_id=".$id);
                }
            }
            ?>
           <div class="enter_block">
            <form class="form_enter" action="" method="post">
                <h2 class="enter_name">Имя участника</h2>
                <input type="text" name="name" class="enter_input" placeholder="Имя">
                <input name="subm" type="submit" value="Далее" class="btn">
            </form>
           </div>
           </section>
           <?php 
            
 require('footer.php');
 ?>