
            <?php
             require("header.php")
        
             ?>
           <div class="enter_block">
            <form class="form_enter" action="enter_action.php?from=<?=$_GET["from"]?>" method="post">
                <h2 class="enter_name">Вход</h2>
                <p>Авторизация необходима для создания викторин и входа в личный кабинет</p>
                <input type="text" name="email" class="enter_input" placeholder="Почта">
                <input type="password" name= "password" class="enter_input" placeholder="Пароль">
                <input type="submit" value="Войти"  class="btn wh">
            </form>
           </div>
        </div>
    </section>
 <?php 
 require('footer.php');
 ?>