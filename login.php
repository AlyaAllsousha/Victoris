
            <?php
            require("header.php");
            ?>
           <div class="enter_block">
            <form class="form_enter" action="login_action.php" method="post">
                <h2 class="enter_name">Регистрация</h2>
                <input type="text" name="name" class="enter_input" placeholder="Имя">
                <input type="text" name="email" class="enter_input" placeholder="Почта">
                <input type="text" name= "password1" class="enter_input" placeholder="Пароль">
                <input type="text" name= "password2" class="enter_input" placeholder="Повторите пароль">
                <input type="submit" value="Зарегестрироваться" class="btn">
            </form>
           </div>
           </section>
           <?php 
 require('footer.php');
 ?>