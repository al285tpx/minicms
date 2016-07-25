<?php
class delete_category extends ACore_admin {
    public function obr() {
        if($_GET['del']) {
           $id_category = (int)$_GET['del'];
           
           $query = "DELETE FROM category WHERE id_category='$id_category'";
           
           if(mysql_query($query)) {
               $_SESSION['res'] = "Удалено";
               header("Location:?option=edit_category");
               exit();
           }
        else {
               exit("Ошибка удаления");
        }
        }
        else {
            exit("Не верные данные для этой страницы");
        }
    }
    
    public function get_content() {
        
    }
}

