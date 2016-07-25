<?php

class update_menu extends ACore_admin {
    //пишем метод обработчика формы ввода
    protected function obr() {
           
        $id = $_POST['id'];
        $title = $_POST['title'];
        $text = $_POST['text'];
               
        //делаем проверку заполнения обязатедльных полей
        if(empty($title) || empty($text)) {
            exit("Не заполнены обязательные поля");
        }
        $query = " UPDATE menu SET name_menu='$title',text_menu='$text'WHERE id_menu='$id'";
        
        if(!mysql_query($query)) {
            exit(mysql_error());
        }
        else {
          $_SESSION['res'] = "Изменения сохранены";
          header('Location:?option=edit_menu');
          exit();
        }
    }

        public function get_content() {
            
        if($_GET['id_text']){
            $id_menu = (int) $_GET['id_text'];
        }    
        else {
            exit("Не правильные данные для этой статьи");
        }
        $menu = $this->get_text_menu($id_menu);
        echo "<div id='main'>";
        if($_SESSION['res']) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        }
               
        //выводим форму редактирования статьи
print <<<HEREDOC
<form method='POST'>
<p>Заголовок меню:<br />
<input type='text' name='title' style='width:420px' value='$menu[name_menu]'>
<input type='hidden' name='id' style='width:420px' value='$menu[id_menu]'>        
<p>Меню:<br />
<textarea name='text' cols='50' rows='7'>$menu[text_menu]</textarea>
</p>
<p><input type='submit' name='buttom' value='Сохранить'></p></form></div></div>
HEREDOC;
    }
}


