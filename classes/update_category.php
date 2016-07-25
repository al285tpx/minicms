<?php

class update_category extends ACore_admin {
    //пишем метод обработчика формы ввода
    protected function obr() {
           
        $id = $_POST['id'];
        $title = $_POST['title'];
                       
        //делаем проверку заполнения обязатедльных полей
        if(empty($title)) {
            exit("Не заполнены обязательные поля");
        }
        $query = " UPDATE category SET name_category='$title' WHERE id_category='$id'";
        
        if(!mysql_query($query)) {
            exit(mysql_error());
        }
        else {
          $_SESSION['res'] = "Изменения сохранены";
          header('Location:?option=edit_category');
          exit();
        }
    }

        public function get_content() {
            
        if($_GET['id_text']){
            $id_category = (int) $_GET['id_text'];
        }    
        else {
            exit("Не правильные данные для этой категории");
        }
        $category = $this->get_text_category($id_category);
        echo "<div id='main'>";
        if($_SESSION['res']) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        }
               
        //выводим форму редактирования 
print <<<HEREDOC
<form method='POST'>
<p>Заголовок меню:<br />
<input type='text' name='title' style='width:420px' value='$category[name_category]'>
<input type='hidden' name='id' style='width:420px' value='$category[id_category]'>        
<p><input type='submit' name='buttom' value='Сохранить'></p></form></div></div>
HEREDOC;
    }
}



