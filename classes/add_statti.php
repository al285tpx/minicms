<?php

/**
 * Description of add_statti
 *
 * @author Пользователь
 */
class add_statti extends ACore_admin {
    //щпишем метод обработчика формы ввода
    protected function obr() {
        //проверяем содержит ли $_FILES данные загружаемого изображения
        if (!empty($_FILES['img_src']['tmp_name'])) {
            //если фаил загружен через форму перемещаем его на сервер
            if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'file/'.$_FILES['img_src']['name'])) {
                exit("Не удалось загрузить изображение");
            }
            $img_src = 'file/'.$_FILES['img_src']['name'];
        }
        else {
        exit("Необходимо загрузить изображение");
        }
        
        $title = $_POST['title'];
        $date = date("Y-m-d", time());
        $discription = $_POST['discription'];
        $text = $_POST['text'];
        $cat = $_POST['cat'];
        
        //делаем проверку заполнения обязатедльных полей
        if(empty($title) || empty($text) ||empty($discription)) {
            exit("Не заполнены обязательные поля");
        }
        $query = " INSERT INTO statti 
                     (title,img_src,date,text,discription,cat)
                   VALUES ('$title','$img_src','$date','$text','$discription',$cat)";
        
        if(!mysql_query($query)) {
            exit(mysql_error());
        }
        else {
          $_SESSION['res'] = "Изменения сохранены";
          header('Location:?option=add_statti');
          exit();
        }
    }

        public function get_content() {
    
        echo "<div id='main'>";
        if($_SESSION['res']) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        }
        $cat = $this->get_categories();
        
        //выводим форму редактирования статьи
print <<<HEREDOC
<form enctype='multipart/form-data' action='' method='POST'>
<p>Заголовок статьи:<br />
<input type='text' name='title' style='width:420px'>
<p>Изображение:<br />   
<input type='file' name='img_src'>
</p>
<p>Краткое описание:<br />
<textarea name='discription' cols='50' rows='7'></textarea>
</p>
<p>Текст:<br />
<textarea name='text' cols='50' rows='7'></textarea>
</p>
<select name='cat'>
HEREDOC;
foreach ($cat as $item) {
    echo "<option value='".$item['id_category']."'>".$item['name_category']."</option>";
}
echo "</select><p><input type='submit' name='buttom' value='Сохранить'></p></form>";
echo "</div></div>";
    }
}
