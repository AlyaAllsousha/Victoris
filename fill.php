
               <?php

                  require("header.php");
                  if (!isset($_SESSION['user_id'])){
                     header("Location: enter.php?from=fill");

                  }
                  else{
               ?> <div class="category_block">
                     <form action="fill_action.php" method="post" enctype="multipart/form-data">

                     
                             
                              <h3 class="category">Название</h3>
                              <input name="name"  type="text" class="search_category">
                              <h3 class="category">Категория</h3>
                              <input name = "category" type="text" class="search_category">
                              <h3 class="category">Добавить exсel-файл с викторииной</h3>
                              <a href="New.xlsx" class="download" download="шаблон excel">
                                  <img src="img/pngegg.png" alt="">
                                  <p>скачать шаблон таблицы</p>
                              </a>
                              <input type="file" name="file"  class="search_category">
                              <input class="subm_category" type="submit" value="Сохранить">
                     </form>
                     </div>

               <?php
                  }     
            ?>
            </div>
            </section>
            <?php 
         require('footer.php');
         ?>