<?php

/**
 * Description of add_statti
 *
 * @author Пользователь
 */
class add_category extends ACore_admin {
    //пишем метод обработчика формы ввода
    protected function obr() {
       
        $title = $_POST['title'];
              
        
        //делаем проверку заполнения обязатедльных полей
        if(empty($title)) {
            exit("Не заполнены обязательные поля");
        }
        $query = " INSERT INTO category 
                     (name_category)
                   VALUES ('$title')";
        
        if(!mysql_query($query)) {
            exit(mysql_error());
        }
        else {
          $_SESSION['res'] = "Изменения сохранены";
          header('Location:?option=add_category');
          exit();
        }
    }

        public function get_content() {
    
        echo "<div id='main'>";
        if($_SESSION['res']) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        }
               
        //выводим форму редактирования статьи
print <<<HEREDOC
<form method='POST'>
<p>Заголовок статьи:<br />
<input type='text' name='title' style='width:420px'>
<p><input type='submit' name='buttom' value='Сохранить'></p></form>
</div></div>
HEREDOC;
    }
}


