<?php

/**
 * Description of newPHPClass
 *
 * @author Пользователь
 */
class edit_menu extends ACore_admin {
    
    public function get_content() {
        
        $query = "SELECT id_menu, name_menu FROM menu";
        $result = mysql_query($query);
        if (!$result) {
            exit(mysql_error());
        }
        echo "<div id='main'>";
        echo "<a style='color:red' href='?option=add_menu'>Добавить новый пункт меню</a><hr>";
         if($_SESSION['res']) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        }
        
        $row = array();
        for ($i=0; $i < mysql_num_rows($result);$i++) { //цикл будет вытаскивать содержимое БД пока $i не станет меньше количества строк в $result 
          $row = mysql_fetch_array($result, MYSQL_ASSOC);
          printf("<p style='font-size:14px;'>
              <a style='color:#585858' href='?option=update_menu&id_text=%s'>%s</a> |
              <a style='color:#red' href='?option=delete_menu&del=%s'>Удалить</a>
              </p>", $row['id_menu'], $row['name_menu'], $row['id_menu']);
        }
        
        
        
        echo "</div></div>";
    }

}
